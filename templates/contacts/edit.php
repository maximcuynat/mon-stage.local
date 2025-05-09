<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Modifier le contact</h1>
    <div class="d-flex gap-2">
        <a href="/contacts" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
        <a href="/contacts/<?= $contact->getId() ?>" class="btn btn-outline-info">
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

<form action="/contacts/edit/<?= $contact->getId() ?>" method="post" class="needs-validation" novalidate>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Informations personnelles</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom *</label>
                    <input type="text" class="form-control" id="nom" name="nom"
                        value="<?= isset($data['nom']) ? htmlspecialchars($data['nom']) : htmlspecialchars($contact->getNom()) ?>" required>
                    <div class="invalid-feedback">Veuillez fournir un nom.</div>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom"
                        value="<?= isset($data['prenom']) ? htmlspecialchars($data['prenom']) : htmlspecialchars($contact->getPrenom() ?? '') ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="poste" class="form-label">Poste</label>
                <input type="text" class="form-control" id="poste" name="poste"
                    value="<?= isset($data['poste']) ? htmlspecialchars($data['poste']) : htmlspecialchars($contact->getPoste() ?? '') ?>">
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Coordonnées</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?= isset($data['email']) ? htmlspecialchars($data['email']) : htmlspecialchars($contact->getEmail() ?? '') ?>">
                <div class="invalid-feedback">Veuillez fournir un email valide.</div>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone"
                    value="<?= isset($data['telephone']) ? htmlspecialchars($data['telephone']) : htmlspecialchars($contact->getTelephone() ?? '') ?>">
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Entreprise</h3>
        </div>
        <div class="card-body">
            <input type="hidden" name="idEntreprise" value="<?= $contact->getIdEntreprise() ?>">

            <div class="mb-3">
                <label for="Nom_entreprise" class="form-label">Nom de l'entreprise</label>
                <input type="text" class="form-control" id="Nom_entreprise" name="Nom_entreprise"
                    value="<?= isset($data['Nom_entreprise']) ? htmlspecialchars($data['Nom_entreprise']) : htmlspecialchars($entreprise->getNom() ?? '') ?>"
                    list="entreprises_list">
                <datalist id="entreprises_list">
                    <?php
                    $uniqueEntreprises = [];
                    foreach ($entreprises as $ent) {
                        if (!in_array($ent->getNom(), $uniqueEntreprises)) {
                            $uniqueEntreprises[] = $ent->getNom();
                    ?>
                            <option value="<?= htmlspecialchars($ent->getNom()) ?>">
                    <?php
                        }
                    }
                    ?>
                </datalist>
                <div class="form-text">Entrez le nom d'une entreprise existante ou créez-en une nouvelle.</div>
            </div>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="bi bi-save"></i> Enregistrer les modifications
        </button>
    </div>
</form>