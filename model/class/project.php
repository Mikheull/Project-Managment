<?php

class project extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }


/******************************************************************************/

    /**
     * Vérifie si un projet existe
     * 
     * Va vérifier si un project existe selon un token donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token du projet
     * @return boolean
     */

    function projectExist($token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `public_token` = '$token' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    } 

/******************************************************************************/

}
