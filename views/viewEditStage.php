<?php
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

            print_r($idEntreprise);


            $data = array(
                "ID_Entreprise"     => $idEntreprise,
                "Lien_offre"        => $Lien_offre,
                "Description"       => $Description,
                "Date_postulation"  => $Date_postulation
            );

            $stage = new Stages($data);
            $stageManager = new StagesManager();
            $stageManager->updateStage($data, $id);

            // Sauvegarde de la candidature
            $data = array(
                "ID_Stage"          => $id,
                "ID_Statut"         => $status,
                "Date_Candidature"  => $Date_postulation,
                "Commentaires"      => $Commentaires
            );
            $candidatureManager = new CandidaturesManager();
            $candidatureManager->updateCandidature($data, $id);

            header("Location: /stages");
        }
    }
?>

<div class="my-3 text-white container px-0">
    <form method="POST">
        <h1>Stage</h1>
        <input type="hidden" name="id" value="<?= $stage->id() ?>">
        <div class="d-flex flex-row justify-content-between">
            <div class="mb-3 me-3 flex-fill">
                <label for="nomEntreprise" class="form-label">Nom de l'entreprise</label>
                <input type="text" class="form-control" id="nomEntreprise" name="Nom_entreprise" value="<?= $entreprise->nom() ?>">
            </div>
            <div class="mb-3 mx-3 flex-fill">
                <label for="lienOffre" class="form-label">Liens vers l'offre de stage</label>
                <input type="text" class="form-control" id="lienOffre" name="Lien_offre" value="<?= $stage->lienOffre() ?>">
            </div>
            <div class="mb-3 ms-3 flex-fill">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-select" aria-label="Status" name="status">
                    <option <?php if($candidature['ID_Statut'] == '1') echo "selected" ?> value="1">En attente</option>
                    <option <?php if($candidature['ID_Statut'] == '2') echo "selected" ?> value="2">En cours de traitement</option>
                    <option <?php if($candidature['ID_Statut'] == '3') echo "selected" ?> value="3">Accepté</option>
                    <option <?php if($candidature['ID_Statut'] == '4') echo "selected" ?> value="4">Refusé</option>
                </select>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-between">
            <div class="mb-3 me-3 flex-fill">
                <label for="description" class="form-label">Descriptions de l'offre</label>
                <textarea type="text" class="form-control" id="description" name="Description" rows="8"><?= $stage->description() ?></textarea>
            </div>
            <div class="mb-3 ms-3 flex-fill">
                <label for="Commentaires" class="form-label">Commentaires</label>
                <textarea type="text" class="form-control" id="Commentaires" name="Commentaires" rows="8"><?= $candidature['Commentaires'] ?></textarea>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-between">
            <div class="mb-3">
                <label for="datePostulation" class="form-label">Date de postulation</label>
                <input type="date" class="form-control" id="datePostulation" name="Date_postulation" value="<?= $stage->datePostulation() ?>">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </form>
</div>