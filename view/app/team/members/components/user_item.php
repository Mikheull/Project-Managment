<div class="row member_item margin-bot margin-top">
    <div class="col-md-3 col-6 user_info"> 
        <div class="profil_picture-xs">
            <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $u['user_public_token']) == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $u['user_public_token'].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $u['user_public_token']) ;?>');"></div>
        </div>
        <div class="name margin-left"> <?= $utils -> getData('imp_user', 'username', 'public_token', $u['user_public_token']) ?>  </div>
    </div>
    <div class="col-md-5 col-6">
        <?php
            if($utils -> getData('pr_team', 'founder_token', 'public_token', $team_token) == $utils -> getData('imp_user', 'public_token', 'public_token', $u['user_public_token'])){ 
                ?><p class="role role_founder">Créateur</p> <?php
            }else{
                ?><p class="role role_member">Membre</p> <?php
            }
        ?>
    </div>
    <div class="col-md-3 col-10"><?= $config -> time_elapsed_string($team -> getMemberJoinDate($team_token, $u['user_public_token'])) ?></div>
    <div class="col-md-1 col-2 <?= $utils -> getData('pr_team', 'founder_token', 'public_token', $team_token) !== $auth -> getToken() ? 'hidden' : '' ;?>"> 
        <i class="fas fa-ellipsis-h" id="act-<?= $u['user_public_token'] ;?>"></i>
    </div>
</div>







<div id="tp-<?= $u['user_public_token'] ?>" class="hidden">
    <ul class="margin-bot">
        <?php
            if($utils -> getData('pr_team', 'founder_token', 'public_token', $team_token) == $auth -> getToken() ){
                if($u['user_public_token'] !== $auth -> getToken()){
                    ?>
                        <li class="margin-top margin-bot"> <a href="<?= $config -> rootUrl() ;?>member/<?= $utils -> getData('imp_user', 'username', 'public_token', $u['user_public_token']) ?>" class="btn btn-sm dark-btn">Accéder a son profil</a> </li>
                        <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $team_token ;?>/members/<?= $utils -> getData('imp_user', 'public_token', 'public_token', $u['user_public_token']) ?>/activity" class="dark-link">Activité</a> </li>
                        <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $team_token ;?>/members/<?= $utils -> getData('imp_user', 'public_token', 'public_token', $u['user_public_token']) ?>/edit" class="dark-link">Editer</a> </li>
                        <li> <a href="" data-action="kick" data-ref="<?= $team_token ?>" data-mem="<?= $u['user_public_token'] ?>" class="link red-link">Retirer</a> </li>
                    <?php
                }else{
                    ?>
                        <li class="margin-top margin-bot"> <a href="<?= $config -> rootUrl() ;?>account" class="btn btn-sm dark-btn">Accéder a mon profil</a> </li>
                        <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $team_token ;?>/members/<?= $utils -> getData('imp_user', 'public_token', 'public_token', $u['user_public_token']) ?>/activity" class="dark-link">Activité</a> </li>
                    <?php
                }
            }
        ?>
    </ul>
</div>

<script>

    var template = document.getElementById('tp-<?= $u['user_public_token'] ?>')
    tippy('#act-<?= $u['user_public_token'] ?>', {
        content: template.innerHTML,
        animation: 'fade',
        theme: 'light-border',
        interactive: true,
        placement: 'bottom',
        arrowType: 'round',
        arrow: true,
    })

</script>