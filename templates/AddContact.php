<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Ajouter un contact</h1>
    <a href="/contacts" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
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

<form action="/contacts/add" method="post" class="needs-validation" novalidate>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Informations personnelles</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="Nom_contact" class="form-label">Nom *</label>
                    <input type="text" class="form-control" id="Nom_contact" name="Nom_contact"
                        value="<?= isset($data['Nom_contact']) ? htmlspecialchars($data['Nom_contact']) : '' ?>" required>
                    <div class="invalid-feedback">Veuillez fournir un nom.</div>
                </div>
                <div class="col-md-6">
                    <label for="Prenom_contact" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="Prenom_contact" name="Prenom_contact"
                        value="<?= isset($data['Prenom_contact']) ? htmlspecialchars($data['Prenom_contact']) : '' ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="Poste_contact" class="form-label">Poste</label>
                <input type="text" class="form-control" id="Poste_contact" name="Poste_contact"
                    value="<?= isset($data['Poste_contact']) ? htmlspecialchars($data['Poste_contact']) : '' ?>">
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Coordonnées</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="Email_contact" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email_contact" name="Email_contact"
                    value="<?= isset($data['Email_contact']) ? htmlspecialchars($data['Email_contact']) : '' ?>">
                <div class="invalid-feedback">Veuillez fournir un email valide.</div>
            </div>

            <div class="mb-3">
                <label for="Tel_contact" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="Tel_contact" name="Tel_contact"
                    value="<?= isset($data['Tel_contact']) ? htmlspecialchars($data['Tel_contact']) : '' ?>">
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Entreprise</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="Nom_entreprise" class="form-label">Nom de l'entreprise</label>
                <input type="text" class="form-control" id="Nom_entreprise" name="Nom_entreprise"
                    value="<?= isset($data['Nom_entreprise']) ? htmlspecialchars($data['Nom_entreprise']) : '' ?>"
                    list="entreprises_list">
                <datalist id="entreprises_list">
                    <?php foreach ($entreprises as $entreprise): ?>
                        <option value="<?= htmlspecialchars($entreprise->getNom()) ?>">
                        <?php endforeach; ?>
                </datalist>
                <div class="form-text">Entrez le nom d'une entreprise existante ou créez-en une nouvelle.</div>
            </div>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="bi bi-save"></i> Enregistrer
        </button>
    </div>
</form>
