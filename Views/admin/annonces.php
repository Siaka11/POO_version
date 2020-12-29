<table class="table table-striped">
    <thead>
        <th>ID</th>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Actif</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php

        use App\Models\AnnoncesModel;

        foreach ($annonces as $annonce) : ?>
            <tr>
                <td><?= $annonce->id ?></td>
                <td><?= $annonce->titre ?></td>
                <td><?= $annonce->description ?></td>
                <td>
                    <div class="form-check form-switch">
                        <input class="form-check-input" data-id="<?= $annonce->id ?>" name="" type="checkbox" id="flexSwitchCheckChecked" <?= $annonce->actif ?> <?= $annonce->actif ? 'checked'  : '' ?>>
                        <label class="form-check-label" for="flexSwitchCheckChecked" <?= $annonce->actif ?>></label>
                    </div>

                </td>

                <td>

                    <button type="button" class="btn btn-primary" id="tombolUbah" data-bs-toggle="modal" data-bs-target="#ubahModal<?= $annonce->id ?>" data-bs-whatever="@getbootstrap">Modifier</button>
                    <div class="modal fade" id="ubahModal<?= $annonce->id ?>" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header blueku">
                                    <h5 class="modal-title" id="ubahModalLabel">New message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- <?php

                                            if (isset($_POST['submit'])) {
                                                echo 'hello';
                                                if (isset($_POST['titre'])) {
                                                    var_dump($annonce->id);
                                                    $annonceU = new AnnoncesModel;
                                                    var_dump($annonceU);
                                                    echo 'Bonjour';
                                                    $annonceU->setId($_POST['id'])
                                                        ->setTitre($_POST['titre'])
                                                        ->setDescription($_POST['description']);

                                                    $annonceU->update();
                                                    $_SESSION['message'] = 'Votre annonce a été modifiée avec succès .';
                                                    header('Location: /admin');
                                                    exit;
                                                } else {
                                                    echo 'Hello';
                                                }
                                            }


                                            ?> -->
                                    <form method="POST" action="#">

                                        <input type="hidden" value="<?= $annonce->id ?>" name="id" id="id">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Titre:</label>
                                            <input type="text" class="form-control" name="titre" id="titre" value="<?= $annonce->titre ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Description:</label>
                                            <textarea class="form-control" name="description" id="description" value=""><?= $annonce->description ?></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary pull-right" data-bs-dismiss="modal">Fermé</button>
                                            <button type="button" data-id=" <?= $annonce->id ?>" class="btn btn-primary pull-left" data-bs-dismiss="modal">Modif</button>

                                            <a class="btn btn-primary pull-left" data-id="<?= $annonce->id ?>">Update</a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>




                    <!-- <a href="/annonces/modifier/<?= $annonce->id ?>" class="btn btn-warning">Modifier</a> -->

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $annonce->id ?>">
                        Supprimer
                    </button>
                    <button type="button" class="btn btn-info" id="ajout">
                        Ajouter
                    </button>
                    <p id="ajouteur">0</p>

                    <!-- Modal
                    <div class="modal fade" id="staticBackdrop<?= $annonce->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous supprimer cette annonce ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="/admin/supprimeAnnonce/<?= $annonce->id ?>"><button type="button" class="btn btn-success">confirmer</button></a>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>