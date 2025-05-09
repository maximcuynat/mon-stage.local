<div class="container-fluid px-0">
    <!-- En-tête avec breadcrumb -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/stages">Stages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Détails</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                <h1 class="h3 mb-2 mb-md-0">
                    <i class="bi bi-file-earmark-text me-2"></i>Détails du stage
                </h1>
                <div class="d-flex gap-2">
                    <a href="/stages" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                    <a href="/stages/edit/<?= $stage->getId() ?>" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil me-1"></i> Modifier
                    </a>
                    <a href="/stages/delete/<?= $stage->getId() ?>" class="btn btn-danger btn-sm" 
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?')">
                        <i class="bi bi-trash me-1"></i> Supprimer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
            <!-- Informations générales -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title h5 mb-0">
                        <i class="bi bi-info-circle me-2"></i>Informations générales
                    </h3>
                    <?php if ($stage->getLienOffre()): ?>
                    <a href="<?= htmlspecialchars($stage->getLienOffre()) ?>" target="_blank" class="btn btn-sm btn-primary">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Voir l'offre
                    </a>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <?php if ($entreprise): ?>
                                <div class="flex-shrink-0">
                                    <div class="avatar-initials bg-primary text-white rounded-circle">
                                        <?= strtoupper(substr($entreprise->getNom(), 0, 1)) ?>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h4 class="h6 mb-1">Entreprise</h4>
                                    <a href="/entreprises/<?= $entreprise->getId() ?>" class="text-decoration-none fw-bold">
                                        <?= htmlspecialchars($entreprise->getNom()) ?>
                                    </a>
                                </div>
                                <?php else: ?>
                                <div class="ms-3">
                                    <h4 class="h6 mb-1">Entreprise</h4>
                                    <span class="text-muted">Non spécifiée</span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="icon-circle bg-light">
                                        <i class="bi bi-calendar-date text-primary"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h4 class="h6 mb-1">Date de postulation</h4>
                                    <span class="badge bg-secondary">
                                        <?= date('d/m/Y', strtotime($stage->getDatePostulation())) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="h6 mb-3">Description</h4>
                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <div class="description-content">
                                <?= nl2br(htmlspecialchars($stage->getDescription())) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne latérale -->
        <div class="col-lg-4">
            <!-- Candidature -->
            <?php if ($candidature): ?>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h3 class="card-title h5 mb-0">
                        <i class="bi bi-clipboard-check me-2"></i>Suivi de candidature
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="h6 mb-0">Statut actuel</h4>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-link text-muted p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="/stages/edit/<?= $stage->getId() ?>">Modifier le statut</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <?php
                        $statutLabel = '';
                        $statutClass = 'bg-secondary';
                        foreach ($statuts ?? [] as $statut) {
                            if ($statut->getId() === $candidature->getStatutId()) {
                                $statutLabel = $statut->getLibelle();
                                // Assignation d'une couleur selon le statut
                                switch(strtolower($statutLabel)) {
                                    case 'envoyée':
                                    case 'envoyé':
                                    case 'soumis':
                                        $statutClass = 'bg-info';
                                        break;
                                    case 'en attente':
                                    case 'en cours':
                                        $statutClass = 'bg-warning';
                                        break;
                                    case 'accepté':
                                    case 'acceptée':
                                    case 'retenu':
                                        $statutClass = 'bg-success';
                                        break;
                                    case 'refusé':
                                    case 'refusée':
                                    case 'rejeté':
                                        $statutClass = 'bg-danger';
                                        break;
                                }
                                break;
                            }
                        }
                        ?>
                        
                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar <?= $statutClass ?>" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge <?= $statutClass ?> py-2 px-3">
                                <?= htmlspecialchars($statutLabel) ?>
                            </span>
                            <small class="text-muted">
                                Mise à jour le <?= date('d/m/Y', strtotime($candidature->getDateCandidature())) ?>
                            </small>
                        </div>
                    </div>

                    <?php if ($candidature->getCommentaires()): ?>
                    <hr class="my-4">
                    
                    <div>
                        <h4 class="h6 mb-3">Commentaires</h4>
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <div class="comment-content">
                                    <?= nl2br(htmlspecialchars($candidature->getCommentaires())) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php else: ?>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body text-center py-4">
                    <div class="display-6 text-muted mb-3">
                        <i class="bi bi-clipboard-x"></i>
                    </div>
                    <h3 class="h5 mb-3">Aucune candidature</h3>
                    <p class="text-muted mb-4">Aucune candidature n'est associée à ce stage.</p>
                    <a href="/stages/edit/<?= $stage->getId() ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Ajouter une candidature
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <!-- Actions rapides -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h3 class="card-title h5 mb-0">
                        <i class="bi bi-lightning-charge me-2"></i>Actions rapides
                    </h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="/stages/edit/<?= $stage->getId() ?>" class="btn btn-outline-primary">
                            <i class="bi bi-pencil me-2"></i> Modifier ce stage
                        </a>
                        <?php if ($entreprise): ?>
                        <a href="/entreprises/<?= $entreprise->getId() ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-building me-2"></i> Voir l'entreprise
                        </a>
                        <?php endif; ?>
                        <button type="button" class="btn btn-outline-info">
                            <i class="bi bi-calendar-plus me-2"></i> Ajouter un rappel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-initials {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}
.icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.description-content, .comment-content {
    line-height: 1.6;
}
</style>