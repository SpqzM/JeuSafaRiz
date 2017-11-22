// Création des variables qui sont les ID ou classes des différents input du formulaire

document.addEventListener("DOMContentLoaded", function () {
    var submitRegistration = document.getElementById('btnRegister'),
        submitContact = document.getElementById('btnContact'),
        familyName = document.getElementById('nom'),
        firstname = document.getElementById('prenom'),
        email = document.getElementById('email'),
        phone = document.getElementById('tel'),
        cp = document.getElementById('cp'),
        reglement = document.getElementById('reglement'),
        mdp = document.getElementById('mdp'),
        feedback = document.getElementById('feedback'),
        address = document.getElementById('adresse'),
        town = document.getElementById('ville'),
        subject = document.getElementById('sujet'),
        message = document.getElementById('texte');


    if (submitRegistration) {
        submitRegistration.addEventListener('click', submitRegisterForm);
    }

    if (submitContact) {
        submitContact.addEventListener('click', submitContactForm);
    }

    // création d'un patern pour que les emails soient valides

    function isValidEmailAddress(email) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(email);
    }

    // On part du principe qu'il n'y a pas d'erreur d'entrées dans le formulaire, s'il y en a, on utilise la variable error et on incrémente

    function submitRegisterForm() {
        var error = 0;

        if (town.value == '') {
            town.classList.add('error');
            error++;
        } else {
            town.classList.add('valid');
        }

        if (address.value == '') {
            address.classList.add('error');
            error++;
        } else {
            address.classList.add('valid');
        }

        if (!isValidEmailAddress(email.value)) {
            email.classList.add('error');
            feedback.innerHTML = "Veuillez entrer un email valide";
            error++;
        } else {
            email.classList.add('valid');
        }


        if (phone.value != '') {
            if (isNaN(phone.value) || phone.value.length < 10) {
                phone.classList.add('error');
                feedback.innerHTML = "Veuillez entrer un téléphone valide";
                error++;
            } else {
                phone.classList.add('valid');
            }
        }

        if (isNaN(cp.value) || cp.value.length < 5) {
            cp.classList.add('error');
            feedback.innerHTML = "Veuillez entrer un code postal valide";
            error++;
        } else {
            cp.classList.add('valid');
        }

        if (!isNaN(firstname.value)) {
            firstname.classList.add('error');
            feedback.innerHTML = "Veuillez entrer un prénom valide";
            error++;
        } else {
            firstname.classList.add('valid');
        }

        if (!isNaN(familyName.value)) {
            familyName.classList.add('error');
            feedback.innerHTML = "Veuillez entrer un nom valide";
            error++;
        } else {
            familyName.classList.add('valid');
        }
        if (!(mdp.value)) {
            mdp.classList.add('error');
            feedback.innerHTML = "Veuillez entrer le mot de passe";
            error++;
        } else {
            mdp.classList.add('valid');
        }

        if (!reglement.checked) {
            reglement.classList.add('error');
            feedback.innerHTML = "Veuillez accepter le règlement du jeu";
            error++;
        }
        // s'il n'y a plus d'erreur, on peut soumettre le formulaire

        if (error === 0) {
            var form = document.getElementById('registration-form');
            form.submit();
        }
    };

    // Même chose que pour le formulaire précendent, s'il y en a des erreurs, on utilise la variable error et on incrémente

    function submitContactForm() {
        var error = 0;

        if (!isValidEmailAddress(email.value)) {
            email.classList.add('error');
            feedback.innerHTML = "Veuillez entrer un email valide";
            error++;
        } else {
            email.classList.add('valid');
        }

        if (phone.value != '') {
            if (isNaN(phone.value) || phone.value.length < 10) {
                phone.classList.add('error');
                feedback.innerHTML = "Veuillez entrer un téléphone valide";
                error++;
            } else {
                phone.classList.add('valid');
            }
        }

        if (!isNaN(firstname.value)) {
            firstname.classList.add('error');
            feedback.innerHTML = "Veuillez entrer un prénom valide";
            error++;
        } else {
            firstname.classList.add('valid');
        }

        if (!isNaN(familyName.value)) {
            familyName.classList.add('error');
            feedback.innerHTML = "Veuillez entrer un nom valide";
            error++;
        } else {
            familyName.classList.add('valid');
        }

        if (subject.value == '') {
            subject.classList.add('error');
            error++;
        } else {
            subject.classList.add('valid');
        }

        if (message.value == '') {
            message.classList.add('error');
            error++;
        } else {
            message.classList.add('valid');
        }

// s'il n'y a plus d'erreur, on peut soumettre le formulaire

        if (error === 0) {
            var form = document.getElementById('contact-form');
            form.submit();
        }

    }
});

// Script du compte à rebours

function compte_a_rebours() {
    var compte_a_rebours = document.getElementById("compte_a_rebours");

    var date_actuelle = new Date();
    var date_evenement = new Date("Nov 28 23:59:00 2017");
    var total_secondes = (date_evenement - date_actuelle) / 1000;

    var prefixe = "Fin du jeu dans ";
    if (total_secondes < 0) {
        prefixe = "Compte à rebours terminé il y a "; // On modifie le préfixe si la différence est négatif
        total_secondes = Math.abs(total_secondes); // On ne garde que la valeur absolue
    }

    if (total_secondes > 0) {
        var jours = Math.floor(total_secondes / (60 * 60 * 24));
        var heures = Math.floor((total_secondes - (jours * 60 * 60 * 24)) / (60 * 60));
        minutes = Math.floor((total_secondes - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
        secondes = Math.floor(total_secondes - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

        var et = "et";
        var mot_jour = "jours,";
        var mot_heure = "heures,";
        var mot_minute = "minutes,";
        var mot_seconde = "secondes";

        if (jours == 0) {
            jours = '';
            jours = '';
            mot_jour = '';
        }
        else if (jours == 1) {
            mot_jour = "jour,";
        }

        if (heures == 0) {
            heures = '';
            mot_heure = '';
        }
        else if (heures == 1) {
            mot_heure = "heure,";
        }

        if (minutes == 0) {
            minutes = '';
            mot_minute = '';
        }
        else if (minutes == 1) {
            mot_minute = "minute,";
        }

        if (secondes == 0) {
            secondes = '';
            mot_seconde = '';
            et = '';
        }
        else if (secondes == 1) {
            mot_seconde = "seconde";
        }

        if (minutes == 0 && heures == 0 && jours == 0) {
            et = "";
        }

        compte_a_rebours.innerHTML = prefixe + jours + ' ' + mot_jour + ' ' + heures + ' ' + mot_heure + ' ' + minutes + ' ' + mot_minute + ' ' + et + ' ' + secondes + ' ' + mot_seconde;
    }
    else {
        compte_a_rebours.innerHTML = 'Compte à rebours terminé.';
    }

    var actualisation = setTimeout("compte_a_rebours();", 1000);
}

compte_a_rebours();
