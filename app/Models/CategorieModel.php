<?php

// DEFINITION DE L"ESPACE DE NOM
namespace App\Models;

// IMPORT DE CLASSES
use App\Core\DbConnect;
use PDOException;

////////////////////////////////////////
// CLASSE MODEL DE L'ENTITE CATEGORIE //
////////////////////////////////////////
class CategorieModel extends DbConnect
{
    ////////////////////////////////////////////
    // METHODE POUR LIRE LES SeanceS EN BDD //
    ////////////////////////////////////////////
    public function readAll()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT categorie.id_categorie, categorie.categorie FROM categorie");

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE EN TABLEAU
            $categories = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $categories;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }
}