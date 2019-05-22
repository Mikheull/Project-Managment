<?php
    if($auth -> isConnected() == true){
        $userToken = $_SESSION['user_token'];
?>

        <div id="account-bg">
            <?php require ('view/components/navbar-header-dark.php') ;?>
        </div>



        <div class="container account floating_container">
            <?php require ('view/content/account/components/heading_account.php') ;?>

            Accueil
        </div>


        <?php require ('view/components/footer.php') ;?>
<?php
    }else{
        header('location: login?return_url=account');
    }
?>