<?php

include './views/head.php';
require 'Class/autoload.php';
require 'connexionBDD.php';
$db = connect();
$manager = new periodeManager($db);
$periode = $manager->periodeJeu();
$debut = strtotime($periode['0']);
$fin = strtotime($periode['1']);

date_default_timezone_set('Europe/Paris');
$datetime = time("Y-m-d H:i:s");

if ($datetime < $debut) {
    header("Location: jeuPasOuvert.php");
} elseif ($datetime > $fin) {
    header("Location: jeuFerme.php");
} else {
    header("Location: jeuOuvert.php");
}
?>

<?php include './views/footer.php'; ?>
