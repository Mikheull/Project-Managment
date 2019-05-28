<?php
    require ('controller/friend.php');

    if($router -> getRouteParam('0') == 'account'){
        
        if($auth -> isConnected() == true){
            $userToken = $main -> getToken();
            $mode = 'user';

        }else{
            header('location: login?return_url=account%2Ffollowers');
        }


    }else if($router -> getRouteParam('0') == 'member'){

        $userToken = $user -> usernameToToken($router -> getRouteParam('1'));
        if(empty($userToken)){
            header('location: ../member');
        }
        $mode = 'member';

    }

?>



<?php // View Content ?>

<div id="account-bg"> <?php require_once ('view/components/navbar-header-dark.php') ;?> </div>

<div class="container account floating_container follow">
    <?php require_once ('view/user/components/heading_'. $mode .'.php') ;?>

    <ul class="fol_content">
        <?php
            if(empty($friend -> getFollowings($userToken))){
                ?>
                    <div class="row">
                        <div class="col-6 offset-6 empty-fol"> <h3>0 followers</h3> </div>
                    </div>
                <?php
            }else{
                foreach($friend -> getFollowings($userToken) as $res){

                ?>
                    <li class="result_item">
                        <div class="container">
                            <div class="row">
                                <div class="col-2">
                                    <a href="<?= $config -> rootUrl() ;?>member/<?= $user -> getUserData( $res['following'], 'username') ?>" title="Accéder au compte de <?= $user -> getUserData( $res['following'], 'first_name') ?> <?= $user -> getUserData( $res['following'], 'last_name') ?>">
                                        <div class="profil_pic"> <img src="<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData( $res['following'], 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $res['following'].'/profil_pic/'.$user -> getUserData( $res['following'], 'profil_image') ;?>" alt="Image de profil" width="70%"> </div> 
                                    </a>
                                </div>
                                <div class="col-8 align-self-center">
                                    <a href="<?= $config -> rootUrl() ;?>member/<?= $user -> getUserData( $res['following'], 'username') ?>" title="Accéder au compte de <?= $user -> getUserData( $res['following'], 'first_name') ?> <?= $user -> getUserData( $res['following'], 'last_name') ?>">
                                        <span class="username"><?= $user -> getUserData( $res['following'], 'username') ?></span>
                                        <span class="name"><?= $user -> getUserData( $res['following'], 'first_name') ?> <?= $user -> getUserData( $res['following'], 'last_name') ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
            <?php
                }
            }
        ?>
    </ul>

</div>

<?php require_once ('view/components/footer.php') ;?>
