<?php

class Lots {
    
    //    Déclaration des attributs
    private $id;
    private $libelle;
    private $dateIg;
}
{   //  Fonction construct
    function __construct($id, $libelle, $dateig) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->dateIg = $dateig;
    }
//   Getter et Setter 
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getDateig() {
        return $this->dateIg;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setDateig($dateig) {
        $this->dateIg = $dateig;
    }

   
}
