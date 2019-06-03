
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
                    url:  '../controller/ajax/team_short-actions.php',
                    type: 'POST',
                    data: {result: result, team_token: ref, action: 'invite'},
                    success:function(data){
                        $('#team_output').html(data);
                    }
                });
            }else{
                popMessage('Mail invalide', 'dark', 1000)
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
        message: "Vous êtes sur le point de supprimer l'équipe définitivement.",
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
                    url:  '../controller/ajax/team_short-actions.php',
                    type: 'POST',
                    data: {team_token: ref, action: 'delete'},
                    success:function(data){
                        $('#team_output').html(data);
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
        message: "Vous êtes sur le point d'archiver l'équipe temporairement.",
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
                    url:  '../controller/ajax/team_short-actions.php',
                    type: 'POST',
                    data: {team_token: ref, action: 'archive'},
                    success:function(data){
                        $('#team_output').html(data);
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
        message: "Vous êtes sur le point de désarchiver l'équipe.",
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
                    url:  '../controller/ajax/team_short-actions.php',
                    type: 'POST',
                    data: {team_token: ref, action: 'unarchive'},
                    success:function(data){
                        $('#team_output').html(data);
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
        message: "Vous êtes sur le point de quitter l'équipe.",
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
                    url:  '../controller/ajax/team_short-actions.php',
                    type: 'POST',
                    data: {team_token: ref, action: 'leave'},
                    success:function(data){
                        $('#team_output').html(data);
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
                    url:  '../controller/ajax/team_short-actions.php',
                    type: 'POST',
                    data: {result: result, team_token: ref, action: 'rename'},
                    success:function(data){
                        $('#team_output').html(data);
                    }
                });
            }else{
                popMessage('Vide', 'dark', 1000)
            }
        }
    });
});