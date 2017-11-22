<?php
session_start();
include 'head.php';
require '../../Class/autoload.php';
require '../../Pdo/connexionBDD.php';
$db = connect();
$mAdmin = new adminManager($db);
$errorLogin = "";

// Vérification des valeurs entrées
if (isset($_POST['login']) && isset($_POST['mdp'])) {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    if (strlen(trim($login)) > 1 && strlen(trim($mdp)) > 1) {
        $user = $mAdmin->verifAdmin($login, $mdp);
        if ($user) {
            header("Location: backOffice.php");
            exit();
        } else {
            $errorLogin = "Login et/ou mot de passe incorrect";
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
        <div class="col-md-7">
            <div class="boxed-grey" id="adminForm">
                <form action="" method="post">
                    <h5>Connexion</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="login"> Login *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-sign-in"></span></span>
                                    <input type="text" class="form-control" name="login" id="login" maxlength="48"
                                           placeholder="Entrer login" required="required"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mdp"> Mot de passe *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                    <input type="password" class="form-control" name="mdp" id="mdp" maxlength="48"
                                           placeholder="Entrer mot de passe" required="required"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="errorLogin"><?php echo $errorLogin; ?></div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-form pull-right" id="btnAdmin" name="btnAdmin">
                                Valider
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
