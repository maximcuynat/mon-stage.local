<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><?= htmlspecialchars($entreprise->getNom()) ?></h1>
    <div class="d-flex gap-2">
        <a href="/entreprises" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
        <a href="/entreprises/edit/<?= $entreprise->getId() ?>" class="btn btn-outline-warning">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <a href="/entreprises/delete/<?= $entreprise->getId() ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">
            <i class="bi bi-trash"></i> Supprimer
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h3 class="card-title h5 mb-0">Informations générales</h3>
            </div>
            <div class="card-body">
                <?php if ($entreprise->getAdresse() || $entreprise->getVille() || $entreprise->getCodePostal() || $entreprise->getPays()): ?>
                    <div class="mb-3">
                        <h4 class="h6">Adresse</h4>
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
                <?php endif; ?>

                <div class="mb-3">
                    <h4 class="h6">Contact</h4>
                    <ul class="list-unstyled">
                        <?php if ($entreprise->getTelephone()): ?>
                            <li class="mb-2"><i class="bi bi-telephone me-2"></i> <a href="tel:<?= htmlspecialchars($entreprise->getTelephone()) ?>" class="text-decoration-none"><?= htmlspecialchars($entreprise->getTelephone()) ?></a></li>
                        <?php endif; ?>

                        <?php if ($entreprise->getEmail()): ?>
                            <li class="mb-2"><i class="bi bi-envelope me-2"></i> <a href="mailto:<?= htmlspecialchars($entreprise->getEmail()) ?>" class="text-decoration-none"><?= htmlspecialchars($entreprise->getEmail()) ?></a></li>
                        <?php endif; ?>

                        <?php if ($entreprise->getSiteWeb()): ?>
                            <li class="mb-2"><i class="bi bi-globe me-2"></i> <a href="<?= htmlspecialchars($entreprise->getSiteWeb()) ?>" target="_blank" class="text-decoration-none"><?= htmlspecialchars($entreprise->getSiteWeb()) ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <?php if ($entreprise->getLiensOffre()): ?>
                    <div>
                        <h4 class="h6">Liens d'offres</h4>
                        <div class="border p-3 bg-light rounded">
                            <?= nl2br(htmlspecialchars($entreprise->getLiensOffre())) ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h3 class="card-title h5 mb-0">Contacts</h3>
                <a href="/contacts/add" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Ajouter
                </a>
            </div>
            <div class="card-body">
                <?php if (empty($allContacts)): ?>
                    <div class="alert alert-info">Aucun contact n'est associé à cette entreprise.</div>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($allContacts as $contact): ?>
                            <a href="/contacts/<?= $contact->getId() ?>" class="list-group-item list-group-item-action border-0 mb-2 rounded">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 h6">
                                        <?= htmlspecialchars($contact->getNom()) ?>
                                        <?= $contact->getPrenom() ? htmlspecialchars($contact->getPrenom()) : '' ?>
                                    </h5>
                                    <small><?= $contact->getPoste() ? htmlspecialchars($contact->getPoste()) : 'Non spécifié' ?></small>
                                </div>
                                <p class="mb-1">
                                    <?php if ($contact->getEmail()): ?>
                                        <i class="bi bi-envelope me-2"></i> <?= htmlspecialchars($contact->getEmail()) ?><br>
                                    <?php endif; ?>

                                    <?php if ($contact->getTelephone()): ?>
                                        <i class="bi bi-telephone me-2"></i> <?= htmlspecialchars($contact->getTelephone()) ?>
                                    <?php endif; ?>
                                </p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h3 class="card-title h5 mb-0">Stages associés</h3>
            </div>
            <div class="card-body">
                <?php
                // Récupérer les stages de cette entreprise
                $stagesEntreprise = [];
                foreach ($stages ?? [] as $stage) {
                    if ($stage->getIdEntreprise() === $entreprise->getId()) {
                        $stagesEntreprise[] = $stage;
                    }
                }

                if (empty($stagesEntreprise)):
                ?>
                    <div class="alert alert-info">Aucun stage n'est associé à cette entreprise.</div>
                    <a href="/stages/add" class="btn btn-outline-success">
                        <i class="bi bi-plus-circle"></i> Ajouter un stage
                    </a>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($stagesEntreprise as $stage): ?>
                            <a href="/stages/<?= $stage->getId() ?>" class="list-group-item list-group-item-action border-0 mb-2 rounded">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 h6">Stage - <?= date('d/m/Y', strtotime($stage->getDatePostulation())) ?></h5>
                                </div>
                                <p class="mb-1">
                                    <?= htmlspecialchars(substr($stage->getDescription(), 0, 100)) ?>...
                                </p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
