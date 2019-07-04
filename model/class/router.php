<?php

class router extends db_connect {
    private $routes = [];

	function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Verification de route
     * 
     * Vérifie si la route donnée est possible
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $route_name Nom de la route
     * @return boolean
     */
    
    function rootExisting($route_name = ''){

        foreach($this->routes as $route){

            $ori_route = $route['route'];
            
            $ori_route = $this -> transformPlaceholder($ori_route);
            $ori_route = str_replace("/", "\/", "$ori_route");

            if(preg_match_all('/^'. $ori_route .'[\/]?$/', $route_name, $matches, PREG_SET_ORDER, 0) == true){
                return true;
            }
        }
        return false;
    }

    

    /**
     * Ajouter une route
     * 
     * Va ajouter une route
     *
     * @access public
     * @author Mikhaël Bailly
     * @param array $array tableau contenant les données de la nouvelle route
     *             - 1) [route]
     *             - 2) [dir_path]
     */
    
    function addRoute($array = []){
        array_push($this->routes, $array);
    }



   /**
     * Ajouter plusieurs routes
     * 
     * Va ajouter plusieurs routes en même temps
     *
     * @access public
     * @author Mikhaël Bailly
     * @param array $array tableau contenant un autre tableau avec les données des nouvelles routes
     *             - 1) [route]
     *             - 2) [dir_path]
     */
    
    function addRoutes($array = []){
        foreach($array as $route){
            array_push($this->routes, $route);
        }
    }



    /**
     * Transforme les placeholder
     * 
     * Va transformer les différents placeholder de la route en regex
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $route_name Nom de la route
     * @return var
     */

     function transformPlaceholder($ori_route = '') {

        $ori_route = str_replace("{{ARTICLE_NAME}}", "([a-zA-Z0-9]{0,})", "$ori_route");
        $ori_route = str_replace("{{USER_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
        $ori_route = str_replace("{{RESET_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
        $ori_route = str_replace("{{USER_NAME}}", "([a-zA-Z0-9]{0,})", "$ori_route");
        $ori_route = str_replace("{{PROJECT_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
        $ori_route = str_replace("{{TEAM_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
        $ori_route = str_replace("{{TASK_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
        $ori_route = str_replace("{{TAB_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
        $ori_route = str_replace("{{DOCUMENTS_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
        $ori_route = str_replace("{{SURVEY_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");
        $ori_route = str_replace("{{UML_TOKEN}}", "([a-zA-Z0-9]{0,})", "$ori_route");

        return $ori_route;
     }



    /**
     * Récupérer le chemin d'accès d'une route
     * 
     * Va renvoyer le chemin d'accès du dossier d'une route, la config et l'index
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $route_name Nom de la route
     * @return array
     */

    function getRouteFilePath($route_name = ''){

        if($this -> rootExisting($route_name) OR $this -> rootExisting($route_name.'/')){
            foreach($this->routes as $route){

                $ori_route = $route['route'];
                
                $ori_route = $this -> transformPlaceholder($ori_route);
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
            return (['success' => false, 'options' => ['content' => 'La route n existe pas !', 'theme' => 'error'] ]);
        }
        
    }



   /**
     * Récupérer un paramètre de la route donnée
     * 
     * Va renvoyer un paramètre de la route
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $position Nom de la route
     * @return array
     */

    function getRouteParam($position = 'all'){
        $params = explode( '/', $_SERVER['QUERY_STRING']);
        $params[0] = str_replace("query=", '', $params[0]);
        
        return ($position == 'all' ? $params : $params[$position]);
    }

    

/******************************************************************************/

}
