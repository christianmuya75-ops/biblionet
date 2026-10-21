<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BiblioNet</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <nav class="mb-4">
        <a href="/catalogue">Catalogue</a>
        <?php if (!empty($_SESSION['user'])): ?>
            | <a href="/livres">Livres</a>
            | <a href="/adherents">Adhérents</a>
            | <a href="/emprunts">Emprunts</a>
            | <a href="/auth/logout">Déconnexion (<?= htmlspecialchars($_SESSION['user']['nom']) ?>)</a>
        <?php else: ?>
            | <a href="/auth/login">Connexion</a>
        <?php endif; ?>
    </nav>
    <?= $content ?>
</body>
</html>