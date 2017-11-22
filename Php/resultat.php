<?php
// Demarrage de la session
session_start();

include '../Views/head.php';
require '../Class/autoload.php';
require '../Pdo/connexionBDD.php';

// Instanciation des class manager
$db = connect();
$manager = new participationsManager($db);
$ParticipantManager = new participantsManager($db);
$mPerdu = new perduManager($db);
$mLots = new lotsManager($db);
$erreur = "";

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['cp']) &&
    isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['reglement']) && isset($_POST['mdp'])) {
// Récupération des inputs  
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $cp = $_POST['cp'];
    $ville = $_POST['ville'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['tel'];
    $password = $_POST['mdp'];

    if ($telephone == "") {
        $telephone = NULL;
    }

// On instancie un objet Participant
    $participant = new Participants(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'adresse' => $adresse,
        'cp' => $cp,
        'ville' => $ville,
        'telephone' => $telephone,
        'email' => $email,
        'mdp' => $password));

    // Contrôle de saisie php
    $unwanted_array = array('Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
        'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
        'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y');
    $_POST['adresse'] = strtr($_POST['adresse'], $unwanted_array);
    $_POST['ville'] = strtr($_POST['ville'], $unwanted_array);
    $is_valid = true;
    $flagSyntaxeCode_postal = preg_match('#[0-9]{5}$#', $_POST['cp']);
    if ($flagSyntaxeCode_postal == 0 || empty($_POST['cp'])) {
        $erreur .= "Rentrez un code postal à 5 chiffres. <br>";
        $is_valid = false;
    }
    $flagSyntaxeTel = preg_match('#[0-9]{10}$#', $_POST['tel']);
    if ($flagSyntaxeTel == 0 || empty($_POST['tel'])) {
        $erreur .= "Rentrez un numéro de téléphone à 10 chiffres. <br>";
        $is_valid = false;
    }
    $flagSyntaxeNom = preg_match('#[^0-9][a-zA-Z\S\-]{1,}$#', $_POST['nom']);
    if ($flagSyntaxeNom == 0 || empty($_POST['nom'])) {
        $erreur .= "Votre nom ne peut comporter que des lettres, tirets et espaces. <br>";
        $is_valid = false;
    }
    $flagSyntaxePrenom = preg_match('#[^0-9][a-zA-Z\S\-]{1,}$#', $_POST['prenom']);
    if ($flagSyntaxePrenom == 0 || empty($_POST['prenom'])) {
        $erreur .= "Votre prénom ne peut comporter que des lettres, tirets et espaces. <br>";
        $is_valid = false;
    }
    if (!isset($_POST['reglement'])) {
        $erreur .= "Veuillez accepter le règlement du jeu. <br>";
        $is_valid = false;
    }

    if ($is_valid) {
        //On vérifie si le participant a déjà joué aujourd'hui
        $limit = $managerP->limit($email);
        if ($email == $limit['email']) {
            echo "Vous avez déjà participé.";
        } else {
            ////Envoi de mail après inscriptions
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
    }
// On ajoute l'objet participant
    $_SESSION["lastid"] = $ParticipantManager->add($participant);
}

$lot = $mLots->lotId();
$lastParticipant = $_SESSION["lastid"];
session_unset();

if ($lot[0] != false) {
    $resultat = "gagne";
    $idLot = $lot[0];
    $idParticipant = $lastParticipant;
    $participation = new Participations(array(
        'idLot' => $idLot,
        'idParticipant' => $idParticipant,
        'resultat' => $resultat
    ));
    $manager->addParticipation($participation);
    $libelleLot = $manager->libelleLot($idLot, $idParticipant);
    $msgGagne = '<h3>Bravo vous avez gagné</h3>
                <p class="lot">' . $libelleLot[0] . '</p>
                <p>Vous serez contacté en fin de jeu pour des modalités de retrait de votre gain. </p>
                <p>En attendant, visitez notre site <a href="http://www.rizdecamargue.com" target="_blank">www.rizdecamargue.com</a> </p>';
} else {
    $idParticipant = $lastParticipant;
    $perduP = new perdu(array(
        'idParticipant' => $idParticipant
    ));
    $msgPerdu = '<h3>Désolé, vous avez perdu.</h3>
                <p>Retentez votre chance sur <a href="http://www.jeusafariz.com" target="_blank">www.jeusafariz.com </a></p>
                <p>Et visitez notre site <a href="http://www.rizdecamargue.com" target="_blank">www.rizdecamargue.com</a> </p>';
    $mPerdu->addParticipationPerdu($perduP);
    session_destroy();
}
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
                <?php
                if (isset($participation)) {
                    echo $msgGagne;
                } else {
                    echo $msgPerdu;
                }
                //                if ($controleParticipant){
                //                    echo $msgDejaJoue;
                //                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include '../Views/footer.php' ?>
