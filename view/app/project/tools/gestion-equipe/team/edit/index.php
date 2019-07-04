<?php
    require_once ('controller/project.php') ;
    require_once ('controller/projectTeam.php') ;
    require_once ('controller/permission.php') ;
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
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe/team" class="link dark-link active"> Équipes </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe/members" class="link dark-link"> Membres </a> </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12"><h3 class="title-sm color-dark margin-bot-lg margin-top">Editer une équipe</h3></div>

            <div class="col-12">
                <form action="" method="post">
                    <div class="input_group">
                        <div class="input-field input-half">
                            <label for="name">Nom de l'équipe</label>
                            <input type="text" name="name" id="name" placeholder="developer" value="<?= $utils -> getData('pr_project_team', 'name', 'public_token', $router -> getRouteParam("6") ) ?>">
                        </div>

                        <br>

                        <div class="input-field input-half">
                            <label for="color">Couleur</label>
                            <input type="text" name="color" id="color" placeholder="#A1A1A1" value="<?= $utils -> getData('pr_project_team', 'color', 'public_token', $router -> getRouteParam("6") ) ?>">
                        </div>
                    </div>


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
                        <button class="btn primary-btn" name="edit_team">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
