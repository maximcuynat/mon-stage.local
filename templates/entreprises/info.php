<div class="container-fluid px-0">
    <!-- En-tête avec breadcrumb -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/entreprises">Entreprises</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <div class="avatar-lg bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                        <?= strtoupper(substr($entreprise->getNom(), 0, 1)) ?>
                    </div>
                    <h1 class="h3 mb-0"><?= htmlspecialchars($entreprise->getNom()) ?></h1>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="/entreprises" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                    <a href="/entreprises/edit/<?= $entreprise->getId() ?>" class="btn btn-warning btn-sm text-white">
                        <i class="bi bi-pencil me-1"></i> Modifier
                    </a>
                    <a href="/entreprises/delete/<?= $entreprise->getId() ?>" class="btn btn-danger btn-sm" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">
                        <i class="bi bi-trash me-1"></i> Supprimer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Colonne principale - Informations générales -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title h5 mb-0">
                        <i class="bi bi-info-circle me-2"></i>Informations générales
                    </h3>
                    <span class="badge bg-primary rounded-pill">ID: <?= $entreprise->getId() ?></span>
                </div>
                <div class="card-body">
                    <?php if ($entreprise->getAdresse() || $entreprise->getVille() || $entreprise->getCodePostal() || $entreprise->getPays()): ?>
                    <div class="mb-4">
                        <h4 class="h6 text-uppercase text-muted small mb-3">Adresse</h4>
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="icon-md bg-light rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                </div>
                            </div>
                            <address class="mb-0">
                                <?php if ($entreprise->getAdresse()): ?>
                                    <?= htmlspecialchars($entreprise->getAdresse()) ?><br>
                                <?php endif; ?>

                                <?php if ($entreprise->getVille() || $entreprise->getCodePostal()): ?>
                                    <?= htmlspecialchars($entreprise->getCodePostal() ?? '') ?> <?= htmlspecialchars($entreprise->getVille() ?? '') ?><br>
                                <?php endif; ?>

                                <?php if ($entreprise->getPays()): ?>
                                    <?= htmlspecialchars($entreprise->getPays()) ?>
                                <?php endif; ?>
                            </address>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <h4 class="h6 text-uppercase text-muted small mb-3">Contact</h4>
                        <ul class="list-unstyled">
                            <?php if ($entreprise->getTelephone()): ?>
                            <li class="d-flex mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="icon-md bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-telephone text-primary"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-muted small">Téléphone</div>
                                    <a href="tel:<?= htmlspecialchars($entreprise->getTelephone()) ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($entreprise->getTelephone()) ?>
                                    </a>
                                </div>
                            </li>
                            <?php endif; ?>

                            <?php if ($entreprise->getEmail()): ?>
                            <li class="d-flex mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="icon-md bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-envelope text-primary"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-muted small">Email</div>
                                    <a href="mailto:<?= htmlspecialchars($entreprise->getEmail()) ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($entreprise->getEmail()) ?>
                                    </a>
                                </div>
                            </li>
                            <?php endif; ?>

                            <?php if ($entreprise->getSiteWeb()): ?>
                            <li class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="icon-md bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-globe text-primary"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-muted small">Site web</div>
                                    <a href="<?= htmlspecialchars($entreprise->getSiteWeb()) ?>" target="_blank" class="text-decoration-none d-flex align-items-center">
                                        <?= htmlspecialchars(preg_replace('#^https?://#', '', $entreprise->getSiteWeb())) ?>
                                        <i class="bi bi-box-arrow-up-right ms-1 small"></i>
                                    </a>
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <?php if ($entreprise->getLiensOffre()): ?>
                    <div>
                        <h4 class="h6 text-uppercase text-muted small mb-3">Liens d'offres</h4>
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <?= nl2br(htmlspecialchars($entreprise->getLiensOffre())) ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h3 class="card-title h5 mb-0">
                        <i class="bi bi-lightning-charge me-2"></i>Actions rapides
                    </h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="/entreprises/edit/<?= $entreprise->getId() ?>" class="btn btn-outline-warning">
                            <i class="bi bi-pencil me-2"></i> Modifier cette entreprise
                        </a>
                        <a href="/contacts/add" class="btn btn-outline-primary">
                            <i class="bi bi-person-plus me-2"></i> Ajouter un contact
                        </a>
                        <a href="/stages/add" class="btn btn-outline-success">
                            <i class="bi bi-calendar-plus me-2"></i> Ajouter un stage
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne secondaire - Contacts et Stages -->
        <div class="col-lg-8">
            <!-- Contacts associés -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title h5 mb-0">
                        <i class="bi bi-people me-2"></i>Contacts
                        <?php if (!empty($allContacts)): ?>
                        <span class="badge bg-primary rounded-pill ms-2"><?= count($allContacts) ?></span>
                        <?php endif; ?>
                    </h3>
                    <a href="/contacts/add" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter
                    </a>
                </div>
                <div class="card-body">
                    <?php if (empty($allContacts)): ?>
                    <!-- État vide pour les contacts -->
                    <div class="text-center py-4">
                        <div class="display-6 text-muted mb-3">
                            <i class="bi bi-person-dash"></i>
                        </div>
                        <h3 class="h5 mb-3">Aucun contact</h3>
                        <p class="text-muted mb-4">Aucun contact n'est associé à cette entreprise.</p>
                        <a href="/contacts/add" class="btn btn-primary">
                            <i class="bi bi-person-plus me-2"></i> Ajouter un contact
                        </a>
                    </div>
                    <?php else: ?>
                    <!-- Liste des contacts -->
                    <div class="row">
                        <?php foreach ($allContacts as $contact): ?>
                        <div class="col-xl-6 mb-3">
                            <div class="card border-0 shadow-sm h-100 contact-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-sm bg-info text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                                            <?= strtoupper(substr($contact->getNom(), 0, 1)) ?>
                                        </div>
                                        <div>
                                            <h5 class="card-title h6 mb-1">
                                                <a href="/contacts/<?= $contact->getId() ?>" class="text-decoration-none stretched-link">
                                                    <?= htmlspecialchars($contact->getNom()) ?>
                                                    <?= $contact->getPrenom() ? htmlspecialchars($contact->getPrenom()) : '' ?>
                                                </a>
                                            </h5>
                                            <div class="text-muted small">
                                                <?= $contact->getPoste() ? htmlspecialchars($contact->getPoste()) : 'Non spécifié' ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="ps-3 ms-3 border-start">
                                        <?php if ($contact->getEmail()): ?>
                                        <div class="mb-1 small">
                                            <i class="bi bi-envelope text-muted me-2"></i>
                                            <a href="mailto:<?= htmlspecialchars($contact->getEmail()) ?>" class="text-decoration-none">
                                                <?= htmlspecialchars($contact->getEmail()) ?>
                                            </a>
                                        </div>
                                        <?php endif; ?>

                                        <?php if ($contact->getTelephone()): ?>
                                        <div class="small">
                                            <i class="bi bi-telephone text-muted me-2"></i>
                                            <a href="tel:<?= htmlspecialchars($contact->getTelephone()) ?>" class="text-decoration-none">
                                                <?= htmlspecialchars($contact->getTelephone()) ?>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Stages associés -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title h5 mb-0">
                        <i class="bi bi-calendar-event me-2"></i>Stages
                        <?php
                        // Récupérer les stages de cette entreprise
                        $stagesEntreprise = [];
                        foreach ($stages ?? [] as $stage) {
                            if ($stage->getIdEntreprise() === $entreprise->getId()) {
                                $stagesEntreprise[] = $stage;
                            }
                        }
                        if (!empty($stagesEntreprise)):
                        ?>
                        <span class="badge bg-primary rounded-pill ms-2"><?= count($stagesEntreprise) ?></span>
                        <?php endif; ?>
                    </h3>
                    <a href="/stages/add" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter
                    </a>
                </div>
                <div class="card-body">
                    <?php if (empty($stagesEntreprise)): ?>
                    <!-- État vide pour les stages -->
                    <div class="text-center py-4">
                        <div class="display-6 text-muted mb-3">
                            <i class="bi bi-calendar-x"></i>
                        </div>
                        <h3 class="h5 mb-3">Aucun stage</h3>
                        <p class="text-muted mb-4">Aucun stage n'est associé à cette entreprise.</p>
                        <a href="/stages/add" class="btn btn-primary">
                            <i class="bi bi-calendar-plus me-2"></i> Ajouter un stage
                        </a>
                    </div>
                    <?php else: ?>
                    <!-- Liste des stages -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stagesEntreprise as $stage): ?>
                                <tr>
                                    <td width="120">
                                        <span class="badge bg-secondary">
                                            <?= date('d/m/Y', strtotime($stage->getDatePostulation())) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 400px;">
                                            <?= htmlspecialchars(substr($stage->getDescription(), 0, 100)) ?>...
                                        </div>
                                    </td>
                                    <td class="text-center" width="120">
                                        <a href="/stages/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-info me-1" title="Voir">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="/stages/edit/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-warning" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-lg {
    width: 60px;
    height: 60px;
    font-size: 24px;
}
.avatar-sm {
    width: 40px;
    height: 40px;
    font-size: 16px;
}
.icon-md {
    width: 36px;
    height: 36px;
}
.contact-card {
    transition: transform 0.3s ease;
}
.contact-card:hover {
    transform: translateY(-5px);
}
</style>