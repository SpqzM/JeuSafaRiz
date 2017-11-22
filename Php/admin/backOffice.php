<?php
session_start();
include 'head.php';
require '../../Class/autoload.php';
require '../../Pdo/connexionBDD.php';
$db = connect();
$manager = new backOfficeManager($db);
$nb = $manager->countLots();
$nbRestant = $manager->lotsRestant();
$nbPartcipant = $manager->nbParticipants();
$nbGagnant = $manager->nbParticipantsGagnants();

?>
<div class="container">
    <div class="row">
        <div class=" col-sm-6 col-md-12 col-lg-12">
            <div class="boxed-grey">
                <h3>Administration - JeuSafaRiz</h3>
                <a href="deconnexion.php" class="pull-right"><span class="fa fa-sign-out"></span>Déconnexion</a>
                <div class="row">
                    <div class="col-md-3">
                        <h4><?php echo $nb['0']; ?></h4>
                        <p>Nombre total de lots</p>
                    </div>
                    <div class="col-md-3">
                        <h4><?php echo $nbRestant['0']; ?></h4>
                        <p>Nombre de lot restant</p>
                    </div>
                    <div class="col-md-3">
                        <h4><?php echo $nbPartcipant['0']; ?></h4>
                        <p>Nombre de participants</p>
                    </div>
                    <div class="col-md-3">
                        <h4><?php echo $nbGagnant['0']; ?></h4>
                        <p>Nombre de gagnant</p>
                    </div>
                    <div class="col-md-6">
                        <a href="exportParticipant.php" type="button" class="btn btn-form">Liste des participants</a>
                    </div>
                    <div class="col-md-6">
                        <a href="exportGagnant.php" type="button" class="btn btn-form">Liste des participants gagnants</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>
