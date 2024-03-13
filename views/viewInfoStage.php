<div class="mt-3 text-white container px-0 pb-5">
    <h1 class="mb-2"><?= $entreprise->nom(); ?></h1>
    <p> il y a <?= round((time() - strtotime($stage->datePostulation())) / (60 * 60 * 24)) ?> jours </p>
    <hr>
    <!-- Description -->
    <h2>Description</h2>
    <pre class="mb-2"><?= $stage->description(); ?></pre>
    <!-- Localisation -->
    <hr>
    <h2>Liens vers l'offre</h2>
    <a href="<?= $stage->lienOffre(); ?>" class="text-decoration-none" target="_blank"><?= $stage->lienOffre(); ?></a>
    <hr>
    <h2>Localisation</h2>
    <p class="mb-2"><?= $entreprise->adresse(); ?></p>
    <p class="mb-2"><?= $entreprise->codePostal(); ?> <?= $entreprise->ville(); ?></p>
    <p class="mb-2"><?= $entreprise->pays(); ?></p>

    <!-- Contact -->
    <hr>
    <h2>Contact</h2>
    <!-- Telephone -->
    <p class="mb-2">Téléphone: <a href="tel:<?= $entreprise->telephone(); ?>" class="text-decoration-none"><?= $entreprise->telephone(); ?></a></p>
    <!-- Email -->
    <p class="mb-2">Email: <a href="mailto:<?= $entreprise->email(); ?>" class="text-decoration-none"><?= $entreprise->email(); ?></a></p>
    <!-- Site web -->
    <p class="mb-2">Site web: <a href="<?= $entreprise->siteWeb(); ?>" class="text-decoration-none" target="_blank"><?= $entreprise->siteWeb(); ?></a></p>
    
</div>
