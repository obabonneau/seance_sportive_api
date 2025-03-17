<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Entities;

//////////////////////////
// CLASSE ET BDD SEANCE //
//////////////////////////
class Seance
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $id_seance;
    private $id_categorie;
    private $nom;
    private $jour;
    private $duree;
    private $commentaire;

    ///////////////////////////////
    // METHODES GETTER ET SETTER //
    ///////////////////////////////
    public function getId_seance()
    {
        return $this->id_seance;
    }

    public function setId_seance($id_seance)
    {
        $this->id_seance = $id_seance;
    }

    public function getId_categorie()
    {
        return $this->id_categorie;
    }

    public function setId_categorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getJour()
    {
        return $this->jour;
    }

    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    public function getDuree()
    {
        return $this->duree;
    }

    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }
}