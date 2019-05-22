<?php

class router {
    private $routes = [];

	function __construct(){

    }



/**
 * function rootExisting($route)
 * 
 * vérifie si la route existe
 * @return boolean
 */
    function rootExisting($route_name){

        foreach($this->routes as $route){

            $ori_route = $route['route'];
            
            $ori_route = str_replace("{{ARTICLE_NAME}}", "([a-zA-Z0-9]{0,})", "$ori_route");
            $ori_route = str_replace("{{USER_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
            $ori_route = str_replace("{{RESET_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
            $ori_route = str_replace("{{USER_NAME}}", "([a-zA-Z0-9]{0,})", "$ori_route");
            $ori_route = str_replace("{{PROJECT_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
            $ori_route = str_replace("{{TEAM_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
            $ori_route = str_replace("{{TASK_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
            $ori_route = str_replace("{{DOCUMENTS_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
            $ori_route = str_replace("{{SURVEY_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");

            $ori_route = str_replace("/", "\/", "$ori_route");

            if(preg_match_all('/^'. $ori_route .'[\/]?$/', $route_name, $matches, PREG_SET_ORDER, 0) == true){
                return true;
            }
        }
        return false;

    }



/**
 * function addRoute($array)
 * 
 * ajouter une route
 * @param 1 = un tableau contenant les données
 * (
 *      Donnée 1 : route
 *      Donnée 2 : FilePath
 * )
 */
    function addRoute($array){
        array_push($this->routes, $array);
    }
   
    

/**
 * function addRoutes($array)
 * 
 * ajouter plusieurs routes
 * @param 1 = un tableau contenant les données
 * Chaques données d'une route est dans un tableau global
 * (
 *      Donnée 1 : route
 *      Donnée 2 : FilePath
 * )
 */
    function addRoutes($array){
        foreach($array as $route){
            array_push($this->routes, $route);
        }
    }



/**
 * function getRouteFilePath($route_name)
 * 
 * récuperer le fichier d'une route
 * @param 1 = le nom de la route
 * @return obj
 */
    function getRouteFilePath($route_name){

        if($this -> rootExisting($route_name) OR $this -> rootExisting($route_name.'/')){
            foreach($this->routes as $route){

                $ori_route = $route['route'];
                
                $ori_route = str_replace("{{ARTICLE_NAME}}", "([a-zA-Z0-9]{0,})", "$ori_route");
                $ori_route = str_replace("{{USER_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
                $ori_route = str_replace("{{RESET_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
                $ori_route = str_replace("{{USER_NAME}}", "([a-zA-Z0-9]{0,})", "$ori_route");
                $ori_route = str_replace("{{PROJECT_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
                $ori_route = str_replace("{{TEAM_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
                $ori_route = str_replace("{{TASK_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
                $ori_route = str_replace("{{DOCUMENTS_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
                $ori_route = str_replace("{{SURVEY_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
    
                $ori_route = str_replace("/", "\/", "$ori_route");
    
                if(preg_match_all('/^'. $ori_route .'[\/]?$/', $route_name, $matches, PREG_SET_ORDER, 0) == true){
                    return ([
                        'success' => true,
                        'file_path' => $route['dir_path'].'index.php',
                        'config_path' => $route['dir_path'].'config.json'
                    ]);
                }
            }
            
        }else{
            return (['success' => false, 'message' => ['text' => 'La route n existe pas !', 'theme' => 'dark', 'timeout' => 2000] ]);
        }
        
    }

/**
 * function addRoutes($position = '')
 * 
 * récupérer un paramètre de la route (url)
 * @param 1 = la position dans le tableau ou le tableau complet
 */
    function getRouteParam($position = 'all'){
        $params = explode( '/', $_SERVER['QUERY_STRING']);
        
        return ($position == 'all' ? $params : $params[$position]);
    }

}