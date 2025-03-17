<?php

// DEFINITION DE L"ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Entities\Seance;
use App\Models\SeanceModel;

////////////////////////////////////////////
// CLASSE CONTROLEUR DE L"ENTITE SEANCE //
////////////////////////////////////////////
class SeanceController
{
    /////////////////////////////////////
    // METHODE POUR LISTER LES SEANCES //
    /////////////////////////////////////
    public function list()
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
            $readSeanceModel = new SeanceModel();
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

    //////////////////////////////////////
    // METHODE POUR AFFICHER UNE SEANCE //
    //////////////////////////////////////
    public function show()
    {
        // HEADER JSON
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        // VERIFICATION DE LA METHODE UTILISEE
        if ($_SERVER["REQUEST_METHOD"] === "GET") {

            // SI RECUPERATION DE L'ID DE LA SEANCE
            if ($_GET["id_seance"] ?? null) {

                // LECTURE DE LA SEANCE
                $readSeance = new Seance();
                $readSeance->setId_seance($_GET["id_seance"]);
                $readSeanceModel = new SeanceModel();
                $seance = $readSeanceModel->readById($readSeance);

                if ($seance) {
                    http_response_code(200); // 200 OK
                    echo json_encode($seance);
                } else {
                    http_response_code(404); // 404 Not Found
                    echo json_encode(["message" => "Création introuvable !"]);
                }
            } else {
                http_response_code(400); // 400 Bad Request
                echo json_encode(["message" => "Paramètres manquants !"]);
            }
        } else {   
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode(["message => Méthode non autorisée !"]);
        }
    }

    ///////////////////////////////////
    // METHODE POUR CREER UNE SEANCE //
    ///////////////////////////////////
    public function create()
    {
        // HEADER JSON
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        // VERIFICATION DE LA METHODE UTILISEE
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // RECUPERATION DES DONNEES ENVOYEES PAR LE CLIENT
            $rawData = file_get_contents("php://input");
            $data = json_decode($rawData, true);

            // RECUPERATION DES DONNEES PAR CLES
            $id_categorie = $data["id_categorie"] ?? null;
            $nom = $data["nom"] ?? null;
            $jour = $data["jour"] ?? null;
            $duree = $data["duree"] ?? null;
            $commentaire = $data["commentaire"] ?? null;

            // VERIFICATION DES DONNEES
            if ($id_categorie && $nom && $jour && $duree && $commentaire) {

                // CREATION DE LA SEANCE
                $addSeance = new Seance(); 
                $addSeance->setId_categorie($id_categorie);                              
                $addSeance->setNom($nom);
                $addSeance->setJour($jour);
                $addSeance->setDuree($duree);
                $addSeance->setCommentaire($commentaire);
                $addSeanceModel = new SeanceModel();
                $success = $addSeanceModel->create($addSeance); 

                if ($success) {
                    http_response_code(201); // 200 OK
                    echo json_encode(["message" => "Séance ajoutée avec succès !"]);
                } else {
                    http_response_code(503); // 503 Service Unavailable
                    echo json_encode(["message" => "ERREUR lors de l'ajout de la séance !"]);
                } 
            } else {
                http_response_code(400); // 400 Bad Request
                echo json_encode(["message" => "Paramètres manquants !"]);
            }
        } else {
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode(["message => Méthode non autorisée !"]);
        }
    }

    //////////////////////////////////////
    // METHODE POUR MODIFIER UNE SEANCE //
    //////////////////////////////////////
    public function update()
    {
        // HEADER JSON
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: PUT");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        // VERIFICATION DE LA METHODE UTILISEE
        if ($_SERVER["REQUEST_METHOD"] === "PUT") {

            // RECUPERATION DES DONNEES ENVOYEES PAR LE CLIENT
            $rawData = file_get_contents("php://input");
            $data = json_decode($rawData, true);

            // RECUPERATION DES DONNEES PAR CLES
            $id_seance = $data["id_seance"] ?? null;
            $id_categorie = $data["id_categorie"] ?? null;
            $nom = $data["nom"] ?? null;
            $jour = $data["jour"] ?? null;
            $duree = $data["duree"] ?? null;
            $commentaire = $data["commentaire"] ?? null;

            // VERIFICATION DES DONNEES
            if ($id_seance && $id_categorie && $nom && $jour && $duree && $commentaire)
            {
                $majSeance = new Seance(); 
                $majSeance->setId_seance($id_seance);                              
                $majSeance->setId_categorie($id_categorie);
                $majSeance->setNom($nom);
                $majSeance->setJour($jour);
                $majSeance->setDuree($duree);
                $majSeance->setCommentaire($commentaire);
                $majSeanceModel = new SeanceModel();
                $success = $majSeanceModel->update($majSeance);

                if ($success) {   
                    http_response_code(200); // 200 OK
                    echo json_encode(["message" => "Séance mise à jour avec succès !"]);
                } else {
                    http_response_code(503); // 503 Service Unavailable
                    echo json_encode(["message" => "ERREUR lors de la mise à jour de la séance !"]);
                }
            } else {
                http_response_code(400); // 400 Bad Request
                echo json_encode(["message" => "Paramètres manquants !"]);
            }
        } else {
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode(["message => Méthode non autorisée !"]);
        } 
    }

    ///////////////////////////////////////
    // METHODE POUR SUPPRIMER UNE SEANCE //
    ///////////////////////////////////////
    public function delete()
    {
        // HEADER JSON
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: DELETE");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        // VERIFICATION DE LA METHODE UTILISEE
        if ($_SERVER["REQUEST_METHOD"] === "DELETE") {

            // RECUPERATION DES DONNEES ENVOYEES PAR LE CLIENT
            $rawData = file_get_contents("php://input");
            $data = json_decode($rawData, true);

            // SI RECUPERATION DE L'ID DE LA SEANCE
            if ($data["id_seance"] ?? null) {

                $delSeance = new Seance();
                $delSeance->setId_seance($data["id_seance"]);
                $delSeanceModel = new SeanceModel();
                $success = $delSeanceModel->delete($delSeance);

                if ($success) {
                    http_response_code(200); // 200 OK
                    echo json_encode(["message" => "CSéance supprimée avec succès !"]);
                } else {
                    http_response_code(503); // 503 Service Unavailable
                    echo json_encode(["message" => "ERREUR lors de la suppression de la séance !"]);
                }
            } else {
                http_response_code(400); // 400 Bad Request
                echo json_encode(["message" => "Paramètres manquants !"]);
            }
        } else {
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode(["message => Méthode non autorisée !"]);
        }
    }
}