<?php

    if(!empty($_POST))
    {
        extract($_POST);
        // Gestions de erreur du formulaire 
        $errors = array();

        // Vérification des champs
        if(empty($Nom_entreprise) || empty($Adresse) || empty($Ville) || empty($Code_postal) || empty($Pays) || empty($Telephone) || empty($Site_web))
            array_push($errors, "Tous les champs doivent être remplis");
        

        // Si il n'y a pas d'erreur
        if(count($errors) == 0)
        {
            $dataEntreprise = array(
                "Nom_entreprise"    => $Nom_entreprise,
                "Adresse"           => $Adresse,
                "Ville"             => $Ville,
                "Code_postal"       => $Code_postal,
                "Pays"              => $Pays,
                "Telephone"         => $Telephone,
                "Site_web"          => $Site_web,
            );

            // On ajoute les dans la table Entreprises
            $entreprise = new Entreprises($data);
            $entrepriseManager = new EntreprisesManager();
            $idEntreprise = $entrepriseManager->addEntreprise($data);

            $dataContact = array(
                "Nom"               => $Nom_contact,
                "Prenom"            => $Prenom_contact,
                "Email"             => $Mail_contact,
                "Telephone"         => $Telephone_contact,
                "ID_Entreprise"     => $idEntreprise,
            );

            // On ajoute les dans la table Contacts
            $contact = new Contacts($dataContact);
            $contactManager = new ContactsManager();
            $contactManager->addContact($data);

            // Redirection vers la page d'accueil
            header("Location: /entreprises");
        }
    }

?>

<!--- Page -->
 
<div class="my-3 text-white container px-0">
    <!-- Formulaire -->
    <form method="POST">
        <h1>Entreprise</h1>
        <hr>
        <div>
            <!-- Informations de l'enreprise -->
            <!-- Nom -->
            <div class="d-flex flex-row justify-content-between">
                <div class="mb-3 flex-fill">
                    <label for="nomEntreprise" class="form-label">Nom de l'entreprise</label>
                    <input type="text" class="form-control" id="nomEntreprise" name="Nom_entreprise" placeholder="Nom de l'entreprise">
                </div>
            </div>
            <!-- Adresse -->
            <div class="d-flex flex-row justify-content-between">
                <div class="mb-3 me-3 flex-fill">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="Adresse" placeholder="Adresse">
                </div>
                <div class="mb-3 mx-3 flex-fill">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="ville" name="Ville" placeholder="Ville">
                </div>
                <div class="mb-3 mx-3 flex-fill">
                    <label for="codepostal" class="form-label">Code Postal</label>
                    <input type="text" class="form-control" id="codepostal" name="Code_postal" placeholder="Code Postal">
                </div>
                <div class="mb-3 ms-3 flex-fill">
                    <label for="pays" class="form-label">Pays</label>
                    <input type="text" class="form-control" id="pays" name="Pays" placeholder="Pays">
                </div>
            </div>
            <!-- Téléphone et site web -->
            <div class="d-flex flex-row justify-content-between">
                <div class="mb-3 me-3 flex-fill">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="telephone" name="Telephone" placeholder="Téléphone">
                </div>
                <div class="mb-3 ms-3 flex-fill">
                    <label for="siteWeb" class="form-label">Site web</label>
                    <input type="text" class="form-control" id="siteWeb" name="Site_web" placeholder="Site web">
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>