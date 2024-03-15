<!-- Page -->
<div class="table-responsive">
    <table class="table table-striped table-hover table-borderless table-dark align-middle">
        <!-- Head -->
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Entreprise</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <!-- Body -->
        <?php if(empty($contacts)): ?>
            <tbody>
                <tr>
                    <td colspan="6" class="text-center">
                        <p class="m-0 text-warning">Aucun contact<br>
                            <a href="/contacts/add"><button type="button" class="btn"><i class="bi bi-plus-circle-fill text-success"></i></button></a>
                        </p>
                    </td>
                </tr>
            </tbody>
        <?php endif; ?>

        <?php if(!empty($contacts)): ?>
            <tbody class="table-group-divider">
                <?php foreach($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact->nom() ?></td>
                        <td><?= $contact->prenom() ?></td>
                        <td><a href="mailto:<?= $contact->email() ?>"><?= $contact->email() ?></a></td>
                        <td><a href="tel:<?= $contact->telephone() ?>"><?= $contact->telephone() ?></a></td>
                        <?php  $entrepriseManager = new EntreprisesManager(); $entreprise = $entrepriseManager->getEntrepriseId($contact->idEntreprise()); ?>
                        <td><a href="/entreprises/<?= $entreprise->id() ?>"><?= $entreprise->nom() ?></a></td>
                        <td>
                            <div class="d-flex justify-content-evenly">
                                <a>
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete_<?= $contact->id() ?>">
                                        <i class="bi bi-trash-fill text-danger"></i>
                                    </button>
                                </a>
                                <!-- Modal dark -->
                                <div class="modal fade" id="delete_<?= $contact->id() ?>" tabindex="-1" aria-labelledby="delete_<?= $contact->id() ?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-dark">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete_<?= $contact->id() ?>Label">Supprimer le contact</h5>
                                                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Êtes-vous sûr de vouloir supprimer ce contact ?</p>
                                                <form method="POST" action="/contacts/delete/<?= $contact->id() ?>" class="d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/contacts/edit/<?= $contact->id() ?>">
                                    <button type="button" class="btn"><i class="bi bi-pencil-fill text-warning"></i></button>
                                </a>
                                <a href="/contacts/<?= $contact->id() ?>">
                                    <button type="button" class="btn"><i class="bi bi-eye-fill text-info"></i></button>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="6" class="text-center">
                        <a href="/contacts/add" class="text-decoration-none">Ajouter un contact<button type="button" class="btn"><i class="bi bi-plus-circle-fill text-success"></i></button></a>
                    </td>
                </tr>
            </tbody>
        <?php endif; ?>
    </table>
</div>