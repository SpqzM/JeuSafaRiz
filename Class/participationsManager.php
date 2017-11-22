<?php

class participationsManager
{

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    //Ajouter une participation
    public function addParticipation(Participations $participation)
    {
        $requete = $this->db->prepare('INSERT INTO participations (DATEPARTICIPATION, IDLOT, IDPARTICIPANT, RESULTAT)'
            . 'VALUES(NOW(), :idlot, :idparticipant, :resultat)');
        $requete->bindValue(':idlot', $participation->getIdLot());
        $requete->bindValue(':idparticipant', $participation->getIdParticipant());
        $requete->bindValue(':resultat', $participation->getResultat());
        $requete->execute();
        return $this->db->lastInsertId();
    }

    // Affiche le lot gagnant
    public function libelleLot($idLot, $idParticipant)
    {
        $query = 'SELECT LIBELLE FROM lots,participations WHERE lots.ID= participations.IDLOT '
            . 'AND IDLOT=:idLot AND IDPARTICIPANT= :idParticipant';
        $result = $this->db->prepare($query);
        $result->bindValue(':idLot', $idLot, PDO::PARAM_INT);
        $result->bindValue(':idParticipant', $idParticipant, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

    //Controler la participation à une par jour
    public function controleParticipation($email)
    {
        $req = "SELECT participants.id, email FROM participants 
            WHERE id IN (SELECT idParticipant FROM participations
                         WHERE DATE(participations.DATEPARTICIPATION) = CURDATE())
            OR id IN ( SELECT id FROM perdu 
                        WHERE DATE(perdu.DATEPARTICIPATION) = CURDATE() )
            AND email = :email";
        $result = $this->db->prepare($req);
        $result->bindValue(':email', $email);
        $result->execute();
        return $result->fetch();
    }

    //Verifie q'un participant n'a pas déja gagné
    public function verifGagant($id)
    {
        $req = "SELECT id from participants
                WHERE id in (SELECT IDPARTICIPANT from participations)
                AND id = :id";
        $result = $this->db->prepare($req);
        $result->bindValue(':id', $id);
        $result->execute();
        return $result->fetch();
    }
}
