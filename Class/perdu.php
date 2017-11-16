<?php

class perdu
{

    //Déclaration des attributs
    private $id;
    private $dateParticipation;
    private $idParticipant;

    //Constructeur
    public function __construct(array $tuple = [])
    {
        if (!empty($tuple)) {
            $this->hydrate($tuple);
        }
    }

    public function hydrate(array $tuple)
    {
        //construction dynamique du setter
        foreach ($tuple as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    function getId()
    {
        return $this->id;
    }

    function getDateParticipation()
    {
        return $this->dateParticipation;
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

    function setIdParticipant($idParticipant)
    {
        $this->idParticipant = $idParticipant;
    }

}
