<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BiblioNet</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="/catalogue">BiblioNet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="/catalogue">Catalogue</a></li>
                <?php if (!empty($_SESSION['user'])): ?>
                    <li class="nav-item"><a class="nav-link" href="/livres">Livres</a></li>
                    <li class="nav-item"><a class="nav-link" href="/adherents">Adhérents</a></li>
                    <li class="nav-item"><a class="nav-link" href="/emprunts">Emprunts</a></li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (!empty($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/auth/logout">
                            Déconnexion (<?= htmlspecialchars($_SESSION['user']['nom']) ?>)
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/auth/login">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    <?= $content ?>
</main>

<script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>