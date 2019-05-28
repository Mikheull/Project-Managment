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
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>" title="Overview">Overview</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/teams" title="Équipes">Équipes</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/projects" title="Projets">Projets</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/followers" title="Abonnés">Abonnés</a> </li>
            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/following" title="Abonnements">Abonnements</a> </li>
        </ul>

        <ul class="nav-right">
        <?php 
            if($router -> getRouteParam('0') == 'member'){
                ?> 
                <form method="post">
                    <?php
                        if($auth -> isConnected() == true){
                            if($userToken !== $main -> getToken()){
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
                            
                        }else{
                            ?> <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>login?return_url=member%2F<?= $user -> getUserData( $userToken, 'username') ?>" class="btn dark-btn" title="Suivre">Suivre</a> </li> <?php
                            ?> <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>login?return_url=member%2F<?= $user -> getUserData( $userToken, 'username') ?>" class="btn dark-btn" title="Bloquer">Bloquer</a> </li> <?php
                        }
                    ?>
                </form>
                <?php 
            ;} 
        ?>
        </ul>
    </div>
</div>