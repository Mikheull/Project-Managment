<?php
    require_once ('controller/project.php') ;
    require_once ('controller/task.php') ;

    $tabs = $task -> getTabs( $router -> getRouteParam('2') );
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/gestion-projet/components/navbar.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet" class="dark-link"> Tableaux </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet/activity" class="dark-link"> Activité </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet/rapports" class="dark-link"> Rapports </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet/statistics" class="dark-link"> Statistiques </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet/diagrammes" class="dark-link"> Diagramme </a> </li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="row tabs scrolling-wrapper">
            <?php
                foreach($tabs['content'] as $t){
                    ?>
                        <div class="tab-item light-border">
                            <div class="container">
                                <div class="row margin-top margin-bot">
                                    <div class="col-10"><h3 class="title-sm"><?= $t['name'] ?></h3></div>
                                    <div class="col-2 text-align-right"><i class="fas fa-ellipsis-h"></i></div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            ?>
            <div class="tab-item">
                <div class="btn primary-btn full-width text-align-center" id="new-tab">Nouvelle colonne</div>
            </div>
        </div>
    </div>
</div>


<div id="tab_output"></div>
<script>
$(document).on("click", "#new-tab", function(e) {
    let ref = <?= $router -> getRouteParam('2') ?>;

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
</script>