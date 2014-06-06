jQuery(document).ready(function($) {

    // hide messages 
    $("#error").hide();
    $("#sent-form-msg").hide();
    $("#sent-form-msg2").hide();
    $("#sent-form-msg3").hide();
    $("#sent-form-msg4").hide();

    // on submit...
    $("#contactForm #submit").click(function() {
        $("#error").hide();

        //required:

        //name
        var name = $("input#name").val();
        if (name == "") {
            $("#error").fadeIn().text("Nom et/ou prenom requis");
            $("input#name").focus();
            return false;
        }

        // email
        var email = $("input#email").val();
        var emailreal = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!(email.match(emailreal))) {
            $("#error").fadeIn().text("Courriel valide requis");
            $("input#email").focus();
            return false;
        }

        // phone
        var phone = $("input#phone").val();
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if (!(phone.match(phoneno))) {
            $("#error").fadeIn().text("Numero de telephone requis");
            $("input#phone").focus();
            return false;
        }

        var form = $('#contactForm');
        var real_data = form.serialize();

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: real_data,
            success: success()
        });
    });

    // on submit...
    $("#inscriptionForm #submit").click(function() {
        $("#error").hide();

        // nom
        var nom = $("input#nom").val();
        if (nom == "") {
            $("#error").fadeIn().text("Nom requis.");
            $("input#nom").focus();
            return false;
        }

        // prenom
        var prenom = $("input#prenom").val();
        if (prenom == "") {
            $("#error").fadeIn().text("Prenom requis.");
            $("input#prenom").focus();
            return false;
        }

        // telephone
        var telephone = $("input#telephone").val();
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if (!(telephone.match(phoneno))) {
            $("#error").fadeIn().text("Numero de telephone requis.");
            $("input#telephone").focus();
            return false;
        }

        // email
        var email = $("input#email").val();
        var emailreal = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!(email.match(emailreal))) {
            $("#error").fadeIn().text("Courriel valide requis");
            $("input#email").focus();
            return false;
        }

        // password
        var password = $("input#password").val();
        if (password == "") {
            $("#error").fadeIn().text("Mot de passe requis");
            $("input#password").focus();
            return false;
        }

        // pays
        var pays = $("input#pays").val();
        if (pays == "") {
            $("#error").fadeIn().text("Pays de residence requis");
            $("input#pays").focus();
            return false;
        }

        // province
        var province = $("input#province").val();
        if (province == "") {
            $("#error").fadeIn().text("Province de residence requis");
            $("input#province").focus();
            return false;
        }

        // ville
        var ville = $("input#ville").val();
        if (ville == "") {
            $("#error").fadeIn().text("Ville de residence requis");
            $("input#ville").focus();
            return false;
        }

        // numero-rue
        var numerorue = $("input#numerorue").val();
        if (numerorue == "") {
            $("#error").fadeIn().text("Numero et rue de residence requis");
            $("input#numerorue").focus();
            return false;
        }

        // codepostal
        var codepostal = $("input#codepostal").val();
        if (codepostal == "") {
            $("#error").fadeIn().text("Code postal requis");
            $("input#codepostal").focus();
            return false;
        }

        var formElement = document.getElementById("inscriptionForm");
        var form = $('#inscriptionForm');

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: new FormData(formElement),
            processData: false,
            contentType: false,
            success: success_ins()
        });

        return true;
    });

    // on submit...
    $("#modificationForm #submit").click(function() {
        $("#error").hide();

        // nom
        var nom = $("input#nom").val();
        if (nom == "") {
            $("#error").fadeIn().text("Nom requis.");
            $("input#nom").focus();
            return false;
        }

        // prenom
        var prenom = $("input#prenom").val();
        if (prenom == "") {
            $("#error").fadeIn().text("Prenom requis.");
            $("input#prenom").focus();
            return false;
        }

        // telephone
        var telephone = $("input#telephone").val();
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if (!(telephone.match(phoneno))) {
            $("#error").fadeIn().text("Numero de telephone requis.");
            $("input#telephone").focus();
            return false;
        }

        // email
        var email = $("input#email").val();
        var emailreal = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!(email.match(emailreal))) {
            $("#error").fadeIn().text("Courriel valide requis");
            $("input#email").focus();
            return false;
        }

        // password
        var password = $("input#password").val();
        if (password == "") {
            $("#error").fadeIn().text("Mot de passe requis");
            $("input#password").focus();
            return false;
        }

        // pays
        var pays = $("input#pays").val();
        if (pays == "") {
            $("#error").fadeIn().text("Pays de residence requis");
            $("input#pays").focus();
            return false;
        }

        // province
        var province = $("input#province").val();
        if (province == "") {
            $("#error").fadeIn().text("Province de residence requis");
            $("input#province").focus();
            return false;
        }

        // ville
        var ville = $("input#ville").val();
        if (ville == "") {
            $("#error").fadeIn().text("Ville de residence requis");
            $("input#ville").focus();
            return false;
        }

        // numero-rue
        var numerorue = $("input#numerorue").val();
        if (numerorue == "") {
            $("#error").fadeIn().text("Numero et rue de residence requis");
            $("input#numerorue").focus();
            return false;
        }

        // codepostal
        var codepostal = $("input#codepostal").val();
        if (codepostal == "") {
            $("#error").fadeIn().text("Code postal requis");
            $("input#codepostal").focus();
            return false;
        }

        // codepostal
        var role = $("input#role").val();
        if (role == "") {
            $("#error").fadeIn().text("Role requis");
            $("input#role").focus();
            return false;
        }

        var form = $('#modificationForm');
        var real_data = form.serialize();

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: real_data,
            success: success_mod()
        });

        return true;
    });

    // on submit...
    $("#categoryForm #submit").click(function() {
        $("#error").hide();

        // type
        var type = $("input#type").val();
        if (type == "") {
            $("#error").fadeIn().text("Type requis");
            $("input#type").focus();
            return false;
        }

        var form = $('#categoryForm');
        var real_data = form.serialize();

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: real_data,
            success: success_cat()
        });

        return true;
    });

    // on submit...
    $("#supcatForm #submit").click(function() {
        $("#error").hide();

        // type
        var type = $("input#type1").val();
        if (type == "") {
            $("#error").fadeIn().text("Type requis");
            $("input#type1").focus();
            return false;
        }

        var form = $('#supcatForm');
        var real_data = form.serialize();

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: real_data,
            success: success_supcat()
        });

        return true;
    });

    // on submit...
    $("#suppressionForm #submit").click(function() {
        $("#error").hide();

        // email
        var email = $("input#email1").val();
        var emailreal = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!(email.match(emailreal))) {
            $("#error").fadeIn().text("Courriel valide requis");
            $("input#email1").focus();
            return false;
        }
        
        var form = $('#suppressionForm');
        var real_data = form.serialize();

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: real_data,
            success: success_sup()
        });

        return true;
    });

    // on submit...
    $("#connexionForm #submit").click(function() {
        $("#error").hide();

        // email
        var email = $("input#email").val();
        var emailreal = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!(email.match(emailreal))) {
            $("#error").fadeIn().text("Courriel valide requis");
            $("input#email").focus();
            return false;
        }

        // password
        var password = $("input#password").val();
        if (password == "") {
            $("#error").fadeIn().text("Mot de passe requis");
            $("input#password").focus();
            return false;
        }

        var form = $('#connexionForm');
        var real_data = form.serialize();

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: real_data
        });

        return true;
    });

    // on success...
    function success() {
        $("#sent-form-msg").fadeIn();
        $("#contactForm").fadeOut();
    }

    // on success...
    function success_ins() {
        $("#sent-form-msg").fadeIn();
        $("#inscriptionForm").fadeOut();
    }

    // on success...
    function success_mod() {
        $("#sent-form-msg").fadeIn();
        $("#modificationForm").fadeOut();
    }

    // on success...
    function success_cat() {
        $("#sent-form-msg3").fadeIn();
        $("#categoryForm").fadeOut();
    }

    // on success...
    function success_sup() {
        $("#sent-form-msg2").fadeIn();
        $("#suppressionForm").fadeOut();
    }

    // on success...
    function success_supcat() {
        $("#sent-form-msg4").fadeIn();
        $("#supcatForm").fadeOut();
    }

    return false;
});

