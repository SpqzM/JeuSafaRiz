<?php

class adminManager
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Verification connexion admin
    public function verifAdmin($login, $mdp)
    {
        $requete = 'SELECT ID,LOGIN,MDP FROM admin
                  WHERE LOGIN = :login
                  AND MDP = MD5(:mdp)';
        $result = $this->db->prepare($requete);
        $result->bindValue(':login', $login, PDO::PARAM_STR);
        $result->bindValue(':mdp', $mdp, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch();
    }
}

?>