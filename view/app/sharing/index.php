<?php
    require_once ('controller/shortener.php') ;
    
    if($utils -> getData('pr_shortener', 'type', 'short_url', $router -> getRouteParam("1")) == 'document'){
        echo $utils -> getData('pr_shortener', 'base_url', 'short_url', $router -> getRouteParam("1"));
    }

