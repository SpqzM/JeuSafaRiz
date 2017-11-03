<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">            
        <link rel="stylesheet" href="custom.css">
        <script src="Js/jquery-3.2.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
    
    var $nom = $('#nom'),
        $prenom = $('#prenom'),
        $email = $('#email'),
        $envoi = $('#envoi'),
        $cp = $('#cp'),
        $ville = $('ville');
        $tel = $('tel');
        $champ = $('.champ');

    $tel.keyup(function(){
        if(Math.floor(tel) == id && $.isNumeric(tel)) { // si le numéro n'est pas un numéro
            $(this).css({ // on rend le champ rouge
                borderColor : 'red',
	        color : 'red'
            });
         }
         else{
             $(this).css({ // si tout est bon, on le rend vert
	         borderColor : 'green',
	         color : 'green'
	     });
         }
    });
    });
    </script>
        <title>Jeu SafaRiz</title>
    </head>
    <body>