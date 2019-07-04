<?php
    require_once ('controller/project.php') ;
    require_once ('controller/projectTeam.php') ;
    require_once ('controller/permission.php') ;

    $allUsers = $project -> getProjectUser( $router -> getRouteParam('2') );
    $allTeams = $projectTeam -> getTeams( $router -> getRouteParam('2') );
    
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/gestion-equipe/components/navbar.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe" class="link dark-link"> Équipes </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe/members" class="link dark-link active"> Membres </a> </li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-12"><h3 class="title-sm color-dark margin-bot-lg margin-top">Editer un utilisateur</h3></div>

            <div class="col-12">
                <form action="" method="post">
                    <div class="input_group">
                        <h4 class="title-xs color-dark margin-bot margin-top">Équipes</h4>
                        <div class="row">
                            <?php
                                foreach($allTeams['content'] as $tm){
                                    ?>
                                        <div class="col-12 tg-list-item flex margin-bot">
                                            <div class="margin-right">
                                                <input class="tgl tgl-light" name="permissions[]" value="<?= $tm['public_token'] ;?>" id="<?= $tm['public_token'] ;?>" type="checkbox"/>
                                                <label class="tgl-btn" for="<?= $tm['public_token'] ;?>"></label>
                                            </div>
                                            <div>
                                                <small><?= $tm['name'] ;?></small>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
  
                    </div>

                    <div class="margin-bot">
                        <button class="btn primary-btn" name="add_team_user">Sauvegarder les équipes</button>
                    </div>
                </form>
            </div>

            <div class="col-12">
                <form action="" method="post">
                    <div class="input_group">
                        <h4 class="title-xs color-dark margin-bot margin-top">Permissions</h4>
                        <div class="row">
                            <?php
                            $typeArray = ['gestion-projet', 'gestion-equipe', 'messenger', 'calendar', 'uml', 'recherche-utilisateur', 'bug-tracker', 'documents', 'project-settings'];
                            $typeNameArray = ['Gestion de projet', 'Gestion d\'équipe', 'Messenger', 'Calendrier', 'Diagramme UML', 'Recherche utilisateur', 'Bug tracker', 'Documents', 'Réglages du projet'];
                            $nb = 0;
                            foreach($typeArray as $type){
                                ?>
                                <div class="margin-bot col-md-4 col-12">
                                    <h3 class="text-sm color-dark margin-bot margin-top"><?= $typeNameArray[$nb] ;?></h3>
                                <?php
                                    foreach($permission -> getPermissionsPerType($type) as $perm){
                                        ?>
                                            <div class="tg-list-item flex margin-bot">
                                                <div class="margin-right">
                                                    <input class="tgl tgl-light" name="permissions[]" value="<?= $perm['permission'] ;?>" id="<?= $perm['permission'] ;?>" type="checkbox" <?= $permission -> projectTeamHasPermission($router -> getRouteParam("6"), $perm['permission']) == true ? 'checked' : '' ?>/>
                                                    <label class="tgl-btn" for="<?= $perm['permission'] ;?>"></label>
                                                </div>
                                                <div>
                                                    <small><?= $perm['description'] ;?></small>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                ?>
                                </div>
                                <?php
                                $nb ++;
                            }
                            
                            ?>
                        </div>
  
                    </div>

                    <div class="margin-bot">
                        <button class="btn primary-btn" name="add_perm_user">Sauvegarder les permissions</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
