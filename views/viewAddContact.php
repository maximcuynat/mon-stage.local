<?php

    // Recupéraations des nom des entreprises
    $entrepriseManager = new EntreprisesManager();
    $entreprises = $entrepriseManager->getEntreprises();

    if(!empty($_POST))
    {
        extract($_POST);
        $errors = array();

        if(empty($Nom_entreprise))
            array_push($errors, "Le nom de l'entreprise est obligatoire");

        if(isset($Email_contact) && !filter_var($Email_contact, FILTER_VALIDATE_EMAIL))
            array_push($errors, "L'email du contact n'est pas valide");

        if(count($errors) == 0)
        {
            // on vérifie que l'entreprise n'existe pas déjà
            $entrepriseManager = new EntreprisesManager();

            $entreprise = $entrepriseManager->getEntreprise($Nom_entreprise);
            
            // Si l'entreprise n'existe pas
            if($entreprise == null)
            {
                // On ajoute les dans la table Entreprises
                $dataEntreprise = array(
                    "Nom"    => $Nom_entreprise
                );
                $entreprise = new Entreprises($dataEntreprise);
                $idEntreprise = $entrepriseManager->addEntreprise($dataEntreprise);
            }
            else
            {
                $idEntreprise = $entreprise['ID'];
            }

            // On ajoute les dans la table Contacts
            $data = array(
                "Nom"           => $Nom_contact,
                "Prenom"        => $Prenom_contact,
                "Email"         => $Email_contact,
                "Telephone"     => $Tel_contact,
                "ID_Entreprise" => $idEntreprise,
                "Poste"         => $Poste_contact
            );

            $contact = new Contacts($data);
            $contactManager = new ContactsManager();
            $idNewContact = $contactManager->addContact($data);

            header('Location: /contacts');
        }

    }

?>

<!-- Page -->

<div class="my-3 text-white container px-0">
    <form method="POST">
        <h1>Enregistrer un Contact</h1> 
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
        <div class="d-flex flex-row justify-content-between">
            <!-- Nom de l'entreprise -->
            <div class="mb-3 w-50">
                <label for="nomEntreprise" class="form-label">Nom de l'entreprise</label>
                <input type="text" class="form-control" id="entreprise" name="Nom_entreprise" list="entreprises" required>
                <datalist id="entreprises">
                    <?php foreach ($entreprises as $entreprise) { ?>
                        <option value="<?= $entreprise->nom() ?>"></option>
                    <?php } ?>
                </datalist>
            </div>
        </div>

        <h2>Informations du contact</h2>
        <hr>
        <div class="d-flex flex-row justify-content-between">
            <!-- Nom -->
            <div class="mb-3 me-3 flex-fill">
                <label for="nomContact" class="form-label">Nom du contact</label>
                <input type="text" class="form-control" id="nomContact" name="Nom_contact" value="<?php  if(isset($Nom_contact)) echo $Nom_contact; ?>">
            </div>

            <!-- Prénom -->
            <div class="mb-3 ms-3 flex-fill">
                <label for="prenomContact" class="form-label">Prénom du contact</label>
                <input type="text" class="form-control" id="prenomContact" name="Prenom_contact">
            </div>
        </div>

        <div class="d-flex flex-row justify-content-between">
            <!-- Email -->
            <div class="mb-3 me-3 flex-fill">
                <label for="emailContact" class="form-label">Email du contact</label>
                <input type="email" class="form-control" id="emailContact" name="Email_contact">
            </div>        
            
            <!-- Téléphone -->
            <div class="mb-3 ms-3 flex-fill">
                <label for="telContact" class="form-label">Téléphone du contact</label>
                <input type="tel" class="form-control" id="telContact" name="Tel_contact">
            </div>
        </div>
        <hr>
        <h2>Poste du contact</h2> 
        <div class="d-flex flex-row justify-content-between">
            <div class="mb-3 w-100">
                <label for="posteContact" class="form-label">Poste du contact</label>
                <input type="text" class="form-control" id="posteContact" name="Poste_contact">
            </div>
        </div>
        <hr>
        <!-- Bouton d'ajout -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    <form>
</div>
