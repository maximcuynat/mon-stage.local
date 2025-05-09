<div class="container-fluid px-0">
    <!-- En-tête avec breadcrumb -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/contacts">Contacts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h1 class="h3">
                    <i class="bi bi-person-plus me-2"></i>Nouveau contact
                </h1>
                <a href="/contacts" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Retour
                </a>
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
    <form action="/contacts/add" method="post" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-8">
                <!-- Informations personnelles -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                        <h3 class="card-title h5 mb-0">
                            <i class="bi bi-person-vcard me-2"></i>Informations personnelles
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="Nom_contact" class="form-label">Nom <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="Nom_contact" name="Nom_contact"
                                        value="<?= isset($data['Nom_contact']) ? htmlspecialchars($data['Nom_contact']) : '' ?>" required>
                                </div>
                                <div class="invalid-feedback">Veuillez fournir un nom.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="Prenom_contact" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="Prenom_contact" name="Prenom_contact"
                                    value="<?= isset($data['Prenom_contact']) ? htmlspecialchars($data['Prenom_contact']) : '' ?>"
                                    placeholder="Prénom (optionnel)">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="Poste_contact" class="form-label">Poste</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-briefcase"></i></span>
                                <input type="text" class="form-control" id="Poste_contact" name="Poste_contact"
                                    value="<?= isset($data['Poste_contact']) ? htmlspecialchars($data['Poste_contact']) : '' ?>"
                                    placeholder="Ex: Responsable RH, Développeur, Directeur commercial...">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="Email_contact" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="Email_contact" name="Email_contact"
                                    value="<?= isset($data['Email_contact']) ? htmlspecialchars($data['Email_contact']) : '' ?>"
                                    placeholder="email@exemple.com">
                            </div>
                            <div class="invalid-feedback">Veuillez fournir un email valide.</div>
                        </div>

                        <div class="mb-4">
                            <label for="Tel_contact" class="form-label">Téléphone</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-telephone"></i></span>
                                <input type="tel" class="form-control" id="Tel_contact" name="Tel_contact"
                                    value="<?= isset($data['Tel_contact']) ? htmlspecialchars($data['Tel_contact']) : '' ?>"
                                    placeholder="+33 1 23 45 67 89">
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
                        <div class="mb-4">
                            <label for="Nom_entreprise" class="form-label">Nom de l'entreprise</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-building"></i></span>
                                <input type="text" class="form-control" id="Nom_entreprise" name="Nom_entreprise"
                                    value="<?= isset($data['Nom_entreprise']) ? htmlspecialchars($data['Nom_entreprise']) : '' ?>"
                                    list="entreprises_list" placeholder="Sélectionnez ou créez une entreprise">
                                <button class="btn btn-outline-secondary" type="button" 
                                        onclick="window.location.href='/entreprises/add'" title="Créer une nouvelle entreprise">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                            <datalist id="entreprises_list">
                                <?php foreach ($entreprises as $entreprise): ?>
                                    <option value="<?= htmlspecialchars($entreprise->getNom()) ?>">
                                <?php endforeach; ?>
                            </datalist>
                            <div class="form-text">Entrez le nom d'une entreprise existante ou créez-en une nouvelle.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="bi bi-save me-2"></i> Enregistrer
                            </button>
                            <a href="/contacts" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Aide -->
                <div class="card border-0 shadow-sm bg-light mb-4">
                    <div class="card-body">
                        <h4 class="h6 d-flex align-items-center mb-3">
                            <i class="bi bi-lightbulb-fill text-warning me-2"></i>
                            Astuces
                        </h4>
                        <ul class="small text-muted mb-0 ps-3">
                            <li class="mb-2">Les champs marqués d'un <span class="text-danger">*</span> sont obligatoires.</li>
                            <li class="mb-2">Vous pourrez associer ce contact à une entreprise existante ou en créer une nouvelle.</li>
                            <li>Pensez à bien vérifier les coordonnées pour faciliter la prise de contact ultérieure.</li>
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