<div class="container-fluid px-0">
    <!-- En-tête avec recherche -->
    <div class="row mb-4 align-items-center">
        <div class="col-lg-6 col-md-8">
            <h1 class="h3 mb-2 mb-md-0">
                <i class="bi bi-calendar-event me-2"></i> Liste des stages
            </h1>
        </div>
        <div class="col-lg-6 col-md-4 d-flex justify-content-md-end mt-3 mt-md-0">
            <a href="/stages/add" class="btn btn-primary position-relative">
                <i class="bi bi-plus-circle me-2"></i> Nouveau stage
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
                <input type="text" class="form-control" id="table-search" placeholder="Rechercher un stage..." aria-label="Rechercher">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Filtrer</button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Tous les stages</a></li>
                    <li><a class="dropdown-item" href="#">Mes candidatures</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Trier par date</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php if (empty($stages)): ?>
    <!-- État vide -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body text-center py-5">
            <div class="display-1 text-muted mb-4">
                <i class="bi bi-clipboard-x"></i>
            </div>
            <h3 class="h4 mb-3">Aucun stage disponible</h3>
            <p class="text-muted mb-4">Commencez à ajouter des stages pour suivre vos candidatures.</p>
            <a href="/stages/add" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i> Ajouter votre premier stage
            </a>
        </div>
    </div>
    <?php else: ?>
    <!-- Liste des stages (version mobile) -->
    <div class="d-md-none">
        <?php foreach ($stages as $stage):
            // Récupération du nom de l'entreprise
            $entrepriseNom = '';
            foreach ($entreprises ?? [] as $entreprise) {
                if ($entreprise->getId() === $stage->getIdEntreprise()) {
                    $entrepriseNom = $entreprise->getNom();
                    break;
                }
            }
        ?>
        <div class="card shadow-sm border-0 mb-3 stage-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="card-title mb-0"><?= htmlspecialchars($entrepriseNom) ?></h5>
                    <span class="badge bg-primary rounded-pill">
                        <?= htmlspecialchars(date('d/m/Y', strtotime($stage->getDatePostulation()))) ?>
                    </span>
                </div>
                <p class="card-text text-muted mb-3">
                    <?= htmlspecialchars(substr($stage->getDescription(), 0, 100)) ?>...
                </p>
                <div class="d-flex justify-content-end">
                    <a href="/stages/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-info me-2" title="Voir">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="/stages/edit/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-warning me-2" title="Modifier">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="/stages/delete/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-danger" title="Supprimer" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Liste des stages (version desktop) -->
    <div class="d-none d-md-block">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 ps-3">Entreprise</th>
                                <th class="border-0">Description</th>
                                <th class="border-0">Date</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stages as $stage):
                                // Récupération du nom de l'entreprise
                                $entrepriseNom = '';
                                foreach ($entreprises ?? [] as $entreprise) {
                                    if ($entreprise->getId() === $stage->getIdEntreprise()) {
                                        $entrepriseNom = $entreprise->getNom();
                                        break;
                                    }
                                }
                            ?>
                            <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initials bg-primary text-white rounded-circle me-2">
                                            <?= strtoupper(substr($entrepriseNom, 0, 1)) ?>
                                        </div>
                                        <span><?= htmlspecialchars($entrepriseNom) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 300px;">
                                        <?= htmlspecialchars(substr($stage->getDescription(), 0, 100)) ?>...
                                    </span>
                                </td>
                                <td><?= date('d/m/Y', strtotime($stage->getDatePostulation())) ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="/stages/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-info" title="Voir">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="/stages/edit/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-warning" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="/stages/delete/<?= $stage->getId() ?>" class="btn btn-sm btn-outline-danger" title="Supprimer"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?')">
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
.stage-card {
    transition: transform 0.3s ease;
}
.stage-card:hover {
    transform: translateY(-5px);
}
</style>