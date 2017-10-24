<?php

class Lots {
    
    //    Déclaration des attributs
    private $id;
    private $libelle;
    private $quantite;
    private $prix;
    private $dateig;
}
{   //  Fonction construct
    function __construct($id, $libelle, $quantite, $prix, $dateig) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->quantite = $quantite;
        $this->prix = $prix;
        $this->dateig = $dateig;
    }
//   Getter et Setter 
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getPrix() {
        return $this->prix;
    }

    function getDateig() {
        return $this->dateig;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

    function setDateig($dateig) {
        $this->dateig = $dateig;
    }

   
}
