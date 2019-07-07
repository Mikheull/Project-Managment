<?php
    require_once ('controller/project.php') ;
    require_once ('controller/bug.php') ;
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

        <div class="row margin-bot">
            <div class="btn btn-sm primary-btn" id="new-bug" data-pro="<?= $router -> getRouteParam('2') ?>"><i class="fas fa-plus"></i> Nouveau bug</div>
        </div>

        <div class="row tabs">

            <div class="tab-item light-border">
                <div class="container">
                    <div class="row margin-top margin-bot">
                        <div class="col-12 flex justify-content-between">
                            <h3 class="title-xs">Non défini</h3>
                            <div style="background: #9c36b5; height: 8px;width: 8px;border-radius: 160px;margin-top: 10px"></div>
                        </div>
                    </div>
                    <div class="row task_container">
                        <?php
                            $bugsList = $bug -> getBugsPerLevel($router -> getRouteParam('2'), '1');
                            foreach($bugsList['content'] as $bug_item){
                                $date_creation = new DateTime( $bug_item['date_creation'] );
                                ?>
                                    <div class="col-12 ">
                                        <div class="container light-border margin-bot-lg">
                                            <div class="row margin-top margin-bot">
                                                <div class="col-10"> 
                                                    <h4 class="text-sm">[<span style="color: #9c36b5"><?= $bug_item['bug_token'] ?></span>] - <?= $bug_item['name'] ?></h4> 
                                                </div>

                                                <div class="col-2 text-align-right expand_btn link"><i class="fas fa-chevron-down"></i></div>
                                                <div class="col-12 margin-top expand_content hidden">
                                                    <div class="color-lg-dark margin-bot"> <?= $bug_item['description'] ?> </div>
                                                    <div class="spacebar spacebar-xl"></div>
                                                    
                                                    <div class="row margin-top margin-bot">
                                                        <div class="col-12">Crée le : <span class="color-lg-dark"><?= date_format($date_creation, 'd/m/Y à H:i') ;?></span> </div>
                                                     </div>
                                                                        
                                                    <div class="spacebar spacebar-xl"></div>
                                                    <div class="margin-top text-align-right link" style="color: #d9480f" id="move-to-working" data-bug="<?= $bug_item['bug_token'] ?>">En cours <i class="fas fa-arrow-right"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="tab-item light-border">
                <div class="container">
                    <div class="row margin-top margin-bot">
                        <div class="col-12 flex justify-content-between">
                            <h3 class="title-xs">En cours</h3>
                            <div style="background: #d9480f; height: 8px;width: 8px;border-radius: 160px;margin-top: 10px"></div>
                        </div>
                    </div>
                    <div class="row task_container">
                        <?php
                            $bugsList = $bug -> getBugsPerLevel($router -> getRouteParam('2'), '2');
                            foreach($bugsList['content'] as $bug_item){
                                $date_creation = new DateTime( $bug_item['date_creation'] );
                                $date_working = new DateTime( $bug_item['date_working'] );

                                ?>
                                    <div class="col-12 ">
                                        <div class="container light-border margin-bot-lg">
                                            <div class="row margin-top margin-bot">
                                                <div class="col-10"> 
                                                    <h4 class="text-sm">[<span style="color: #d9480f"><?= $bug_item['bug_token'] ?></span>] - <?= $bug_item['name'] ?></h4> 
                                                </div>

                                                <div class="col-2 text-align-right expand_btn link"><i class="fas fa-chevron-down"></i></div>
                                                <div class="col-12 margin-top expand_content hidden">
                                                    <div class="color-lg-dark margin-bot"> <?= $bug_item['description'] ?> </div>
                                                    <div class="spacebar spacebar-xl"></div>
                                                    
                                                    <div class="row margin-top margin-bot">
                                                        <div class="col-12">Crée le : <span class="color-lg-dark"><?= date_format($date_creation, 'd/m/Y à H:i') ;?></span> </div>
                                                        <div class="col-12 margin-top">"En cours" le : <span class="color-lg-dark"><?= date_format($date_working, 'd/m/Y à H:i') ;?></span> </div>
                                                     </div>
                                                                        
                                                    <div class="spacebar spacebar-xl"></div>
                                                    <div class="margin-top text-align-right link" style="color: #2b8a3e" id="move-to-end" data-bug="<?= $bug_item['bug_token'] ?>">Terminé <i class="fas fa-arrow-right"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="tab-item light-border">
                <div class="container">
                    <div class="row margin-top margin-bot">
                        <div class="col-12 flex justify-content-between">
                            <h3 class="title-xs">Terminé</h3>
                            <div style="background: #2b8a3e; height: 8px;width: 8px;border-radius: 160px;margin-top: 10px"></div>
                        </div>
                    </div>
                    <div class="row task_container">
                        <?php
                            $bugsList = $bug -> getBugsPerLevel($router -> getRouteParam('2'), '3');
                            foreach($bugsList['content'] as $bug_item){
                                $date_creation = new DateTime( $bug_item['date_creation'] );
                                $date_working = new DateTime( $bug_item['date_working'] );
                                $date_end = new DateTime( $bug_item['date_end'] );
                                ?>
                                    <div class="col-12 ">
                                        <div class="container light-border margin-bot-lg">
                                            <div class="row margin-top margin-bot">
                                                <div class="col-10"> 
                                                    <h4 class="text-sm">[<span style="color: #2b8a3e"><?= $bug_item['bug_token'] ?></span>] - <?= $bug_item['name'] ?></h4> 
                                                </div>

                                                <div class="col-2 text-align-right expand_btn link"><i class="fas fa-chevron-down"></i></div>
                                                    <div class="col-12 margin-top expand_content hidden">
                                                    <div class="color-lg-dark margin-bot"> <?= $bug_item['description'] ?> </div>
                                                    <div class="spacebar spacebar-xl"></div>
                                                    
                                                    <div class="row margin-top margin-bot">
                                                        <div class="col-12">Crée le : <span class="color-lg-dark"><?= date_format($date_creation, 'd/m/Y à H:i') ;?></span> </div>
                                                        <div class="col-12 margin-top">"En cours" le : <span class="color-lg-dark"><?= date_format($date_working, 'd/m/Y à H:i') ;?></span> </div>
                                                        <div class="col-12 margin-top">Terminé le : <span class="color-lg-dark"><?= date_format($date_end, 'd/m/Y à H:i') ;?></span> </div>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</div>


<div id="bug_output"></div>