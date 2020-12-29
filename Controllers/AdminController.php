<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\AnnoncesModel;
use App\Controllers\Controller;

class AdminController extends Controller
{

    public function index()
    {

        //On vérifie si l'utlisateur est admin
        if ($this->isAdmin()) {
            $annonces = new AnnoncesModel;
            $annonces = $annonces->findAll();

            $annonceU = new AnnoncesModel;
            $annonceU = $annonceU->find(2);



            $this->render('admin/annonces.php', compact('annonces', 'annonceU'), 'admin.php');
        }
    }





    public function activer($id)
    {
        $id = intval(end($id));
        if ($this->isAdmin()) {
            $annonceModel = new AnnoncesModel;

            $annonceArray = $annonceModel->find($id);

            if ($annonceArray) {
                $annonce = $annonceModel->hydrate($annonceArray);

                $annonce->setActif($annonce->getActif() ? 0 : 1);

                $annonce->update();
            }
        }
    }
    /**
     * Supprime une annonce
     *
     * @param [type] $id
     * @return void
     */
    public function supprimeAnnonce($id)
    {
        if ($this->isAdmin()) {

            $id = intval(end($id));
            $annonce = new AnnoncesModel;
            $annonce->delete($id);

            header('Location: /admin');
        }
    }

    private function modifieAnnonce($id)
    {
        if ($this->isAdmin()) {

            echo 'Bonjour';
        }
    }

    private function isAdmin()
    {
        if (isset($_SESSION['user']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {
            return true;
        } else {
            $_SESSION['erreur'] = 'Vous n\'avez pas accès à cette page';
            header('Location: /annonces');
        }
    }

    public function modifier($id)
    {

        $id = intval(end($id));

        // Vérifié si l'annonce se trouve dans notre liste
        $annonceModifier = new AnnoncesModel;
        $annonceM = $annonceModifier->find($id);



        $annonceModifier->setId(1)
            ->setTitre("professeur")
            ->setDescription("Patron");

        $annonceModifier->update();
    }
}
