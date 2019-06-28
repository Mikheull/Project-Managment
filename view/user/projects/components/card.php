<?php
    $owner = $project -> getProjectData($t['project_token'], 'founder_token');
?>


<div class="col-md-4 col-12">
    <div class="card-item light-border margin-bot">

        <div class="header relative">
            <div class="head-bg absolute">
                <svg id="Calque_1" data-name="Calque 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 43.78"><path style="fill: #242e5a" d="M0,0H64V35C32,43.78,0,43.78,0,43.78Z"/><path style="fill: #242e5a" d="M64,35"/></svg>
            </div>

            <div class="flex justify-content-between">
                <div class="status margin-top margin-left <?= $utils -> getData('pr_project', 'public', 'public_token', $t['project_token']) == true ? 'bg-primary' : 'bg-red' ;?> color-light text-xs">
                    <?= $utils -> getData('pr_project', 'public', 'public_token', $t['project_token']) == true ? 'publique' : 'privée' ;?>
                </div>

                <?php if($router -> getRouteParam('0') == 'account'){ ?>
                    <div class="options color-light link margin-top margin-right">
                        <i class="fas fa-ellipsis-h" id="act-<?= $t['project_token'] ;?>"></i>
                    </div>
                <?php } ?>
            </div>

            <div class="heading text-align-center margin-top-lg">
                <div class="team_profilImage"><?= substr($utils -> getData('pr_project', 'name', 'public_token', $t['project_token']), 0, 1) ;?></div>
                <div class="name title-sm bold"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $t['project_token'] ?>" class="link light-link"> <?= $utils -> getData('pr_project', 'name', 'public_token', $t['project_token']) ;?> </a> </div>
            </div>
        </div>

        <div class="content margin-bot-lg text-align-center">
            <div class="desc color-lg-dark margin-top-lg"> <?= $utils -> getData('pr_project', 'description', 'public_token', $t['project_token']) ;?> </div>
        </div>

        <div class="footer">
            <div class="owner"> <span class="txt"><i class="fas fa-calendar-check margin-right"></i> <?= $config -> time_elapsed_string($utils -> getData('pr_project', 'date_begin', 'public_token', $t['project_token']) ) ?></span> </div>
            <div class="members margin-right">
                <?php 
                    $project_member = $project -> getProjectMembers($t['project_token']);
                    foreach($project_member['content'] as $member){
                        ?> 
                            <div class="item" data-tippy="<?= $utils -> getData('imp_user', 'username', 'public_token', $member['user_public_token']) ?>"> 
                                <div class="profil_picture-xs">
                                    <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $member['user_public_token']) == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $member['user_public_token'].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $member['user_public_token']) ;?>');"></div>
                                </div>
                            </div> 
                        <?php
                    }
                ?>
            </div>
        </div>

    </div>
</div>











<?php
if($router -> getRouteParam('0') == 'account'){
?>
    <div id="tp-<?= $t['project_token'] ?>" class="hidden">
        <ul class="margin-bot">
            <li class="margin-top margin-bot"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $t['project_token'] ?>" class="btn btn-sm dark-btn">Accéder au panel</a> </li>
            <?php
                if($owner == $main -> getToken()){
                    ?>
                        <li> <a href="" data-action="invite" data-ref="<?= $t['project_token'] ?>" class="link dark-link">Inviter</a> </li>
                        <li> <a href="" data-action="rename" data-ref="<?= $t['project_token'] ?>" class="link dark-link">Renommer</a> </li>
                        <li class="margin-bot"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $t['project_token'] ?>/settings" class="link dark-link">Gérer</a> </li>
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