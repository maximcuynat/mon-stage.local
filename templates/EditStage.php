<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Modifier le stage</h1>
    <div class="d-flex gap-2">
        <a href="/stages" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
        <a href="/stages/<?= $stage->getId() ?>" class="btn btn-outline-info">
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

<form action="/stages/edit/<?= $stage->getId() ?>" method="post" class="needs-validation" novalidate>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Informations du stage</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="Nom_entreprise" class="form-label">Entreprise *</label>
                <input type="text" class="form-control" id="Nom_entreprise" name="Nom_entreprise"
                    value="<?= isset($data['Nom_entreprise']) ? htmlspecialchars($data['Nom_entreprise']) : htmlspecialchars($entreprise->getNom()) ?>"
                    list="entreprises_list" required>
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

            <div class="mb-3">
                <label for="Lien_offre" class="form-label">Lien de l'offre *</label>
                <input type="url" class="form-control" id="Lien_offre" name="Lien_offre"
                    value="<?= isset($data['Lien_offre']) ? htmlspecialchars($data['Lien_offre']) : htmlspecialchars($stage->getLienOffre()) ?>" required>
            </div>

            <div class="mb-3">
                <label for="Description" class="form-label">Description *</label>
                <textarea class="form-control" id="Description" name="Description" rows="4" required><?= isset($data['Description']) ? htmlspecialchars($data['Description']) : htmlspecialchars($stage->getDescription()) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="Date_postulation" class="form-label">Date de postulation *</label>
                <input type="date" class="form-control" id="Date_postulation" name="Date_postulation"
                    value="<?= isset($data['Date_postulation']) ? htmlspecialchars($data['Date_postulation']) : htmlspecialchars($stage->getDatePostulation()) ?>" required>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h3 class="card-title h5 mb-0">Informations de candidature</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="status" class="form-label">Statut *</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Sélectionnez un statut</option>
                    <?php
                    $currentStatus = isset($data['status']) ? $data['status'] : ($candidature ? $candidature->getStatutId() : '');
                    $uniqueStatuts = [];
                    foreach ($statuts as $statut) {
                        if (!in_array($statut->getId(), $uniqueStatuts)) {
                            $uniqueStatuts[] = $statut->getId();
                    ?>
                            <option value="<?= $statut->getId() ?>" <?= $currentStatus == $statut->getId() ? 'selected' : '' ?>>
                                <?= htmlspecialchars($statut->getLibelle()) ?>
                            </option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="Commentaires" class="form-label">Commentaires</label>
                <textarea class="form-control" id="Commentaires" name="Commentaires" rows="3"><?= isset($data['Commentaires']) ? htmlspecialchars($data['Commentaires']) : ($candidature ? htmlspecialchars($candidature->getCommentaires()) : '') ?></textarea>
            </div>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="bi bi-save"></i> Enregistrer les modifications
        </button>
    </div>
</form>
