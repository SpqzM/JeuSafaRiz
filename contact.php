<?php include 'views/head.php'; ?>

<div class="container">
    <div class="row">
        <header class='col-sm-4 col-md-4 col-lg-4'>
            <div id="gagner">Gagner un</div>
            <div id="safariz">SAFA'RIZ</div>
            <div id="camargue">en Camargue</div>
        </header>
        <div class="col-md-8">
            <div class="boxed-grey">
                <form id="contact-form" method="post">

                    <h3>Contact</h3>
                    <p>Besoin de renseignement complémentaires ? </p>  
                    <p>Tous les champs marqués d'une * sont obligatoires</p>                    
                    <div class="row">
                        <div class="col-md-6 ">                                       
                            <div class="form-group">
                                <label for="nom"> Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer nom" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="prenom"> Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer prénom" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="email"> Email </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrer email" required="required" />
                                </div>                            
                            </div>
                            <div class="form-group">
                                <label for="tel"> Tél </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-mobile-phone"></span></span>
                                    <input type="tel" class="form-control" id="tel" name="tel" placeholder="Entrer téléphone" required="required" />
                                </div>
                            </div>                        
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sujet">Sujet</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="sujet" name="sujet" placeholder="Entrer sujet" required="required" />
                                </div>
                            </div>                              
                            <div class="form-group">
                                <label for="texte">Message</label>
                                <textarea name="texte" id="texte" class="form-control" rows="8" cols="30" required="required"
                                          placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span id="resultat"></span>
                            <button type="submit" class="btn btn-form pull-right" id="btnContact">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['sujet']) && isset($_POST['texte'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $sujet = $_POST['sujet'];
    $texte = $_POST['texte'];
    $telephone = $_POST['tel'];

    if ($telephone == "") {
        $telephone = NULL;
    } else {
        $telephone = $_POST['tel'];
    }
// On sécurise l'adresse mail du destinataire
    $debut = 'safarizgame';
    $fin = '@gmail.com';
    $mail = $debut . $fin;
    $destinataire = $mail;
// Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
    $expediteurmail = $email;
    $expediteurnom = $nom . " " . $prenom;

    $objet = $sujet;

    $headers = 'MIME-Version: 1.0' . "\r\n"; // Version MIME
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // l'en-tete Content-type pour le format HTML
    $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
    $headers .= 'To: Safariz <' . $destinataire . '>' . "\r\n"; // Mail de reponse
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
    $headers .= 'X-Priority: 1' . "\r\n";
    $headers .= 'From: ' . $nom . '<' . $email . '>' . "\r\n"; // Expediteur
    $headers .= 'Reply-to: ' . $nom . '<' . $email . '>' . "\r\n"; // Expediteur

    $message = '<html><body><h1>' . $sujet . '</h1>'// Corps du message
            . '<div>'
            . $texte . '</div></body></html>';
    mail($destinataire, $objet, $message, $headers);
}



include 'views/footer.php';
?>
