<?php

class backOfficeManager
{

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

// Affiche le nombre total de lots
    public function countLots()
    {
        $query = 'select COUNT(*) as NB_LOT from lots';
        $result = $this->db->prepare($query);
        $result->execute();
        return $result->fetch();
    }

// Affiche le nombre restant de lot
    public function lotsRestant()
    {
        $query = 'SELECT count(*) as NB_restant FROM lots '
            . 'WHERE ID NOT IN ( SELECT idLot from participations)';
        $result = $this->db->prepare($query);
        $result->execute();
        return $result->fetch();
    }

// Affiche le nombre de participants gagnant/perdant
    public function nbParticipants()
    {
        $query = 'SELECT SUM(NB_participant)
                  FROM (SELECT COUNT(IDPARTICIPANT) AS NB_participant
                        FROM   participations
                        UNION  ALL 
                        SELECT COUNT(IDPARTICIPANT) AS NB_participant 
                        FROM   perdu) P';
        $result = $this->db->prepare($query);
        $result->execute();
        return $result->fetch();
    }

// Affiche le nombre de participants gagnants
    public function nbParticipantsGagnant()
    {
        $query = 'SELECT count(IDPARTICIPANT) as NB_ParticipantGagnant FROM `participations` WHERE RESULTAT="gagne"';
        $result = $this->db->prepare($query);
        $result->execute();
        return $result->fetch();
    }

// Affiche tout les particpants gagnants
    public function allParticipantsGagnant()
    {
        $result = $this->db->query('select `NOM`,`PRENOM`,`ADRESSE`,`CP`,`VILLE`,`TELEPHONE`,`EMAIL`,`DATEINSCRIPTION`,`LIBELLE` '
            . 'from participants,participations,lots '
            . 'WHERE participants.id = participations.IDPARTICIPANT '
            . 'AND participations.IDLOT=lots.ID AND RESULTAT="gagne"');
        $handle = fopen('php://output', 'w+');
        //On insère les nom des champs
        fputcsv($handle, array('nom', 'prenom', 'adresse', 'cp', 'ville', 'telephone', 'email', 'lot'), ';');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($donnees = $result->fetch()) {
            fputcsv($handle, $donnees, ";");
        }
        $result->closeCursor();
        fclose($handle);
    }

// Affiche tout les particpants
    public function allParticipants()
    {
        $result = $this->db->query('select `NOM`,`PRENOM`,`ADRESSE`,`CP`,`VILLE`,`TELEPHONE`,`EMAIL`,`DATEINSCRIPTION`'
            . 'from participants');
        $handle = fopen('php://output', 'w+');
        //On insère les nom des champs
        fputcsv($handle, array('nom', 'prenom', 'adresse', 'cp', 'ville', 'telephone', 'email', 'dateinscription'), ';');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($donnees = $result->fetch()) {
            fputcsv($handle, $donnees, ";");
        }
        $result->closeCursor();
        fclose($handle);
    }

}
