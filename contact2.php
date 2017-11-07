<?php
/*
	********************************************************************************************
	CONFIGURATION
	********************************************************************************************
*/

// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
$debut = 'safarizgame';
$fin = '@gmail.com';
$mail = $debut .$fin;
$destinataire = $mail;

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $destinataire)) // On filtre les serveurs qui rencontrent des bogues.
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
};
 
// Messages de confirmation du mail
$message_envoye = "Votre message nous est bien parvenu !";
$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";
 
// Messages d'erreur du formulaire
$message_erreur_formulaire = "Vous devez d'abord <a href=\"contact.php\">envoyer le formulaire</a>.";
$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis";
 
/*
	********************************************************************************************
	TESTE DU CONTENU
	********************************************************************************************
*/
 
// on teste si le formulaire a été soumis
if (!isset($_POST['envoi']))
{
	// formulaire non envoyé
	echo '<p>'.$message_erreur_formulaire.'</p>'.$passage_ligne;
}
else
{
	/*
	 * cette fonction sert à nettoyer et enregistrer un texte
	 */
	function Rec($text)
	{
		$text = htmlspecialchars(trim($text), ENT_QUOTES);
		if (1 === get_magic_quotes_gpc())
		{
			$text = stripslashes($text);
		}
 
		$text = nl2br($text);
		return $text;
	};

/*
	 * Cette fonction sert à vérifier la syntaxe d'un email
	 */
	function IsEmail($email)
	{
		$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
		return (($value === 0) || ($value === false)) ? false : true;
	}
 
/*
	********************************************************************************************
	RECUPERATION DES CHAMPS
	********************************************************************************************
*/
	$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
	$prenom  = (isset($_POST['prenom']))     ? Rec($_POST['prenom'])     : '';
	$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
	$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';
	$sujet = (isset($_POST['sujet'])) ? Rec($_POST['sujet']) : '';
	$tel = (isset($_POST['tel'])) ? Rec($_POST['tel']) : '';

/*
	********************************************************************************************
	GENERATION DE L'EMAIL
	********************************************************************************************
*/

	$contenu = 'Message de : ' .$nom .$passage_ligne .'Mail : ' .$email .$passage_ligne .'Message du joueur : ' .$message .$passage_ligne;
	$objet = "Message d'un nouveau joueur";

	//=====Déclaration des messages au format texte et au format HTML.
	$message_txt = "Cher Admin, vous avez reçu un nouveau message via votre site JeuSafaRiz, voici le message : ".$passage_ligne .$contenu;
	$message_html = "<html><head></head><body><b>Cher Admin, vous avez reçu un nouveau message via votre site JeuSafaRiz</b>, voici le message : ".$passage_ligne .$contenu ."</body></html>";
 
	//=====Création de la boundary
	$boundary = "-----=".md5(rand());
	//==========
	
	 //=====Création du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format texte.
	$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format HTML
	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	//==========

	// On va vérifier les variables et l'email ...
	$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré


	if(!empty($_POST['humans'])) {  // On vérifie que c'est bien un humain
		echo('SPAM');
	} else if (($email != ''))
	{
		// S'il y a une adresse mail, on génère le mail
		$headers  = 'MIME-Version: 1.0' .$passage_ligne;
		$headers .= "From:\"SafaRiz\"<safarizgame@gmail.com>" .$passage_ligne .
				"Reply-to: \"SafaRiz\"<safarizgame@gmail.com>" .$passage_ligne .
				'Content-Type: multipart/alternative;'.$passage_ligne .'boundary=\"$boundary\"' .$passage_ligne;
 
		// Remplacement de certains caractères spéciaux
		$message = str_replace("&#039;","'",$message);
		$message = str_replace("&#8217;","'",$message);
		$message = str_replace("&quot;",'"',$message);
		$message = str_replace('<br>','',$message);
		$message = str_replace('<br />','',$message);
		$message = str_replace("&lt;","<",$message);
		$message = str_replace("&gt;",">",$message);
		$message = str_replace("&amp;","&",$message);
 
		// Envoi du mail
		
		// $num_emails = 0;

		if (mail($destinataire, $objet, $message, $headers)) {
		$num_emails++;
		};
 
		if ($num_emails == 1)
		{
			$confirmation = '<i class="fa fa-check-square-o" aria-hidden="true" style="color: green;"></i> <strong>' .$message_envoye .'</strong>';
		}
		else
		{
			$confirmation = '<i class="fa fa-window-close-o" aria-hidden="true" style="color: red;"></i> <strong>' .$message_non_envoye .'</strong>';
		};
	}
	else
	{
		// une des 3 variables (ou plus) est vide ...
		echo '<p>'.$message_formulaire_invalide.' <a href="contact.php">Retour au formulaire</a></p>'."\n";
	};
}; // fin du if (!isset($_POST['envoi']))
?>