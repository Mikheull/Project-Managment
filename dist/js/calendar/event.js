
// Edit
$(document).on("click", "[data-action='edit_event']", function(e) {
    let ref = this.dataset.ref;

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
                        data: {event_name: event_name, event_desc: event_desc, event_token: ref, action: 'edit'},
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
        message: '<form method="POST" class="margin-bot-lg"> <div class="container"> <div class="row"> <div class="col-12 input"> <div class="input-field"> <label for="event_name" class="color-dark">Titre de l\'évènement</label> <input type="text" placeholder="Event x" name="event_name" id="event_name"> </div></div><div class="col-12 input"> <div class="input-field"> <label for="event_desc" class="color-dark">Description</label> <textarea placeholder="Lorem Ipsum" name="event_desc" id="event_desc"></textarea> </div></div></div></div></form>',
        
    });
});



// Suppression
$(document).on("click", "[data-action='delete_event']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;

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
                    data: {event_token: ref, action: 'delete'},
                    success:function(data){
                        $('#calendar_details_output').html(data);
                    }
                });
            }
        }
    });
});