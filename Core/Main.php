<?php






namespace App\Core;

use App\Controllers\MainController;


class Main
{
    public function start()
    {
        session_start();
        // On rétire le trailing slash

        $uri = $_SERVER['REQUEST_URI'];
        //var_dump($uri);

        //var_dump(substr("abcdef", 0, 3));

        if (!empty($uri) && $uri != '/' && $uri[-1] === "/") {
            //on enlève le slash
            $uri = substr($uri, 0, -1);

            http_response_code(301);
            header('Location: ' . $uri);
        }

        //On gère les paramètres d'URL
        //p = controleur/methode
        //var_dump($_GET);

        $params = explode('/', $_GET['p']);
        //var_dump($params);
        //var_dump($params[0]);

        if ($params[0] != '') {
            // var_dump($params[1]);
            // On récupère le nom du controller
            $controller = '\\App\\Controllers\\' . ucfirst($params[0]) . 'Controller';

            //on instancie le controleur



            if (isset($controller)) {


                $controller = new $controller();
                // var_dump($controller);


                /////////////////
                if (isset($params[1])) {
                    $action = $params[1];
                } else {
                    $action = null;
                }
                // var_dump($params[1]);
                // var_dump($_GET['p']);
                //var_dump($action);


                if (method_exists($controller, $action)) {
                    (isset($params[0])) ? $controller->$action($params) : $controller->$action();
                } else {
                    $main = new $controller;
                    $main->index();
                }
            } else {
                http_response_code(404);
                echo 'Vous vous êtes trompés de page!';
            }








            /////////////////////


        } else {
            $main = new MainController;

            $main->index();
        }
    }
}
