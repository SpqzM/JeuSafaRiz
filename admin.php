<?php include 'views/head.php'; ?>
<div class="container">
    <div class="row">
        <header class='col-sm-4 col-md-4 col-lg-4'>
            <div id="gagner">Gagner un</div>
            <div id="safariz">SAFA'RIZ</div>
            <div id="camargue">en Camargue</div>
        </header>
        <div class="col-md-5">
            <div class="boxed-grey">
                <form action="admin.php" method="post">
                    <h5>Connexion</h5>
                    <div class="row">
                        <div class="col-md-12">                                       
                            <div class="form-group">
                                <label for="login"> Login *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-sign-in"></span></span>                                               
                                    <input type="text" class="form-control" id="login" maxlength="48" placeholder="Entrer login" required="required" />
                                </div>
                            </div>    
                            <div class="form-group">
                                <label for="mdp"> Mot de passe *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>                                                                   
                                    <input type="password" class="form-control" id="mdp" maxlength="48" placeholder="Entrer mot de passe" required="required" />                         
                                </div>
                            </div>    
                        </div>                      
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-form pull-right" id="btnAdmin">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>	
</div>
<?php include 'views/footer.php'; ?>
