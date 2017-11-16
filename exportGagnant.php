<?php
//affiche un csv
header('Content-Type: text/csv;charset=utf-8');
// nom du fichier exporté
header('Content-Disposition: attachment;filename=participantGagnant.csv');
session_start();
require 'Class/autoload.php';
require 'connexionBDD.php';
$db = connect();

$mBackOffice = new backOfficeManager($db);
$participantGagnant = $mBackOffice->allParticipantsGagnant();
