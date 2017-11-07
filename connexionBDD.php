<?php


//connexion à la base de donnée avec PDO

function connect() {
    try {
         $db = new PDO('mysql:host=localhost;dbname=id3518550_jeusafariz;charset=utf8', 'id3518550_root', 'ilouelle'
                 . '');
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (Exception $ex)
        {
            die("connexion a MySQL impossible : " .$ex->getMessage());
        }
    return $db; 
}
