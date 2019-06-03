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
    $list = $friend -> getFollowers($userToken);
?>



<?php // View Content ?>

<?php require_once ('view/components/navbar-header-light.php') ;?>

<div class="container account light-border margin-top-lg margin-bot-lg">
    <div class="account_wrapper">
        <?php require_once ('view/user/components/heading_'. $mode .'.php') ;?>
        
        <div class="row head-bar">
            <div class="col">
                <h3 class="title-sm bold color-dark">Abonnés</h3>
            </div>
        </div>

        <?php
        if(empty($list)){
            ?>
                <div class="row">
                    <div class="col-6 offset-3 text-align-center margin-top-lg margin-bot-lg light-border">
                        <h2 class="title-sm color-dark margin-bot margin-top">0 followers</h2>
                    </div>
                </div>
            <?php
        }else{
            ?>
            
                <div class="row margin-top-lg margin-bot-lg">
                    <ul class="follow_content">
                        <?php
                        foreach($list as $res){
                            ?>
                            <li class="item margin-bot col-5 light-border">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3 col-12 margin-bot margin-top">
                                            <a href="<?= $config -> rootUrl() ;?>member/<?= $user -> getUserData( $res['follower'], 'username') ?>" title="Accéder au compte de <?= $user -> getUserData( $res['follower'], 'first_name') ?> <?= $user -> getUserData( $res['follower'], 'last_name') ?>">
                                                <div class="col-md-3 profil_picture-md">
                                                    <div class="img light-border" style="background-image: url('<?= $config -> rootUrl() ;?>dist/<?= $user -> getUserData( $res['follower'], 'profil_image') == NULL ? 'images/content/defaut_profil_pic.png' : 'uploads/u/'. $res['follower'].'/profil_pic/'.$user -> getUserData( $res['follower'], 'profil_image') ;?>');"></div>
                                                </div>    
                                            </a>
                                        </div>
                                        <div class="col-md-9 col-12 align-self-center">
                                            <a href="<?= $config -> rootUrl() ;?>member/<?= $user -> getUserData( $res['follower'], 'username') ?>" title="Accéder au compte de <?= $user -> getUserData( $res['follower'], 'first_name') ?> <?= $user -> getUserData( $res['follower'], 'last_name') ?>">
                                                <p class="title-xs bold color-dark"><?= $user -> getUserData( $res['follower'], 'username') ?></p>
                                                <p class="color-dark"><?= $user -> getUserData( $res['follower'], 'first_name') ?> <?= $user -> getUserData( $res['follower'], 'last_name') ?></p>
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

<?php require_once ('view/components/footer.php') ;?>