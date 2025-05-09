<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Liste des entreprises</h1>
    <a href="/entreprises/add" class="btn btn-outline-success">
        <i class="bi bi-plus-circle"></i> Ajouter une entreprise
    </a>
</div>

<?php if (empty($entreprises)): ?>
    <div class="alert alert-info">Aucune entreprise n'a été ajoutée pour le moment.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Localisation</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entreprises as $entreprise): ?>
                    <tr>
                        <td>
                            <a href="/entreprises/<?= $entreprise->getId() ?>" class="text-decoration-none">
                                <?= htmlspecialchars($entreprise->getNom()) ?>
                            </a>
                        </td>
                        <td>
                            <?php
                            $location = [];
                            if ($entreprise->getVille()) $location[] = $entreprise->getVille();
                            if ($entreprise->getCodePostal()) $location[] = $entreprise->getCodePostal();
                            if ($entreprise->getPays()) $location[] = $entreprise->getPays();
                            echo htmlspecialchars(implode(', ', $location));
                            ?>
                        </td>
                        <td>
                            <?php if ($entreprise->getEmail()): ?>
                                <a href="mailto:<?= htmlspecialchars($entreprise->getEmail()) ?>" class="text-decoration-none">
                                    <i class="bi bi-envelope me-2"></i> <?= htmlspecialchars($entreprise->getEmail()) ?>
                                </a>
                            <?php elseif ($entreprise->getTelephone()): ?>
                                <a href="tel:<?= htmlspecialchars($entreprise->getTelephone()) ?>" class="text-decoration-none">
                                    <i class="bi bi-telephone me-2"></i> <?= htmlspecialchars($entreprise->getTelephone()) ?>
                                </a>
                            <?php else: ?>
                                <span class="text-muted">N/A</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/entreprises/<?= $entreprise->getId() ?>" class="btn btn-sm btn-outline-info" title="Voir">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="/entreprises/edit/<?= $entreprise->getId() ?>" class="btn btn-sm btn-outline-warning" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="/entreprises/delete/<?= $entreprise->getId() ?>" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
