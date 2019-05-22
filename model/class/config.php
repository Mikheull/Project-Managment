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
     * Récupérer la configuration d'une page
     * 
     * Récupère des configuration d'un fichier config (css, js ou meta)
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $config_file = le chemin d'accès de la config
     * @param string $part = la partie a récupérer
     */

    function getPageConfig($config_file = '', $part = ''){
        $content = file_get_contents($config_file);
        $obj = json_decode($content, true);
        
        foreach($obj[$part] as $ob){
            if($part == 'css'){
                echo '<link rel="stylesheet" type="text/css" media="screen" href="'. $this -> rootUrl() . $this -> includeCss($ob, $this -> getTheme('front'), 'front') .'">';
            }else if($part == 'js'){
                echo '<script type="text/javascript" src="'. $this -> rootUrl() .'dist/js/'. $ob .'"></script>';
            }else{
                echo $ob;
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
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? 'Il y a ' . implode(', ', $string) : 'a l instant';
    }

/******************************************************************************/

}
