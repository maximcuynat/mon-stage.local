<div class="container-fluid px-0">
    <!-- En-tête avec breadcrumb -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/entreprises">Entreprises</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h1 class="h3">
                    <i class="bi bi-building-add me-2"></i>Nouvelle entreprise
                </h1>
                <a href="/entreprises" class="btn btn-outline-secondary btn-sm">
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
    <form action="/entreprises/add" method="post" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-8">
                <!-- Informations générales -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                        <h3 class="card-title h5 mb-0">
                            <i class="bi bi-info-circle me-2"></i>Informations générales
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="Nom_entreprise" class="form-label">Nom de l'entreprise <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-building"></i></span>
                                <input type="text" class="form-control" id="Nom_entreprise" name="Nom_entreprise"
                                    value="<?= isset($data['Nom_entreprise']) ? htmlspecialchars($data['Nom_entreprise']) : '' ?>" required>
                            </div>
                            <div class="invalid-feedback">Veuillez fournir un nom d'entreprise.</div>
                        </div>

                        <div class="mb-4">
                            <label for="Adresse" class="form-label">Adresse</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" class="form-control" id="Adresse" name="Adresse"
                                    value="<?= isset($data['Adresse']) ? htmlspecialchars($data['Adresse']) : '' ?>"
                                    placeholder="123 rue de la Paix">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="Code_postal" class="form-label">Code postal</label>
                                <input type="text" class="form-control" id="Code_postal" name="Code_postal"
                                    value="<?= isset($data['Code_postal']) ? htmlspecialchars($data['Code_postal']) : '' ?>"
                                    placeholder="75000">
                            </div>
                            <div class="col-md-8">
                                <label for="Ville" class="form-label">Ville</label>
                                <input type="text" class="form-control" id="Ville" name="Ville"
                                    value="<?= isset($data['Ville']) ? htmlspecialchars($data['Ville']) : '' ?>"
                                    placeholder="Paris">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="Pays" class="form-label">Pays</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-globe"></i></span>
                                <input type="text" class="form-control" id="Pays" name="Pays"
                                    value="<?= isset($data['Pays']) ? htmlspecialchars($data['Pays']) : 'France' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Informations de contact -->
                <div class="card border-0 shadow-sm mb-4 sticky-lg-top" style="top: 20px; z-index: 10;">
                    <div class="card-header bg-white border-bottom py-3">
                        <h3 class="card-title h5 mb-0">
                            <i class="bi bi-person-lines-fill me-2"></i>Informations de contact
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="Telephone" class="form-label">Téléphone</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-telephone"></i></span>
                                <input type="tel" class="form-control" id="Telephone" name="Telephone"
                                    value="<?= isset($data['Telephone']) ? htmlspecialchars($data['Telephone']) : '' ?>"
                                    placeholder="+33 1 23 45 67 89">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="Email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="Email" name="Email"
                                    value="<?= isset($data['Email']) ? htmlspecialchars($data['Email']) : '' ?>"
                                    placeholder="contact@entreprise.com">
                            </div>
                            <div class="invalid-feedback">Veuillez fournir un email valide.</div>
                        </div>

                        <div class="mb-4">
                            <label for="Site_web" class="form-label">Site web</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-globe2"></i></span>
                                <input type="url" class="form-control" id="Site_web" name="Site_web"
                                    value="<?= isset($data['Site_web']) ? htmlspecialchars($data['Site_web']) : '' ?>"
                                    placeholder="https://www.entreprise.com">
                            </div>
                            <div class="invalid-feedback">Veuillez fournir une URL valide.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="bi bi-save me-2"></i> Enregistrer
                            </button>
                            <a href="/entreprises" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Carte d'aide -->
                <div class="card border-0 shadow-sm bg-light mb-4">
                    <div class="card-body">
                        <h4 class="h6 d-flex align-items-center mb-3">
                            <i class="bi bi-lightbulb-fill text-warning me-2"></i>
                            Astuce
                        </h4>
                        <p class="small text-muted mb-0">
                            Après avoir ajouté une entreprise, vous pourrez y associer des contacts et des stages depuis sa page de détails.
                        </p>
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