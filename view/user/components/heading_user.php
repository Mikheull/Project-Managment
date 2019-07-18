<div>
    <div class="row">
        <div class="col-10 offset-1 mr-bot">
            <div class="image_bloc" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $userToken ) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $userToken.'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $userToken ) ;?>');"></div>
        </div>
        <div class="col-10 offset-1 text-align-center">
            <h2 class="title-md bold color-dark">
                <?= $utils -> getData('imp_user', 'first_name', 'public_token', $userToken ) ?> <?= $utils -> getData('imp_user', 'last_name', 'public_token', $userToken ) ?> 
                <?= $user -> getRoleFormated($utils -> getData('imp_user', 'role', 'public_token', $userToken )); ?>
            </h2>
            <h3 class="title-xs color-gray">@<?= $utils -> getData('imp_user', 'username', 'public_token', $userToken ) ?></h3>

            <p class="bio color-gray mr-top mr-bot text-xs"><?= $utils -> getData('imp_user', 'bio', 'public_token', $userToken ) ?></p>
        </div>
    </div>
</div>