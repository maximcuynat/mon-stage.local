<div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="text-center">
        <h1 class="display-4 text-danger"><i class="bi bi-exclamation-triangle"></i></h1>
        <h2 class="h4 mb-4">Erreur</h2>

        <div class="alert alert-danger">
            <?= isset($errorMessage) ? htmlspecialchars($errorMessage) : "Une erreur inattendue s'est produite." ?>
        </div>

        <div class="mt-4">
            <a href="/" class="btn btn-outline-primary">
                <i class="bi bi-house"></i> Retour à l'accueil
            </a>
        </div>
    </div>
</div>
