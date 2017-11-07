<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of participationsManager
 *
 * @author PC200
 */
class participationsManager {

    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    //Limiter la participation à un jour par foyer
    public function limit($email) {
        $req = "SELECT email, adresse, cp, ville, participations.ID FROM `participations`, participants WHERE participants.email = :email AND participants.ID = participations.ID AND DATEPARTICIPATION = CURDATE();";
        $result = $this->db->prepare($req);
        $result->bindValue(':email', $email);
        $result->execute();
        return $result->fetch();
    }
        //Ajouter une participation
    public function addParticipation(Participations $participation) {
        $requete = $this->db->prepare('INSERT INTO participations (DATEPARTICIPATION, IDLOT, IDPARTICIPANT, RESULTAT)'
            . 'VALUES(NOW(), :idlot, :idparticipant, :resultat)');
        $requete->bindValue(':idlot', $participation->getIdLot());
        $requete->bindValue(':idparticipant', $participation->getIdParticipant());
        $requete->bindValue(':resultat', $participation->getResultat());
        $requete->execute();
    }
}
