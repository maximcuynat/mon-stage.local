<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Liste des stages</h1>
    <a href="/stages/add" class="btn btn-outline-success">
        <i class="bi bi-plus-circle"></i> Ajouter un stage
    </a>
</div>

<?php if (empty($stages)): ?>
    <div class="alert alert-info">Aucun stage n'a été ajouté pour le moment.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Entreprise</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stages as $stage):
                    // On extrait l'entreprise depuis les données si disponible
                    $entrepriseNom = '';
                    foreach ($entreprises ?? [] as $entreprise) {
                        if ($entreprise->getId() === $stage->getIdEntreprise()) {
                            $entrepriseNom = $entreprise->getNom();
                            break;
                        }
                    }
                ?>
                    <tr>
                        <td><?= htmlspecialchars($entrepriseNom) ?></td>
                        <td><?= htmlspecialchars(substr($stage->getDescription(), 0, 100)) ?>...</td>
                        <td><?= htmlspecialchars($stage->getDatePostulation()) ?></td>
                        <td>
                            <a href="/stages/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-info" title="Voir">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="/stages/edit/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-warning" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="/stages/delete/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>