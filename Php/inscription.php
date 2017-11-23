<?php
session_start();


include '../Views/head.php';
require '../Class/autoload.php';
require '../Pdo/connexionBDD.php';

// Instanciation des class manager
$db = connect();
$ParticipantManager = new participantsManager($db);
$erreur = "";

$is_valid = false;

// Si on a un formulaire validé
if (!empty($_POST)) {
    $is_valid = true;

    // Récupération des inputs
    $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $cp = isset($_POST['cp']) ? $_POST['cp'] : null;
    $ville = isset($_POST['ville']) ? $_POST['ville'] : null;
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : null;
    $telephone = isset($_POST['tel']) ? $_POST['tel'] : null;
    $password = isset($_POST['mdp']) ? $_POST['mdp'] : null;

    // Contrôle de saisie php
    $unwanted_array = array('Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
        'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
        'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y');
    $adresse = strtr($adresse, $unwanted_array);
    $ville = strtr($ville, $unwanted_array);

    $flagSyntaxeCode_postal = preg_match('#[0-9]{5}$#', $cp);
    if ($flagSyntaxeCode_postal == 0 || empty($cp)) {
        $erreur .= "Rentrez un code postal à 5 chiffres. <br>";
        $is_valid = false;
    }
    $flagSyntaxeTel = preg_match('#[0-9]{10}$#', $telephone);
    if ($flagSyntaxeTel == 0 || empty($telephone)) {
        $erreur .= "Rentrez un numéro de téléphone à 10 chiffres. <br>";
        $is_valid = false;
    }
    $flagSyntaxeNom = preg_match('#[^0-9][a-zA-Z\S\-]{1,}$#', $nom);
    if ($flagSyntaxeNom == 0 || empty($nom)) {
        $erreur .= "Votre nom ne peut comporter que des lettres, tirets et espaces. <br>";
        $is_valid = false;
    }
    $flagSyntaxePrenom = preg_match('#[^0-9][a-zA-Z\S\-]{1,}$#', $prenom);
    if ($flagSyntaxePrenom == 0 || empty($prenom)) {
        $erreur .= "Votre prénom ne peut comporter que des lettres, tirets et espaces. <br>";
        $is_valid = false;
    }
    if (!isset($_POST['reglement'])) {
        $erreur .= "Veuillez accepter le règlement du jeu. <br>";
        $is_valid = false;
    }
    
}

// Si aucun champ ne renvoie d'erreur
if ($is_valid) {

    // On récupère les données du POST pour les passer en session
    $_SESSION = $_POST;
    
    // On instancie un objet Participant
    $participant = new Participants(array(
        'nom' => $_SESSION['nom'],
        'prenom' => $_SESSION['prenom'],
        'adresse' => $_SESSION['adresse'],
        'cp' => $_SESSION['cp'],
        'ville' => $_SESSION['ville'],
        'telephone' => $_SESSION['tel'],
        'email' => $_SESSION['email'],
        'mdp' => $_SESSION['mdp']));
    
    // On verifie que le participant n'existe pas et on ajoute l'objet participant
    if (!$ParticipantManager->participantExists($email)) {
        // On ajoute l'objet participant et on stocke son ID en SESSION
        $_SESSION['lastParticipant'] = $ParticipantManager->add($participant);
        // Envoi du mail après inscriptions
        send_mail($participant);
        // On redirige vers le résultat
        header("Location: resultat.php");
    } else {
        // Sinon message d'erreur
        $erreur .= "Vous êtes déjà inscrit. Veuillez vous connecter";
    }
}

// Fonction d'envoi de mail
function send_mail($participant){
     // On sécurise l'adresse mail destinataire
        $debut = 'safarizgame';
        $fin = '@gmail.com';
        $mail = $debut . $fin;
        $destinataire = $mail;
        // Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
        $expediteurmail = $participant->getEmail();
        $expediteurnom = $participant->getNom();

        $objet = "Inscription de " . $expediteurnom . " au tirage SafaRiz";

        $headers = 'MIME-Version: 1.0' . "\r\n"; // Version MIME
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // l'en-tete Content-type pour le format HTML
        $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
        $headers .= 'To: Safariz <' . $destinataire . '>' . "\r\n"; // Mail de reponse
        $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
        $headers .= 'X-Priority: 1' . "\r\n";
        $headers .= 'From: ' . $expediteurnom . '<' . $expediteurmail . '>' . "\r\n"; // Expediteur
        $headers .= 'Reply-to: ' . $expediteurnom . '<' . $expediteurmail . '>' . "\r\n"; // Expediteur

        $message = '<html><body><h1>' . $objet . '</h1>'
                . '<div>'
                . 'L\'utilisateur ' . $expediteurnom . ' s`\'est inscrit.'
                . '</div></body></html>';
        //Envoi du mail
        mail($destinataire, $objet, $message, $headers);
}

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
                <form id="registration-form" method="post" action="">
                    <h5>Inscrivez-vous ci-dessous ou <a href="connexionParticipant.php">S'identifier</a></h5>
                    <h6>Tous les champs marqués d'une * sont obligatoires</h6>


                    <?php if (!empty($erreur)) { ?>
                        <div class="error"><?php echo $erreur; ?></div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="nom"> Nom <em>*</em></label>
                                <input value="<?php echo(isset($nom) ? $nom : ''); ?>" type="text"
                                       class="form-control" name="nom" id="nom" maxlength="48" placeholder="Entrer nom"
                                       required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="prenom"> Prénom <em>*</em></label>
                                <input value="<?php echo(isset($prenom) ? $prenom : ''); ?>"
                                       type="text" class="form-control" name="prenom" id="prenom" maxlength="48"
                                       placeholder="Entrer prénom" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="email"> Email <em>*</em></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    <input value="<?php echo(isset($email) ? $email : ''); ?>"
                                           type="email" class="form-control" name="email" id="email"
                                           placeholder="Entrer email" required="required"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cp">CP <em>*</em></label>
                                <div class="input-group">
                                    <input value="<?php echo(isset($cp) ? $cp : ''); ?>" type="text"
                                           class="form-control" name="cp" id="cp" maxlength="5"
                                           placeholder="Entrer code postal" required="required"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ville">Ville <em>*</em></label>
                                <div class="input-group">
                                    <input value="<?php echo(isset($ville) ? $ville : ''); ?>"
                                           type="text" class="form-control" name="ville" id="ville" maxlength="48"
                                           placeholder="Entrer ville" required="required"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tel"> Tél </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-mobile-phone"></span></span>
                                    <input value="<?php echo(isset($telephone) ? $telephone : ''); ?>" type="tel"
                                           class="form-control" name="tel" id="tel" maxlength="10"
                                           placeholder="Entrer téléphone"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="adresse">Adresse <em>*</em></label>
                                <div class="input-group">
                                    <input value="<?php echo(isset($adresse) ? $adresse : ''); ?>"
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
