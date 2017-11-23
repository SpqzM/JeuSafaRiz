<?php
// Demarrage de la session
session_start();

include '../Views/head.php';
require '../Class/autoload.php';
require '../Pdo/connexionBDD.php';

// Instanciation des class manager pour les gagnés, perdus, et les lots
$db = connect();
$manager = new participationsManager($db);
$mPerdu = new perduManager($db);
$mLots = new lotsManager($db);
$erreur = "";

if (isset($_SESSION['nom']) && isset($_SESSION['prenom']) && isset($_SESSION['email']) && isset($_SESSION['cp']) &&
        isset($_SESSION['ville']) && isset($_SESSION['adresse']) && isset($_SESSION['reglement']) && isset($_SESSION['mdp'])) {

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

    // On récupère l'ID du dernier participant
    $lastParticipant = $_SESSION['lastParticipant'];

    //Traitement d'un instant gagnant
    $lot = $mLots->lotId();

    //Verification de l'instant gagnant
    // Si l'IG n'est pas faux, on a gagné
    if ($lot[0] != false) {
        $idLot = $lot[0];
        $idParticipant = $lastParticipant;
        // Instanciation de la participation sur ce lot
        $participation = new Participations(array(
            'idLot' => $idLot,
            'idParticipant' => $idParticipant
        ));
        // On vérifie que le participant n'a pas déjà joué
        $controleParticipant = $manager->controleParticipation($participant->getEmail());
        if ($controleParticipant != false) {
            $msg = "Vous avez deja joué aujourd'hui";
        } else {
            // S'il n'a pas déjà joué, il a gagné
            $manager->addParticipation($participation);
            $libelleLot = $manager->libelleLot($idLot, $idParticipant);
            $msg = '<h3>Bravo vous avez gagné</h3>
                <p class="lot center">' . $libelleLot[0] . '</p>
                <p>Vous serez contacté en fin de jeu pour des modalités de retrait de votre gain. </p>
                <p>En attendant, visitez notre site <a href="http://www.rizdecamargue.com" target="_blank">www.rizdecamargue.com</a> </p>';
        }
    }
    // Si l'IG est faux, on a perdu
    else {
        $idParticipant = $lastParticipant;
        // Instanciation de l'objet perdu
        $perduP = new perdu(array(
            'idParticipant' => $idParticipant
        ));
        $msg = '<h3>Désolé, vous avez perdu.</h3>
                <p>Retentez votre chance sur <a href="http://www.jeusafariz.com" target="_blank">www.jeusafariz.com </a></p>
                <p>Et visitez notre site <a href="http://www.rizdecamargue.com" target="_blank">www.rizdecamargue.com</a> </p>';
        // Insertion en base du perdant
        $mPerdu->addParticipationPerdu($perduP);
        session_destroy();
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

        <div class="col-sm-4 col-md-8 col-lg-8">
            <div class="boxed-grey">
                <?php
                echo $msg;
                ?>
            </div>
        </div>
    </div>
</div>
<?php include '../Views/footer.php' ?>
