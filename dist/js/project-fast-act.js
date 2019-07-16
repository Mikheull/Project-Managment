
// Invitation
$(document).on("click", "[data-action='invite']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;

    bootbox.prompt({
        backdrop: true,
        closeButton: false,
        title: "Entrez l'email de l'utilisateur",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn'
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn'
            }
        },
        inputType: 'email',
        callback: function (result) {
            if(result !== ''){
                $.ajax({
                    url:  rootUrl + 'controller/ajax/project_short-actions.php',
                    type: 'POST',
                    data: {result: result, project_token: ref, action: 'invite'},
                    success:function(data){
                        $('#project_output').html(data);
                    }
                });
            }else{
                notify.new({content : 'Mail invalide', theme: 'error'});
            }
        }
    });
});


// Suppression
$(document).on("click", "[data-action='delete']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de supprimer le projet définitivement.",
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
                    url:  rootUrl + 'controller/ajax/project_short-actions.php',
                    type: 'POST',
                    data: {project_token: ref, action: 'delete'},
                    success:function(data){
                        $('#project_output').html(data);
                    }
                });
            }
        }
    });
});


// Archive
$(document).on("click", "[data-action='archive']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point d'archiver le projet temporairement.",
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
                    url:  rootUrl + 'controller/ajax/project_short-actions.php',
                    type: 'POST',
                    data: {project_token: ref, action: 'archive'},
                    success:function(data){
                        $('#project_output').html(data);
                    }
                });
            }
        }
    });
});


// Unarchive
$(document).on("click", "[data-action='unarchive']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de désarchiver le projet.",
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
                    url:  rootUrl + 'controller/ajax/project_short-actions.php',
                    type: 'POST',
                    data: {project_token: ref, action: 'unarchive'},
                    success:function(data){
                        $('#project_output').html(data);
                    }
                });
            }
        }
    });
});


// Quitter
$(document).on("click", "[data-action='leave']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de quitter le projet.",
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
                    url:  rootUrl + 'controller/ajax/project_short-actions.php',
                    type: 'POST',
                    data: {project_token: ref, action: 'leave'},
                    success:function(data){
                        $('#project_output').html(data);
                    }
                });
            }
        }
    });
});



// Renommer
$(document).on("click", "[data-action='rename']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;

    bootbox.prompt({
        backdrop: true,
        closeButton: false,
        title: "Entrez le nouveau nom",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn'
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn'
            }
        },
        inputType: 'text',
        callback: function (result) {
            if(result !== ''){
                $.ajax({
                    url:  rootUrl + 'controller/ajax/project_short-actions.php',
                    type: 'POST',
                    data: {result: result, project_token: ref, action: 'rename'},
                    success:function(data){
                        $('#project_output').html(data);
                    }
                });
            }else{
                notify.new({content : 'Vide', theme: 'error'});
            }
        }
    });
});





// ------------------------------------------------------------------------------------------------------------


// Nouvel event calendrier
$(document).on("click", "[data-action='new_header_cal_event']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Créer un évènement",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn',
                callback: function(){
                    let event_name = $( 'input[name="event_name"]' ).val();
                    let event_date = $( 'input[name="date"]' ).val();
                    
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/calendar/event_short-actions.php',
                        type: 'POST',
                        data: {event_name: event_name, event_date: event_date, event_token: ref, action: 'new_byHeader'},
                        success:function(data){
                            $('#project_output').html(data);
                        }
                    });
                   
                }
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn',
            }
        },
        message: '<form method="POST" class="margin-bot-lg"> <div class="container"> <div class="row"> <div class="col-12 input"> <div class="input-field"> <label for="event_name" class="color-dark">Titre de l\'évènement</label> <input type="text" placeholder="Event x" name="event_name" id="event_name"> </div></div><div class="col-12 input"> <div class="input-field"> <label for="date" class="color-dark">Date de l\'évènement</label> <input type="date" name="date" id="date"> </div></div></div></div></form>',
        
    });
});


// Nouveau rapport de bug
$(document).on("click", "[data-action='new_header_bug']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;

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