<?php

// AFFICHAGE DES ERREURS PHP
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// INCLUSION DE L'AUTOLOADER
require_once '../app/Autoloader.php';

// IMPORT DE CLASSES
use App\Core\Router;

// CHARGEMENT DE L'AUTOLOADER
App\Autoloader::register();

// INSTANCIATION D'UN OBJET "routeur"
$routeur = new Router();

// UTILISATION DE LA METHODE "routes" DE L'OBJET
$routeur->routes();