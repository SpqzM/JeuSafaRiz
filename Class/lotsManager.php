<?php
class lotsManager {
    private $db;

    public function __construct(PDO $db) {
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
}

?>
