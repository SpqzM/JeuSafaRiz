document.addEventListener("DOMContentLoaded", function() { 
    var submit = document.getElementById('btnRegister'),
        familyName = document.getElementById('nom'),
        firstname = document.getElementById('prenom'),
        email = document.getElementById('email'),
        phone = document.getElementById('tel'),
        cp = document.getElementById('cp'),
        reglement = document.getElementById('reglement'),
        feedback = document.getElementById('feedback'),
        error = document.getElementsByClassName('error');
        
    if (submit) {
        submit.addEventListener('click', submitForm);
    }
    
    function isValidEmailAddress(email) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(email);
    }
          
    function submitForm() {
            if (!isValidEmailAddress(email.value)) {
                email.classList.add('error');
                feedback.innerHTML = "Veuillez entrer un email valide";
            } else if (isNaN(phone.value) || phone.value.length < 10) {
                email.classList.add('valid');
                phone.classList.add('error');
                feedback.innerHTML = "Veuillez entrer un téléphone valide";
            } else if (isNaN(cp.value) || cp.value.length < 5) {
                phone.classList.add('valid');
                cp.classList.add('error');
                feedback.innerHTML = "Veuillez entrer un code postal valide";
            } else if (!isNaN(firstname.value)) {
                cp.classList.add('valid');
                firstname.classList.add('error');
                feedback.innerHTML = "Votre prénom comporte des chiffres ? :)";
            } else if (!isNaN(familyName.value)) {
                firstname.classList.add('valid');
                familyName.classList.add('error');
                feedback.innerHTML = "Votre nom comporte des chiffres ? :)";
            } else if (!reglement.checked) {
                familyName.classList.add('valid');
                reglement.classList.add('error');
                feedback.innerHTML = "Veuillez accepter le règlement du jeu";
            } else {
                feedback.innerHTML = "Envoyé";
                var form = document.getElementById('registration-form');
                form.submit();
            }
    };
});