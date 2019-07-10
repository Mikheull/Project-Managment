


// NEW
$(document).on("click", ".new-task", function(e) {
    let ref = this.dataset.pro;
    let tab = this.dataset.tab;

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Créer une tâche",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn',
                callback: function(){
                    let task_name = $( 'input[name="task_name"]' ).val();
                    let deadline = $( 'input[name="deadline"]' ).val();
                    let duration = $( 'input[name="duration"]' ).val();
                    
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/task/create_task.php',
                        type: 'POST',
                        data: {task_name: task_name, deadline: deadline, duration: duration, project_token: ref, tab_token: tab},
                        success:function(data){
                            $('#tab_output').html(data);
                        }
                    });
                   
                }
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn',
            }
        },
        message: '<form method="POST" class="margin-bot-lg"><div class="container"><div class="row"><div class="col-12 input"><div class="input-field"> <label for="task_name" class="color-dark">Titre de la tâche</label> <input type="text" placeholder="Tache x" name="task_name" id="task_name"></div></div><div class="col-12 input margin-bot"><div class="input-field"> <label for="deadline" class="color-dark">Deadline</label> <input type="date" name="deadline" id="deadline"></div></div><div class="col-12 input margin-bot"><div class="input-field"> <label for="duration" class="color-dark">Durée</label> <input type="time" name="duration" id="duration" value="01:00"></div></div></div></div></form>',
        
    });
});

// Edit
$(document).on("click", "[data-action='edit_task']", function(e) {
    let ref = this.dataset.ref;
    let project = this.dataset.pro;

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Editer la tâche",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn',
                callback: function(){
                    let task_name = $( 'input[name="task_name"]' ).val();
                    let deadline = $( 'input[name="deadline"]' ).val();
                    let duration = $( 'input[name="duration"]' ).val();
                    
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/task/task_short-actions.php',
                        type: 'POST',
                        data: {task_name: task_name, deadline: deadline, duration: duration, task_token: ref, project_token: project, action: 'edit'},
                        success:function(data){
                            $('#tab_output').html(data);
                        }
                    });
                   
                }
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn',
            }
        },
        message: '<form method="POST" class="margin-bot-lg"><div class="container"><div class="row"><div class="col-12 input"><div class="input-field"> <label for="task_name" class="color-dark">Titre de la tâche</label> <input type="text" placeholder="Tache x" name="task_name" id="task_name"></div></div><div class="col-12 input margin-bot"><div class="input-field"> <label for="deadline" class="color-dark">Deadline</label> <input type="date" name="deadline" id="deadline"></div></div><div class="col-12 input margin-bot"><div class="input-field"> <label for="duration" class="color-dark">Durée</label> <input type="time" name="duration" id="duration" value="01:00"></div></div></div></div></form>',
        
    });
});



// Suppression
$(document).on("click", "[data-action='delete_task']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;
    let project = this.dataset.pro;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de supprimer la tâche définitivement.",
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
                    url:  rootUrl + 'controller/ajax/project/task/task_short-actions.php',
                    type: 'POST',
                    data: {task_token: ref, project_token: project, action: 'delete'},
                    success:function(data){
                        $('#tab_output').html(data);
                    }
                });
            }
        }
    });
});


// Clore
$(document).on("click", "[data-action='close_task']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;
    let project = this.dataset.pro;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de clôre la tâche.",
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
                    url:  rootUrl + 'controller/ajax/project/task/task_short-actions.php',
                    type: 'POST',
                    data: {task_token: ref, project_token: project, action: 'close'},
                    success:function(data){
                        $('#tab_output').html(data);
                    }
                });
            }
        }
    });
});


// Re-open
$(document).on("click", "[data-action='reopen_task']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;
    let project = this.dataset.pro;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de ré-ouvrir la tâche.",
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
                    url:  rootUrl + 'controller/ajax/project/task/task_short-actions.php',
                    type: 'POST',
                    data: {task_token: ref, project_token: project, action: 'reopen'},
                    success:function(data){
                        $('#tab_output').html(data);
                    }
                });
            }
        }
    });
});



// Expandable task
$(document).on('click', '.expand_btn', function() {
    $( this ).next('.expand_content').toggleClass( 'hidden' );
});
