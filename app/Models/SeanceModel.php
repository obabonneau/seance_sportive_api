<?php


// DEFINITION DE L"ESPACE DE NOM
namespace App\Models;

// IMPORT DE CLASSES
use App\Core\DbConnect;
use App\Entities\Seance;
use PDOException;
use PDO;

///////////////////////////////////////
// CLASSE MODEL DE L"ENTITE Seance //
///////////////////////////////////////
class SeanceModel extends DbConnect
{
    ///////////////////////////////////////////
    // METHODE POUR LIRE UNE SEANCE EN BDD //
    ///////////////////////////////////////////
    public function readById(Seance $readSeance)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM seance
            INNER JOIN categorie
            ON seance.id_categorie = categorie.id_categorie
            WHERE id_seance = :id_seance");
            $this->request->bindValue(":id_seance", $readSeance->getId_seance(), PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $seance = $this->request->fetch();

            // RETOUR DU RESULTAT
            return $seance;

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ////////////////////////////////////////////
    // METHODE POUR LIRE LES SeanceS EN BDD //
    ////////////////////////////////////////////
    public function readAll()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM seance
                INNER JOIN categorie 
                ON seance.id_categorie = categorie.id_categorie");

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE EN TABLEAU
            $seances = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $seances;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    //////////////////////////////////////////
    // METHODE POUR CREER UNE SEANCE EN BDD //
    //////////////////////////////////////////
    public function create(Seance $addSeance)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("INSERT INTO Seance (id_categorie, nom, jour, duree, commentaire)
                VALUES (:id_categorie, :nom, :jour, :duree, :commentaire)");
            $this->request->bindValue(":id_categorie", $addSeance->getId_categorie(), PDO::PARAM_INT);
            $this->request->bindValue(":nom", $addSeance->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(":jour", $addSeance->getJour(), PDO::PARAM_STR);
            $this->request->bindValue(":duree", $addSeance->getDuree(), PDO::PARAM_STR);
            $this->request->bindValue(":commentaire", $addSeance->getCommentaire(), PDO::PARAM_STR);

            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ///////////////////////////////////////////////////
    // METHODE DE MODIFICATION D"UNE SEANCE EN BDD //
    ///////////////////////////////////////////////////
    public function update(Seance $majSeance)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("UPDATE seance SET
                id_categorie = :id_categorie,
                nom = :nom,
                jour = :jour,
                duree = :duree,
                commentaire = :commentaire
                WHERE id_seance = :id_seance");
            $this->request->bindValue(":id_seance", $majSeance->getId_seance(), PDO::PARAM_INT);
            $this->request->bindValue(":id_categorie", $majSeance->getId_categorie(), PDO::PARAM_INT);
            $this->request->bindValue(":nom", $majSeance->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(":jour", $majSeance->getJour(), PDO::PARAM_STR);
            $this->request->bindValue(":duree", $majSeance->getDuree(), PDO::PARAM_STR);
            $this->request->bindValue(":commentaire", $majSeance->getCommentaire(), PDO::PARAM_STR);

            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    ////////////////////////////////////////////////
    // METHODE DE SUPPRESSION D"UNE SEANCE EN BDD //
    ////////////////////////////////////////////////
    public function delete(Seance $delSeance)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("DELETE FROM seance WHERE id_seance = :id_seance");
            $this->request->bindValue(":id_seance", $delSeance->getId_seance(), PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL ET RETOUR DE L"EXECUTION
            return $this->request->execute();

        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }
}