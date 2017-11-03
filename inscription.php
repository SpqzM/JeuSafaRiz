
<?php
include 'views/head.php';
require 'Class/autoload.php';
require 'connexionBDD.php';

$db = connect();
$manager = new participantsManager($db);

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['cp']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['reglement'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $cp = $_POST['cp'];
    $ville = $_POST['ville'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['tel'];

    if ($telephone == "") {
        $telephone = NULL;
    }
    $participant = new Participants(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'adresse' => $adresse,
        'cp' => $cp,
        'ville' => $ville,
        'telephone' => $telephone,
        'email' => $email));

    $manager->add($participant);


    $destinataire = 'safarizgame@gmail.com';
    // Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
    $expediteurmail = $participant->getEmail();
    $expediteurnom = $participant->getNom();

    $objet = "Inscription de " . $expediteurnom;

    $headers = 'MIME-Version: 1.0' . "\r\n"; // Version MIME
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // l'en-tete Content-type pour le format HTML
    $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
    $headers .= 'To: Safariz <' . $destinataire . '>' . "\r\n"; // Mail de reponse
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
    $headers .= 'X-Priority: 1' . "\r\n";
    $headers .= 'From: ' . $expediteurnom . '<' . $expediteurmail . '>' . "\r\n"; // Expediteur
    $headers .= 'Reply-to: ' . $expediteurnom . '<' . $expediteurmail . '>' . "\r\n"; // Expediteur

    $message = '<html><body><h1>' . $objet . '</h1>'
            . '<div style="width: 100%; text-align: center;">'
            . 'Bonjour ' . $expediteurnom . '!<br>'
            . 'Message générique</div></body></html>';
//     var_dump($participant);
//     echo $destinataire."-".$objet."-".$message."-".$headers;
    if (mail($destinataire, $objet, $message, $headers)) {
        echo '<script language="javascript" >alert("Votre participation a été envoyée ");</script>';
    } else { // Non envoyé
        echo '<script language="javascript">alert("Votre participation n\'a pas pu être envoyée");</script>';
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

        <div class="col-md-8">
            <div class="boxed-grey">
                <form id="registration-form" method="post" action="inscription.php">
                    <h5>Inscrivez-vous ci-dessous :</h5>
                    <h6>Tous les champs marqués d'une * sont obligatoires</h6>
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label for="nom"> Nom <em>*</em></label>
                                <input type="text" class="form-control" name="nom" id="nom" maxlength="48" placeholder="Entrer nom" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="prenom"> Prénom <em>*</em></label>
                                <input type="text" class="form-control" name="prenom" id="prenom" maxlength="48" placeholder="Entrer prénom" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="email"> Email <em>*</em></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Entrer email" required="required" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cp">CP <em>*</em></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cp" id="cp" maxlength="5" placeholder="Entrer code postal" required="required" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ville">Ville <em>*</em></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ville" id="ville" maxlength="48" placeholder="Entrer ville" required="required" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tel"> Tél </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-mobile-phone"></span></span>
                                    <input type="tel" class="form-control" name="tel" id="tel" maxlength="10" placeholder="Entrer téléphone" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="adresse">Adresse <em>*</em></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="adresse" id="adresse" maxlength="48" placeholder="Entrer adresse" required="required" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="reglement" id="reglement">
                                    J'accepte <a href="reglement.php" target="_blank"> le règlement du jeu</a> *
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="btn btn-form pull-right" id="btnRegister">Valider votre inscription</div>
                        </div>
                        <div class="col-md-6" id="feedback">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>                    
</div>
<?php include 'views/footer.php' ?>
