// Terminer un sondage
$(document).on("click", "[data-action='affinity_diagram-end']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;
    let pro = this.dataset.pro;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de clôre le diagramme d'afinité.",
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
                    url:  rootUrl + 'controller/ajax/project/recherche-utilisateur/affinity-diagram.php',
                    type: 'POST',
                    data: {project_token: pro, diagram_token: ref, action: 'ended'},
                    success:function(data){
                        $('#diagram_output').html(data);
                    }
                });
            }
        }
    });
});


// Réouvrir un sondage
$(document).on("click", "[data-action='affinity_diagram-reopen']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;
    let pro = this.dataset.pro;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de ré-ouvrir le diagramme d'afinité.",
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
                    url:  rootUrl + 'controller/ajax/project/recherche-utilisateur/affinity-diagram.php',
                    type: 'POST',
                    data: {project_token: pro, diagram_token: ref, action: 'reopen'},
                    success:function(data){
                        $('#diagram_output').html(data);
                    }
                });
            }
        }
    });
});

// Suppression
$(document).on("click", "[data-action='affinity_diagram-delete']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;
    let pro = this.dataset.pro;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de supprimer le diagramme d'affinité définitivement.",
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
                    url:  rootUrl + 'controller/ajax/project/recherche-utilisateur/affinity-diagram.php',
                    type: 'POST',
                    data: {project_token: pro, diagram_token: ref, action: 'delete'},
                    success:function(data){
                        $('#diagram_output').html(data);
                    }
                });
            }
        }
    });
});






let defaut_postitName = $( '#new-idea' ).html();

$(document).on("focusout", "#new-idea", function(e) {
    new_postitName = $( '#new-idea' ).html();
    if(new_postitName !== defaut_postitName && new_postitName !== ''){

        let ref = this.dataset.ref;
        let project = this.dataset.pro;
    
        $.ajax({
            url:  rootUrl + 'controller/ajax/project/recherche-utilisateur/affinity-diagram.php',
            type: 'POST',
            data: {result: new_postitName, diagram_token: ref, project_token: project, action: 'new_idea'},
            success:function(data){
                $('#diagram_output').html(data);
                $('#new-idea').html('Ecrivez votre idée ici ...');
            }
        });
    }else{
        $('#new-idea').html('Ecrivez votre idée ici ...');
    }
});

$(document).on("focusin", "#new-idea", function(e) {
    new_postitName = $( '#new-idea' ).html();
    if(new_postitName == defaut_postitName){
        $('#new-idea').html('');
    }
});




// Approuver une idée
$(document).on("click", "[data-action='idea-approve']", function(e) {
    event.preventDefault();
    let idea = this.dataset.idea;
    let ref = this.dataset.ref;
    let pro = this.dataset.pro;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point d'approuver l'idée.",
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
                    url:  rootUrl + 'controller/ajax/project/recherche-utilisateur/affinity-diagram.php',
                    type: 'POST',
                    data: {project_token: pro, diagram_token: ref, idea: idea, action: 'approve_idea'},
                    success:function(data){
                        $('#diagram_output').html(data);
                    }
                });
            }
        }
    });
});



// Supprimers une idée
$(document).on("click", "[data-action='idea-remove']", function(e) {
    event.preventDefault();
    let idea = this.dataset.idea;
    let ref = this.dataset.ref;
    let pro = this.dataset.pro;

    bootbox.confirm({
        backdrop: true,
        closeButton: false,
        title: "Êtes vous sûr ?",
        message: "Vous êtes sur le point de supprimer l'idée.",
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
                    url:  rootUrl + 'controller/ajax/project/recherche-utilisateur/affinity-diagram.php',
                    type: 'POST',
                    data: {project_token: pro, diagram_token: ref, idea: idea, action: 'remove_idea'},
                    success:function(data){
                        $('#diagram_output').html(data);
                    }
                });
            }
        }
    });
});