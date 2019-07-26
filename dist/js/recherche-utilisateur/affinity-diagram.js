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
                        $('#survey_output').html(data);
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
                        $('#survey_output').html(data);
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
                        $('#survey_output').html(data);
                    }
                });
            }
        }
    });
});