<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Core;

///////////////////////
// CLASSE DE ROUTAGE //
///////////////////////
class Router
{
    //-----------//
    // ATTRIBUTS //
    //-----------//
    private $controller;
    private $action;

    //----------------//
    // METHODE ROUTES //
    //----------------//
    public function routes()
    {   
        // RECUPERATION DE LA ROUTE (Par défaut, HomeControler->homeAction)
        $this->controller = ($_GET["controller"] ?? "Home") . "Controller";
        $this->action = $_GET["action"] ?? "home"; 
        
        // VERIFICATION DE L'EXISTENCE DU FICHIER DU CONTROLEUR
        if (file_exists("../app/Controllers/" . $this->controller . ".php")) {

            // DEFINITION DU CHEMIN DE LA CLASSE (namespace)
            $controllerClass = "App\\Controllers\\" . $this->controller;

            // VERIFICATION DE L'EXISTENCE DE LA CLASSE
            if (class_exists($controllerClass)) {

                // INSTANCIATION DE LA CLASSE DU CONTRÔLEUR
                $controller = new $controllerClass();

                // VERIFICATION DE L'EXISTENCE DE LA METHODE
                if (method_exists($controller, $this->action)) {

                    // APPEL DE LA METHODE
                    $controller->{$this->action}();

                } else {

                    // REDIRECTION VERS LA PAGE 404 SI LA METHODE N'EXISTE PAS
                    echo "ERREUR : La méthode '" . $this->action . "' n'existe pas dans le contrôleur '" . $this->controller . "'.";

                }
            } else {

                // REDIRECTION VERS LA PAGE 404 SI LA CLASSE N'EXISTE PAS
                echo "ERREUR : La classe '" . $this->controller . "' n'existe pas.";

            }
        } else {

            // REDIRECTION VERS LA PAGE 404 SI LE FICHIER DU CONTROLEUR N'EXISTE PAS
            echo "ERREUR : Le fichier du contrôleur '" . $this->controller . "' n'existe pas.";

        }
    }
}