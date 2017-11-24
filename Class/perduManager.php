<?php

class perduManager
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    //Ajouter une participation perdu
    public function addParticipationPerdu(perdu $perdu)
    {
        $requete = $this->db->prepare('INSERT INTO perdu (DATEPARTICIPATION,IDPARTICIPANT)'
            . 'VALUES(NOW(),:idparticipant)');
        $requete->bindValue(':idparticipant', $perdu->getIdParticipant());
        $requete->execute();
        return $this->db->lastInsertId();
    }

}
