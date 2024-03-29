<?php
    $owner = $project -> getProjectData($t['project_token'], 'founder_token');
?>


<div class="col-md-4 col-12">
    <div class="card-item light-border mr-bot">

        <div class="header relative">
            <div class="head-bg absolute">
                <svg id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 43.78"><path style="fill: #242e5a" d="M0,0H64V35C32,43.78,0,43.78,0,43.78Z"/><path style="fill: #242e5a" d="M64,35"/></svg>
            </div>

            <div class="flex justify-content-between">
                <div class="status mr-top mr-left <?= $utils -> getData('pr_project', 'public', 'public_token', $t['project_token']) == true ? 'bg-primary' : 'bg-red' ;?> color-light text-xs">
                    <?= $utils -> getData('pr_project', 'public', 'public_token', $t['project_token']) == true ? 'publique' : 'privée' ;?>
                </div>

                <?php if($router -> getRouteParam('0') == 'account'){ ?>
                    <div class="options color-light link mr-top mr-right">
                        <i class="fas fa-ellipsis-h" id="act-<?= $t['project_token'] ;?>"></i>
                    </div>
                <?php } ?>
            </div>

            <div class="heading text-align-center mr-top-lg">
                <div class="team_profilImage"><?= substr($utils -> getData('pr_project', 'name', 'public_token', $t['project_token']), 0, 1) ;?></div>
                <div class="name title-sm bold"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $t['project_token'] ?>" class="link light-link"> <?= $utils -> getData('pr_project', 'name', 'public_token', $t['project_token']) ;?> </a> </div>
            </div>
        </div>

        <div class="content mr-bot-lg text-align-center">
            <div class="desc color-lg-dark mr-top-lg"> <?= $utils -> getData('pr_project', 'description', 'public_token', $t['project_token']) ;?> </div>
        </div>

        <div class="footer">
            <div class="owner"> <span class="txt"><i class="fas fa-calendar-check mr-right"></i> <?= $config -> time_elapsed_string($utils -> getData('pr_project', 'date_begin', 'public_token', $t['project_token']) ) ?></span> </div>
            <div class="members mr-right">
                <div class="avatar-group">
                    <?php
                        $project_member = $project -> getProjectMembers($t['project_token']);
                        $count = 1;
                        foreach($project_member['content'] as $member){
                            if($count < 5){
                                ?> 
                                    <div class="avatar avatar--sm" data-tippy="<?= $utils -> getData('imp_user', 'username', 'public_token', $member['user_public_token']) ?>"> 
                                        <figure class="avatar__figure" role="img" aria-label="Emily Ewing">
                                            <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                                            <img class="avatar__img" src="<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $member['user_public_token']) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $member['user_public_token'].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $member['user_public_token']) ;?>">
                                        </figure>
                                    </div>
                                <?php
                                $count ++;
                            }

                        }
                    
                        if($project_member['count'] > 5){
                            ?>
                                <div class="avatar avatar--sm avatar--btn">
                                    <figure aria-hidden="true" class="avatar__figure">
                                        <div class="avatar__users-counter color-lg-dark"><span>+<?= $project_member['count'] - $count + 1?></span></div>
                                    </figure>
                                </div>
                            <?php
                        }
                    ?>
                </div> 
            </div>
        </div>

    </div>
</div>











<?php
if($router -> getRouteParam('0') == 'account'){
?>
    <div id="tp-<?= $t['project_token'] ?>" class="hidden">
        <ul class="mr-bot">
            <li class="mr-top mr-bot"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $t['project_token'] ?>" class="btn btn-sm dark-btn">Accéder au panel</a> </li>
            <?php
                if($owner == $main -> getToken()){
                    ?>
                        <li> <a href="" data-action="invite" data-ref="<?= $t['project_token'] ?>" class="link dark-link">Inviter</a> </li>
                        <li> <a href="" data-action="rename" data-ref="<?= $t['project_token'] ?>" class="link dark-link">Renommer</a> </li>
                        <li class="mr-bot"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $t['project_token'] ?>/settings" class="link dark-link">Gérer</a> </li>
                        <li> <a href="" data-action="archive" data-ref="<?= $t['project_token'] ?>" class="link dark-link">Archiver</a> </li>
                        <li> <a href="" data-action="delete" data-ref="<?= $t['project_token'] ?>" class="link red-link">Supprimer</a> </li>
                    <?php
                }else{
                    ?>
                        <li> <a href="" data-action="leave" data-ref="<?= $t['project_token'] ?>" class="link red-link">Quitter</a> </li>
                    <?php
                }
            ?>
        </ul>
    </div>

    <script>

        var template = document.getElementById('tp-<?= $t['project_token'] ?>')
        tippy('#act-<?= $t['project_token'] ?>', {
            content: template.innerHTML,
            animation: 'fade',
            theme: 'light-border',
            interactive: true,
            placement: 'bottom',
            arrowType: 'round',
            arrow: true,
        })

    </script>
<?php
}
?>