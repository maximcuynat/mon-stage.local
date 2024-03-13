<?php
    // Post des données du formulaire
    if(!empty($_POST))
    {
        extract($_POST);
        // Gestions de erreur du formulaire 
        $errors = array();

        if(empty($Nom_entreprise))
            array_push($errors, "Le nom de l'entreprise est obligatoire");
        if(empty($Lien_offre))
            array_push($errors, "Le lien de l'offre est obligatoire");
        if(empty($Description))
            array_push($errors, "La description est obligatoire");
        if(empty($status))
            array_push($errors, "Le status est obligatoire");
        if(empty($Date_postulation))
            array_push($errors, "La date de postulation est obligatoire");

        
        // Si il n'y a pas d'erreur
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

             // On ajoute les dans la table Stages
            $data = array(
                "ID_Entreprise"     => $idEntreprise,
                "Lien_offre"        => $Lien_offre,
                "Description"       => $Description,
                "Date_postulation"  => $Date_postulation
            );

            $stage = new Stages($data);
            $stageManager = new StagesManager();
            $idNewStage = $stageManager->addStage($data);

            // On ajoute la nouvelle Candidature
            $data = array(
                "ID_Stage"          => $idNewStage,
                "ID_Statut"         => $status,
                "Date_Candidature"  => $Date_postulation,
                "Commentaires"      => $Commentaires
            );
            $candidature = new Candidatures($data);
            $candidatureManager = new CandidaturesManager();
            $candidatureManager->addCandidature($data);

            // Redirection vers la page d'accueil
            header("Location: /stages");
        }
    }

    // Recupéraations des nom des entreprises
    $entrepriseManager = new EntreprisesManager();
    $entreprises = $entrepriseManager->getEntreprises();
?>
<!-- Page -->

<div class="my-3 text-white container px-0">
    <form method="POST">
        <h1>Candidature</h1>
        <hr>
        <h2>Informations générale</h2>
        <!-- Nom de l'entreprise -->
        <div class="d-flex flex-row justify-content-between">
            <div class="mb-3 me-3 flex-fill">
                <label for="nomEntreprise" class="form-label">Nom de l'entreprise</label>
                <input type="text" class="form-control" id="entreprise" name="Nom_entreprise" list="entreprises" required>
                <datalist id="entreprises">
                    <?php foreach ($entreprises as $entreprise) { ?>
                        <option value="<?= $entreprise->nom() ?>"></option>
                    <?php } ?>
                </datalist>
            </div>
            <div class="mb-3 mx-3 flex-fill">
                <label for="lienOffre" class="form-label">Liens vers l'offre de stage</label>
                <input type="text" class="form-control" id="lienOffre" name="Lien_offre" required>
            </div>
            <div class="mb-3 ms-3 flex-fill">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-select" aria-label="Status" name="status" required>
                    <option value="1">En attente</option>
                    <option value="2">En cours de traitement</option>
                    <option value="3">Accepté</option>
                    <option value="4">Refusé</option>
                </select>
            </div>
        </div>
        <h2>Descriptions</h2>
        <hr>
        <div class="d-flex flex-row justify-content-between">
            <div class="mb-3 me-3 flex-fill">
                <label for="description" class="form-label">Descriptions de l'offre</label>
                <textarea type="text" class="form-control" id="description" name="Description" rows="8" required></textarea>
            </div>
            <div class="mb-3 ms-3 flex-fill">
                <label for="Commentaires" class="form-label">Commentaires</label>
                <textarea type="text" class="form-control" id="Commentaires" name="Commentaires" rows="8"></textarea>
            </div>
        </div>
        <h2>Date de postulation et site web</h2>
        <hr>
        <div class="d-flex flex-row justify-content-between">
            <!-- Date de postulation -->
            <div class="mb-3 me-3 flex-fill">
                <label for="datePostulation" class="form-label">Date de postulation</label>
                <input type="date" class="form-control" id="datePostulation" name="Date_postulation" required>
            </div>
            <!-- Site web 
            <div class="mb-3 ms-3 flex-fill">
                <label for="siteWeb" class="form-label">Site web</label>
                <input type="text" class="form-control" id="siteWeb" name="Site_web">
            </div>
        -->
        </div>
        <hr>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>