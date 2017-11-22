<?php

class periode
{

    //Déclaration des attributs
    private $id;
    private $dateDebut;
    private $dateFin;

    function __construct($id, $dateDebut, $dateFin)
    {
        $this->id = $id;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
    }

//   Getter et Setter
    function getId()
    {
        return $this->id;
    }

    function getDateDebut()
    {
        return $this->dateDebut;
    }

    function getDateFin()
    {
        return $this->dateFin;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

}
