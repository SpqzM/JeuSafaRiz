<?php

class periodeManager {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

// Affiche la date debut et fin du jeu
    public function periodeJeu() {
        $query = 'SELECT DATEDEBUT,DATEFIN FROM periode';
        $result = $this->db->prepare($query);
        $result->execute();
        return $result->fetch();
    }
}
