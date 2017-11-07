<?php


class Participations{
    
    //Déclaration des attributs
    private $id;
    private $dateParticipation;
    private $idLot;
    private $idParticipant;
    private $resultat;

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
    //Getter et Setter
    function getId() {
        return $this->id;
    }

    function getDateParticipation() {
        return $this->dateParticipation;
    }

    function getResultat() {
        return $this->resultat;
    }

    function getIdLot() {
        return $this->idLot;
    }

    function getIdParticipant() {
        return $this->idParticipant;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDateParticipation($dateParticipation) {
        $this->dateParticipation = $dateParticipation;
    }

    function setResultat($resultat) {
        $this->resultat = $resultat;
    }

    function setIdLot($idLot) {
        $this->idLot = $idLot;
    }

    function setIdParticipant($idParticipant) {
        $this->idParticipant = $idParticipant;
    }
}
