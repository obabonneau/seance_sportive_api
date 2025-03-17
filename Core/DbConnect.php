<?php

//////////////////////////////////////////////
// CLASSE DE CONNEXION A LA BASE DE DONNEES //
//////////////////////////////////////////////
abstract class DbConnect
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    protected $connection;
    protected $request;
    protected $ack;

    //////////////////////////////////////////////////
    // CONSTANTES DE CONNEXION A LA BASE DE DONNEES //
    //////////////////////////////////////////////////
    const SERVER = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const BASE = 'portfolio';

    ////////////////////////////////////////////////
    // CONSTRUCTEUR POUR INITIALISER LA CONNEXION //
    ////////////////////////////////////////////////
    public function __construct()
    {
        try {
            // CRÉATION D'UNE INSTANCE PDO
            $this->connection = new PDO('mysql:host=' . self::SERVER . ';dbname=' . self::BASE, self::USER, self::PASSWORD);

            // DÉFINITION DU MODE DE GESTION DES ERREURS EN MODE EXCEPTION
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // RETOUR DES REQUETES DANS UN TABLEAU D'OBJET PAR DEFAUT
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            // ENCODAGE DES CARACTERES SPECIAUX EN UTF8
            $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");

        } catch (Exception $e) {
            //echo $e->getMessage();
        }
    }
}
