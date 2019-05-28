feather.replace()



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
        onShow(instance) {
            $.ajax({
				url: 'controller/ajax/read_notif.php',
				type: 'POST',
				data: {},
				success:function(data){
					// instance.setContent('ok')
                    console.log('show');
				}
			});
        },

    })
};


// Partie du plugin Select

$(document).ready(function() {
    if ($("select")[0]){
        $('select').niceSelect();
    }
});

$( "select[name='goto_team']" ).change(function() {
    var href = $('select[name="goto_team"]').val();
    location.href= "team/"+href;
});




// Partie du plugin fakeLoader
if ($(".fakeLoader")[0]){
    $(document).ready(function () {
        $.fakeLoader({
            timeToHide: 600,
            bgColor: '#4C6CF6',
            spinner:"spinner2"
        });
    });
}