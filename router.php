<?php


if(isset($_GET['query'])){

    if($router -> rootExisting($_GET['query']) == true){
        
        $exec_router = $router -> getRouteFilePath($_GET['query']);
        $require_url = $exec_router['file_path'];
        
        if($exec_router['success'] == true && file_exists($exec_router['file_path']) && file_exists($exec_router['config_path'])){
            require ('view/content/vue.php');
        }else{
            
            die( 'la page demandée est configurée mais son fichier source n\'existe pas ('.$exec_router['file_path'].')' );
        }

    }else{
        require ('view/content/error/not-found.php');
    }

}else{
    $_GET['query'] = 'home';
    $exec_router['file_path'] = 'view/content/landing/home/index.php';
    $exec_router['config_path'] = 'view/content/landing/home/config.json';
    $require_url = $exec_router['file_path'];
    require ('view/content/vue.php');
}