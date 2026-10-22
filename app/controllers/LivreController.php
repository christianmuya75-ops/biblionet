<?php
class LivreController extends Controller
{
    public function index(): void
    {
        $this->requireAuth();
        $this->view('livres/index', ['livres' => Livre::all()]);
    }

    public function create(): void
    {
        $this->requireAuth();
        $this->view('livres/form', ['livre' => null, 'erreur' => null]);
    }

    public function store(): void
    {
        $this->requireAuth();
        $this->postOnly();
        $d = $this->donnees();
        if ($d['titre'] === '' || $d['auteur'] === '') {
            $this->view('livres/form', ['livre' => $d, 'erreur' => "Le titre et l'auteur sont obligatoires."]);
            return;
        }
        Livre::create($d);
        $_SESSION['flash'] = 'Livre ajouté.';
        $this->redirect('/livres');
    }

    public function edit($id = 0): void
    {
        $this->requireAuth();
        $livre = Livre::find((int) $id);
        if (!$livre) {
            $this->redirect('/livres');
        }
        $this->view('livres/form', ['livre' => $livre, 'erreur' => null]);
    }

    public function update($id = 0): void
    {
        $this->requireAuth();
        $this->postOnly();
        $id = (int) $id;
        $d = $this->donnees();
        if ($d['titre'] === '' || $d['auteur'] === '') {
            $this->view('livres/form', [
                'livre' => $d + ['id' => $id],
                'erreur' => "Le titre et l'auteur sont obligatoires.",
            ]);
            return;
        }
        Livre::update($id, $d);
        $_SESSION['flash'] = 'Livre modifié.';
        $this->redirect('/livres');
    }

    public function delete($id = 0): void
    {
        $this->requireAuth();
        $this->postOnly();
        try {
            Livre::delete((int) $id);
            $_SESSION['flash'] = 'Livre supprimé.';
        } catch (PDOException $e) {
            $_SESSION['flash'] = 'Impossible de supprimer : ce livre a des emprunts.';
        }
        $this->redirect('/livres');
    }

    private function postOnly(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/livres');
        }
    }

    private function donnees(): array
    {
        return [
            'titre'          => trim($_POST['titre'] ?? ''),
            'auteur'         => trim($_POST['auteur'] ?? ''),
            'categorie'      => trim($_POST['categorie'] ?? ''),
            'annee'          => (int) ($_POST['annee'] ?? 0),
            'nb_exemplaires' => max(1, (int) ($_POST['nb_exemplaires'] ?? 1)),
        ];
    }
}