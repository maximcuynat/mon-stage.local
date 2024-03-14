<div class="mt-3 text-white container px-0">
    <h1 class="mb-2"><?= $entreprise->nom() ?><h1>
    <hr>
    <!-- Affichage des informations de l'entreprise -->
    <h2 class="">Adresse</h2>
    <p>
        <?= $entreprise->adresse() ?>
        <?= $entreprise->codePostal() ?>
        <?= $entreprise->ville() ?>
        <?= $entreprise->pays() ?>
    </p>
    <a href="https://www.google.com/maps/search/?api=1&query=<?= $entreprise->adresse() ?>+<?= $entreprise->codePostal() ?>+<?= $entreprise->ville() ?>+<?= $entreprise->pays() ?>" target="_blank">Voir sur Google Maps</a>
    <hr>
    
    <!-- Affichage des informations de contact -->
    <h2 class="">Site web</h2>
    <p><a href="<?= $entreprise->siteWeb() ?>" target="_blank"><?= $entreprise->siteWeb() ?></a></p>
    <hr>
    
    <!-- Affichage des informations de contact -->
    <h2>Contacts</h2>
    <!-- Affichage des contacts sour forme de carte bootstrap -->
    <div class="d-flex flex-wrap gap-3 pb-5">
        <?php foreach($allContacts as $contact): ?>
            <!-- Carte bootstrap theme noir -->
            <div class="card bg-dark text-white" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $contact->nom() ?></h5>
                    <h6 class="card-subtitle mb-2"><?= $contact->prenom() ?></h6>
                    <!-- Affichage des informations du poste -->
                    <?php if($contact->poste() != null): ?>
                        <hr>
                        <h6>Poste</h6>
                        <p class="card-text"><?= $contact->poste() ?></p>
                    <?php endif; ?>
                    <!-- Affichage des informations du poste -->
                    <?php if($contact->email() != null): ?>
                        <hr>
                        <h6>Email</h6>
                        <p class="card-text"><?= $contact->email() ?></p>
                    <?php endif; ?>
                    <!-- Affichage des informations du téléphone -->
                    <?php if($contact->telephone() != null): ?>
                        <hr>
                        <h6>Téléphone</h6>
                        <p class="card-text"><?= $contact->telephone() ?></p>
                    <?php endif; ?>
                    <!-- Boutton pour modifier le contact -->
                    <a href="/contacts/edit/<?= $contact->id() ?>" class="btn btn-primary">Modifier</a>
                </div>
            </div>
            
        <?php endforeach; ?>
    </div>

</div>
