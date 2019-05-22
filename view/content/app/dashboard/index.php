<?php
    if($auth -> isConnected() == true){
        $userToken = $main -> getToken();

        require_once ('view/content/app/components/sidebar.php');
?>










<?php
    }else{
        header('location: login?return_url=app');
    }
?>