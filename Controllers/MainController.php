<?php


namespace App\Controllers;


use App\Controllers\Controller;
use App\Models\AnnoncesModel;

class MainController extends Controller
{

    public function index()
    {


        $this->render('main/index.php', [], 'home.php');
    }

    public function merci($params)
    {
        var_dump($params);
        echo 'ceci est la foonction merci';
    }
}
