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

        <ul class="nav-right">
                <?php 
                    if($router -> getRouteParam('0') == 'member'){
                        ?> 
                        <form method="post">
                            <?php
                                if($auth -> isConnected() == true){
                                    if($userToken !== $main -> getToken()){
                                        if($friend -> isFollowing($main -> getToken(), $userToken) == false){
                                            ?> <li class="nav-item margin-right"> <button name="follow" class="btn dark-btn" title="Suivre">Suivre</button> </li> <?php
                                        }else{
                                            ?> <li class="nav-item margin-right"> <button name="unfollow" class="btn dark-btn" title="Ne plus suivre">Ne plus suivre</button> </li> <?php
                                        }
            
                                        if($user -> isBlocked($userToken) == false){
                                            ?> <li class="nav-item margin-right"> <button name="block" class="btn dark-btn" title="Bloquer">Bloquer</button> </li> <?php
                                        }else{
                                            ?> <li class="nav-item margin-right"> <button name="unblock" class="btn dark-btn" title="Débloquer">Débloquer</button> </li> <?php
                                        }
                                    }
                                    
                                }else{
                                    ?> <li class="nav-item margin-right"> <a href="<?= $config -> rootUrl() ;?>login?return_url=member%2F<?= $utils -> getData('imp_user', 'username', 'public_token', $userToken ) ?>" class="btn dark-btn" title="Suivre">Suivre</a> </li> <?php
                                    ?> <li class="nav-item margin-right"> <a href="<?= $config -> rootUrl() ;?>login?return_url=member%2F<?= $utils -> getData('imp_user', 'username', 'public_token', $userToken ) ?>" class="btn dark-btn" title="Bloquer">Bloquer</a> </li> <?php
                                }
                            ?>
                        </form>
                        <?php 
                    ;} 
                ?>
            </ul>

            <ul>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>" title="Overview">Overview</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/teams" title="Équipes">Équipes</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/projects" title="Projets">Projets</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/followers" title="Abonnés">Abonnés</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/following" title="Abonnements">Abonnements</a> </li>
            </ul>
        </div>
    </div>
</div>