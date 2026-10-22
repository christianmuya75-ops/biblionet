<?php
class EmpruntController extends Controller
{
    public function index(): void
    {
        $this->requireAuth();
        $this->view('emprunts/index', ['emprunts' => Emprunt::enCours()]);
    }

    public function create(): void
    {
        $this->requireAuth();
        $this->afficherFormulaire(null);
    }

    public function store(): void
    {
        $this->requireAuth();
        $this->postOnly();

        $livreId = (int) ($_POST['livre_id'] ?? 0);
        $adherentId = (int) ($_POST['adherent_id'] ?? 0);

        if ($livreId <= 0 || $adherentId <= 0) {
            $this->afficherFormulaire('Choisissez un livre et un adhérent.');
            return;
        }

        if (Emprunt::create($livreId, $adherentId)) {
            $_SESSION['flash'] = 'Emprunt enregistré.';
            $this->redirect('/emprunts');
        }

        $this->afficherFormulaire("Emprunt refusé : ce livre n'a plus d'exemplaire disponible.");
    }

    public function retour($id = 0): void
    {
        $this->requireAuth();
        $this->postOnly();

        if (Emprunt::retourner((int) $id)) {
            $_SESSION['flash'] = 'Retour enregistré.';
        } else {
            $_SESSION['flash'] = 'Retour impossible : emprunt introuvable ou déjà rendu.';
        }
        $this->redirect('/emprunts');
    }

    private function afficherFormulaire(?string $erreur): void
    {
        $this->view('emprunts/form', [
            'livres'    => Emprunt::livresDisponibles(),
            'adherents' => Emprunt::adherents(),
            'erreur'    => $erreur,
        ]);
    }

    private function postOnly(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/emprunts');
        }
    }
}