<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Mes annonces</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/">Accueil du site</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/">Accueil de l'admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/annonces">Liste des annonces</a>
                    </li>

                </ul>

                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link"><?= $_SESSION['user']['email'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/users/profil">Profil</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/users/logout">Déconnexion</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="/users/login">Connexion</a>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['erreur'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['erreur'];
            unset($_SESSION['erreur']); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['erreurConnexion'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['erreurConnexion'];
            unset($_SESSION['erreurConnexion']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['bienvenu'])) : ?>
        <div class="alert alert-success" role="alert">


            <h4 class="alert-heading">Votre site qui se rapproche toujours de vous.</h4>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            <?php echo $_SESSION['bienvenu'];
            unset($_SESSION['bienvenu']); ?>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
        </div>
    <?php endif; ?>


    <div class="contenu" style="padding: 0 auto;">

        <?= $contenu ?>

    </div>
    <script src="public/js/script.js">
        // var exampleModal = document.getElementById('exampleModal')
        // exampleModal.addEventListener('show.bs.modal', function(event) {
        //     // Button that triggered the modal
        //     var button = event.relatedTarget
        //     // Extract info from data-bs-* attributes
        //     var recipient = button.getAttribute('data-bs-whatever')
        //     // If necessary, you could initiate an AJAX request here
        //     // and then do the updating in a callback.
        //     //
        //     // Update the modal's content.
        //     var modalTitle = exampleModal.querySelector('.modal-title')
        //     var modalBodyInput = exampleModal.querySelector('.modal-body input')

        //     modalTitle.textContent = 'New message to ' + recipient
        //     modalBodyInput.value = recipient
        // })
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- <script>
        var exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', function(event) {

        })
        $(document).on('click', "#tombolUbah", function() {
            let id = $(this).data('id')
            let titre = $(this).data('titre')
            let description = $(this).data('description')
        })
        console.log('Bonjour');
    </script> -->
</body>

</html>