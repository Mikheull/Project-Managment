<?php
    if($router -> getRouteParam('0') == 'account'){
        
        if($auth -> isConnected() == true){
            $userToken = $main -> getToken();
            $mode = 'user';
        }else{
            header('location: '. $config -> rootUrl() .'login?return_url=account');
        }


    }else if($router -> getRouteParam('0') == 'member'){

        require_once ('controller/friend.php');

        $userToken = $user -> usernameToToken($router -> getRouteParam('1'));
        if(empty($userToken)){
            header('location: '. $config -> rootUrl() .'member');
        }
        $mode = 'member';

    }

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
            <?php require_once ('view/user/home/components/feed_gen.php') ;?>
        </div>
    </div>

</div>

<?php require_once ('view/components/footer.php') ;?>
