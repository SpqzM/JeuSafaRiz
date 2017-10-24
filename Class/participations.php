<?php


class Participations extends Participants{
    
//    Déclaration des attributs
    private $id;
    private $dateparticipation;
    private $dategain;
    private $resultat;
    private $idlot;
    private $idparticipant;
}
//  Fonction construct
function __construct($id, $dateparticipation, $dategain, $resultat, $idlot, $idparticipant) {
        $this->id = $id;
        $this->dateparticipation = $dateparticipation;
        $this->dategain = $dategain;
        $this->resultat = $resultat;
        $this->idlot = $idlot;
        $this->idparticipant = $idparticipant;
    }
//   Getter et Setter 
    function getId() {
        return $this->id;
    }

    function getDateparticipation() {
        return $this->dateparticipation;
    }

    function getDategain() {
        return $this->dategain;
    }

    function getResultat() {
        return $this->resultat;
    }

    function getIdlot() {
        return $this->idlot;
    }

    function getIdparticipant() {
        return $this->idparticipant;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDateparticipation($dateparticipation) {
        $this->dateparticipation = $dateparticipation;
    }

    function setDategain($dategain) {
        $this->dategain = $dategain;
    }

    function setResultat($resultat) {
        $this->resultat = $resultat;
    }

    function setIdlot($idlot) {
        $this->idlot = $idlot;
    }

    function setIdparticipant($idparticipant) {
        $this->idparticipant = $idparticipant;
    }
