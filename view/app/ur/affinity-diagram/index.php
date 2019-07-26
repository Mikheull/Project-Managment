<?php
    require_once ('controller/project.php') ;
    require_once ('controller/recherche_utilisateur.php') ;
    
    if($recherche_utilisateur -> affinityDiagramExist($router -> getRouteParam("1"))){
        require_once ('view/app/ur/affinity-diagram/affinity-diagram.php');
    }else{
        require_once ('view/app/ur/affinity-diagram/not-found.php');
    }
    
