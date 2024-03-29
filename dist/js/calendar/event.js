
// Edit
$(document).on("click", "[data-action='edit_event']", function(e) {
    var ctx = document.getElementById("event-if");
    var ref = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Editer l'évènement",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn',
                callback: function(){
                    let event_name = $( 'input[name="event_name"]' ).val();
                    let event_desc = $( 'textarea[name="event_desc"]' ).val();
                    
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/calendar/event_short-actions.php',
                        type: 'POST',
                        data: {project_token : project, event_name: event_name, event_desc: event_desc, event_token: ref, action: 'edit'},
                        success:function(data){
                            $('#calendar_details_output').html(data);
                        }
                    });
                   
                }
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn',
            }
        },
        message: '<form method="POST" class="mr-bot-lg"> <div class="container"> <div class="row"> <div class="col-12 input"> <div class="input-field"> <label for="event_name" class="color-dark">Titre de l\'évènement</label> <input type="text" placeholder="Event x" name="event_name" id="event_name"> </div></div><div class="col-12 input"> <div class="input-field"> <label for="event_desc" class="color-dark">Description</label> <textarea placeholder="Lorem Ipsum" name="event_desc" id="event_desc"></textarea> </div></div></div></div></form>',
        
    });
});



// Suppression
$(document).on("click", "[data-action='delete_event']", function(e) {
    event.preventDefault();
    var ctx = document.getElementById("event-if");
    var ref = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de supprimer l'évènement définitivement.",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel',
                className: 'btn dark-btn'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Confirm',
                className: 'btn primary-btn'
            }
        },
        callback: function (result) {
            if(result == true){
                $.ajax({
                    url:  rootUrl + 'controller/ajax/project/calendar/event_short-actions.php',
                    type: 'POST',
                    data: {project_token : project, event_token: ref, action: 'delete'},
                    success:function(data){
                        $('#calendar_details_output').html(data);
                    }
                });
            }
        }
    });
});




$(document).ready(function() {
    $(document).on("click", "#close-event-popup", function(e) {
        $( '#popup-event-wrapper' ).empty();
        $( '#popup-event-wrapper' ).toggleClass( 'hidden' );
    });
});
$(document).bind('keydown', function(e) {
    if(e.which == 27) {
        if ( $( "#popup-event-wrapper #event-if" ).length ) {
            e.preventDefault();
            $( '#popup-event-wrapper' ).empty();
            $( '#popup-event-wrapper' ).toggleClass( 'hidden' );
        }
        return false;
    }
});
$('#popup-event-wrapper').mouseup(function(e){
    var container = $(".event_popup");
    if ( $( ".event_popup" ).length ) {
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $( '#popup-event-wrapper' ).empty();
            $( '#popup-event-wrapper' ).toggleClass( 'hidden' );
        }
    }
});


$(document).on('click', '.head_menu li', function() {
    $( '.head_menu li').removeClass( 'active' );
    $( this ).addClass( 'active' );

    let page = this.dataset.page;
    $( '.page_el').removeClass( 'hidden' );
    $( '.page_el').toggleClass( 'hidden' );
    $( '.page_el#'+page).toggleClass( 'hidden' );

});