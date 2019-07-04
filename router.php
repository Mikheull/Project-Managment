<?php


if(isset($_GET['query'])){

    if($router -> rootExisting($_GET['query']) == true){
        
        $exec_router = $router -> getRouteFilePath($_GET['query']);
        $require_url = $exec_router['file_path'];
        $rendering_html = $exec_router['rendering_html'];
        
        if($exec_router['success'] == true && file_exists($exec_router['file_path']) && file_exists($exec_router['config_path'])){
            require ('view/index.php');
        }else{
            die( 'la page demandée est configurée mais son fichier source n\'existe pas ('.$exec_router['file_path'].')' );
        }

    }else{
        $_GET['query'] = 'not-found';
        $exec_router['file_path'] = 'view/error/not-found/index.php';
        $exec_router['config_path'] = 'view/error/not-found/config.json';
        $require_url = $exec_router['file_path'];
        $rendering_html = true;
        require ('view/index.php');
    }

}else{
    $_GET['query'] = 'home';
    $exec_router['file_path'] = 'view/landing/home/index.php';
    $exec_router['config_path'] = 'view/landing/home/config.json';
    $require_url = $exec_router['file_path'];
    $rendering_html = true;
    require ('view/index.php');
}


if($auth -> isConnected() == true){
    $now = date("Y-m-d H:i:s");
    $utils -> setData('imp_user', 'date_last_join', $now, 'public_token', $main -> getToken());
}