<?php
session_start();
include 'views/head.php';
require 'Class/autoload.php';
require 'connexionBDD.php';
$db = connect();
$mParticipant = new participantsManager($db);
$errorAuth = "";

if (isset($_POST['emailP']) && isset($_POST['mdp'])) {
    $email = $_POST['emailP'];
    $mdp = $_POST['mdp'];
    if (strlen(trim($email)) > 1 && strlen(trim($mdp)) > 1) {
        $user = $mParticipant->verifParticipant($email, $mdp);
        if ($user) {
            header("Location: resultat.php");
        } else {
            $errorAuth = "Login et/ou mot de passe incorrect";
        }
    }
}
?>

<div class="container">
    <div class="row">
        <header class='col-sm-4 col-md-4 col-lg-4'>
            <div id="gagner">Gagner un</div>
            <div id="safariz">SAFA'RIZ</div>
            <div id="camargue">en Camargue</div>
        </header>
        <div class="col-md-5">
            <div class="boxed-grey">
                <form action="" method="post">
                    <h5>Connexion</h5>
                    <div class="row">
                        <div class="col-md-12">                                       
                            <div class="form-group">
                                <label for="emailP"> Email *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-sign-in"></span></span>                                               
                                    <input type="email" class="form-control" name="emailP" id="emailP" maxlength="48" placeholder="Entrer login" required="required" />
                                </div>
                            </div>    
                            <div class="form-group">
                                <label for="mdp"> Mot de passe *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>                                                                   
                                    <input type="password" class="form-control" name="mdp" id="mdp" maxlength="48" placeholder="Entrer mot de passe" required="required" />                         
                                </div>
                            </div>    
                        </div>
                        <div class="col-md-12">
                            <div class="errorLogin"><?php echo $errorAuth; ?></div>
                        </div>                        
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-form pull-right" id="btnParticipant" name="btnParticipant" >Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>	
</div>
<?php include 'views/footer.php'; ?>
