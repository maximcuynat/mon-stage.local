<div class="container-fluid px-0">
    <!-- En-tête avec breadcrumb -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/contacts">Contacts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <div class="avatar-lg bg-info text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                        <?= strtoupper(substr($contact->getNom(), 0, 1)) ?>
                    </div>
                    <div>
                        <h1 class="h3 mb-0">
                            <?= htmlspecialchars($contact->getNom()) ?>
                            <?= $contact->getPrenom() ? htmlspecialchars($contact->getPrenom()) : '' ?>
                        </h1>
                        <?php if ($contact->getPoste()): ?>
                        <p class="text-muted mb-0">
                            <i class="bi bi-briefcase me-1"></i> <?= htmlspecialchars($contact->getPoste()) ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="/contacts" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                    <a href="/contacts/edit/<?= $contact->getId() ?>" class="btn btn-warning btn-sm text-white">
                        <i class="bi bi-pencil me-1"></i> Modifier
                    </a>
                    <a href="/contacts/delete/<?= $contact->getId() ?>" class="btn btn-danger btn-sm" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
                        <i class="bi bi-trash me-1"></i> Supprimer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Colonne principale - Informations de contact -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title h5 mb-0">
                        <i class="bi bi-person-vcard me-2"></i>Informations de contact
                    </h3>
                    <span class="badge bg-primary rounded-pill">ID: <?= $contact->getId() ?></span>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="h6 text-uppercase text-muted small mb-3">Identité</h4>
                        <ul class="list-unstyled">
                            <li class="d-flex mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="icon-md bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person text-info"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-muted small">Nom complet</div>
                                    <div class="fw-medium">
                                        <?= htmlspecialchars($contact->getNom()) ?>
                                        <?= $contact->getPrenom() ? htmlspecialchars($contact->getPrenom()) : '' ?>
                                    </div>
                                </div>
                            </li>
                            
                            <?php if ($contact->getPoste()): ?>
                            <li class="d-flex mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="icon-md bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-briefcase text-info"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-muted small">Poste</div>
                                    <div class="fw-medium">
                                        <?= htmlspecialchars($contact->getPoste()) ?>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div>
                        <h4 class="h6 text-uppercase text-muted small mb-3">Coordonnées</h4>
                        <ul class="list-unstyled">
                            <?php if ($contact->getEmail()): ?>
                            <li class="d-flex mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <div class="icon-md bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-envelope text-info"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-muted small">Email</div>
                                    <div>
                                        <a href="mailto:<?= htmlspecialchars($contact->getEmail()) ?>" class="text-decoration-none">
                                            <?= htmlspecialchars($contact->getEmail()) ?>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>

                            <?php if ($contact->getTelephone()): ?>
                            <li class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="icon-md bg-light rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-telephone text-info"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-muted small">Téléphone</div>
                                    <div>
                                        <a href="tel:<?= htmlspecialchars($contact->getTelephone()) ?>" class="text-decoration-none">
                                            <?= htmlspecialchars($contact->getTelephone()) ?>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
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
                        <a href="/contacts/edit/<?= $contact->getId() ?>" class="btn btn-outline-warning">
                            <i class="bi bi-pencil me-2"></i> Modifier ce contact
                        </a>
                        <?php if ($contact->getEmail()): ?>
                        <a href="mailto:<?= htmlspecialchars($contact->getEmail()) ?>" class="btn btn-outline-info">
                            <i class="bi bi-envelope me-2"></i> Envoyer un email
                        </a>
                        <?php endif; ?>
                        <?php if ($contact->getTelephone()): ?>
                        <a href="tel:<?= htmlspecialchars($contact->getTelephone()) ?>" class="btn btn-outline-info">
                            <i class="bi bi-telephone me-2"></i> Appeler
                        </a>
                        <?php endif; ?>
                        <?php if ($entreprise): ?>
                        <a href="/entreprises/<?= $entreprise->getId() ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-building me-2"></i> Voir l'entreprise
                        </a>
                        <?php endif; ?>
                        <a href="/stages/add" class="btn btn-outline-primary">
                            <i class="bi bi-calendar-plus me-2"></i> Ajouter un stage
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne secondaire - Entreprise et Notes -->
        <div class="col-lg-7">
            <!-- Entreprise associée -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title h5 mb-0">
                        <i class="bi bi-building me-2"></i>Entreprise
                    </h3>
                    <a href="/entreprises/add" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter
                    </a>
                </div>
                <div class="card-body">
                    <?php if ($entreprise): ?>
                    <!-- Détails de l'entreprise -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-md bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center">
                                    <?= strtoupper(substr($entreprise->getNom(), 0, 1)) ?>
                                </div>
                                <div>
                                    <h4 class="h5 mb-1">
                                        <a href="/entreprises/<?= $entreprise->getId() ?>" class="text-decoration-none">
                                            <?= htmlspecialchars($entreprise->getNom()) ?>
                                        </a>
                                    </h4>
                                    <?php
                                    $adresse = [];
                                    if ($entreprise->getVille()) $adresse[] = $entreprise->getVille();
                                    if ($entreprise->getCodePostal()) $adresse[] = $entreprise->getCodePostal();
                                    if ($entreprise->getPays()) $adresse[] = $entreprise->getPays();
                                    if (!empty($adresse)):
                                    ?>
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-geo-alt me-1"></i> <?= htmlspecialchars(implode(', ', $adresse)) ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <?php if ($entreprise->getTelephone()): ?>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-telephone text-primary me-2"></i>
                                        <a href="tel:<?= htmlspecialchars($entreprise->getTelephone()) ?>" class="text-decoration-none">
                                            <?= htmlspecialchars($entreprise->getTelephone()) ?>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($entreprise->getEmail()): ?>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-envelope text-primary me-2"></i>
                                        <a href="mailto:<?= htmlspecialchars($entreprise->getEmail()) ?>" class="text-decoration-none">
                                            <?= htmlspecialchars($entreprise->getEmail()) ?>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($entreprise->getSiteWeb()): ?>
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-globe text-primary me-2"></i>
                                        <a href="<?= htmlspecialchars($entreprise->getSiteWeb()) ?>" target="_blank" class="text-decoration-none">
                                            <?= htmlspecialchars(preg_replace('#^https?://#', '', $entreprise->getSiteWeb())) ?>
                                            <i class="bi bi-box-arrow-up-right ms-1 small"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <a href="/entreprises/<?= $entreprise->getId() ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-building me-1"></i> Voir les détails complets
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <!-- État vide pour l'entreprise -->
                    <div class="text-center py-4">
                        <div class="display-6 text-muted mb-3">
                            <i class="bi bi-building-slash"></i>
                        </div>
                        <h3 class="h5 mb-3">Aucune entreprise associée</h3>
                        <p class="text-muted mb-4">Ce contact n'est pas associé à une entreprise.</p>
                        <a href="/entreprises/add" class="btn btn-primary">
                            <i class="bi bi-building-add me-2"></i> Ajouter une entreprise
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Stages liés (exemple) -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title h5 mb-0">
                        <i class="bi bi-calendar-event me-2"></i>Stages liés
                    </h3>
                    <a href="/stages/add" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter
                    </a>
                </div>
                <div class="card-body">
                    <!-- État vide pour les stages liés (par défaut, car pas de stage lié au contact dans le modèle original) -->
                    <div class="text-center py-4">
                        <div class="display-6 text-muted mb-3">
                            <i class="bi bi-calendar-x"></i>
                        </div>
                        <h3 class="h5 mb-3">Aucun stage lié</h3>
                        <p class="text-muted mb-4">Aucun stage n'est associé à ce contact.</p>
                        <a href="/stages/add" class="btn btn-primary">
                            <i class="bi bi-calendar-plus me-2"></i> Ajouter un stage
                        </a>
                    </div>
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
.avatar-md {
    width: 48px;
    height: 48px;
    font-size: 20px;
}
.icon-md {
    width: 36px;
    height: 36px;
}
</style>