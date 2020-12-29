<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Mes annonces</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/annonces">Liste des annonces</a>
                    </li>

                </ul>

                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) : ?>
                        <?php if (in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">Admin</a>
                            </li>
                        <?php endif; ?>
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
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://img1.bonnesimages.com/bi/noel/noel_055.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://img1.bonnesimages.com/bi/noel/noel_055.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://img1.bonnesimages.com/bi/noel/noel_055.jpg class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
    <div class="contenu" style="padding: 0 auto;">
        


        <?= $contenu ?>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script>
        document.getElementById("tombolUbah").addEventListener('click', function() {



        })
    </script>
</body>

</html>