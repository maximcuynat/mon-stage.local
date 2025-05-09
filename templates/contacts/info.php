<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">
        <?= htmlspecialchars($contact->getNom()) ?>
        <?= $contact->getPrenom() ? htmlspecialchars($contact->getPrenom()) : '' ?>
    </h1>
    <div class="d-flex gap-2">
        <a href="/contacts" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
        <a href="/contacts/edit/<?= $contact->getId() ?>" class="btn btn-outline-warning">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <a href="/contacts/delete/<?= $contact->getId() ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
            <i class="bi bi-trash"></i> Supprimer
        </a>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header bg-white border-bottom">
        <h3 class="card-title h5 mb-0">Informations du contact</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4 class="h6">Identité</h4>
                <p class="mb-2"><strong>Nom:</strong> <?= htmlspecialchars($contact->getNom()) ?></p>
                <p class="mb-2"><strong>Prénom:</strong> <?= $contact->getPrenom() ? htmlspecialchars($contact->getPrenom()) : 'Non spécifié' ?></p>
                <p class="mb-2"><strong>Poste:</strong> <?= $contact->getPoste() ? htmlspecialchars($contact->getPoste()) : 'Non spécifié' ?></p>
            </div>

            <div class="col-md-6">
                <h4 class="h6">Coordonnées</h4>
                <p class="mb-2">
                    <strong>Email:</strong>
                    <?php if ($contact->getEmail()): ?>
                        <a href="mailto:<?= htmlspecialchars($contact->getEmail()) ?>" class="text-decoration-none">
                            <?= htmlspecialchars($contact->getEmail()) ?>
                        </a>
                    <?php else: ?>
                        Non spécifié
                    <?php endif; ?>
                </p>
                <p class="mb-2">
                    <strong>Téléphone:</strong>
                    <?php if ($contact->getTelephone()): ?>
                        <a href="tel:<?= htmlspecialchars($contact->getTelephone()) ?>" class="text-decoration-none">
                            <?= htmlspecialchars($contact->getTelephone()) ?>
                        </a>
                    <?php else: ?>
                        Non spécifié
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <hr>

        <div class="mt-3">
            <h4 class="h6">Entreprise</h4>
            <?php if ($entreprise): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/entreprises/<?= $entreprise->getId() ?>" class="text-decoration-none">
                                <?= htmlspecialchars($entreprise->getNom()) ?>
                            </a>
                        </h5>
                        <p class="card-text">
                            <?php
                            $adresse = [];
                            if ($entreprise->getVille()) $adresse[] = $entreprise->getVille();
                            if ($entreprise->getCodePostal()) $adresse[] = $entreprise->getCodePostal();
                            if ($entreprise->getPays()) $adresse[] = $entreprise->getPays();
                            echo htmlspecialchars(implode(', ', $adresse));
                            ?>
                        </p>
                        <?php if ($entreprise->getSiteWeb()): ?>
                            <a href="<?= htmlspecialchars($entreprise->getSiteWeb()) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-globe"></i> Site web
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    Aucune entreprise n'est associée à ce contact.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
