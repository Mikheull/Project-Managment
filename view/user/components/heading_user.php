<div class="row">
    <div class="col-md-3 profile_image">
        <img src="<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData( $userToken, 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $userToken.'/profil_pic/'.$user -> getUserData( $userToken, 'profil_image') ;?>" alt="Image de profil" width="100%">    
    </div>

    <div class="col-md-9 align-self-center">
        <div class="heading">
            <h2 class="title-lg bold color-dark">
                <?= $user -> getUserData( $userToken, 'first_name') ?> <?= $user -> getUserData( $userToken, 'last_name') ?> 
                <?= $user -> getRoleFormated($user -> getUserData( $userToken, 'role')); ?>
            </h2>
            <h3 class="title-sm color-gray"><?= $user -> getUserData( $userToken, 'username') ?></h3>
        </div>
        <div class="bio"><?= $user -> getUserData( $userToken, 'bio') ?></div>
    </div>
</div>

<div class="row">
    <div class="col menu_bar">
        <ul class="nav-left">
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account" title="Overview">Overview</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account/teams" title="Équipes">Équipes</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account/projects" title="Projets">Projets</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account/followers" title="Abonnés">Abonnés</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account/following" title="Abonnements">Abonnements</a> </li>
            <?php if($router -> getRouteParam('0') == 'account'){?> <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account/settings" title="Réglages">Réglages</a> </li> <?php ;} ?>
        </ul>
    </div>
</div>