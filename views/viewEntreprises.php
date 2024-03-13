<!-- page web -->
<div class="table-responsive">
    <table class="table table-striped table-hover table-borderless table-dark align-middle">
        <!-- Head -->
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Ville</th>
                <th scope="col">Pays</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Site web</th>
                <th scope="col" class="text-center" >Action</th>
            </tr>
        </thead>
        <!-- Body -->
        <tbody class="table-group-divider">
            <?php foreach($entreprises as $entreprise):?>
            <tr>
                <td><a href="/entreprises/<?= $entreprise->id()?>"><?= $entreprise->nom()?></a></td>
                <td><?= $entreprise->ville()?></td>
                <td><?= $entreprise->pays()?></td>
                <td><a href="tel:<?= $entreprise->telephone()?>"><?= $entreprise->telephone()?></a></td>
                <td><a href="<?= $entreprise->siteWeb()?>" target="_blank"><?= $entreprise->siteWeb()?></a></td>
                <td>
                    <div class="d-flex justify-content-evenly">
                        <div>
                            <a>
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_<?=$entreprise->id()?>">
                                    <i class="bi bi-trash-fill text-danger"></i>
                                </button>
                            </a>
                            <!-- Modal dark -->
                            <div class="modal fade" id="delete_<?=$entreprise->id()?>" tabindex="-1" aria-labelledby="delete_<?=$entreprise->id()?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete_<?=$entreprise->id()?>Label">Supprimer l'entreprise</h5>
                                            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Êtes-vous sûr de vouloir supprimer cette entreprise ?</p>

                                            <form method="POST" action="entreprises/delete/<?=$entreprise->id()?>" class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin modal -->
                        </div>
                        <div>
                            <a href="entreprises/edit/<?=$entreprise->id()?>">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edit_<?=$entreprise->id()?>"><i class="bi bi-pencil-fill text-warning"></i></button>
                            </a>
                        </div>
                        <div>
                            <a href="entreprises/<?=$entreprise->id()?>">
                                <button type="button" class="btn"><i class="bi bi-eye-fill text-info"></i></button>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>