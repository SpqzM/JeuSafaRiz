<?php

class lotsManager
{

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

// Récupère l' id du lot de l'IG en cours et vérifie qu'il n'est pas gagné
    public function lotId()
    {
        $query = 'SELECT id FROM lots WHERE DATEIG <= NOW() '
            . 'AND id NOT IN (select idLot from participations) ORDER BY DATEIG LIMIT 1';
        $result = $this->db->prepare($query);
        $result->execute();
        return $result->fetch();
    }


}

?>
