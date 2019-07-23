<?php
    require_once ('controller/project.php') ;
    require_once ('controller/recherche_utilisateur.php') ;
    
    if($recherche_utilisateur -> surveyExist($router -> getRouteParam("1"))){
        require_once ('view/app/ur/survey/survey.php');
    }else{
        require_once ('view/app/ur/survey/not-found.php');
    }
    
