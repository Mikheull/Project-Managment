<?php
    if($router -> getRouteParam('0') == 'account'){
        
        if($auth -> isConnected() == true){
            $userToken = $main -> getToken();
            $mode = 'user';
        }else{
            header('location: login?return_url=account');
        }


    }else if($router -> getRouteParam('0') == 'member'){

        require_once ('controller/friend.php');

        $userToken = $user -> usernameToToken($router -> getRouteParam('1'));
        if(empty($userToken)){
            header('location: ../member');
        }
        $mode = 'member';

    }

?>



<?php // View Content ?>

<div id="account-bg"> <?php require_once ('view/components/navbar-header-dark.php') ;?> </div>

<div class="container account floating_container">
    <?php require_once ('view/user/components/heading_'. $mode .'.php') ;?>
    <?php require_once ('view/user/home/feed_gen.php') ;?>
</div>

<?php require_once ('view/components/footer.php') ;?>
