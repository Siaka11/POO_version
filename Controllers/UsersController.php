<?php


namespace App\Controllers;

use App\Controllers\Controller;
use App\Core\Form;
use App\Models\UsersModel;

class UsersController extends Controller
{


    public function index()
    {
        echo 'hello' . __NAMESPACE__;
    }

    public function login()
    {
        if (Form::validate($_POST, ['email', 'password'])) {

            $email = strip_tags($_POST['email']);

            $userModel = new UsersModel;
            //var_dump($userModel);
            $emailExist = $userModel->findOneByEmail($email);
            //var_dump($emailExist);


            if (!$emailExist) {
                $_SESSION['erreur'] = 'L\'adresse mail ou le mot de passe est incorrect';
                header('Location: /users/login');
                exit;
            }

            $user = $userModel->hydrate($emailExist);
            


            if (password_verify($_POST['password'], $user->getPassword())) {
                $user->setSession();
                $_SESSION['bienvenu'] = 'Bonjour ' . $_SESSION['user']['email'] . ' Vous nous avez manquer';
                header('Location: /annonces');
                exit;
            } else {
                $_SESSION['erreur'] = 'L\'adresse mail ou le mot de passe est incorrect';
                header('Location: /users/login');
                exit;
            }
        }



        $form = new Form;

        $form->debutForm()
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['class' => 'form-control'])
            ->ajoutLabelFor('pass', 'Password :')
            ->ajoutInput('password', 'password', ['class' => 'form-control'])
            ->ajoutBouton('Se connecter', ['class' => 'btn btn-primary'])
            ->finForm();

        $formLogin = $form->create();

        $this->render('users/login.php', compact('formLogin'));
    }
    /**
     * Inscription des utlisateurs
     *
     * @return void
     */
    public function register()
    {

        if (Form::validate($_POST, ['email', 'password'])) {

            if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && !empty($_POST['email'])) {
                $email = strip_tags($_POST['email']);
                $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);


                $createUser = new UsersModel;



                $emailExist = $createUser->findOneByEmail($email);
                var_dump($emailExist);

                if (!$emailExist) {
                } else {
                    $_SESSION['erreurConnexion'] = 'L\'adresse mail a déjà été utilisée.';

                    header('Location: /users/register');
                    exit;
                }

                $bytes = random_bytes(16);
                var_dump(bin2hex($bytes));
                $_POST['confirmkey'] = bin2hex($bytes);


                $createUser->setEmail($email)
                    ->setPassword($pass)
                    ->setConfirmkey($_POST['confirmkey']);


                $createUser->createOne();

                $recupUser = $createUser->findOneByEmail($email);
                //var_dump($recupUser);
                $id = $recupUser->id;
                $confirmkey = $recupUser->confirmkey;
                
                //echo "#################################";
                //var_dump($id);
                
                ////// Envoie du mail de confirmation /////////://////

                $header = "MIME-Version: 1.0\r\n";
                $header .= 'From:"monsite.com"<support@monsite.com>' . "\n";
                $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
                $header .= 'Content-Transfer-Encoding: 8bit';

                $message = '
                <html>
                    <body>
                        <div align="center">
                            <img src="http://www.primfx.com/mailing/banniere.png"/>
                            <br />
                            Merci de confirmer votre mail s\'il vous plaît
                            <br />
                            <a href="https://youkarlo.000webhostapp.com/users/$id"
                            <img src="http://www.primfx.com/mailing/separation.png"/>
                            <a href="https://youkarlo.000webhostapp.com/users/confirmation/'.$id.'/'.$confirmkey.'">Confirmer</a>
                        </div>
                    </body>
                </html>
                ';

                mail($email, "Mail de confirmation !", $message, $header);


                ////////////////////////////////////////////////////////

                $_SESSION['message'] = "Votre compte sera crée , merci de le confirmer svp";
            }
        } else {
            $_SESSION['erreur'] = !empty($_POST) ? "Votre formulaire est incomplet" : "";
        }

        $form = new Form;

        $form->debutForm()
            ->ajoutInput('hidden', 'confirmkey', ['class' => 'form-control'])
            ->ajoutLabelFor('email', 'E-mail :')
            ->ajoutInput('email', 'email', ['class' => 'form-control'])
            ->ajoutLabelFor('pass', 'Password :')
            ->ajoutInput('password', 'password', ['class' => 'form-control'])
            ->ajoutBouton('S\'inscrire', ['class' => 'btn btn-primary'])
            ->finForm();
        $formRegister = $form->create();
        $this->render('users/register.php', compact('formRegister'));
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    public function confirmation(?array $conf)
    {

        $id = $conf[2];
        $userConf = $conf[3];
        //var_dump($id);
        if (empty($id) || empty($userConf)) {
            echo "Toutes les informations doivent être requises";
            header('Location: /users/login');
        }

        $id = intval(strip_tags(htmlspecialchars($id)));
        //var_dump($id);
        $userConf = strip_tags(htmlspecialchars($userConf));

        $userExist = new UsersModel;
        //var_dump($userExist);
        $userExist = $userExist->find($id);
        //var_dump($userExist);

        $userConf = new UsersModel;
        $userConf = $userConf->findByConfi($conf[3]);

        if (!$userExist) {
            echo "Les informations communiquées n'existe pas!";
            header('Location: /users/login');
            exit;
        }

        if (!$userConf) {
            echo "Les informations communiquées n'existe pas!";
            header('Location: /users/login');
            exit;
        }

        $confirme = new UsersModel;

        $confirme->setId($id)
            ->setConfirm(1);
        $confirme->update();
        $_SESSION['message'] = "Votre mail a été confirmé";
        header('Location: /users/login');
        exit;
    }
}
