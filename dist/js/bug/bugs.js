


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
        message: '<form method="POST" class="mr-bot-lg"> <div class="container"> <div class="row"> <div class="col-12 input"> <div class="input-field"> <label for="bug_name" class="color-dark">Titre du bug</label> <input type="text" placeholder="Bug x" name="bug_name" id="bug_name"> </div></div><div class="col-12 input"> <div class="input-field"> <label for="bug_desc" class="color-dark">Description du bug</label> <textarea placeholder="Lorem Ipsum" name="bug_desc" id="bug_desc"></textarea> </div></div></div></div></form>',
        
    });
});






// Open popup bug
$(document).on('click', '#popup-bug-btn', function() {
    let ref = this.dataset.ref;
    let project = this.dataset.pro;
    console.log(ref, project);
    $( '#popup-bug-wrapper' ).toggleClass( 'hidden' );
    
    $.ajax({
        url:  rootUrl + 'controller/ajax/project/bug/bug_short-actions.php',
        type: 'POST',
        data: {bug_token: ref, project_token: project, action: 'popup-bug'},
        success:function(data){
            $('#popup-bug-wrapper').html(data);
        }
    });

});
$(document).ready(function() {
    $(document).on("click", "#close-bug-popup", function(e) {
        $( '#popup-bug-wrapper' ).empty();
        $( '#popup-bug-wrapper' ).toggleClass( 'hidden' );
    });
});
$(document).bind('keydown', function(e) {
    if(e.which == 27) {
        if ( $( "#popup-bug-wrapper #bug-if" ).length ) {
            e.preventDefault();
            $( '#popup-bug-wrapper' ).empty();
            $( '#popup-bug-wrapper' ).toggleClass( 'hidden' );
        }
        return false;
    }
});
$('#popup-bug-wrapper').mouseup(function(e){
    var container = $(".bug_popup");
    if ( $( ".bug_popup" ).length ) {
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $( '#popup-bug-wrapper' ).empty();
            $( '#popup-bug-wrapper' ).toggleClass( 'hidden' );
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






// Bug link viewer
$(document).ready(function() {
    var urlParams = new URLSearchParams(location.search);


    if(urlParams.has('bug') == true){
        let bugToken = urlParams.get('bug');
        $("[data-ref='"+ bugToken +"']").addClass('selected_item-bug')

        setTimeout(function() {

            $("[data-ref='"+ bugToken +"']").removeClass('selected_item-bug')

        }, 3000);
    }

});



// Move to in working
$(document).on("click", "#move-to-working", function(e) {
    event.preventDefault();
    var ctx = document.getElementById("bug-if");
    var token = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de déplacer ce rapport dans (en cours).",
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
                    url:  rootUrl + 'controller/ajax/project/bug/edit_bug.php',
                    type: 'POST',
                    data: {bug_token: token, project_token: project, new_status: 2},
                    success:function(data){
                        $('#bug_output').html(data);
                    }
                });
            }
        }
    });
});


// Move to end
$(document).on("click", "#move-to-end", function(e) {
    event.preventDefault();
    var ctx = document.getElementById("bug-if");
    var token = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de déplacer ce rapport dans (terminé).",
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
                    url:  rootUrl + 'controller/ajax/project/bug/edit_bug.php',
                    type: 'POST',
                    data: {bug_token: token, project_token: project, new_status: 3},
                    success:function(data){
                        $('#bug_output').html(data);
                    }
                });
            }
        }
    });
});




// Edit
$(document).on("click", "[data-action='edit_bug']", function(e) {
    var ctx = document.getElementById("bug-if");
    var ref = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Editer le rapport de bug",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn',
                callback: function(){
                    let bug_name = $( 'input[name="bug_name"]' ).val();
                    
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/bug/bug_short-actions.php',
                        type: 'POST',
                        data: {bug_name: bug_name, bug_token: ref, project_token: project, action: 'edit'},
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
        message: '<form method="POST" class="mr-bot-lg"> <div class="container"> <div class="row"> <div class="col-12 input"> <div class="input-field"> <label for="bug_name" class="color-dark">Titre du bug</label> <input type="text" placeholder="Bug x" name="bug_name" id="bug_name"> </div></div></div></div></form>',
        
    });
});



// Suppression
$(document).on("click", "[data-action='delete_bug']", function(e) {
    event.preventDefault();
    var ctx = document.getElementById("bug-if");
    var ref = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de supprimer le rapport de bug définitivement.",
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
                    url:  rootUrl + 'controller/ajax/project/bug/bug_short-actions.php',
                    type: 'POST',
                    data: {bug_token: ref, project_token: project, action: 'delete'},
                    success:function(data){
                        $('#bug_output').html(data);
                    }
                });
            }
        }
    });
});