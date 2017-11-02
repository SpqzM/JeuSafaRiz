<?php

   // On va chercher la définition de la classe
   require('PHPMailer-FE_v4.11/_lib/class.phpmailer.php');
 
        $mail = new PHPmailer();
     
       
        $mail->From='sylvainprat75@gmail.com';
        $mail->AddAddress('sylvainprat75@gmail.com');
        $mail->AddReplyTo('sylvainprat75@gmail.com');     
        $mail->Subject='Exemple trouvé sur DVP';
        $mail->Body='Voici un exemple d\'e-mail au format Texte';
        
        if(!$mail->Send()){ //Teste le return code de la fonction
          echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
        }
        else{     
          echo 'Mail envoyé avec succès';
        }
   
        unset($mail);
?>