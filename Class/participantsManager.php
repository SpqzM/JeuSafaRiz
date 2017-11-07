<?php

class participantsManager {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    // Ajout d'un particpant
    public function add(Participants $participants) {
        $requete = $this->db->prepare('INSERT INTO participants (NOM, PRENOM, ADRESSE, CP, VILLE, TELEPHONE, EMAIL,DATEINSCRIPTION,PASSWORD )'
                . 'VALUES(:nom, :prenom, :adresse, :cp, :ville, :telephone, :email, NOW(),MD5(:password))');
        $requete->bindValue(':nom', $participants->getNom());
        $requete->bindValue(':prenom', $participants->getPrenom());
        $requete->bindValue(':adresse', $participants->getAdresse());
        $requete->bindValue(':cp', $participants->getCp());
        $requete->bindValue(':ville', $participants->getVille());
        $requete->bindValue(':telephone', $participants->getTelephone());
        $requete->bindValue(':email', $participants->getEmail());
        $requete->bindValue(':password', $participants->getMdp());
        $requete->execute();
    }
    
    // Verification connexion participant
    public function verifParticipant($email, $mdp)
    {
        $requete = 'SELECT EMAIL,PASSWORD FROM participants
                  WHERE EMAIL = :email
                  AND PASSWORD = MD5(:mdp)';
        $result = $this->db->prepare($requete);
        $result->bindValue(':email', $email, PDO::PARAM_STR);
        $result->bindValue(':mdp',$mdp, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch();
    }   
}

