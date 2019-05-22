
// Function pour faire pop un message (d'erreur en général)
function popMessage(message, theme, delay){
    setTimeout(function() {
        $( "body" ).prepend( "<div class='popMessage_container'> <div class='popMessage "+ theme +" slidedown'> <span>"+ message +"</span> </div> </div>" );
        $( ".popMessage_container" ).hide().fadeIn('fast')
        setTimeout(function() {
            $('.popMessage_container').fadeOut('fast');
        }, delay);
    }, 200);
    
}



// Partie du plugin Tippy

tippy.setDefaults({
    animation: 'fade',
    arrow: true,
    arrowType: 'round',
})


if ($("#notifications_tmpl")[0]){
    const template = document.getElementById('notifications_tmpl')
    const container = document.createElement('div')
    container.appendChild(document.importNode(template.content, true))

    tippy('.notification', {
        content: container.innerHTML,
        animation: 'fade',
        arrow: true,
        arrowType: 'round',
        interactive: true,

    })
};




// Partie du plugin Select

$(document).ready(function() {
    $('select').niceSelect();
});

$( "select[name='goto_team']" ).change(function() {
    var href = $('select[name="goto_team"]').val();
    location.href= "team/"+ href;
});