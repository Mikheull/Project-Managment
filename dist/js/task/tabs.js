
// NEW
$(document).on("click", "#new-tab", function(e) {
    let ref = this.dataset.pro;

    bootbox.prompt({
        backdrop: true,
        closeButton: false,
        title: "Nom du tableau",
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
                    url:  rootUrl + 'controller/ajax/project/task/create_tab.php',
                    type: 'POST',
                    data: {result: result, project_token: ref},
                    success:function(data){
                        $('#tab_output').html(data);
                    }
                });
            }else{
                notify.new({
                    content: 'Le nom est vide',
                    theme: 'error',
                    position: 'left-bottom',
                    size: 'sm'
                });
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
        message: "Vous êtes sur le point de supprimer le tableau définitivement.",
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
                    url:  rootUrl + 'controller/ajax/project/task/tabs_short-actions.php',
                    type: 'POST',
                    data: {tab_token: ref, action: 'delete'},
                    success:function(data){
                        $('#tab_output').html(data);
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
            if(result != ''){
                $.ajax({
                    url:  rootUrl + 'controller/ajax/project/task/tabs_short-actions.php',
                    type: 'POST',
                    data: {result: result, tab_token: ref, action: 'rename'},
                    success:function(data){
                        $('#tab_output').html(data);
                    }
                });
            }
        }
    });
});