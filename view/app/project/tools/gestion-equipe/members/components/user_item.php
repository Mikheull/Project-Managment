<tr>
    <td class="flex">


        <div class="avatar avatar--md">
            <figure class="avatar__figure" role="img" aria-label="Emily Ewing">
                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                <img class="avatar__img" src="<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $u['user_public_token']) == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $u['user_public_token'].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $u['user_public_token']) ;?>">
            </figure>
            <span role="status" class="avatar__status avatar__status--busy" aria-label="Active"></span>
        </div>
        <div class="name margin-left"> <?= $utils -> getData('imp_user', 'username', 'public_token', $u['user_public_token']) ?>  </div>
    </td>
    <td>
        <?php
            if($utils -> getData('pr_project', 'founder_token', 'public_token', $router -> getRouteParam('2')) == $utils -> getData('imp_user', 'public_token', 'public_token', $u['user_public_token'])){ 
                ?><p class="role role_founder">Créateur</p> <?php
            }else{
                ?><p class="role role_member">Membre</p> <?php
            }
        ?>
    </td>
    <td> SOON </td>
    <td> SOON </td>

    <td class="<?= $utils -> getData('pr_project', 'founder_token', 'public_token', $router -> getRouteParam('2')) !== $auth -> getToken() ? 'hidden' : '' ;?>">
        <i class="fas fa-ellipsis-h" id="act-<?= $u['user_public_token'] ;?>"></i>
    </td>
</tr>



<div id="tp-<?= $u['user_public_token'] ?>" class="hidden">
    <ul class="margin-bot">
        <?php
            if($utils -> getData('pr_project', 'founder_token', 'public_token', $router -> getRouteParam('2')) == $auth -> getToken() ){
                if($u['user_public_token'] !== $auth -> getToken()){
                    ?>
                        <li class="margin-top margin-bot"> <a href="<?= $config -> rootUrl() ;?>member/<?= $utils -> getData('imp_user', 'username', 'public_token', $u['user_public_token']) ?>" class="btn btn-sm dark-btn">Accéder a son profil</a> </li>
                        <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam('2') ;?>/members/<?= $utils -> getData('imp_user', 'public_token', 'public_token', $u['user_public_token']) ?>/activity" class="dark-link">Activité</a> </li>
                        <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam('2') ;?>/members/<?= $utils -> getData('imp_user', 'public_token', 'public_token', $u['user_public_token']) ?>/edit" class="dark-link">Editer</a> </li>
                        <li> <a href="" data-action="kick" data-ref="<?= $router -> getRouteParam('2') ?>" data-mem="<?= $u['user_public_token'] ?>" class="link red-link">Retirer</a> </li>
                    <?php
                }else{
                    ?>
                        <li class="margin-top margin-bot"> <a href="<?= $config -> rootUrl() ;?>account" class="btn btn-sm dark-btn">Accéder a mon profil</a> </li>
                        <li> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam('2') ;?>/members/<?= $utils -> getData('imp_user', 'public_token', 'public_token', $u['user_public_token']) ?>/activity" class="dark-link">Activité</a> </li>
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