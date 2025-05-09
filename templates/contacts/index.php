<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Liste des contacts</h1>
    <a href="/contacts/add" class="btn btn-outline-success">
        <i class="bi bi-plus-circle"></i> Ajouter un contact
    </a>
</div>

<div class="mb-3">
    <input type="text" class="form-control" id="table-search" placeholder="Rechercher un contact...">
</div>

<?php if (empty($contacts)): ?>
    <div class="alert alert-info">Aucun contact n'a été ajouté pour le moment.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Entreprise</th>
                    <th>Poste</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact):
                    // On récupère l'entreprise associée si disponible
                    $entrepriseNom = '';
                    foreach ($entreprises ?? [] as $entreprise) {
                        if ($entreprise->getId() === $contact->getIdEntreprise()) {
                            $entrepriseNom = $entreprise->getNom();
                            break;
                        }
                    }
                ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($contact->getNom()) ?>
                            <?= $contact->getPrenom() ? htmlspecialchars($contact->getPrenom()) : '' ?>
                        </td>
                        <td>
                            <?php if ($entrepriseNom): ?>
                                <a href="/entreprises/<?= $contact->getIdEntreprise() ?>" class="text-decoration-none">
                                    <?= htmlspecialchars($entrepriseNom) ?>
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Non spécifiée</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $contact->getPoste() ? htmlspecialchars($contact->getPoste()) : 'Non spécifié' ?></td>
                        <td>
                            <?php if ($contact->getEmail()): ?>
                                <a href="mailto:<?= htmlspecialchars($contact->getEmail()) ?>" class="text-decoration-none">
                                    <i class="bi bi-envelope me-2"></i> <?= htmlspecialchars($contact->getEmail()) ?>
                                </a>
                            <?php elseif ($contact->getTelephone()): ?>
                                <a href="tel:<?= htmlspecialchars($contact->getTelephone()) ?>" class="text-decoration-none">
                                    <i class="bi bi-telephone me-2"></i> <?= htmlspecialchars($contact->getTelephone()) ?>
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Non spécifié</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/contacts/<?= $contact->getId() ?>" class="btn btn-sm btn-outline-info" title="Voir">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="/contacts/edit/<?= $contact->getId() ?>" class="btn btn-sm btn-outline-warning" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="/contacts/delete/<?= $contact->getId() ?>" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
