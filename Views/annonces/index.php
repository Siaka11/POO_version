<h1>La liste des annonces</h1>
<?php foreach ($annonces as $annonce) : ?>

    <article>
        <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header"><a href="/annonces/lire/<?= $annonce->id ?>"><?= $annonce->titre ?></a></div>
            <div class="card-body">
                <h5 class="card-title"><a href="/annonces/lire/<?= $annonce->id ?>"><?= $annonce->create_at ?></a></h5>
                <p class="card-text"><?= $annonce->description ?>.</p>
            </div>
        </div>

    </article>
<?php endforeach; ?>