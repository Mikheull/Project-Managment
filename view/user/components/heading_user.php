<div class="row">
    <div class="col-md-3 profil_picture">
        <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData( $userToken, 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $userToken.'/profil_pic/'.$user -> getUserData( $userToken, 'profil_image') ;?>');"></div>
    </div>

    <div class="col-md-9 align-self-center">
        <div class="heading margin-bot">
            <h2 class="title-lg bold color-dark">
                <?= $user -> getUserData( $userToken, 'first_name') ?> <?= $user -> getUserData( $userToken, 'last_name') ?> 
                <?= $user -> getRoleFormated($user -> getUserData( $userToken, 'role')); ?>
            </h2>
            <h3 class="title-sm color-gray"><?= $user -> getUserData( $userToken, 'username') ?></h3>
        </div>
        <p class="bio color-dark"><?= $user -> getUserData( $userToken, 'bio') ?></p>
    </div>
</div>

<div class="row">
    <div class="col menu_bar margin-bot-lg">
        <ul>
            <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account" title="Overview">Overview</a> </li>
            <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account/teams" title="Équipes">Équipes</a> </li>
            <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account/projects" title="Projets">Projets</a> </li>
            <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account/followers" title="Abonnés">Abonnés</a> </li>
            <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account/following" title="Abonnements">Abonnements</a> </li>
            <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>account/settings" title="Réglages">Réglages</a> </li>
        </ul>
    </div>
</div>