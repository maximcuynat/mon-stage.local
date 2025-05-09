<div class="container-fluid px-0">
    <!-- En-tête avec breadcrumb -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/contacts">Contacts</a></li>
                    <li class="breadcrumb-item"><a href="/contacts/<?= $contact->getId() ?>">
                        <?= htmlspecialchars($contact->getNom()) ?> <?= $contact->getPrenom() ? htmlspecialchars($contact->getPrenom()) : '' ?>
                    </a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                <h1 class="h3 mb-2 mb-md-0">
                    <i class="bi bi-pencil-square me-2"></i>Modifier le contact
                </h1>
                <div class="d-flex gap-2">
                    <a href="/contacts" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                    <a href="/contacts/<?= $contact->getId() ?>" class="btn btn-info btn-sm text-white">
                        <i class="bi bi-eye me-1"></i> Voir détails
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertes -->
    <?php if (isset($error) || (isset($errors) && !empty($errors))): ?>
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <?php if (isset($errors) && !empty($errors)): ?>
                    <ul class="mb-0 ps-3">
                        <?php foreach ($errors as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= htmlspecialchars($error) ?>
                <?php endif; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Formulaire -->
    <form action="/contacts/edit/<?= $contact->getId() ?>" method="post" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-8">
                <!-- Informations personnelles -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                        <h3 class="card-title h5 mb-0">
                            <i class="bi bi-person-vcard me-2"></i>Informations personnelles
                        </h3>
                        <span class="badge bg-primary">ID: <?= $contact->getId() ?></span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="nom" name="nom"
                                        value="<?= isset($data['nom']) ? htmlspecialchars($data['nom']) : htmlspecialchars($contact->getNom()) ?>" required>
                                </div>
                                <div class="invalid-feedback">Veuillez fournir un nom.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom"
                                    value="<?= isset($data['prenom']) ? htmlspecialchars($data['prenom']) : htmlspecialchars($contact->getPrenom() ?? '') ?>"
                                    placeholder="Prénom (optionnel)">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="poste" class="form-label">Poste</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-briefcase"></i></span>
                                <input type="text" class="form-control" id="poste" name="poste"
                                    value="<?= isset($data['poste']) ? htmlspecialchars($data['poste']) : htmlspecialchars($contact->getPoste() ?? '') ?>"
                                    placeholder="Ex: Responsable RH, Développeur, Directeur commercial...">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= isset($data['email']) ? htmlspecialchars($data['email']) : htmlspecialchars($contact->getEmail() ?? '') ?>"
                                    placeholder="email@exemple.com">
                                <?php if ($contact->getEmail()): ?>
                                <a href="mailto:<?= htmlspecialchars($contact->getEmail()) ?>" class="btn btn-outline-secondary" title="Envoyer un email">
                                    <i class="bi bi-envelope-paper"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                            <div class="invalid-feedback">Veuillez fournir un email valide.</div>
                        </div>

                        <div class="mb-4">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-telephone"></i></span>
                                <input type="tel" class="form-control" id="telephone" name="telephone"
                                    value="<?= isset($data['telephone']) ? htmlspecialchars($data['telephone']) : htmlspecialchars($contact->getTelephone() ?? '') ?>"
                                    placeholder="+33 1 23 45 67 89">
                                <?php if ($contact->getTelephone()): ?>
                                <a href="tel:<?= htmlspecialchars($contact->getTelephone()) ?>" class="btn btn-outline-secondary" title="Appeler">
                                    <i class="bi bi-telephone-outbound"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Entreprise -->
                <div class="card border-0 shadow-sm mb-4 sticky-lg-top" style="top: 20px; z-index: 10;">
                    <div class="card-header bg-white border-bottom py-3">
                        <h3 class="card-title h5 mb-0">
                            <i class="bi bi-building me-2"></i>Entreprise
                        </h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="idEntreprise" value="<?= $contact->getIdEntreprise() ?>">

                        <div class="mb-4">
                            <label for="Nom_entreprise" class="form-label">Nom de l'entreprise</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-building"></i></span>
                                <input type="text" class="form-control" id="Nom_entreprise" name="Nom_entreprise"
                                    value="<?= isset($data['Nom_entreprise']) ? htmlspecialchars($data['Nom_entreprise']) : htmlspecialchars($entreprise->getNom() ?? '') ?>"
                                    list="entreprises_list" placeholder="Sélectionnez ou créez une entreprise">
                                <?php if ($entreprise): ?>
                                <a href="/entreprises/<?= $entreprise->getId() ?>" class="btn btn-outline-info" title="Voir l'entreprise">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <?php else: ?>
                                <button class="btn btn-outline-secondary" type="button" 
                                        onclick="window.location.href='/entreprises/add'" title="Créer une nouvelle entreprise">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                                <?php endif; ?>
                            </div>
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

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning text-white py-2">
                                <i class="bi bi-save me-2"></i> Enregistrer les modifications
                            </button>
                            <a href="/contacts/<?= $contact->getId() ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Historique -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h3 class="card-title h5 mb-0">
                            <i class="bi bi-clock-history me-2"></i>Activité
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="d-block text-muted">Dernière modification</small>
                                    <span>ID contact</span>
                                </div>
                                <span class="badge bg-light text-dark">
                                    <?= $contact->getId() ?>
                                </span>
                            </li>
                            <?php if ($entreprise): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="d-block text-muted">Entreprise associée</small>
                                    <span>ID entreprise</span>
                                </div>
                                <span class="badge bg-light text-dark">
                                    <?= $entreprise->getId() ?>
                                </span>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
@media (max-width: 992px) {
    .sticky-lg-top {
        position: relative !important;
        top: 0 !important;
    }
}
</style>