<section class="wrapper_content">
    
    <div class="data_content">
        <?php
        if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'project.team.create')){
            ?>
            <div class="mr-bot mr-top">
                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/gestion-equipe/team/create" class="btn btn-sm primary-btn">Nouvelle équipe</a>
            </div>
            <?php
        }
        ?>

        <div class="container-fluid">
            <ul class="row pt-3 flex-column">

                <?php
                    $allTeams = $projectTeam -> getTeams($router -> getRouteParam('2'));
                    foreach($allTeams['content'] as $tm){
                        ?> 
                            <li class="col-md-5 col-12 pl-0">
                                <div class="pt-3 pb-3 container light-border mr-bot">
                                    <div class="row">
                                        <div class="col-10"> <span class="text-sm"><?= $tm['name'] ?></span> </div>
                                        <div class="col-2 text-align-right"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/gestion-equipe/team/<?= $tm['public_token'] ;?>/edit"> <i class="fas fa-ellipsis-h"> </i> </a> </div>
                                    </div>
                                </div>
                            </li> 
                        <?php
                    }
                ?>
            </ul>

        </div>
    </div>
</section>