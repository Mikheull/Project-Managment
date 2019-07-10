<div class="row">
    <div class="col">
        <h3 class="title-sm bold color-dark margin-bot">Vos équipes :</h3>
        <?php
            foreach($allTeams['content'] as $tm){
                ?>
                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/gestion-equipe/team/<?= $tm['public_token'] ;?>/edit"><?= $tm['name'] ;?></a> <br>
                <?php
            }
        ?>
        <br>
        <?php
        if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'project.team.create')){
            ?>
            <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam('2') ?>/t/gestion-equipe/team/create" class="btn btn-sm primary-btn">Nouvelle équipe</a>
            <?php
        }
        ?>
    </div>
</div>
