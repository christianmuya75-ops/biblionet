<h2>Connexion</h2>
<?php if ($erreur): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
<?php endif; ?>
<form method="post" class="col-md-4">
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Mot de passe" required>
    <button class="btn btn-primary">Se connecter</button>
</form>