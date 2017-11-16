<?php
include './views/head.php';
require 'Class/autoload.php';
require 'connexionBDD.php';
date_default_timezone_set('Europe/Paris');

$db = connect();
$manager = new periodeManager($db);
$periode = $manager->periodeJeu();
$debut = $periode['0'];
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
// strftime("jourEnLettres jour moisEnLettres annee") de la date courante
$date = strftime("%A %d %B %Y à %H:%M:%S", strtotime($debut));
?>
    <div class="container">
        <div class="row">
            <header class='col-sm-4 col-md-4 col-lg-4'>
                <div id="gagner">Gagner un</div>
                <div id="safariz">SAFA'RIZ</div>
                <div id="camargue">en Camargue</div>
            </header>

            <div class="col-sm-4 col-md-8 col-lg-8">
                <div class="boxed-grey">
                    <div class='center'>
                        <p>Le jeu SafaRiz n'a pas encore débuté.</p>
                        <p>Revenez le <strong><?php echo $date ?></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'views/footer.php' ?>