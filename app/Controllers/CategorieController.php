<?php

// DEFINITION DE L"ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Models\CategorieModel;

////////////////////////////////////////////
// CLASSE CONTROLEUR DE LENTITE CATEGORIE //
////////////////////////////////////////////
class CategorieController
{
    ////////////////////////////////////////
    // METHODE POUR LISTER LES CATEGORIES //
    ////////////////////////////////////////
    public function listAll()
    {
        // HEADER JSON
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        // VERIFICATION DE LA METHODE UTILISEE
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
        
            // LECTURE DES SEANCES
            $readSeanceModel = new CategorieModel();
            $seances = $readSeanceModel->readAll();
        
            if ($seances) {
                http_response_code(200); // 200 OK
                echo json_encode($seances);
            } else {
                http_response_code(404); // 404 Not Found
                echo json_encode(["message" => "Aucunes créations trouvées !"]);
            }
        } else {
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode(["message" => "Méthode non autorisée !"]);
        }
    }
}