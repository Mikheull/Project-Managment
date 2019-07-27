<div>
    <div class="row">
        <div class="col-10 offset-1 mr-bot">
            <div class="image_bloc" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $userToken ) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $userToken.'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $userToken ) ;?>');background-size: contain;background-repeat: no-repeat;"></div>
        </div>
        <div class="col-10 offset-1 text-align-center">
            <h2 class="title-md bold color-dark">
                <?= $utils -> getData('imp_user', 'first_name', 'public_token', $userToken ) ?> <?= $utils -> getData('imp_user', 'last_name', 'public_token', $userToken ) ?> 
                <?= $user -> getRoleFormated($utils -> getData('imp_user', 'role', 'public_token', $userToken )); ?>
            </h2>
            <h3 class="title-xs color-gray">@<?= $utils -> getData('imp_user', 'username', 'public_token', $userToken ) ?></h3>

            <p class="bio color-gray mr-top mr-bot text-xs"><?= $utils -> getData('imp_user', 'bio', 'public_token', $userToken ) ?></p>
        </div>

        <div class="col-10 offset-1 mr-top">
            <form method="post" class="flex justify-content-between">
                <?php
                    if($auth -> isConnected() == true){
                        if($userToken !== $main -> getToken()){
                            if($friend -> isFollowing($main -> getToken(), $userToken) == false){
                                ?> <div class="nav-item mr-right"> <button name="follow" class="btn dark-btn" title="Suivre">Suivre</button> </div> <?php
                            }else{
                                ?> <div class="nav-item mr-right"> <button name="unfollow" class="btn dark-btn" title="Ne plus suivre">Ne plus suivre</button> </div> <?php
                            }

                            if($user -> isBlocked($userToken) == false){
                                ?> <div class="nav-item mr-right"> <button name="block" class="btn red-btn" title="Bloquer">Bloquer</button> </div> <?php
                            }else{
                                ?> <div class="nav-item mr-right"> <button name="unblock" class="btn red-btn" title="Débloquer">Débloquer</button> </div> <?php
                            }
                        }
                        
                    }else{
                        ?> <div class="nav-item mr-right"> <a href="<?= $config -> rootUrl() ;?>login?return_url=member%2F<?= $utils -> getData('imp_user', 'username', 'public_token', $userToken ) ?>" class="btn dark-btn" title="Suivre">Suivre</a> </div> <?php
                        ?> <div class="nav-item mr-right"> <a href="<?= $config -> rootUrl() ;?>login?return_url=member%2F<?= $utils -> getData('imp_user', 'username', 'public_token', $userToken ) ?>" class="btn red-btn" title="Bloquer">Bloquer</a> </div> <?php
                    }
                ?>
            </form>
        </div>
    </div>
</div>