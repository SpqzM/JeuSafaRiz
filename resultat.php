<?php
session_start();
include 'views/head.php';
require 'Class/autoload.php';
require 'connexionBDD.php';

// Instanciation des class manager
$db = connect();
$manager = new participationsManager($db);
$ParticipantManager = new participantsManager($db);
$mPerdu = new perduManager($db);
$mLots = new lotsManager($db);

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['cp']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['reglement']) && isset($_POST['mdp'])) {
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

// On ajoute l'objet participant
//note : faire le controle sur l'ajout d'une participation gagne ou perdu !!!
    $controleParticipant = $manager->controleParticipation($email);
    var_dump($controleParticipant);
    if ($controleParticipant != false) {
        echo "Vous avez deja joué aujourd'hui";
        exit();
    } else {
        $_SESSION["lastid"] = $ParticipantManager->add($participant);
    }

//Envoi de mail après inscriptions
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
        . 'L\'utilisateur' . $expediteurnom . 's`\'est inscrit.'
        . '</div></body></html>';
    mail($destinataire, $objet, $message, $headers);
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
<?php include 'views/footer.php' ?>
