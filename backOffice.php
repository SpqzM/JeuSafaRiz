<?php
include 'views/head.php';
require 'Class/autoload.php';
require 'connexionBDD.php';
$db = connect();
$mLots = new lotsManager($db);
$nb=$mLots->countLots();
var_dump($nb);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-12 col-lg-12">
            <div class="boxed-grey">
                <h3>Administration - JeuSafaRiz</h3>
                <a href="deconnexion.php"><span class="fa fa-sign-out"></span>Déconnexion</a>                
            </div>            
        </div>
    </div>                    
</div>
</div>
<?php include 'views/footer.php' ?>
