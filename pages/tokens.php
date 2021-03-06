<div class="jumbotron parallax" data-parallax="scroll" data-image-src="theme/<?php echo $_Serveur_['General']['theme'];?>/img/jumbotron.png">
    <div class="container">
        <h1> Achat de <?php echo $monnaie ?>s </h1>
        <br/>
        <p> Achetez des
            <?php echo $monnaie ?>s ici </p>
    </div>
</div>
<div class="container">
    <?php if(isset($_GET['success']) AND $_GET['success'] == 'true'){ ?>
        <div class="alert alert-success">Votre code a bien été validé, vous avez été crédité de <?php echo $_GET['tokens']; ?>  Jetons ! </div>
    <?php } elseif(isset($_GET['success']) AND $_GET['success'] == 'false'){ ?>
        <div class="alert alert-danger">Le code entré est incorrect, vous n'avez pas été crédité...</div>
    <?php }
    if($_Serveur_['Payement']['paypal'] == true)
    {
    ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 style="color:white">Payement par PayPal</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-success">Deux possibilités s'offrent à vous pour les dons, vous pouvez payer par PayPal, soit avec votre compte soit avec votre carte bancaire de manière sécurisée depuis le site PayPal (le paiement ne s'effectue donc pas sur notre serveur/site). L'avantage de PayPal est que le joueur reçoit plus de Jetons qu'avec un paiement téléphonique (qui sont surtaxés).</div>
            <?php
            require_once('controleur/tokens/paypal.php');
            ?>
            <div class="row">
                <?php
                if(isset($offresTableau))
                    for($i = 0; $i < count($offresTableau); $i++)
                    {
                        echo '
						<div class="col-md-4 offre-boutique">
							<div class="well offre-contenu">
								<div class="contenuBoutique">
									<h3 class="titre-offre">'. $offresTableau[$i]['nom'] .'</h3>
									' .$offresTableau[$i]['description']. '
								</div>
								<div class="footer-offre"> ';
                        if(isset($_Joueur_)) {
                            if($lienPaypal[$i] == 'viaMail')
                                require('controleur/paypal/paypalMail.php');
                            else
                                echo '<a href="'. $lienPaypal[$i] .'" class="btn btn-primary">Acheter !</a>';
                        }
                        else { echo'<a href="?&page=connection" class="btn btn-danger">Connexion..</a>'; }
                        echo '
									<button class="btn btn-info pull-right">' .$offresTableau[$i]['prix']. ' euro</button>
								</div>
							</div>
						</div>		';
                    }
                else
                    echo '<div style="margin-left: 15px;margin-right: 15px;" class="alert alert-danger"><strong>Aucune offre de payement par paypal n\'est disponible pour le moment...</strong></div>';
                ?>
            </div>
        </div>
    </div>
       <?php } ?>


    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 style="color:white">Payement par MCGPass</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-success">Vous pouvez payer par MCGPass, vous paierez ainsi avec votre forfait téléphonique, c'est donc un avantage important. D'un autre côté, vous serez déversé de moins de
                            <?php echo $monnaie ?>s qu'avec un paiement PayPal (qui sont beaucoup moins taxés).</div>
                        <iframe src="https://secure.mcgpass.com/script_mv/v1/script_payment?id=<?php echo $_Serveur_['Payement']['mcgpass_idSite']; ?>&merchant_data=" width="100%" height="400" marginheight="0" marginwidth="0" style="border:0px" scrolling="yes"></iframe>
                    </div>
                </div>
</div>