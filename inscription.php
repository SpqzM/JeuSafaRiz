
<?php 
require 'Class/autoload.php';
require 'connexionBDD.php';

$db = connect();
$manager = new participantsManager($db);

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email'])
        && isset($_POST['cp']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['reglement']) )
{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email= $_POST['email'];
    $cp= $_POST['cp'];
    $ville= $_POST['ville'];
    $adresse= $_POST['adresse'];
    $telephone = $_POST['tel'];
    
    if ($telephone == ""){
        $telephone = NULL; 
    }
    $participant = new Participants(array(
                        'nom'=> $nom,
                        'prenom' =>$prenom,
                        'adresse' => $adresse,
                        'cp' => $cp,
                        'ville' => $ville,
                        'telephone' => $telephone,
                        'email' => $email));
    
    $manager->add($participant);
}   
    include '../views/header.php';
    
?>

<div class="row">
        <div class="col-md-8">
            <div class="boxed-grey">
                <form id="contact-form" method="post" action="inscription.php">
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
                                    <input type="checkbox" class="form-check-input" name="reglement">
                                    J'accepte <a href="reglement.php"> le réglement du jeu</a> *
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-form pull-right" id="btnContact">Valider votre inscription</button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>                    
            </div>
        </div>
        <?php include '../views/footer.php'; ?>
