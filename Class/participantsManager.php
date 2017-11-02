<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of participantsManager
 *
 * @author PC200
 */
class participantsManager {
    //put your code here
    
     /**
     * Attribut contenant l'instance représentant la BDD.
     * @type PDO
     */
    private $db;

    /**
     * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     * @param $db PDO Le DAO
     * @return void
     */
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * @see NewsManager::add()
     */
    protected function add(Participants $participants) {
        $requete = $this->db->prepare('INSERT INTO participants (NOM, PRENOM, ADRESSE, CP, VILLE, TELEPHONE, EMAIL )'
                . 'VALUES(:nom, :prenom, :adresse, :cp, :ville, :telephone, :email)');
        $requete->bindValue(':nom', $participants->getNom());
        $requete->bindValue(':prenom', $participants->getPrenom());
        $requete->bindValue(':adresse', $participants->getAdresse());
        $requete->bindValue(':cp', $participants->getCp());
        $requete->bindValue(':ville', $participants->getVille());
        $requete->bindValue(':telephone', $participants->getTelephone());
        $requete->bindValue(':email', $participants->getEmail());
        $requete->execute();
    }
    

    /**
     * @see NewsManager::update()
     */
}

