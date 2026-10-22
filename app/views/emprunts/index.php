<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Emprunts en cours</h2>
    <a href="/emprunts/create" class="btn btn-primary">Nouvel emprunt</a>
</div>

<div class="table-responsive">
<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>Livre</th><th>Adhérent</th><th>Date d'emprunt</th><th>Statut</th><th></th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($emprunts)): ?>
        <tr><td colspan="5" class="text-center">Aucun emprunt en cours.</td></tr>
    <?php endif; ?>
    <?php foreach ($emprunts as $e): ?>
        <tr>
            <td><?= htmlspecialchars($e['titre']) ?></td>
            <td><?= htmlspecialchars($e['prenom'] . ' ' . $e['nom']) ?></td>
            <td><?= htmlspecialchars($e['date_emprunt']) ?></td>
            <td>
                <?php if ((int) $e['jours'] > 14): ?>
                    <span class="badge bg-danger">Retard (<?= (int) $e['jours'] ?> j)</span>
                <?php else: ?>
                    <span class="badge bg-success"><?= (int) $e['jours'] ?> j</span>
                <?php endif; ?>
            </td>
            <td class="text-end">
                <form method="post" action="/emprunts/retour/<?= (int) $e['id'] ?>" class="d-inline"
                      onsubmit="return confirm('Enregistrer le retour de ce livre ?');">
                    <button class="btn btn-sm btn-success">Enregistrer le retour</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>