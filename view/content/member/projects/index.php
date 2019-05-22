<?php
    require ('controller/friend.php');

    $userToken = $user -> usernameToToken($router -> getRouteParam('1'));
    if(empty($userToken)){
        header('location: ../member');
        $errors = ['success' => false, 'message' => ['text' => 'Aucun utilisateur n a été trouvé !', 'theme' => 'light', 'timeout' => 2000] ];
    }
?>

        <div id="account-bg">
            <?php require ('view/components/navbar-header-dark.php') ;?>
        </div>



        <div class="container account floating_container">
            <?php require ('view/content/member/components/heading_account.php') ;?>

            Projets
        </div>


        <?php require ('view/components/footer.php') ;?>