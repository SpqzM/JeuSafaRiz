<?php
class participationsManager {

    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
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

    
    // Affiche le lot gagnant
    public function libelleLot($idLot,$idParticipant)
    {
        $query = 'SELECT LIBELLE FROM lots,participations WHERE lots.ID= participations.IDLOT AND IDLOT=:idLot AND IDPARTICIPANT= :idParticipant';
        $result = $this->db->prepare($query);
        $result->bindValue(':idLot', $idLot, PDO::PARAM_INT);
        $result->bindValue(':idParticipant',$idParticipant, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }
    //Limiter la participation Ã  un jour par foyer
    public function limit($email) {
        $req = "SELECT email, adresse, cp, ville, participations.id, perdu.IDPARTICIPANT FROM `perdu`, `participations`, `participants` WHERE participants.email = :email AND participants.id = participations.id AND perdu.DATEPARTICIPATION = CURDATE() AND participations.dateparticipation = CURDATE();";
        $result = $this->db->prepare($req);
        $result->bindValue(':email', $email);
        $result->execute();
        return $result->fetch();
    }
}

