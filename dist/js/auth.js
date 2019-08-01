function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}


/**
 * Vérification de mail
 */
$(document).on('input', 'input[data-validate="email"]', function() {
    let emailaddress = $( 'input[data-validate="email"]' ).val();

    if( isValidEmailAddress( emailaddress ) ) { 
        $( this ).next('small').html( '' );
        $( this ).removeClass('error');
    }else{
        $( this ).addClass('error');
        $( this ).next('small').html( 'Le mail n\'est pas valide !' );
    }
});


/**
 * Vérification de mot de passe 8 caractères
 */
$(document).on('input', 'input[data-validate="password"]', function() {
    let pass = $( 'input[data-validate="password"]' ).val();

    if( pass.length >= 8 ) { 
        $( this ).next('small').html( '' );
        $( this ).removeClass('error');
    }else{
        $( this ).addClass('error');
        $( this ).next('small').html( 'Le mot de passe doit contenir minmimum 8 caractères ! <br>' );
    }
});


/**
 * Vérification de mot de passe identique + 8 caractères
 */
$(document).on('input', 'input[data-validate="same-password"]', function() {
    let original = $( 'input[data-validate="password"]' ).val();
    let pass = $( 'input[data-validate="same-password"]' ).val();

    if( pass.length >= 8 ) { 
        if( original == pass ) { 
            $( this ).next('small').html( '' );
            $( this ).removeClass('error');
        }else{
            $( this ).addClass('error');
            $( this ).next('small').html( 'Les mot de passes sont différents ! <br>' );
        }
    }else{
        $( this ).addClass('error');
        $( this ).next('small').html( 'Le mot de passe doit contenir minmimum 8 caractères ! <br>' );
    }
});