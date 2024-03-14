<div class="mt-3 text-white container px-0 pb-5">
    <h1 class="mb-2">Stage chez : <?= $entreprise->nom(); ?></h1>
    <p>J'ai postuler il y a <strong><?= round((time() - strtotime($stage->datePostulation())) / (60 * 60 * 24)) ?></strong> jours </p>
    <hr>
    <!-- ============================ Informations générales -->
    <h2>Description</h2>
    <pre class="mb-2"><?= $stage->description(); ?></pre>
    <!-- ============================ Lien Vers l'offre -->
    <hr>
    <h2>Liens vers l'offre</h2>
    <a href="<?= $stage->lienOffre(); ?>" class="text-decoration-none" target="_blank"><?= $stage->lienOffre(); ?></a>
    
    <!-- ============================ Localisation de l'entreprise -->
    <hr>
    <h2>Localisation</h2>
    <?php if ($entreprise->adresse() || $entreprise->ville() || $entreprise->codePostal() || $entreprise->pays()) : ?>
        <p class="mb-2"><?= $entreprise->adresse(); ?></p>
        <p class="mb-2"><?= $entreprise->ville(); ?>, <?= $entreprise->codePostal(); ?></p>
        <p class="mb-2"><?= $entreprise->pays(); ?></p>
        <?php $Adresse = $entreprise->adresse() . ' ' . $entreprise->codePostal() . ' ' . $entreprise->ville() . ' ' . $entreprise->pays(); ?>
        <a href="https://www.google.com/maps/search/?api=1&query=<?= $Adresse ?>" target="_blank">Voir sur Google Maps</a>
    <?php else : ?>
        <p class="mb-2">Pas d'informations de localisation</p>
        <!-- Ajouter des informations de localisation -->
        <a href="/entreprises/edit/<?= $entreprise->id();?>" class="fw-bold btn btn-primary">Ajouter des informations de localisation</a>
    <?php endif; ?>

    <!-- ============================ Contact  -->
    <hr>
    <h2>Contact</h2>
    <?php if ($entreprise->telephone() || $entreprise->email() || $entreprise->siteWeb()) : ?>
        <p class="mb-2">Contactez l'entreprise pour plus d'informations</p>
    <?php else : ?>
        <p class="mb-2">Pas d'informations de contact</p>
        <a href="/entreprises/edit/<?= $entreprise->id();?>" class="fw-bold btn btn-primary">Ajouter des informations de contact</a>
    <?php endif; ?>
    <?php if ($entreprise->telephone()) : ?>
        <p class="mb-2">Téléphone: <a href="tel:<?= $entreprise->telephone(); ?>" class="text-decoration-none"><?= $entreprise->telephone(); ?></a></p>
    <?php endif; ?>
    
    <?php if ($entreprise->email()) : ?>
        <p class="mb-2">Email: <a href="mailto:<?= $entreprise->email(); ?>" class="text-decoration-none"><?= $entreprise->email(); ?></a></p>
    <?php endif; ?>
    
    <?php if ($entreprise->siteWeb()) : ?>
        <p class="mb-2">Site web: <a href="<?= $entreprise->siteWeb(); ?>" class="text-decoration-none" target="_blank"><?= $entreprise->siteWeb(); ?></a></p>
    <?php endif; ?>

</div>
