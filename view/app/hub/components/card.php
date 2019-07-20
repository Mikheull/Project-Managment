<?php
    $owner = $project -> getProjectData($all['project_token'], 'founder_token');
?>


<div class="col-md-3 col-12">
    <div class="card-item light-border mr-bot">

        <div class="header relative">
            <div class="flex justify-content-between">
                <div class="status mr-top mr-left <?= $utils -> getData('pr_project', 'public', 'public_token', $all['project_token']) == true ? 'bg-primary' : 'bg-red' ;?> color-light text-xs">
                    <?= $utils -> getData('pr_project', 'public', 'public_token', $all['project_token']) == true ? 'publique' : 'privée' ;?>
                </div>

                <div class="options color-dark link mr-top mr-right">
                    <i class="fas fa-ellipsis-h" id="act-<?= $all['project_token'] ;?>"></i>
                </div>
            </div>

            <div class="heading text-align-center mr-top-lg">
                <div class="team_profilImage"><?= substr($utils -> getData('pr_project', 'name', 'public_token', $all['project_token']), 0, 1) ;?></div>
                <div class="name title-sm bold"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $all['project_token'] ?>" class="link dark-link"> <?= $utils -> getData('pr_project', 'name', 'public_token', $all['project_token']) ;?> </a> </div>
            </div>
        </div>

        <div class="content mr-bot-lg text-align-center">
            <div class="desc color-lg-dark mr-top-lg"> <?= $utils -> getData('pr_project', 'description', 'public_token', $all['project_token']) ;?> </div>
        </div>

    </div>
</div>











<div id="tp-<?= $all['project_token'] ?>" class="hidden">
    <ul class="mr-bot">
        <li class="mr-top mr-bot"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $all['project_token'] ?>" class="btn btn-sm dark-btn">Accéder au panel</a> </li>
        <?php
            if($permission -> hasPermission($main -> getToken(), $all['project_token'], 'project.team.member.manage')){?> <li> <a href="" data-action="invite" data-ref="<?= $all['project_token'] ?>" class="link dark-link">Inviter</a> </li> <?php }
            if($permission -> hasPermission($main -> getToken(), $all['project_token'], 'project.manage')){?> <li> <a href="" data-action="rename" data-ref="<?= $all['project_token'] ?>" class="link dark-link">Renommer</a> </li> <?php }
            if($permission -> hasPermission($main -> getToken(), $all['project_token'], 'project.manage')){?> <li class="mr-bot"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $all['project_token'] ?>/settings" class="link dark-link">Gérer</a> </li> <?php }
            if($permission -> hasPermission($main -> getToken(), $all['project_token'], 'project.manage')){?> <li> <a href="" data-action="archive" data-ref="<?= $all['project_token'] ?>" class="link dark-link">Archiver</a> </li> <?php }
            if($owner == $main -> getToken()){ ?> <li> <a href="" data-action="delete" data-ref="<?= $all['project_token'] ?>" class="link red-link">Supprimer</a> </li> <?php }
            if($owner !== $main -> getToken()){ ?> <li> <a href="" data-action="leave" data-ref="<?= $all['project_token'] ?>" class="link red-link">Quitter</a> </li> <?php }
        ?>
    </ul>
</div>

<script>

    var template = document.getElementById('tp-<?= $all['project_token'] ?>')
    tippy('#act-<?= $all['project_token'] ?>', {
        content: template.innerHTML,
        animation: 'fade',
        theme: 'light-border',
        interactive: true,
        placement: 'bottom',
        arrowType: 'round',
        arrow: true,
    })

</script>
