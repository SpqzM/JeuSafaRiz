<?php
session_start();
require 'Class/autoload.php';
require 'connexionBDD.php';
$db = connect();
$mBackOffice = new backOffice($db);
$participantAll=$mBackOffice->allParticipants();

//affiche un csv
header('Content-Type: text/csv;charset=utf-8');
// nom du fichier exporté
header('Content-Disposition: attachment;filename=particpantGagnant.csv');
