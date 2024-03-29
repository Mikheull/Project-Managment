

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
        message: '<form method="POST" class="mr-bot-lg"><div class="container"><div class="row"><div class="col-12 input"><div class="input-field"> <label for="task_name" class="color-dark">Titre de la tâche</label> <input type="text" placeholder="Tache x" name="task_name" id="task_name"></div></div><div class="col-12 input mr-bot"><div class="input-field"> <label for="deadline" class="color-dark">Deadline</label> <input type="date" name="deadline" id="deadline"></div></div><div class="col-12 input mr-bot"><div class="input-field"> <label for="duration" class="color-dark">Durée</label> <input type="time" name="duration" id="duration" value="01:00"></div></div></div></div></form>',
        
    });
});

// Edit
$(document).on("click", "[data-action='edit_task']", function(e) {
    var ctx = document.getElementById("task-if");
    var ref = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

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
        message: '<form method="POST" class="mr-bot-lg"><div class="container"><div class="row"><div class="col-12 input"><div class="input-field"> <label for="task_name" class="color-dark">Titre de la tâche</label> <input type="text" placeholder="Tache x" name="task_name" id="task_name"></div></div><div class="col-12 input mr-bot"><div class="input-field"> <label for="deadline" class="color-dark">Deadline</label> <input type="date" name="deadline" id="deadline"></div></div><div class="col-12 input mr-bot"><div class="input-field"> <label for="duration" class="color-dark">Durée</label> <input type="time" name="duration" id="duration" value="01:00"></div></div></div></div></form>',
        
    });
});



// Suppression
$(document).on("click", "[data-action='delete_task']", function(e) {
    event.preventDefault();
    var ctx = document.getElementById("task-if");
    var ref = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

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
    var ctx = document.getElementById("task-if");
    var ref = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

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
    var ctx = document.getElementById("task-if");
    var ref = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

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



// Open popup task
$(document).on('click', '#popup-task-btn', function() {
    let ref = this.dataset.ref;
    let project = this.dataset.pro;
    $( '#popup-task-wrapper' ).toggleClass( 'hidden' );
    
    $.ajax({
        url:  rootUrl + 'controller/ajax/project/task/task_short-actions.php',
        type: 'POST',
        data: {task_token: ref, project_token: project, action: 'popup-task'},
        success:function(data){
            $('#popup-task-wrapper').html(data);
        }
    });

});
$(document).ready(function() {
    $(document).on("click", "#close-task-popup", function(e) {
        $( '#popup-task-wrapper' ).empty();
        $( '#popup-task-wrapper' ).toggleClass( 'hidden' );
    });
});
$(document).bind('keydown', function(e) {
    if(e.which == 27) {
        if ( $( "#popup-task-wrapper #task-if" ).length ) {
            e.preventDefault();
            $( '#popup-task-wrapper' ).empty();
            $( '#popup-task-wrapper' ).toggleClass( 'hidden' );
        }
        return false;
    }
});
$('#popup-task-wrapper').mouseup(function(e){
    var container = $(".task_popup");
    if ( $( ".task_popup" ).length ) {
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $( '#popup-task-wrapper' ).empty();
            $( '#popup-task-wrapper' ).toggleClass( 'hidden' );
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






// Task link viewer
$(document).ready(function() {
    var urlParams = new URLSearchParams(location.search);


    if(urlParams.has('task') == true){
        let taskToken = urlParams.get('task');
        $("[data-ref='"+ taskToken +"']").addClass('selected_item-task')

        setTimeout(function() {

            $("[data-ref='"+ taskToken +"']").removeClass('selected_item-task')

        }, 3000);
    }

});



var timer = new easytimer.Timer();

// Launch Timer
$(document).on("click", "[data-action='launch-timer']", function(e) {

    let ref = this.dataset.ref;
    let project = this.dataset.pro;
    $( '.btn-play' ).hide();
    $( this ).next("[data-action='stop-timer']").toggleClass( 'hidden' );
    $( this ).parent().next(".timer-content").toggleClass( 'hidden' );


    $.ajax({
        url:  rootUrl + 'controller/ajax/project/task/task_short-actions.php',
        type: 'POST',
        data: {task_token: ref, project_token: project, action: 'launch_timer'},
        success:function(data){
            $('#timer_output').html(data);
        }
    });

    timer.stop();
    timer.start();
    timer.addEventListener('secondsUpdated', function (e) {
        $('.timer-content').html(timer.getTimeValues().toString());
    });
});

// Stop Timer
$(document).on("click", "[data-action='stop-timer']", function(e) {

    let ref = this.dataset.ref;
    let project = this.dataset.pro;
    let time = timer.getTimeValues().toString();
    $( '.btn-play' ).show();
    $( this ).toggleClass( 'hidden' );
    $( this ).parent().next(".timer-content").toggleClass( 'hidden' );

    $.ajax({
        url:  rootUrl + 'controller/ajax/project/task/task_short-actions.php',
        type: 'POST',
        data: {task_token: ref, project_token: project, time: time, action: 'stop_timer'},
        success:function(data){
            $('#timer_output').html(data);
        }
    });

    timer.stop();
});