


// NEW
$(document).on("click", "#new-bug", function(e) {
    let ref = this.dataset.pro;

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Déclarer un bug",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn',
                callback: function(){
                    let bug_name = $( 'input[name="bug_name"]' ).val();
                    let bug_desc = $( 'textarea[name="bug_desc"]' ).val();
                    
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/bug/create_bug.php',
                        type: 'POST',
                        data: {bug_name: bug_name, bug_desc: bug_desc, project_token: ref},
                        success:function(data){
                            $('#bug_output').html(data);
                        }
                    });
                   
                }
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn',
            }
        },
        message: '<form method="POST" class="margin-bot-lg"> <div class="container"> <div class="row"> <div class="col-12 input"> <div class="input-field"> <label for="bug_name" class="color-dark">Titre du bug</label> <input type="text" placeholder="Bug x" name="bug_name" id="bug_name"> </div></div><div class="col-12 input"> <div class="input-field"> <label for="bug_desc" class="color-dark">Description du bug</label> <textarea placeholder="Lorem Ipsum" name="bug_desc" id="bug_desc"></textarea> </div></div></div></div></form>',
        
    });
});





// Expandable task
$(document).on('click', '.expand_btn', function() {
    $( this ).next('.expand_content').toggleClass( 'hidden' );
});