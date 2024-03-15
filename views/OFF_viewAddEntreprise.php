<?php

    if(!empty($_POST))
    {
        extract($_POST);
        // Gestions de erreur du formulaire 
        $errors = array();

        var_dump($_POST);

        // Vérification des champs
        if(empty($Nom))
            $errors[] = "Le nom de l'entreprise est obligatoire";
        if(empty($Adresse))
            $errors[] = "L'adresse est obligatoire";
        if(empty($Ville))
            $errors[] = "La ville est obligatoire";
        if(empty($Code_Postal))
            $errors[] = "Le code postal est obligatoire";
        if(empty($Pays))
            $errors[] = "Le pays est obligatoire";
        if(empty($Telephone))
            $errors[] = "Le téléphone est obligatoire";
        if(empty($Site_Web))
            $errors[] = "Le site web est obligatoire";
        

        // Si il n'y a pas d'erreur
        if(count($errors) == 0)
        {
            $dataEntreprise = array(
                "Nom"           => $Nom,
                "Adresse"       => $Adresse,
                "Ville"         => $Ville,
                "Code_Postal"   => $Code_Postal,
                "Pays"          => $Pays,
                "Telephone"     => $Telephone,
                "Site_Web"      => $Site_Web
            );
            var_dump($dataEntreprise);

            // On ajoute les dans la table Entreprises
            $entreprise         = new Entreprises($data);
            $entrepriseManager  = new EntreprisesManager();
            $idEntreprise       = $entrepriseManager->addEntreprise($data);

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
        <?php
            if(!empty($errors))
            {
                echo "<div class='alert alert-danger'>";
                foreach($errors as $error)
                    echo "<p>$error</p>";
                echo "</div>";
            }
        ?>
        <hr>
        <div>
            <!-- Informations de l'enreprise -->
            <!-- Nom -->
            <div class="d-flex flex-row justify-content-between">
                <div class="mb-3 flex-fill">
                    <label for="nomEntreprise" class="form-label">Nom de l'entreprise</label>
                    <input type="text" class="form-control" id="nomEntreprise" name="Nom" placeholder="Nom de l'entreprise">
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
                    <input type="text" class="form-control" id="codepostal" name="Code_Postal" placeholder="Code Postal">
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
                    <input type="text" class="form-control" id="siteWeb" name="Site_Web" placeholder="Site web">
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>