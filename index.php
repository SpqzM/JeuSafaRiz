<?php
include 'Views/head.php';
require 'Class/autoload.php';
require 'Pdo/connexionBDD.php';

$db = connect();
$manager = new periodeManager($db);
$periode = $manager->periodeJeu();
$debut = strtotime($periode[0]);
$fin = strtotime($periode[1]);

date_default_timezone_set('Europe/Paris');
$datetime = time("Y-m-d H:i:s");

if ($datetime < $debut) {
    header("Location: Php/jeuPasOuvert.php");
    exit();
} elseif ($datetime > $fin) {
    header("Location: Php/jeuFerme.php");
    exit();
} else {
    header("Location: Php/jeuOuvert.php");
    exit();
}
?>

<?php include 'Views/footer.php'; ?>
