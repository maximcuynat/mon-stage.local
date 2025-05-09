<div class="container-fluid px-0">
    <!-- En-tête avec breadcrumb -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/stages">Stages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h1 class="h3">
                    <i class="bi bi-plus-circle-dotted me-2"></i>Nouveau stage
                </h1>
                <a href="/stages" class="btn btn-outline-secondary btn-sm">
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
    <form action="/stages/add" method="post" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-lg-8">
                <!-- Informations du stage -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h3 class="card-title h5 mb-0">
                            <i class="bi bi-info-circle me-2"></i>Informations du stage
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="Nom_entreprise" class="form-label">Entreprise <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-building"></i></span>
                                <input type="text" class="form-control" id="Nom_entreprise" name="Nom_entreprise"
                                    value="<?= isset($data['Nom_entreprise']) ? htmlspecialchars($data['Nom_entreprise']) : '' ?>"
                                    list="entreprises_list" required>
                                <button class="btn btn-outline-secondary" type="button" title="Créer une nouvelle entreprise">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            <datalist id="entreprises_list">
                                <?php
                                $uniqueEntreprises = [];
                                foreach ($entreprises as $entreprise) {
                                    if (!in_array($entreprise->getNom(), $uniqueEntreprises)) {
                                        $uniqueEntreprises[] = $entreprise->getNom();
                                ?>
                                        <option value="<?= htmlspecialchars($entreprise->getNom()) ?>">
                                <?php
                                    }
                                }
                                ?>
                            </datalist>
                            <div class="form-text">Entrez le nom d'une entreprise existante ou créez-en une nouvelle</div>
                        </div>

                        <div class="mb-4">
                            <label for="Lien_offre" class="form-label">Lien de l'offre <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-link-45deg"></i></span>
                                <input type="url" class="form-control" id="Lien_offre" name="Lien_offre"
                                    value="<?= isset($data['Lien_offre']) ? htmlspecialchars($data['Lien_offre']) : '' ?>" 
                                    placeholder="https://example.com/job-offer" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="Description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="Description" name="Description" rows="5" 
                                placeholder="Décrivez le poste, les missions, les compétences requises..." required><?= isset($data['Description']) ? htmlspecialchars(trim($data['Description'])) : '' ?></textarea>
                        </div>

                        <div class="mb-2">
                            <label for="Date_postulation" class="form-label">Date de postulation <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-calendar-date"></i></span>
                                <input type="date" class="form-control" id="Date_postulation" name="Date_postulation"
                                    value="<?= isset($data['Date_postulation']) ? htmlspecialchars($data['Date_postulation']) : date('Y-m-d') ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Informations de candidature -->
                <div class="card shadow-sm border-0 mb-4 sticky-lg-top" style="top: 20px; z-index: 10;">
                    <div class="card-header bg-white border-bottom py-3">
                        <h3 class="card-title h5 mb-0">
                            <i class="bi bi-clipboard-check me-2"></i>Suivi de candidature
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">Sélectionnez un statut</option>
                                <?php
                                $uniqueStatuts = [];
                                foreach ($statuts as $statut) {
                                    if (!in_array($statut->getId(), $uniqueStatuts)) {
                                        $uniqueStatuts[] = $statut->getId();
                                ?>
                                        <option value="<?= $statut->getId() ?>"
                                            <?= (isset($data['status']) && $data['status'] == $statut->getId()) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($statut->getLibelle()) ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="Commentaires" class="form-label">Commentaires</label>
                            <textarea class="form-control" id="Commentaires" name="Commentaires" rows="4" 
                                placeholder="Notes personnelles, contacts, remarques..."><?= isset($data['Commentaires']) ? htmlspecialchars(trim($data['Commentaires'])) : '' ?></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="bi bi-save me-2"></i> Enregistrer
                            </button>
                            <a href="/stages" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                        </div>
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