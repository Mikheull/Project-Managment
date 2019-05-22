<div class="row">
    <div class="col-md-3 profile_image">
        <img src="<?= $config -> rootUrl() ;?>dist/<?= $user -> getDataFromUserToken( $userToken, 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $userToken.'/profil_pic/'.$user -> getDataFromUserToken( $userToken, 'profil_image') ;?>" alt="Image de profil" width="100%">    
    </div>

    <div class="col-md-9 align-self-center">
        <div class="heading">
            <h2>
                <?= $user -> getDataFromUserToken( $userToken, 'first_name') ?> <?= $user -> getDataFromUserToken( $userToken, 'last_name') ?> 
                <?php
                    if($user -> getDataFromUserToken( $userToken, 'role') == '1'){echo '<i class="fas fa-shield-alt fa-xs" data-tippy="Roi en ce royaume"></i>' ;}
                    if($user -> getDataFromUserToken( $userToken, 'role') == '3'){echo '<i class="fas fa-headset fa-xs" data-tippy="Membre du support"></i>' ;}
                    if($user -> getDataFromUserToken( $userToken, 'role') == '4'){echo '<i class="far fa-question-circle fa-xs" data-tippy="Helper"></i>' ;}
                    if($user -> getDataFromUserToken( $userToken, 'role') == '5'){echo '<i class="fas fa-headset fa-xs" data-tippy="Moderateur"></i>' ;}
                    if($user -> getDataFromUserToken( $userToken, 'role') == '6'){echo '<i class="fas fa-shield-alt fa-xs" data-tippy="Administrateur"></i>' ;}
                ?>
            </h2>
            <h3><?= $user -> getDataFromUserToken( $userToken, 'username') ?></h3>
        </div>
        <div class="bio"><?= $user -> getDataFromUserToken( $userToken, 'bio') ?></div>
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
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account/settings" title="Réglages">Réglages</a> </li>
        </ul>

        <ul class="nav-right">
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account/edit" class="btn dark-btn" title="Modifier son profil">Modifier</a> </li>
        </ul>
    </div>
</div>