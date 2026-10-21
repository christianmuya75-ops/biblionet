<?php
class AuthController extends Controller
{
    public function login(): void
    {
        $erreur = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::findByEmail(trim($_POST['email'] ?? ''));
            if ($user && password_verify($_POST['password'] ?? '', $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user'] = ['id' => $user['id'], 'nom' => $user['nom']];
                $this->redirect('/livres');
            }
            $erreur = 'Email ou mot de passe incorrect.';
        }
        $this->view('auth/login', ['erreur' => $erreur]);
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect('/catalogue');
    }
}