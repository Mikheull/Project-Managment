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
                        <h2 class="title-sm color-dark mr-bot mr-top">0 <?= $follow_mode == 'follower' ? 'abonnés' : 'abonnements' ;?></h2>
                    </div>
                </div>
            <?php
        }else{
            ?>
            
                <div class="mr-top-lg mr-bot-lg">
                    <ul class="row follow_content">
                        <?php
                        foreach($list as $res){
                            ?>
                            <li class="col-md-6 col-12 pl-0 mr-bot">
                                <div class="pt-3 pb-3 container light-border mr-bot flex">

                                    <a href="<?= $config -> rootUrl() ;?>member/<?= $utils -> getData('imp_user', 'username', 'public_token', $res[$follow_mode] ) ?>">
                                        <div class="flex col-10">
                                            <div class="avatar avatar--lg ">
                                                <figure class="avatar__figure" role="img" aria-label="Emily Ewing">
                                                    <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                                                    <img class="avatar__img" src="<?= $config -> rootUrl() ;?>dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $res[$follow_mode]) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $res[$follow_mode].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $res[$follow_mode]) ;?>">
                                                </figure>
                                                <span role="status" class="avatar__status avatar__status--busy" aria-label="Active"></span>
                                            </div>
                                            <div class="name mr-left mr-top"> <?= $utils -> getData('imp_user', 'username', 'public_token', $res[$follow_mode]) ?>  </div>
                                        </div>
                                    </a>
                                    
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
