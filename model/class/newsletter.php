<?php

class newsletter extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }


/******************************************************************************/

    /**
     * Inscris un email a notre newsletter
     * 
     * Va essayer d'inscrire un email a la newsletter
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $email email de l'utilisateur
     * @return boolean
     */

    function subscribe($email = '') {
        $request = $this -> _db -> query("SELECT * FROM `imp_newsletter` WHERE `email` = '$email' ");
        $res = $request->fetch();
        
        if(!$res){
            $request = $this -> _db -> exec("INSERT INTO `imp_newsletter` (`email`) VALUES ('$email') ");
            return (['success' => true, 'message' => ['text' => "Inscription a la newsletter validée !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }
        return (['success' => false, 'message' => ['text' => "Vous êtes déjà inscris !", 'theme' => 'dark', 'timeout' => 2000] ]);
    } 

/******************************************************************************/

}
