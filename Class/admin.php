<?php

class admin
{
    //  Déclaration des attributs
    private $id;
    private $login;
    private $mdp;

    //  Fonction construct
    function __construct($login, $mdp)
    {
        $this->login = $login;
        $this->mdp = $mdp;
    }

//   Getter et Setter
    function getLogin()
    {
        return $this->login;
    }

    function getMdp()
    {
        return $this->mdp;
    }

    function setLogin($login)
    {
        $this->login = $login;
    }

    function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

}

?>