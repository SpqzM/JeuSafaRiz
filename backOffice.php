<?php
session_start();
include 'views/head.php';
require 'Class/autoload.php';
require 'connexionBDD.php';
$db = connect();
$manager = new backOffice($db);
$nb = $manager->countLots();
$nbRestant = $manager->lotsRestant();
$nbPartciipant = $manager->nbParticipants();
$nbGagnant = $manager->nbParticipantsGagnant();
?>
<div class="container">
    <div class="row">      
        <div class="col-sm-6 col-md-12 col-lg-12">
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
                        <h4><?php echo $nbPartciipant['0']; ?></h4>
                        <p>Nombre de participants</p>
                    </div>
                    <div class="col-md-3">
                        <h4><?php echo $nbGagnant['0']; ?></h4>
                        <p>Nombre de gagnant</p>
                    </div>
                    <div class="col-md-3">
                        <a href="exportCsv.php" type="button" class="btn btn-form">Liste des participants gagnants</a>
                    </div>
                </div>                    
            </div>                
        </div>            
    </div>
</div>                    

<?php include 'views/footer.php' ?>
