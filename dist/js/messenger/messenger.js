


// ------------------------------------------------------------------------------------------------------------


// Nouveu channel
$(document).on("click", "[data-action='new_channel']", function(e) {
    event.preventDefault();
    let project = this.dataset.pro;

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Créer un channel",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn',
                callback: function(){
                    let channel_name = $( 'input[name="channel_name"]' ).val();
                    let channel_topic = $( 'input[name="channel_topic"]' ).val();
                    
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/messenger/messenger-actions.php',
                        type: 'POST',
                        data: {channel_name: channel_name, channel_topic: channel_topic, project_token: project, action: 'new_channel'},
                        success:function(data){
                            $('#channel-list_output').html(data);
                        }
                    });
                   
                }
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn',
            }
        },
        message: '<form method="POST" class="mr-bot-lg"> <div class="container"> <div class="row"> <div class="col-12 input"> <div class="input-field"> <label for="channel_name" class="color-dark">Nom du channel</label> <input type="text" placeholder="Debug" name="channel_name" id="channel_name"> </div></div><div class="col-12 input"> <div class="input-field"> <label for="channel_topic" class="color-dark">Topic du channel</label> <input type="text" placeholder="Lorem Ipsum" name="channel_topic" id="channel_topic"> </div></div></div></div></form>',
        
    });
});


// Delete message
$(document).on("click", "[data-action='delete_message']", function(e) {
    event.preventDefault();
    let message = this.dataset.message;

    $.ajax({
        url:  rootUrl + 'controller/ajax/project/messenger/messenger-actions.php',
        type: 'POST',
        data: {message_token: message, action: 'delete_message'},
        success:function(data){
            $('#channel-list_output').html(data);
        }
    });
});

// Edit message
$(document).on("click", "[data-action='edit_message']", function(e) {
    event.preventDefault();
    let message = this.dataset.message;

    $( 'button[name="message_send"]' ).attr('name', 'message_edit')
    $( 'input[name="edit_id"]' ).val(message)
    $.ajax({
        url:  rootUrl + 'controller/ajax/project/messenger/messenger-actions.php',
        type: 'POST',
        data: {message_token: message, action: 'edit_message-part1'},
        success:function(data){
            $("#emojionearea5")[0].emojioneArea.setFocus();
            $("#emojionearea5")[0].emojioneArea.setText(data);
        }
    });

   
});