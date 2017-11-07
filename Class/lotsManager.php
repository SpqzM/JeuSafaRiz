<?php
class lotsManager {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

// Récupère l' id du lot de l'IG en cours   
  public function lotId($id)
  {
    $query = 'select id from lots';
    $result = $this->db->prepare($query);
    $result->execute();    
    return $result->fetch();
  }
}

?>
