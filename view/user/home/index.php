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

<?php require_once ('view/components/navbar-header-light.php') ;?>

<div class="container account light-border margin-top-lg margin-bot-lg">
    <div class="account_wrapper">
        <?php require_once ('view/user/components/heading_'. $mode .'.php') ;?>
        <?php require_once ('view/user/home/views/feed_gen.php') ;?>
    </div>
</div>

<?php require_once ('view/components/footer.php') ;?>
