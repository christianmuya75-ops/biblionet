<h2>Nouvel emprunt</h2>

<?php if (!empty($erreur)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
<?php endif; ?>

<?php if (empty($adherents)): ?>
    <div class="alert alert-warning">Aucun adhérent : ajoutez-en un d'abord.</div>
<?php elseif (empty($livres)): ?>
    <div class="alert alert-warning">Aucun livre n'est disponible actuellement.</div>
<?php else: ?>
<form method="post" action="/emprunts/store" class="col-md-6">
    <label class="form-label">Livre</label>
    <select name="livre_id" class="form-select mb-3" required>
        <option value="">-- Choisir un livre --</option>
        <?php foreach ($livres as $l): ?>
            <option value="<?= (int) $l['id'] ?>">
                <?= htmlspecialchars($l['titre'] . ' (' . $l['auteur'] . ') - ' . (int) $l['disponibles'] . ' dispo') ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label class="form-label">Adhérent</label>
    <select name="adherent_id" class="form-select mb-3" required>
        <option value="">-- Choisir un adhérent --</option>
        <?php foreach ($adherents as $a): ?>
            <option value="<?= (int) $a['id'] ?>">
                <?= htmlspecialchars($a['nom'] . ' ' . $a['prenom'] . ' (' . ($a['classe'] ?? '') . ')') ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button class="btn btn-primary">Enregistrer l'emprunt</button>
    <a href="/emprunts" class="btn btn-secondary">Annuler</a>
</form>
<?php endif; ?>