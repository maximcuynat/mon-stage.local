<div class="container-fluid px-0">
    <!-- En-tête avec recherche -->
    <div class="row mb-4 align-items-center">
        <div class="col-lg-6 col-md-8">
            <h1 class="h3 mb-2 mb-md-0">
                <i class="bi bi-people-fill me-2"></i> Liste des contacts
            </h1>
        </div>
        <div class="col-lg-6 col-md-4 d-flex justify-content-md-end mt-3 mt-md-0">
            <a href="/contacts/add" class="btn btn-primary position-relative">
                <i class="bi bi-person-plus me-2"></i> Nouveau contact
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                    <i class="bi bi-lightning-charge-fill"></i>
                </span>
            </a>
        </div>
    </div>

    <!-- Barre de recherche -->
    <div class="row mb-4">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" id="table-search" placeholder="Rechercher un contact..." aria-label="Rechercher">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filtrer</button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Tous les contacts</a></li>
                    <li><a class="dropdown-item" href="#">Par entreprise</a></li>
                    <li><a class="dropdown-item" href="#">Par poste</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Trier par nom</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php if (empty($contacts)): ?>
    <!-- État vide -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body text-center py-5">
            <div class="display-1 text-muted mb-4">
                <i class="bi bi-people-fill"></i>
            </div>
            <h3 class="h4 mb-3">Aucun contact disponible</h3>
            <p class="text-muted mb-4">Commencez à ajouter des contacts pour gérer votre réseau professionnel.</p>
            <a href="/contacts/add" class="btn btn-primary">
                <i class="bi bi-person-plus me-2"></i> Ajouter votre premier contact
            </a>
        </div>
    </div>
    <?php else: ?>
    <!-- Liste des contacts (version mobile) -->
    <div class="d-md-none">
        <?php foreach ($contacts as $contact):
            // On récupère l'entreprise associée si disponible
            $entrepriseNom = '';
            $entrepriseId = '';
            foreach ($entreprises ?? [] as $entreprise) {
                if ($entreprise->getId() === $contact->getIdEntreprise()) {
                    $entrepriseNom = $entreprise->getNom();
                    $entrepriseId = $entreprise->getId();
                    break;
                }
            }
        ?>
        <div class="card shadow-sm border-0 mb-3 contact-card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-initials bg-info text-white rounded-circle me-3">
                        <?= strtoupper(substr($contact->getNom(), 0, 1)) ?>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">
                            <a href="/contacts/<?= $contact->getId() ?>" class="text-decoration-none stretched-link">
                                <?= htmlspecialchars($contact->getNom()) ?>
                                <?= $contact->getPrenom() ? ' ' . htmlspecialchars($contact->getPrenom()) : '' ?>
                            </a>
                        </h5>
                        <div class="text-muted small">
                            <?= $contact->getPoste() ? htmlspecialchars($contact->getPoste()) : 'Poste non spécifié' ?>
                        </div>
                    </div>
                </div>
                
                <?php if ($entrepriseNom): ?>
                <p class="card-text mb-2">
                    <i class="bi bi-building text-muted me-2"></i>
                    <a href="/entreprises/<?= $entrepriseId ?>" class="text-decoration-none">
                        <?= htmlspecialchars($entrepriseNom) ?>
                    </a>
                </p>
                <?php endif; ?>
                
                <p class="card-text mb-3">
                    <?php if ($contact->getEmail()): ?>
                        <i class="bi bi-envelope text-muted me-2"></i> <?= htmlspecialchars($contact->getEmail()) ?>
                    <?php elseif ($contact->getTelephone()): ?>
                        <i class="bi bi-telephone text-muted me-2"></i> <?= htmlspecialchars($contact->getTelephone()) ?>
                    <?php else: ?>
                        <span class="text-muted"><i class="bi bi-info-circle me-2"></i> Aucun contact</span>
                    <?php endif; ?>
                </p>
                
                <div class="d-flex justify-content-end">
                    <a href="/contacts/<?= $contact->getId() ?>" class="btn btn-sm btn-outline-info me-2" title="Voir">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="/contacts/edit/<?= $contact->getId() ?>" class="btn btn-sm btn-outline-warning me-2" title="Modifier">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="/contacts/delete/<?= $contact->getId() ?>" class="btn btn-sm btn-outline-danger" title="Supprimer" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Liste des contacts (version desktop) -->
    <div class="d-none d-md-block">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 ps-3">Nom</th>
                                <th class="border-0">Entreprise</th>
                                <th class="border-0">Poste</th>
                                <th class="border-0">Contact</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contacts as $contact):
                                // On récupère l'entreprise associée si disponible
                                $entrepriseNom = '';
                                $entrepriseId = '';
                                foreach ($entreprises ?? [] as $entreprise) {
                                    if ($entreprise->getId() === $contact->getIdEntreprise()) {
                                        $entrepriseNom = $entreprise->getNom();
                                        $entrepriseId = $entreprise->getId();
                                        break;
                                    }
                                }
                            ?>
                            <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initials bg-info text-white rounded-circle me-2">
                                            <?= strtoupper(substr($contact->getNom(), 0, 1)) ?>
                                        </div>
                                        <a href="/contacts/<?= $contact->getId() ?>" class="text-decoration-none fw-medium">
                                            <?= htmlspecialchars($contact->getNom()) ?>
                                            <?= $contact->getPrenom() ? ' ' . htmlspecialchars($contact->getPrenom()) : '' ?>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($entrepriseNom): ?>
                                        <a href="/entreprises/<?= $entrepriseId ?>" class="text-decoration-none">
                                            <i class="bi bi-building text-muted me-1"></i> <?= htmlspecialchars($entrepriseNom) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">Non spécifiée</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= $contact->getPoste() ? htmlspecialchars($contact->getPoste()) : '<span class="text-muted">Non spécifié</span>' ?>
                                </td>
                                <td>
                                    <?php if ($contact->getEmail()): ?>
                                        <a href="mailto:<?= htmlspecialchars($contact->getEmail()) ?>" class="text-decoration-none d-flex align-items-center">
                                            <i class="bi bi-envelope me-2"></i>
                                            <span class="text-truncate" style="max-width: 150px;"><?= htmlspecialchars($contact->getEmail()) ?></span>
                                        </a>
                                    <?php elseif ($contact->getTelephone()): ?>
                                        <a href="tel:<?= htmlspecialchars($contact->getTelephone()) ?>" class="text-decoration-none">
                                            <i class="bi bi-telephone me-2"></i> <?= htmlspecialchars($contact->getTelephone()) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">Non spécifié</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="/contacts/<?= $contact->getId() ?>" class="btn btn-sm btn-outline-info" title="Voir">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="/contacts/edit/<?= $contact->getId() ?>" class="btn btn-sm btn-outline-warning" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="/contacts/delete/<?= $contact->getId() ?>" class="btn btn-sm btn-outline-danger" title="Supprimer"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
.avatar-initials {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}
.contact-card {
    transition: transform 0.3s ease;
}
.contact-card:hover {
    transform: translateY(-5px);
}
.btn-group .btn {
    border-radius: 0;
}
.btn-group .btn:first-child {
    border-top-left-radius: 0.25rem;
    border-bottom-left-radius: 0.25rem;
}
.btn-group .btn:last-child {
    border-top-right-radius: 0.25rem;
    border-bottom-right-radius: 0.25rem;
}
</style>