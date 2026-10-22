<?php $edition = !empty($livre['id']); ?>
<h2><?= $edition ? 'Modifier le livre' : 'Ajouter un livre' ?></h2>

<?php if (!empty($erreur)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
<?php endif; ?>

<form method="post"
      action="<?= $edition ? '/livres/update/' . (int) $livre['id'] : '/livres/store' ?>"
      class="col-md-6">
    <label class="form-label">Titre</label>
    <input type="text" name="titre" class="form-control mb-2" required
           value="<?= htmlspecialchars($livre['titre'] ?? '') ?>">

    <label class="form-label">Auteur</label>
    <input type="text" name="auteur" class="form-control mb-2" required
           value="<?= htmlspecialchars($livre['auteur'] ?? '') ?>">

    <label class="form-label">Catégorie</label>
    <input type="text" name="categorie" class="form-control mb-2"
           value="<?= htmlspecialchars($livre['categorie'] ?? '') ?>">

    <label class="form-label">Année</label>
    <input type="number" name="annee" class="form-control mb-2"
           value="<?= htmlspecialchars((string) ($livre['annee'] ?? '')) ?>">

    <label class="form-label">Nombre d'exemplaires</label>
    <input type="number" name="nb_exemplaires" class="form-control mb-3" min="1"
           value="<?= (int) ($livre['nb_exemplaires'] ?? 1) ?>">

    <button class="btn btn-primary">Enregistrer</button>
    <a href="/livres" class="btn btn-secondary">Annuler</a>
</form>