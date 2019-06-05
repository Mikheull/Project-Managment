function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}

$(document).on('input', 'input[data-validate="email"]', function() {
    let emailaddress = $( 'input[data-validate="email"]' ).val();

    if( isValidEmailAddress( emailaddress ) ) { 
        // $( '.submit-valid' ).attr("disabled", false);
        $( this ).next('small').html( '' );
        $( this ).removeClass('error');
    }else{
        // $( '.submit-valid' ).attr("disabled", true);
        $( this ).addClass('error');
        $( this ).next('small').html( 'Le mail n\'est pas valide !' );
    }
});

$(document).on('input', 'input[data-validate="password"]', function() {
    let pass = $( 'input[data-validate="password"]' ).val();

    if( pass.length >= 8 ) { 
        // $( '.submit-valid' ).attr("disabled", false);
        $( this ).next('small').html( '' );
        $( this ).removeClass('error');
    }else{
        // $( '.submit-valid' ).attr("disabled", true);
        $( this ).addClass('error');
        $( this ).next('small').html( 'Le mot de passe doit contenir minmimum 8 caractères ! <br>' );
    }
});