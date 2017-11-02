<?php

class Participants {
    
    // Déclaration des attributs
    private $id;
    private $nom;
    private $prenom;
    private $adresse;
    private $cp;
    private $ville;
    private $telephone;
    private $email;
    
    //Constructeur
    public function __construct(array $tuple=[]){
        if(!empty($tuple)){
        $this->hydrate($tuple);
        }
    }
    
    public function hydrate(array $tuple){
    //construction dynamique du setter
    foreach ($tuple as $key => $value){
        $method = 'set'.ucfirst($key);
        if (method_exists($this, $method)){
        $this->$method($value);
        }
    }
    }
    
    // Getters et setters
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getCp() {
        return $this->cp;
    }

    function getVille() {
        return $this->ville;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setCp($cp) {
        $this->cp = $cp;
    }

    function setVille($ville) {
        $this->ville = $ville;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setEmail($email) {
        $this->email = $email;
    }


}
