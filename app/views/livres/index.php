<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Livres</h2>
    <a href="/livres/create" class="btn btn-primary">Ajouter un livre</a>
</div>

<div class="table-responsive">
<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>Titre</th><th>Auteur</th><th>Catégorie</th>
            <th>Année</th><th>Exemplaires</th><th></th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($livres)): ?>
        <tr><td colspan="6" class="text-center">Aucun livre.</td></tr>
    <?php endif; ?>
    <?php foreach ($livres as $l): ?>
        <tr>
            <td><?= htmlspecialchars($l['titre']) ?></td>
            <td><?= htmlspecialchars($l['auteur']) ?></td>
            <td><?= htmlspecialchars($l['categorie'] ?? '') ?></td>
            <td><?= htmlspecialchars((string) $l['annee']) ?></td>
            <td><?= (int) $l['nb_exemplaires'] ?></td>
            <td class="text-end">
                <a class="btn btn-sm btn-warning" href="/livres/edit/<?= (int) $l['id'] ?>">Modifier</a>
                <form method="post" action="/livres/delete/<?= (int) $l['id'] ?>" class="d-inline"
                      onsubmit="return confirm('Supprimer ce livre ?');">
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>