<?php


namespace App\Controllers;

use App\Core\Form;
use App\Models\AnnoncesModel;
use App\Controllers\Controller;

class AnnoncesController extends Controller
{
    public function index()
    {
        $annonces = new AnnoncesModel;

        $annonces = $annonces->findAll();
        //var_dump($annonces);
        $this->render('annonces/index.php', compact('annonces'));
    }

    public function lire($id)
    {
        $id = intval(end($id));


        $annonces = new AnnoncesModel;
        $annonces = $annonces->find($id);
        $this->render('annonces/lire.php', compact('annonces'));
    }


    public function ajouter()
    {
        //Vérifier si l'utilisateur est connecté(e) 



        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
            //Traitement du formulaire
            
            if($_SESSION['user']['confirm'] == 0){
                $_SESSION['message'] = "Veuillez confirmer votre compte avant d'ajouter une annonce";
                header('Location: /annonces');
                exit;
                
            }

            if (Form::validate($_POST, ['titre', 'description'])) {
                //On protège notre bdd contre les failles xss ou les injections sql
                $titre = strip_tags($_POST['titre']);

                $description = strip_tags($_POST['description']);

                $modelAnnonce = new AnnoncesModel;
                $modelAnnonce->setTitre($titre)
                    ->setDescription($description)
                    ->setUser_id($_SESSION['user']['id']);
                //var_dump($modelAnnonce);

                $modelAnnonce->createOne();
                $_SESSION['message'] = "Votre annonce a été validé avec succès";
                header('Location: /annonces/ajouter');
                exit;
            } else {
                $_SESSION['erreur'] = !empty($_POST) ? 'Vous n\'avez pas rempli tous les champs .' : '';
            }


            $form = new Form;
            $form->debutForm()
                ->ajoutLabelFor('titre', 'Titre de l\'annonce')
                ->ajoutInput('text', 'titre', [
                    'class' => 'form-control',
                    'id' => 'titre',

                ])
                ->ajoutLabelFor('description', 'Description de l\'annonce')
                ->ajoutTextarea('description', '', ['class' => 'form-control'])
                ->ajoutBouton('Ajouter', ['class' => 'btn btn-info'])
                ->finForm();

            $formAjouter = $form->create();

            $this->render('annonces/ajouter.php', compact('formAjouter'));
        } else {
            $_SESSION['erreur'] = "Veuillez-vous connecter pour accéder à cette page";
            header('Location: /users/login');
        }
    }

    public function modifier($id)
    {

        $id = intval(end($id));
        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
            // Vérifié si l'annonce se trouve dans notre liste
            $annonceModifier = new AnnoncesModel;
            $annonceM = $annonceModifier->find($id);




            if (!$annonceM) {
                $_SESSION['erreur'] = "L'annonce notifiée n'existe pas ";
                header('Location: /annonces');
                exit;
            }

            if ($annonceM->user_id != $_SESSION['user']['id']) {
                if (!in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {
                    $_SESSION['erreur'] = "Vous ne pouvez pas modifier cette annonce";
                    header('location: /annonces');
                    exit;
                }
            }






            //Traitement du formulaire
            if (Form::validate($_POST, ['titre', 'description'])) {

                $titre = strip_tags($_POST['titre']);

                $description = strip_tags($_POST['description']);

                $annonceModifier1 = new AnnoncesModel;
                $annonceModifier1->setId($annonceM->id)
                    ->setTitre($titre)
                    ->setDescription($description);

                $annonceModifier1->update();
                $_SESSION['message'] = 'Votre annonce a été modifié avec succès';
                header('Location: /annonces');
                exit;
            } else {

                $_SESSION['erreur'] = !empty($_POST) ? "Veuillez remplir tous les champs s'il vous plaît ." : '';
            }

            //création du formulaire

            $form = new Form;
            $form->debutForm()
                ->ajoutLabelFor('titre', 'Titre de l\'annonce')
                ->ajoutInput('text', 'titre', [
                    'class' => 'form-control',
                    'id' => 'titre',
                    'value' => $annonceM->titre
                ])
                ->ajoutLabelFor('description', 'Description de l\'annonce')
                ->ajoutTextarea('description', $annonceM->description, ['class' => 'form-control'])
                ->ajoutBouton('Modifier', ['class' => 'btn btn-info'])
                ->finForm();

            $formModifier = $form->create();

            $this->render('annonces/modifier.php', compact('formModifier'));
            // Vérifier si l'utilisateur est connecté
        } else {
            $_SESSION['erreur'] = "Vous devez vous connecter pour accéder à cette page";
            header('location: /users/login');
            exit;
        }
    }
}
