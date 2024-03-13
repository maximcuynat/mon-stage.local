<?php

    // On récupère l'entreprise
    if(!empty($_POST))
    {
        extract($_POST);
        $errors = array();

        if(empty($nom))
            array_push($errors, "Le nom du contact est obligatoire");
        if(empty($prenom))
            array_push($errors, "Le prénom du contact est obligatoire");
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            array_push($errors, "L'email du contact n'est pas valide");
        if(empty($telephone))
            array_push($errors, "Le téléphone du contact est obligatoire");

        if(count($errors) == 0)
        {
            // On ajoute les dans la table Contacts
            $data = array(
                "Nom"           => $nom,
                "Prenom"        => $prenom,
                "Email"         => $email,
                "Telephone"     => $telephone
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
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <hr>
        <input type="hidden" name="idContact" value="<?= $contact->id()?>">
        <input type="hidden" name="idEntreprise" value="<?= $contact->idEntreprise() ?>">
        <div class="d-flex flex-row justify-content-between">
            <!-- Nom -->
            <div class="mb-3 me-3 flex-fill">
                <label for="nomContact" class="form-label">Nom du contact</label>
                <input type="text" class="form-control" id="nomContact" name="nom" value="<?= $contact->nom() ?>" required>
            </div>

            <!-- Prénom -->
            <div class="mb-3 ms-3 flex-fill">
                <label for="prenomContact" class="form-label">Prénom du contact</label>
                <input type="text" class="form-control" id="prenomContact" name="prenom" value="<?= $contact->prenom() ?>" required>
            </div>
        </div>
        
        <div class="d-flex flex-row justify-content-between">
            <!-- Email -->
            <div class="mb-3 me-3 flex-fill">
                <label for="emailContact" class="form-label">Email du contact</label>
                <input type="email" class="form-control" id="emailContact" name="email" value="<?= $contact->email() ?>" required>
            </div>        
            
            <!-- Téléphone -->
            <div class="mb-3 ms-3 flex-fill">
                <label for="telContact" class="form-label">Téléphone du contact</label>
                <input type="tel" class="form-control" id="telContact" name="telephone" value="<?= $contact->telephone() ?>" required>
            </div>
        </div>
        
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>