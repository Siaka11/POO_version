<?php

use App\Client\Compte;


use App\Autoloader;

use App\Banque\Compte as CompteBancaire;
use App\Banque\CompteCourant;
use App\Banque\constructor;
use App\BDD\Bdd;
use App\Models\AnnoncesModel;

require_once 'Autoloader.php';

//var_dump($compte1->argent($compte));
Autoloader::register();



$model = new AnnoncesModel;

$donnees = [
    'titre' => 'titre ',
    'description' => 'description ',
    'actif' => 1
];

$model->hydrate($donnees);

//$donnees = $model
//  ->setTitre('titre de POO')
//  ->setDescription('description de POO')
// ->setActif(0);

$model->create($donnees);
