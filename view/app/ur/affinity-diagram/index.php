<?php
    require_once ('controller/project.php') ;
    require_once ('controller/document.php') ;
    require_once ('controller/shortener.php') ;
    
    if($shortener -> shortenerExist($router -> getRouteParam("1"))){
        if($utils -> getData('pr_shortener', 'type', 'short_url', $router -> getRouteParam("1")) == 'document'){
            require_once ('view/app/sharing/doc.php');
        }
    }else{
        require_once ('view/app/sharing/not-found.php');
    }
    
