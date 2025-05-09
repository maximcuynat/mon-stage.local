<div class="container-fluid px-0">
    <!-- En-tête avec recherche -->
    <div class="row mb-4 align-items-center">
        <div class="col-lg-6 col-md-8">
            <h1 class="h3 mb-2 mb-md-0">
                <i class="bi bi-building me-2"></i> Liste des entreprises
            </h1>
        </div>
        <div class="col-lg-6 col-md-4 d-flex justify-content-md-end mt-3 mt-md-0">
            <a href="/entreprises/add" class="btn btn-primary position-relative">
                <i class="bi bi-plus-circle me-2"></i> Nouvelle entreprise
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
                <input type="text" class="form-control" id="table-search" placeholder="Rechercher une entreprise..." aria-label="Rechercher">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filtrer</button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Toutes les entreprises</a></li>
                    <li><a class="dropdown-item" href="#">Avec contacts</a></li>
                    <li><a class="dropdown-item" href="#">Avec stages</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Trier par nom</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php if (empty($entreprises)): ?>
    <!-- État vide -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body text-center py-5">
            <div class="display-1 text-muted mb-4">
                <i class="bi bi-building-slash"></i>
            </div>
            <h3 class="h4 mb-3">Aucune entreprise disponible</h3>
            <p class="text-muted mb-4">Commencez à ajouter des entreprises pour gérer vos contacts professionnels.</p>
            <a href="/entreprises/add" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i> Ajouter votre première entreprise
            </a>
        </div>
    </div>
    <?php else: ?>
    <!-- Liste des entreprises (version mobile) -->
    <div class="d-md-none">
        <?php foreach ($entreprises as $entreprise): 
            $location = [];
            if ($entreprise->getVille()) $location[] = $entreprise->getVille();
            if ($entreprise->getCodePostal()) $location[] = $entreprise->getCodePostal();
            if ($entreprise->getPays()) $location[] = $entreprise->getPays();
            $locationStr = implode(', ', $location);
        ?>
        <div class="card shadow-sm border-0 mb-3 enterprise-card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-initials bg-primary text-white rounded-circle me-3">
                        <?= strtoupper(substr($entreprise->getNom(), 0, 1)) ?>
                    </div>
                    <h5 class="card-title mb-0">
                        <a href="/entreprises/<?= $entreprise->getId() ?>" class="text-decoration-none stretched-link">
                            <?= htmlspecialchars($entreprise->getNom()) ?>
                        </a>
                    </h5>
                </div>
                
                <?php if (!empty($locationStr)): ?>
                <p class="card-text mb-2">
                    <i class="bi bi-geo-alt text-muted me-2"></i> <?= htmlspecialchars($locationStr) ?>
                </p>
                <?php endif; ?>
                
                <p class="card-text mb-3">
                    <?php if ($entreprise->getEmail()): ?>
                        <i class="bi bi-envelope text-muted me-2"></i> <?= htmlspecialchars($entreprise->getEmail()) ?>
                    <?php elseif ($entreprise->getTelephone()): ?>
                        <i class="bi bi-telephone text-muted me-2"></i> <?= htmlspecialchars($entreprise->getTelephone()) ?>
                    <?php else: ?>
                        <span class="text-muted"><i class="bi bi-info-circle me-2"></i> Aucun contact</span>
                    <?php endif; ?>
                </p>
                
                <div class="d-flex justify-content-end">
                    <a href="/entreprises/<?= $entreprise->getId() ?>" class="btn btn-sm btn-outline-info me-2" title="Voir">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="/entreprises/edit/<?= $entreprise->getId() ?>" class="btn btn-sm btn-outline-warning me-2" title="Modifier">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="/entreprises/delete/<?= $entreprise->getId() ?>" class="btn btn-sm btn-outline-danger" title="Supprimer" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Liste des entreprises (version desktop) -->
    <div class="d-none d-md-block">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 ps-3">Entreprise</th>
                                <th class="border-0">Localisation</th>
                                <th class="border-0">Contact</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($entreprises as $entreprise): 
                                $location = [];
                                if ($entreprise->getVille()) $location[] = $entreprise->getVille();
                                if ($entreprise->getCodePostal()) $location[] = $entreprise->getCodePostal();
                                if ($entreprise->getPays()) $location[] = $entreprise->getPays();
                                $locationStr = implode(', ', $location);
                            ?>
                            <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initials bg-primary text-white rounded-circle me-2">
                                            <?= strtoupper(substr($entreprise->getNom(), 0, 1)) ?>
                                        </div>
                                        <a href="/entreprises/<?= $entreprise->getId() ?>" class="text-decoration-none fw-medium">
                                            <?= htmlspecialchars($entreprise->getNom()) ?>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <?php if (!empty($locationStr)): ?>
                                        <span class="text-truncate d-inline-block" style="max-width: 250px;">
                                            <i class="bi bi-geo-alt text-muted me-1"></i> <?= htmlspecialchars($locationStr) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">Non spécifiée</span>
                                    <?php endif; ?>
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
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="/entreprises/<?= $entreprise->getId() ?>" class="btn btn-sm btn-outline-info" title="Voir">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="/entreprises/edit/<?= $entreprise->getId() ?>" class="btn btn-sm btn-outline-warning" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="/entreprises/delete/<?= $entreprise->getId() ?>" class="btn btn-sm btn-outline-danger" title="Supprimer"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">
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
.enterprise-card {
    transition: transform 0.3s ease;
}
.enterprise-card:hover {
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