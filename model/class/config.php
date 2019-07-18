<?php

class config extends router {
    private $front_theme;
    private $back_theme;

	function __construct(){
        $this->front_theme = 'original';
        $this->back_theme = 'original';
    }


/******************************************************************************/

    /**
     * Récupère le thème
     * 
     * Récupérer le thème défini (front ou back)
     * du thème par défaut
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $end FrontEnd ou BackEnd
     * @return string
     */

    function getTheme($end) {
        return ( $end == 'front' ? $this->front_theme : $this->back_theme);
    }



    /**
     * Include un fichier css
     * 
     * Va détecter si un fichier css d'un thème existe, dans le cas écheant, il prendra le fichier css
     * du thème par défaut
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $cssfile Nom du fichier css avec extension
     * @param string $theme Nom du thème
     * @param string $end FrontEnd ou BackEnd
     * @return string
     */

    function includeCss($cssfile = '', $theme = '', $end = '') {
        if($end == 'front'){
            return (file_exists('dist/css/themes/'.$theme.'/'.$cssfile) ? 'dist/css/themes/'.$theme.'/'.$cssfile : 'dist/css/themes/defaut/'.$cssfile);  
        }else{
            return (file_exists('dist/css/themes/'.$theme.'/admin/'.$cssfile) ? 'dist/css/themes/'.$theme.'/admin/'.$cssfile : 'dist/css/themes/defaut/admin/'.$cssfile);  
        }
    }



    /**
     * Récupérer si il faut etre connecté pour afficher une page
     * 
     * Récupérer si il faut etre connecté pour afficher une page
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $config_file = le chemin d'accès de la config
     */

    function renderMustBeConnected($config_file = ''){
        $content = file_get_contents($config_file);
        $obj = json_decode($content, true);

        if(isset($obj['must_be_logged']) AND $obj['must_be_logged'] == true){
            return true;
        }
        return false;
    }



    /**
     * Récupérer si il faut avoir accès a un projet
     * 
     * Récupérer si il faut avoir accès a un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $config_file = le chemin d'accès de la config
     */

    function renderProjectCanAcess($config_file = ''){
        $content = file_get_contents($config_file);
        $obj = json_decode($content, true);

        if(isset($obj['project_can_access']) AND $obj['project_can_access'] == true){
            return true;
        }
        return false;
    }



    /**
     * Récupérer si il faut avoir accès a une équipe
     * 
     * Récupérer si il faut avoir accès a une équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $config_file = le chemin d'accès de la config
     */

    function renderTeamCanAcess($config_file = ''){
        $content = file_get_contents($config_file);
        $obj = json_decode($content, true);

        if(isset($obj['team_can_access']) AND $obj['team_can_access'] == true){
            return true;
        }
        return false;
    }



    /**
     * Récupérer les metas d'une page
     * 
     * Récupérer les metas d'un fichier config
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $config_file = le chemin d'accès de la config
     */

    function getConfigMeta($config_file = ''){
        $content = file_get_contents($config_file);
        $obj = json_decode($content, true);

        if(isset($obj['use_generic_meta']) AND $obj['use_generic_meta'] == true){
            echo file_get_contents('view/components/generic_meta.php');
        }else{
            if(isset($obj['meta'])){
                foreach($obj['meta'] as $ob){ 
                    if(router::getRouteParam('0') == 'account'){
                        $ob = str_replace("{{username}}", main::getToken(), "$ob");
                    }


                    echo $ob;
                }
            }else{
                echo file_get_contents('view/components/generic_meta.php');
            }
        }

        
    }



    /**
     * Récupérer les librairies d'une page
     * 
     * Récupérer les librairies d'un fichier config
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $config_file = le chemin d'accès de la config
     * @param string $lib = la librairie
     */

    function getConfigLib($config_file = '', $lib = ''){
        $content = file_get_contents($config_file);
        $obj = json_decode($content, true);

        if(isset($obj['libs'])){
            return in_array($lib, $obj['libs']) ? true : false;
        }
    }



    /**
     * Récupérer les styles d'une page
     * 
     * Récupérer les styles d'un fichier config
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $config_file = le chemin d'accès de la config
     */

    function getConfigCss($config_file = ''){
        $content = file_get_contents($config_file);
        $obj = json_decode($content, true);

        if(isset($obj['css'])){
            foreach($obj['css'] as $ob){
                echo '<link rel="stylesheet" type="text/css" media="screen" href="'. $this -> rootUrl() . $this -> includeCss($ob, $this -> getTheme('front'), 'front') .'">';
            }
        }
        if(isset($obj['online_css'])){
            foreach($obj['online_css'] as $ob){
                echo '<link rel="stylesheet" type="text/css" media="screen" href="'. $ob .'">';
            }
        }
    }



    /**
     * Récupérer les scripts d'une page
     * 
     * Récupérer les scripts d'un fichier config
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $config_file = le chemin d'accès de la config
     */

    function getConfigScript($config_file = ''){
        $content = file_get_contents($config_file);
        $obj = json_decode($content, true);

        if(isset($obj['js'])){
            foreach($obj['js'] as $ob){
                echo '<script type="text/javascript" src="'. $this -> rootUrl() .'dist/js/'. $ob .'"></script>';
            }
        }
        if(isset($obj['online_js'])){
            foreach($obj['online_js'] as $ob){
                echo '<script type="text/javascript" src="'. $ob .'"></script>';
            }
        }
    }

    
    

/******************************************************************************/



/******************************************************************************/
    
    /**
     * Obtenir un lien depuis la racine du site
     * 
     * obtenir l'url de la base du site
     *
     * @access public
     * @author Mikhaël Bailly
     * @return string
     */

    function rootUrl(){
        $counter = count(explode( '/', $_SERVER['QUERY_STRING']));
        $correctSlug = "";
        if($counter !== 0){
            for($i = 1;$i < $counter; $i ++){
                $correctSlug .= "../"; 
            }
        }
        return $correctSlug; 
    }

/******************************************************************************/



/******************************************************************************/

    /**
     * Transforme une date en "ago"
     * 
     * @access public
     * @author null
     * @param string $datetime = la date
     * @param string $full = full ou pas
     * @return string
     */
    
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'année',
            'm' => 'mois',
            'w' => 'semaine',
            'd' => 'jour',
            'h' => 'heure',
            'i' => 'minute',
            's' => 'seconde',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                if($v != 'mois'){
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                }else{
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
                }
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? 'Il y a ' . implode(', ', $string) : 'a l instant';
    }

/******************************************************************************/

}
