<?php

    // On récupère l'entreprise
    if(!empty($_POST))
    {
        extract($_POST);
        $errors = array();

        if(count($errors) == 0)
        {
            // On ajoute les dans la table Contacts
            $data = array(
                "Nom"           => $nom,
                "Prenom"        => $prenom,
                "Email"         => $email,
                "Telephone"     => $telephone,
                "Poste"         => $poste
            );

            $contact = new Contacts($data);
            $contactsManager = new ContactsManager();
            $contactsManager->updateContact($data, $idContact);
            header('Location: /contacts');
        }
    }
?>

<div class="my-3 text-white container px-0">
    <!-- Formulaire pour editer le contact --> 
    <form method="POST">
        <h1>Informations du contact</h1>
        <hr>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <!-- Entreprise  dans laquelle le contact travaille -->
        <h2>Entreprise du contact</h2>
        <div class="mb-3 d-flex flex-row justify-content-between align-items-end">
            <div class="flex-fill me-3">
                <label for="entreprise" class="form-label">Entreprise</label>
                <input type="text" class="form-control" id="entreprise" name="entreprise" value="<?= $entreprises->nom() ?>" disabled>
            </div>
            <div>
                <a href="/entreprises/edit/<?= $contact->idEntreprise() ?>" class="btn btn-primary">Modifier l'entreprise</a>  
            </div>
        </div>
        
        <hr>
        <input type="hidden" name="idContact" value="<?= $contact->id()?>">
        <input type="hidden" name="idEntreprise" value="<?= $contact->idEntreprise() ?>">
        <h2>Informations du contact</h2>
        <!-- Nom et prénom -->
        <div class="d-flex flex-row justify-content-between">
            <!-- Nom -->
            <div class="mb-3 me-3 flex-fill">
                <label for="nomContact" class="form-label">Nom du contact</label>
                <input type="text" class="form-control" id="nomContact" name="nom" value="<?= $contact->nom() ?>">
            </div>

            <!-- Prénom -->
            <div class="mb-3 ms-3 flex-fill">
                <label for="prenomContact" class="form-label">Prénom du contact</label>
                <input type="text" class="form-control" id="prenomContact" name="prenom" value="<?= $contact->prenom() ?>">
            </div>
        </div>
        <!-- Email et Téléphone -->
        <div class="d-flex flex-row justify-content-between">
            <!-- Email -->
            <div class="mb-3 me-3 flex-fill">
                <label for="emailContact" class="form-label">Email du contact</label>
                <input type="email" class="form-control" id="emailContact" name="email" value="<?= $contact->email() ?>">
            </div>        
            
            <!-- Téléphone -->
            <div class="mb-3 ms-3 flex-fill">
                <label for="telContact" class="form-label">Téléphone du contact</label>
                <input type="tel" class="form-control" id="telContact" name="telephone" value="<?= $contact->telephone() ?>">
            </div>
        </div>

        <hr>
        <h2>Poste du contact</h2>
        <!-- Poste -->
        <div class="d-flex flex-row justify-content-between">
            <div class="mb-3 flex-fill">
                <label for="posteContact" class="form-label">Poste du contact</label>
                <input type="text" class="form-control" id="posteContact" name="poste" value="<?= $contact->poste() ?>">
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>