<?php
    require_once ('controller/project.php') ;
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/bug-tracker/components/navbar.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker" class="link dark-link active"> Bugs </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker/reports" class="link dark-link"> Rapports </a> </li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="row tabs">
            a
        </div>
    </div>
</div>


<div id="bug_output"></div>