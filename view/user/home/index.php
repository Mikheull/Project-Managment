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

<div class="container account margin-top-lg margin-bot-lg">
    <div class="account_wrapper">
        <?php require_once ('view/user/components/heading_'. $mode .'.php') ;?>
        <?php require_once ('view/user/home/components/feed_gen.php') ;?>
    </div>
</div>

<?php require_once ('view/components/footer.php') ;?>
