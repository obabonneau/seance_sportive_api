<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Entities;

//////////////////////////
// CLASSE ET BDD SEANCE //
//////////////////////////
class Categorie
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $id_categorie;
    private $categorie;
    private $photo;

    ///////////////////////////////
    // METHODES GETTER ET SETTER //
    ///////////////////////////////
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    public function setIdCategorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
}