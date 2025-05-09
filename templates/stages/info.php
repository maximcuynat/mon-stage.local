<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Détails du stage</h1>
    <div class="d-flex gap-2">
        <a href="/stages" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
        <a href="/stages/edit/<?= $stage->getId() ?>" class="btn btn-outline-warning">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <a href="/stages/delete/<?= $stage->getId() ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stage ?')">
            <i class="bi bi-trash"></i> Supprimer
        </a>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-white border-bottom">
        <h3 class="card-title h5 mb-0">Informations générales</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-2"><strong>Entreprise:</strong>
                    <?php if ($entreprise): ?>
                        <a href="/entreprises/<?= $entreprise->getId() ?>" class="text-decoration-none">
                            <?= htmlspecialchars($entreprise->getNom()) ?>
                        </a>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </p>
                <p class="mb-2"><strong>Date de postulation:</strong> <?= htmlspecialchars($stage->getDatePostulation()) ?></p>
            </div>
            <div class="col-md-6">
                <p class="mb-2"><strong>Lien de l'offre:</strong>
                    <?php if ($stage->getLienOffre()): ?>
                        <a href="<?= htmlspecialchars($stage->getLienOffre()) ?>" target="_blank" class="text-decoration-none">
                            Voir l'offre <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    <?php else: ?>
                        Non disponible
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <div class="mt-3">
            <h4 class="h6">Description</h4>
            <div class="border p-3 bg-light rounded">
                <?= nl2br(htmlspecialchars($stage->getDescription())) ?>
            </div>
        </div>
    </div>
</div>

<?php if ($candidature): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Candidature</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-2"><strong>Statut:</strong>
                        <?php
                        $statutLabel = '';
                        foreach ($statuts ?? [] as $statut) {
                            if ($statut->getId() === $candidature->getStatutId()) {
                                $statutLabel = $statut->getLibelle();
                                break;
                            }
                        }
                        echo htmlspecialchars($statutLabel);
                        ?>
                    </p>
                    <p class="mb-2"><strong>Date de candidature:</strong> <?= htmlspecialchars($candidature->getDateCandidature()) ?></p>
                </div>
            </div>

            <?php if ($candidature->getCommentaires()): ?>
                <div class="mt-3">
                    <h4 class="h6">Commentaires</h4>
                    <div class="border p-3 bg-light rounded">
                        <?= nl2br(htmlspecialchars($candidature->getCommentaires())) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning">
        Aucune candidature n'est associée à ce stage.
    </div>
<?php endif; ?>
