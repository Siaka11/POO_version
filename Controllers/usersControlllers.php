public function login()
{
if (Form::validate($_POST, ['email', 'password'])) {

$userModel = new UsersModel;
$userExist = $userModel->findOneByEmail(strip_tags($_POST['email']));
var_dump($userExist);

if (!$userExist) {
$_SESSION['erreur'] = 'L\'adresse mail ou le mot de passe est incorrect';
header('Location: /users/login');
}
$user = $userModel->hydrate($userExist);

//On vérifie si le mot de passe est correct
if (password_verify($_POST['password'], $user->getPassword())) {
var_dump($user->getEmail());
$user->setSession();
var_dump($user);
echo $_SESSION['user']['email'];
// header('Location: /annonces');
// exit;
} else {
$_SESSION['erreur'] = 'L\'adresse e-mail ou mot de passe est incrorrect';
header('Location: /users/login');
exit;
}
}


$form = new Form();

$form->debutForm()
->ajoutLabelFor('email', ' E-mail :')
->ajoutInput('email', 'email', ['class' => 'form-control', 'id' => 'email', 'required', 'autofocus', 'novalidate'])
->ajoutLabelFor('pass', 'Mot de passe :')
->ajoutInput('password', 'password', ['class' => 'form-control', 'id' => 'pass'])
->ajoutBouton('Me connecter', ['class' => 'btn btn-primary'])
->finForm();

$this->render('users/login.php', ['loginForm' => $form->create()]);
}


public function register()
{
if (Form::validate($_POST, ['email', 'password'])) {
// On nettoie l'adresse mail
$email = strip_tags($_POST['email']);

$password = password_hash($_POST['password'], PASSWORD_ARGON2I);
//on stocke l'utilisateur de la base


$user = new UsersModel();

$user->setEmail($email)
->setPassword($password);
$user->createOneUser();
}




$form = new Form();

$form->debutForm()
->ajoutLabelFor('email', 'E-mail :')
->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Votre mail'])
->ajoutLabelFor('password', 'Password :')
->ajoutInput('password', 'password', ['id' => 'password', 'class' => 'form-control'])

->ajoutBouton('S\'inscrire ', ['class' => 'btn btn-success'])
->finForm();


$this->render('users/register.php', ['registerForm' => $form->create()]);
}

public function logout()
{
unset($_SESSION['user']);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}






    
    
public function ajouter()
    {
        // on vérifie si l'utilisateur est connecté 
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {

            if (Form::validate($_POST, ['titre', 'description'])) {

                $titre = strip_tags($_POST['titre']);
                $description = strip_tags($_POST['description']);

                $annonceModel = new AnnoncesModel;
                var_dump($_SESSION['user']['id']);
                $annonceModel->setTitre($titre)
                    ->setDescription($description)
                    ->setUser_id($_SESSION['user']['id']);


                $annonceModel->createOne();
                $_SESSION['message'] = "Votre annonce a été enregistré avec succès";
            } else {
                $_SESSION['erreur'] = "Veuillez remplir les champs svp.";
            }
            $form = new Form;

            $form->debutForm()
                ->ajoutLabelFor('titre', 'Titre de l\'annonce :')
                ->ajoutInput('text', 'titre', ['class' => 'form-control', 'id' => 'titre'])
                ->ajoutLabelFor('description', 'Description de l\'annonce :')
                ->ajoutTextarea('description', '', ['id' => 'description', 'class' => 'form-control'])
                ->ajoutBouton('Ajouter', ['class' => 'btn btn-info'])
                ->finForm();

            $formAjouter = $form->create();
            $this->render('annonces/ajouter.php', compact('formAjouter'));
        } else {
            $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
            header('Location: /users/login');
        }
    }

    public function modifier($id)
    {
        $id = intval(end($id));

        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {

            $annonceModel = new AnnoncesModel;
            $annonce = $annonceModel->find($id);

            // si l'annonce n'existe pas on retourne à la liste des annonces
            if (!$annonce) {
                $_SESSION['erreur'] = 'L\'annonce recherchée n\'existe pas .';
                header('Location: /annonces');
                exit;
            }
            //On vérfie si l'utilisateur est propriétaire de l'annonce
            if ($annonce->user_id != $_SESSION['user']['id']) {
                $_SESSION['erreur'] = "Vous n'avez pas accès à cette page pour éditer l'annonce";
                header('Location: /annonces');
                exit;
            }
            //On traite le formulaire

            if (Form::validate($_POST, ['titre', 'description'])) {
                $titre = strip_tags($_POST['titre']);

                $description = strip_tags($_POST['description']);

                $annonceModif =  new AnnoncesModel;
                $annonceModif->setId($annonce->id)
                    ->setTitre($titre)
                    ->setDescription($description);

                $formModifier = $annonceModif->update();

                $_SESSION['message'] = "Votre annonce a été modifiée avec succès";
                header('Location: /annonces');
                exit;
            } else {
                $_SESSION['erreur'] = !empty($_POST) ? "Votre formulaire est incomplet" : "";
            }

            //formulaire pour la modification d'une annonce
            $form = new Form;

            $form->debutForm()
                ->ajoutLabelFor('titre', 'Titre de l\'annonce :')
                ->ajoutInput(
                    'text',
                    'titre',
                    [
                        'class' => 'form-control',
                        'id' => 'titre',
                        'value' => $annonce->titre
                    ]
                )
                ->ajoutLabelFor('description', 'Description de l\'annonce :')
                ->ajoutTextarea('description', $annonce->description, ['id' => 'description', 'class' => 'form-control'])
                ->ajoutBouton('Modifier', ['class' => 'btn btn-info'])
                ->finForm();

            $formModifier = $form->create();
            $this->render('annonces/modifier.php', compact('formModifier'));
        } else {
            $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page. ";
            header('Location: /users/login');
            exit;
        }
    }