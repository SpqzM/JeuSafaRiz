
<?php 

include 'views/header.php';
include 'views/head.php'; ?>
                <section class="col-sm-8">
                    <?php
                    // put your code here for the contact
                    ?>
<div class="row">
        <div class="col-md-7">
            <div class="boxed-grey">
                <form id="contact-form" method="post">
                    <h3>Contact</h3>                    
                    <p>Besoin de renseignement complémentaires ? </p>                    
                    <div class="row">
                        <div class="col-md-6 ">                                       
                            <div class="form-group">
                                <label for="nom"> Nom</label>
                                <input type="text" class="form-control" id="nom" placeholder="Entrer nom" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="prenom"> Prénom</label>
                                <input type="text" class="form-control" id="prenom" placeholder="Entrer prénom" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="email"> Email </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                    <input type="email" class="form-control" id="email" placeholder="Entrer email" required="required" />
                                </div>                            
                            </div>
                            <div class="form-group">
                                <label for="tel"> Tél </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-mobile-phone"></span></span>
                                    <input type="tel" class="form-control" id="tel" placeholder="Entrer téléphone" required="required" />
                                </div>
                            </div>                        
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
		                <label for="sujet">Sujet</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="sujet" placeholder="Entrer sujet" required="required" />
                                </div>
	                    </div>                              
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" class="form-control" rows="8" cols="30" required="required"
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
                </section>
            </div>
        </div>
        <?php include 'views/footer.php'; ?>
