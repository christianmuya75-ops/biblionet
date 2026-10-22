<h2>Catalogue</h2>

<form method="get" action="/catalogue" class="row g-2 mb-3">
    <div class="col-md-6">
        <input type="text" name="q" class="form-control"
               placeholder="Rechercher par titre ou auteur"
               value="<?= htmlspecialchars($q) ?>">
    </div>
    <div class="col-auto">
        <button class="btn btn-primary">Rechercher</button>
        <a href="/catalogue" class="btn btn-secondary">Tout afficher</a>
    </div>
</form>

<div class="table-responsive">
<table class="table table-striped align-middle">
    <thead>
        <tr><th>Titre</th><th>Auteur</th><th>Catégorie</th><th>Année</th><th>Disponibilité</th></tr>
    </thead>
    <tbody>
    <?php if (empty($livres)): ?>
        <tr><td colspan="5" class="text-center">Aucun livre trouvé.</td></tr>
    <?php endif; ?>
    <?php foreach ($livres as $l): ?>
        <tr>
            <td><?= htmlspecialchars($l['titre']) ?></td>
            <td><?= htmlspecialchars($l['auteur']) ?></td>
            <td><?= htmlspecialchars($l['categorie'] ?? '') ?></td>
            <td><?= htmlspecialchars((string) $l['annee']) ?></td>
            <td>
                <?php if ((int) $l['disponibles'] > 0): ?>
                    <span class="badge bg-success">Disponible (<?= (int) $l['disponibles'] ?>)</span>
                <?php else: ?>
                    <span class="badge bg-danger">Indisponible</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>