<?php

class Participations
{

    //Déclaration des attributs
    private $id;
    private $dateParticipation;
    private $idLot;
    private $idParticipant;

    //Constructeur
    public function __construct(array $tuple = [])
    {
        if (!empty($tuple)) {
            $this->hydrate($tuple);
        }
    }

    //Construction dynamique du setter
    public function hydrate(array $tuple)
    {
        foreach ($tuple as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //Getter et Setter
    function getId()
    {
        return $this->id;
    }

    function getDateParticipation()
    {
        return $this->dateParticipation;
    }

    function getIdLot()
    {
        return $this->idLot;
    }

    function getIdParticipant()
    {
        return $this->idParticipant;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setDateParticipation($dateParticipation)
    {
        $this->dateParticipation = $dateParticipation;
    }

    function setIdLot($idLot)
    {
        $this->idLot = $idLot;
    }

    function setIdParticipant($idParticipant)
    {
        $this->idParticipant = $idParticipant;
    }

}
