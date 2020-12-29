<h1>La liste des annonces</h1>


<article>

    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><?= $annonces->titre ?></h3>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p><?= $annonces->description ?></p>
            <p><?= $annonces->create_at ?></p>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Modifier une annonce</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</article>