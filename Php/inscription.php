<?php
include '../Views/head.php';
require '../Class/autoload.php';
require '../Pdo/connexionBDD.php';

$db = connect();
$manager = new participantsManager($db);
$managerP = new participationsManager($db);


?>
<div class="container">
    <div class="row">
        <header class='col-sm-4 col-md-4 col-lg-4' id="headerLogo">
            <div id="gagner">Gagnez un</div>
            <div id="safariz">SAFA'RIZ</div>
            <div id="camargue">en Camargue</div>
        </header>

        <div class="col-md-8">
            <div class="boxed-grey">
                <form id="registration-form" method="post" action="resultat.php">
                    <h5>Inscrivez-vous ci-dessous ou <a href="connexionParticipant.php">S'identifier</a></h5>
                    <h6>Tous les champs marqués d'une * sont obligatoires</h6>

                    <?php
                    if (!empty($erreur)) {
                        ?>    
                        <div class="error"><?php echo $erreur; ?></div>
                        <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="nom"> Nom <em>*</em></label>
                                <input value="<?php echo(isset($_POST['nom']) ? $_POST['nom'] : ''); ?>" type="text"
                                       class="form-control" name="nom" id="nom" maxlength="48" placeholder="Entrer nom"
                                       required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="prenom"> Prénom <em>*</em></label>
                                <input value="<?php echo(isset($_POST['prenom']) ? $_POST['prenom'] : ''); ?>"
                                       type="text" class="form-control" name="prenom" id="prenom" maxlength="48"
                                       placeholder="Entrer prénom" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="email"> Email <em>*</em></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    <input value="<?php echo(isset($_POST['email']) ? $_POST['email'] : ''); ?>"
                                           type="email" class="form-control" name="email" id="email"
                                           placeholder="Entrer email" required="required"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cp">CP <em>*</em></label>
                                <div class="input-group">
                                    <input value="<?php echo(isset($_POST['cp']) ? $_POST['cp'] : ''); ?>" type="text"
                                           class="form-control" name="cp" id="cp" maxlength="5"
                                           placeholder="Entrer code postal" required="required"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ville">Ville <em>*</em></label>
                                <div class="input-group">
                                    <input value="<?php echo(isset($_POST['ville']) ? $_POST['ville'] : ''); ?>"
                                           type="text" class="form-control" name="ville" id="ville" maxlength="48"
                                                                                      placeholder="Entrer ville" required="required"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tel"> Tél </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-mobile-phone"></span></span>
                                    <input value="<?php echo(isset($_POST['tel']) ? $_POST['tel'] : ''); ?>" type="tel"
                                           class="form-control" name="tel" id="tel" maxlength="10"
                                           placeholder="Entrer téléphone"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="adresse">Adresse <em>*</em></label>
                                <div class="input-group">
                                    <input value="<?php echo(isset($_POST['adresse']) ? $_POST['adresse'] : ''); ?>"
                                           type="text" class="form-control" name="adresse" id="adresse" maxlength="48"
                                                                                      placeholder="Entrer adresse" required="required"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mdp"> Mot de passe *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                    <input type="password" class="form-control" name="mdp" id="mdp" maxlength="48"
                                           placeholder="Entrer mot de passe" required="required"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="reglement" id="reglement">
                                    J'accepte <a href="reglement.php" target="_blank"> le règlement du jeu</a> *
                                </label>

                            </div>
                        </div>
                        <!--                        <div class="col-md-12"> 
                                                    <div class="btn btn-form pull-right" id="btnRegister">Valider votre inscription</div>
                                                </div>-->
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-form pull-right" id="btnRegister"
                                   value="Valider votre inscription"/>
                        </div>
                        <div class="col-md-6" id="feedback"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../Views/footer.php' ?>
