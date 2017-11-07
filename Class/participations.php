<?php

class Participations {

//    Déclaration des attributs
    private $id;
    private $dateParticipation;
    private $resultat;
    private $idLot;
    private $idParticipant;

}

//Fonction construct
function __construct($id, $dateParticipation, $dateGain, $resultat, $idLot, $idParticipant) {
    $this->id = $id;
    $this->dateParticipation = $dateParticipation;
    $this->resultat = $resultat;
    $this->idLot = $idLot;
    $this->idParticipant = $idParticipant;
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

function setDateGain($dateGain) {
    $this->dateGain = $dateGain;
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
