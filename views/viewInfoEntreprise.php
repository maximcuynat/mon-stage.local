<div class="mt-3 text-white container px-0">
    <h1 class="mb-2"><?= $entreprise->nom() ?><h1>
    <hr>
    <h2 class="">Adresse</h2>
    <p><?= $entreprise->adresse() ?></p>

    <h2 class="">Site web</h2>
    <p><a href="<?= $entreprise->siteWeb() ?>" target="_blank"><?= $entreprise->siteWeb() ?></a></p>

    <h2 class="">Contacts</h2>

    <!-- Affichage des contacts sour forme de carte bootstrap -->
    <div class="d-flex flex-wrap gap-2">
        <?php foreach($allContacts as $contact): ?>

            <!-- Carte bootstrap theme noir -->
            <div class="card bg-dark text-white" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $contact->nom() ?></h5>
                    <h6 class="card-subtitle mb-2"><?= $contact->prenom() ?></h6>
                    <p class="card-text"><?= $contact->email() ?></p>
                    <p class="card-text"><?= $contact->telephone() ?></p>
                </div>
            </div>
            
        <?php endforeach; ?>
    </div>

</div>
