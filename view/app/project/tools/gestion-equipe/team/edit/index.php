<?php
    require_once ('controller/project.php') ;
    require_once ('controller/projectTeam.php') ;
    require_once ('controller/permission.php') ;
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-12 navbar-app">
                    <div class="navbar-nav">
                        <ul class="text-align-left">
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe" class="link dark-link active"> Équipes </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe/members" class="link dark-link"> Membres </a> </li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'project.team.edit')){
                ?>
                <div class="row">
                    <div class="col-12"><h3 class="title-sm color-dark mr-bot-lg mr-top">Editer une équipe</h3></div>

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
                                <h4 class="title-xs color-dark mr-bot mr-top">Permissions <span class="text-xs mr-left check-all"><i data-feather="check-square"></i>Tout cocher</span></h4>
                                
                                <div class="row">
                                    <?php
                                    $typeArray = ['gestion-projet', 'gestion-equipe', 'messenger', 'calendar', 'uml', 'recherche-utilisateur', 'bug-tracker', 'documents', 'project'];
                                    $typeNameArray = ['Gestion de projet', 'Gestion d\'équipe', 'Messenger', 'Calendrier', 'Diagramme UML', 'Recherche utilisateur', 'Bug tracker', 'Documents', 'Réglages du projet'];
                                    $nb = 0;
                                    foreach($typeArray as $type){
                                        ?>
                                        <div class="mr-bot col-md-4 col-12">
                                            <h3 class="text-sm color-dark mr-bot mr-top"><?= $typeNameArray[$nb] ;?> <span class="text-xs mr-left check-group"><i data-feather="check-square"></i>Tout cocher</span></h3>
                                        <?php
                                            foreach($permission -> getPermissionsPerType($type) as $perm){
                                                ?>
                                                    <div class="tg-list-item flex mr-bot">
                                                        <div class="mr-right">
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

                            <div class="mr-bot">
                                <button class="btn primary-btn" name="edit_team">Sauvegarder</button>
                                <button class="btn red-btn mr-left-lg" name="delete_team">Supprimer</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }else{
                ?>
                <div class="no-access">Vous n'avez pas la permission nécessaire pour accéder a ce contenu</div>
                <?php
            }
            ?>
            
        </div>
    </div>
</div>

<?php require_once ('view/app/project/components/footer.php') ?>
