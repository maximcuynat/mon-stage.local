<?php

    // On récupère l'entreprise
    if(!empty($_POST))
    {
        extract($_POST);

        $data = array(
            "Nom" => $Nom_entreprise,
            "Adresse" => $Adresse,
            "Ville" => $Ville,
            "Code_postal" => $Code_postal,
            "Pays" => $Pays,
            "Telephone" => $Telephone,
            "Site_web" => $Site_web
        );

        print_r($data);
        // On met a jours l'entreprise
        $entrepriseManager = new EntreprisesManager();
        $entrepriseManager->updateEntreprise($data, $id);
        header("Location: /entreprises");

    }
?>

<div class="my-3 text-white container px-0">
    <!-- Formulaire -->
    <form method="POST">
        <h1>Entreprise</h1>
        <hr>
        <div>
            <input type="hidden" name="id" value="<?= $entreprise->id() ?>">
            <!-- Informations de l'enreprise -->
            <!-- Nom -->
            <div class="d-flex flex-row justify-content-between">
                <div class="mb-3 flex-fill">
                    <label for="nomEntreprise" class="form-label">Nom de l'entreprise</label>
                    <input type="text" class="form-control" id="nomEntreprise" name="Nom_entreprise" placeholder="Nom de l'entreprise" value="<?= $entreprise->nom() ?>">
                </div>
            </div>
            <hr>
            <!-- Adresse -->
            <div class="d-flex flex-row justify-content-between">
                <div class="mb-3 me-3 flex-fill">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="Adresse" placeholder="Adresse" value="<?= $entreprise->adresse() ?>">
                </div>
                <div class="mb-3 mx-3 flex-fill">
                    <label for="ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="ville" name="Ville" placeholder="Ville" value="<?= $entreprise->ville() ?>" >
                </div>
                <div class="mb-3 mx-3 flex-fill">
                    <label for="codepostal" class="form-label">Code Postal</label>
                    <input type="text" class="form-control" id="codepostal" name="Code_postal" placeholder="Code Postal" value="<?= $entreprise->codepostal() ?>">
                </div>
                <div class="mb-3 ms-3 flex-fill">
                    <label for="pays" class="form-label">Pays</label>
                    <input type="text" class="form-control" id="pays" name="Pays" placeholder="Pays" value="<?= $entreprise->pays() ?>">
                </div>
            </div>
            <!-- Téléphone et site web -->
            <div class="d-flex flex-row justify-content-between">
                <div class="mb-3 me-3 flex-fill">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="telephone" name="Telephone" placeholder="Téléphone" value="<?= $entreprise->telephone() ?>">
                </div>
                <div class="mb-3 ms-3 flex-fill">
                    <label for="siteWeb" class="form-label">Site web</label>
                    <input type="text" class="form-control" id="siteWeb" name="Site_web" placeholder="Site web" value="<?= $entreprise->siteweb() ?>">
                </div>
            </div>
        </div>
        <h3 hidden class="mt-5">Contact</h3>
        <hr>
        <div hidden >
            <div class="d-flex flex-row justify-content-between">
                <div class="mb-3 me-3 flex-fill">
                    <label for="nomContact" class="form-label">Nom du contact</label>
                    <input type="text" class="form-control" id="nomContact" name="Nom_contact" placeholder="Nom du contact" value="">
                </div>
                <div class="mb-3 ms-3 flex-fill">
                    <label for="prenomContact" class="form-label">Prénom du contact</label>
                    <input type="text" class="form-control" id="prenomContact" name="Prenom_contact" placeholder="Prénom du contact">
                </div>
            </div>
            
            <div class="d-flex flex-row justify-content-between">
                <div class="mb-3 me-3 flex-fill">
                    <label for="mailContact" class="form-label">Mail du contact</label>
                    <input type="email" class="form-control" id="mailContact" name="Mail_contact" placeholder="Mail du contact">
                </div>
                <div class="mb-3 ms-3 flex-fill">
                    <label for="telephonecontact" class="form-label">Télépgone du contact</label>
                    <input type="text" class="form-control" id="telephonecontact" name="Telephone_contact" placeholder="Téléphone du contact">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>