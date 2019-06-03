<div class="head_bar">
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
            <ul class="nav-left">
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>" title="Overview">Overview</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/teams" title="Équipes">Équipes</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/projects" title="Projets">Projets</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/followers" title="Abonnés">Abonnés</a> </li>
                <li class="nav-item margin-right"> <a class="dark-link" href="<?= $config -> rootUrl() ;?>member/<?= $router -> getRouteParam('1') ;?>/following" title="Abonnements">Abonnements</a> </li>
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
                                    ?> <li class="nav-item margin-right"> <a href="<?= $config -> rootUrl() ;?>login?return_url=member%2F<?= $user -> getUserData( $userToken, 'username') ?>" class="btn dark-btn" title="Suivre">Suivre</a> </li> <?php
                                    ?> <li class="nav-item margin-right"> <a href="<?= $config -> rootUrl() ;?>login?return_url=member%2F<?= $user -> getUserData( $userToken, 'username') ?>" class="btn dark-btn" title="Bloquer">Bloquer</a> </li> <?php
                                }
                            ?>
                        </form>
                        <?php 
                    ;} 
                ?>
            </ul>
        </div>
    </div>
</div>