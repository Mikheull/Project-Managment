<?php
    require ('controller/friend.php');

    if($router -> getRouteParam('0') == 'account'){
        $follow_mode = $router -> getRouteParam('1') == 'followers' ? 'follower' : 'following';
        
        if($auth -> isConnected() == true){
            $userToken = $main -> getToken();
            $mode = 'user';

        }else{
            ?> <script> location.href="<?= $config -> rootUrl() .'login?return_url=account%2Ffollowers' ?>" </script> <?php
        }


    }else if($router -> getRouteParam('0') == 'member'){
        $follow_mode = $router -> getRouteParam('2') == 'followers' ? 'follower' : 'following';

        $userToken = $user -> usernameToToken($router -> getRouteParam('1'));
        if(empty($userToken)){
            ?> <script> location.href="<?= $config -> rootUrl() .'member' ?>" </script> <?php
        }
        $mode = 'member';

    }

    $list = $follow_mode == 'follower' ? $friend -> getFollowers($userToken) : $friend -> getFollowings($userToken);
?>






<?php // View Content ?>

<?php require_once ('view/components/navbar-header-light.php') ;?>

<div class="container account mr-top-lg mr-bot-lg">

    <div class="row">
        <div class="col-md-3 col-12">
            <?php require_once ('view/user/components/heading_'. $mode .'.php') ;?>
        </div>
        
        <div class="col-md-8 col-12">
            <?php require_once ('view/user/components/navbar_'. $mode .'.php') ;?>
            <div class="row head-bar">
            <div class="col">
                <h3 class="title-sm bold color-dark"><?= $follow_mode == 'follower' ? 'Abonnés' : 'Abonnements' ;?></h3>
            </div>
        </div>
        
        <?php
        if(empty($list)){
            ?>
                <div class="row">
                    <div class="col-6 offset-3 text-align-center mr-top-lg mr-bot-lg light-border">
                        <h2 class="title-sm color-dark mr-bot mr-top">0 followers</h2>
                    </div>
                </div>
            <?php
        }else{
            ?>
            
                <div class="row mr-top-lg mr-bot-lg">
                    <ul class="follow_content">
                        <?php
                        foreach($list as $res){
                            ?>
                            <li class="item mr-bot col-6 light-border">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3 col-12 mr-bot mr-top">
                                            <a href="<?= $config -> rootUrl() ;?>member/<?= $utils -> getData('imp_user', 'username', 'public_token', $res[$follow_mode] ) ?>" title="Accéder au compte de <?= $utils -> getData('imp_user', 'first_name', 'public_token', $res[$follow_mode] ) ?> <?= $utils -> getData('imp_user', 'last_name', 'public_token', $res[$follow_mode] ) ?>">
                                                <div class="profil_picture-md">
                                                    <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $res[$follow_mode] ) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $res[$follow_mode].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $res[$follow_mode] ) ;?>');"></div>
                                                </div>    
                                            </a>
                                        </div>
                                        <div class="col-md-5 col-12 align-self-center">
                                            <a href="<?= $config -> rootUrl() ;?>member/<?= $utils -> getData('imp_user', 'username', 'public_token', $res[$follow_mode] ) ?>" title="Accéder au compte de <?= $utils -> getData('imp_user', 'first_name', 'public_token', $res[$follow_mode] ) ?> <?= $utils -> getData('imp_user', 'last_name', 'public_token', $res[$follow_mode] ) ?>">
                                                <p class="title-xs bold color-dark"><?= $utils -> getData('imp_user', 'username', 'public_token', $res[$follow_mode] ) ?></p>
                                                <p class="color-dark"><?= $utils -> getData('imp_user', 'first_name', 'public_token', $res[$follow_mode] ) ?> <?= $utils -> getData('imp_user', 'last_name', 'public_token', $res[$follow_mode] ) ?></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            <?php
        }
        ?>
        </div>
    </div>

</div>

<?php require_once ('view/components/footer.php') ;?>
