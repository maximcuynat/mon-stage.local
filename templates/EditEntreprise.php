<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Modifier l'entreprise</h1>
    <div class="d-flex gap-2">
        <a href="/entreprises" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
        <a href="/entreprises/<?= $entreprise->getId() ?>" class="btn btn-outline-info">
            <i class="bi bi-eye"></i> Voir le détail
        </a>
    </div>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($error) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            <?php foreach ($errors as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form action="/entreprises/edit/<?= $entreprise->getId() ?>" method="post" class="needs-validation" novalidate>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Informations générales</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="Nom_entreprise" class="form-label">Nom de l'entreprise *</label>
                <input type="text" class="form-control" id="Nom_entreprise" name="Nom_entreprise"
                    value="<?= isset($data['Nom_entreprise']) ? htmlspecialchars($data['Nom_entreprise']) : htmlspecialchars($entreprise->getNom()) ?>" required>
                <div class="invalid-feedback">Veuillez fournir un nom d'entreprise.</div>
            </div>

            <div class="mb-3">
                <label for="Adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="Adresse" name="Adresse"
                    value="<?= isset($data['Adresse']) ? htmlspecialchars($data['Adresse']) : htmlspecialchars($entreprise->getAdresse() ?? '') ?>">
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="Code_postal" class="form-label">Code postal</label>
                    <input type="text" class="form-control" id="Code_postal" name="Code_postal"
                        value="<?= isset($data['Code_postal']) ? htmlspecialchars($data['Code_postal']) : htmlspecialchars($entreprise->getCodePostal() ?? '') ?>">
                </div>
                <div class="col-md-8">
                    <label for="Ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="Ville" name="Ville"
                        value="<?= isset($data['Ville']) ? htmlspecialchars($data['Ville']) : htmlspecialchars($entreprise->getVille() ?? '') ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="Pays" class="form-label">Pays</label>
                <input type="text" class="form-control" id="Pays" name="Pays"
                    value="<?= isset($data['Pays']) ? htmlspecialchars($data['Pays']) : htmlspecialchars($entreprise->getPays() ?? 'France') ?>">
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Informations de contact</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="Telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="Telephone" name="Telephone"
                    value="<?= isset($data['Telephone']) ? htmlspecialchars($data['Telephone']) : htmlspecialchars($entreprise->getTelephone() ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email" name="Email"
                    value="<?= isset($data['Email']) ? htmlspecialchars($data['Email']) : htmlspecialchars($entreprise->getEmail() ?? '') ?>">
                <div class="invalid-feedback">Veuillez fournir un email valide.</div>
            </div>

            <div class="mb-3">
                <label for="Site_web" class="form-label">Site web</label>
                <input type="url" class="form-control" id="Site_web" name="Site_web"
                    value="<?= isset($data['Site_web']) ? htmlspecialchars($data['Site_web']) : htmlspecialchars($entreprise->getSiteWeb() ?? '') ?>"
                    placeholder="https://...">
                <div class="invalid-feedback">Veuillez fournir une URL valide.</div>
            </div>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="bi bi-save"></i> Enregistrer les modifications
        </button>
    </div>
</form>