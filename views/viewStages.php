<?php

    // Changement du statut
    if(!empty($_POST))
    {
        extract($_POST);    
        $data = array("ID_Statut" => $status, "ID_Stage" => $id);
        $candidatureManager = new CandidaturesManager();
        $candidatureManager->updateCandidature($data, $id);
    }

    function selectColor($id)
    {
        switch ($id) {
            case '1':
                echo 'text-warning';
                break;
            case '2':
                echo 'text-info';
                break;
            case '3':
                echo 'text-success';
                break;
            case '4':
                echo 'text-danger';
                break;
            default:
                echo 'text-secondary';
                break;
        }
    }

    function displayStatut($id)
    {
        switch ($id) {
            case '1':
                return '<span class="badge bg-warning text-dark">En attente</span>';
                break;
            case '2':
                return '<span class="badge bg-info">En cours de traitement</span>';
                break;
            case '3':
                return '<span class="badge bg-success">Accepté</span>';
                break;
            case '4':
                return '<span class="badge bg-danger">Refusé</span>';
                break;
            default:
                return '<span class="badge bg-secondary">Aucun statut</span>';
                break;
        }
    }
?>
<div class="table-responsive">
    <table class="table table-striped table-hover table-borderless table-dark align-middle">
        <thead>
            <tr>
            <th scope="col">Nom entreprisse</th>
            <th scope="col">Liens vers l'offre</th>
            <th scope="col">Commentaires</th>
            <th scope="col">Temps écoulé</th>
            <th scope="col">Statut</th>
            <th scope="col" class="text-center" >Action</th>
            </tr>
        </thead>
        <!-- Body -->
        <?php if(empty($stages)): ?>
            <tbody>
                <tr>
                    <td colspan="6" class="text-center">
                        <p>Aucun stage</p>
                        <a href="/stages/add"><button type="button" class="btn"><i class="bi bi-plus-circle-fill text-success"></i></button></a>
                    </td>
                </tr>
            </tbody>
        <?php endif; ?>

        <?php if(!empty($stages)): ?>
            <tbody class="table-group-divider">
                <?php foreach($stages as $stage) : ?>
                    <?php

                        $this->_candidaturesManager = new CandidaturesManager;
                        $candidature = $this->_candidaturesManager->getCandidatureByStageId($stage->id());

                        // print_r($candidature);

                        $this->_entreprisesManager = new EntreprisesManager;
                        $entreprise = $this->_entreprisesManager->getEntrepriseId($stage->idEntreprise());

                        // print_r($entreprise);
                    ?>
                    <tr>
                        <td><a href="/stages/<?= $stage->id() ?>" class="text-decoration-none"><?= $entreprise->nom() ?></a></td>
                        <td><a href="<?= $stage->lienOffre() ?>" target="_blank" class="text-decoration-none">Vers le site</a></td>
                        <td><?= $candidature['Commentaires'] ?></td>
                        <td><?= round((time() - strtotime($stage->datePostulation())) / (60 * 60 * 24)) ?> jours</td>
                        <!-- Statut -->
                        <td  style="width: 19%">
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $stage->id() ?>">
                                <select class="form-select bg-dark <?php selectColor($candidature['ID_Statut'])  ?> fw-bolder" aria-label="Status" name="status" onchange="this.form.submit()">
                                    <option <?php if($candidature['ID_Statut'] == '1') echo "selected" ?> value="1">En attente</option>
                                    <option <?php if($candidature['ID_Statut'] == '2') echo "selected" ?> value="2">En cours de traitement</option>
                                    <option <?php if($candidature['ID_Statut'] == '3') echo "selected" ?> value="3">Entretien</option>
                                    <option <?php if($candidature['ID_Statut'] == '4') echo "selected" ?> value="4">Accepté</option>
                                    <option <?php if($candidature['ID_Statut'] == '5') echo "selected" ?> value="5">Refusé</option>
                                </select>
                            </form>
                        </td>
                        <td hidden>
                            <?= displayStatut($candidature['ID_Statut']) ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-evenly">
                                <div>
                                    <a type="button" href="stages/delete/<?= $stage->id()?>"></a>
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_<?=$stage->id()?>"><i class="bi bi-trash-fill text-danger"></i></button>
                                </div>
                                <!-- Modal black -->
                                <div class="modal fade" id="delete_<?=$stage->id()?>" tabindex="-1" aria-labelledby="delete_<?=$stage->id()?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-dark">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete_<?=$stage->id()?>Label">Suppression</h5>
                                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer ce stage ?
                                                <form method="POST" action="stages/delete/<?= $stage->id()?>" class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End modal -->
                                <div>
                                    <a type="button" href="stages/edit/<?= $stage->id() ?>">
                                        <button type="button" class="btn"><i class="bi bi-pencil-fill text-warning"></i></button>
                                    </a>
                                </div>
                                <div>
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#info_<?=$stage->id()?>">
                                        <i class="bi bi-eye-fill text-info"></i>
                                    </button>
                                </div>
                                <!-- Modal black -->
                                <div class="modal fade" id="info_<?=$stage->id()?>" tabindex="-1" aria-labelledby="info_<?=$stage->id()?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-dark">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="info_<?=$stage->id()?>Label">Informations</h5>
                                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Entreprise : <?= $entreprise->nom() ?></p>
                                                <p>Liens vers l'offre : <a class="text-decoration-none" href="<?= $stage->lienOffre() ?>" target="_blank">Voir l'offre</a></p>
                                                <p>Commentaires : <?= $candidature['Commentaires'] ?></p>
                                                <p>Temps écoulé : <?= round((time() - strtotime($stage->datePostulation())) / (60 * 60 * 24)) ?> jours</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="6" class="text-center">
                        <a href="/stages/add" class="text-decoration-none">Ajouter un stage<button type="button" class="btn"><i class="bi bi-plus-circle-fill text-success"></i></button></a>
                    </td>
                </tr>
            </tbody>
        <?php endif; ?>
    </table>
</div>
