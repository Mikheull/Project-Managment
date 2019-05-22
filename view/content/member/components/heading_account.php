<div class="row">
    <div class="col-md-3 profile_image">
        <img src="<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData( $userToken, 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $userToken.'/profil_pic/'.$user -> getUserData( $userToken, 'profil_image') ;?>" alt="Image de profil" width="100%">    
    </div>

    <div class="col-md-9 align-self-center">
        <div class="heading">
            <h2>
                <?= $user -> getUserData( $userToken, 'first_name') ?> <?= $user -> getUserData( $userToken, 'last_name') ?> 
                <?php
                    if($user -> getUserData( $userToken, 'role') == '1'){echo '<i class="fas fa-shield-alt fa-xs" data-tippy="Roi en ce royaume"></i>' ;}
                    if($user -> getUserData( $userToken, 'role') == '3'){echo '<i class="fas fa-headset fa-xs" data-tippy="Membre du support"></i>' ;}
                    if($user -> getUserData( $userToken, 'role') == '4'){echo '<i class="far fa-question-circle fa-xs" data-tippy="Helper"></i>' ;}
                    if($user -> getUserData( $userToken, 'role') == '5'){echo '<i class="fas fa-headset fa-xs" data-tippy="Moderateur"></i>' ;}
                    if($user -> getUserData( $userToken, 'role') == '6'){echo '<i class="fas fa-shield-alt fa-xs" data-tippy="Administrateur"></i>' ;}
                ?>
            </h2>
            <h3><?= $user -> getUserData( $userToken, 'username') ?></h3>
        </div>
        <div class="bio"><?= $user -> getUserData( $userToken, 'bio') ?></div>
    </div>
</div>

<div class="row">
    <div class="col menu_bar">
        <ul class="nav-left">
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>" title="Overview">Overview</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/teams" title="Équipes">Équipes</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/projects" title="Projets">Projets</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/followers" title="Abonnés">Abonnés</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/following" title="Abonnements">Abonnements</a> </li>
        </ul>

        <ul class="nav-right">
            <form method="post">
            <?php
                if($auth -> isConnected() == true AND $userToken !== $main -> getToken()){
                    
                    if($friend -> isFollowing($main -> getToken(), $userToken) == false){
                        ?> <li class="nav-item"> <button name="follow" class="btn dark-btn" title="Suivre">Suivre</button> </li> <?php
                    }else{
                        ?> <li class="nav-item"> <button name="unfollow" class="btn dark-btn" title="Ne plus suivre">Ne plus suivre</button> </li> <?php
                    }

                    if($user -> isBlocked($userToken) == false){
                        ?> <li class="nav-item"> <button name="block" class="btn dark-btn" title="Bloquer">Bloquer</button> </li> <?php
                    }else{
                        ?> <li class="nav-item"> <button name="unblock" class="btn dark-btn" title="Débloquer">Débloquer</button> </li> <?php
                    }
                    
                }
            ?>
            </form>
        </ul>
        
    </div>
</div>