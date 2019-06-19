<div class="col-10 offset-1 margin-bot-lg light-border">
    <div class="row">
        <div class="col-md-6 col-12" style="padding-left: 0">
            <div class="image_bloc" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $userToken ) == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $userToken.'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $userToken ) ;?>');"></div>
        </div>
        <div class="col-md-6 col-12 align-self-center text-align-center">
            <p class="bio color-gray"><?= $utils -> getData('imp_user', 'bio', 'public_token', $userToken ) ?></p>
            
            <h2 class="title-md bold color-dark margin-top">
                <?= $utils -> getData('imp_user', 'first_name', 'public_token', $userToken ) ?> <?= $utils -> getData('imp_user', 'last_name', 'public_token', $userToken ) ?> 
                <?= $user -> getRoleFormated($utils -> getData('imp_user', 'role', 'public_token', $userToken )); ?>
            </h2>
            <h3 class="title-xs color-gray">@<?= $utils -> getData('imp_user', 'username', 'public_token', $userToken ) ?></h3>
        </div>
    </div>
</div>


<div class="col-12 margin-bot-lg margin-top">
    <div class="row">
        <div class="col menu_bar text-align-center">
            <ul>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account" title="Accueil">Accueil</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account/teams" title="Équipes">Équipes</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account/projects" title="Projets">Projets</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account/followers" title="Abonnés">Abonnés</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account/following" title="Abonnements">Abonnements</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account/settings" title="Réglages">Réglages</a> </li>
            </ul>
        </div>
    </div>
</div>
