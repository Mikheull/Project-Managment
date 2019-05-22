<?php

class search extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Recherche d'utilisateur
     * 
     * Va rechercher des utilisateurs selon un keyword donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $keyword l'utilisateur a rechercher
     * @return array
     */

    function searchUser($keyword = '') {

        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `username` LIKE '%$keyword%' OR first_name like '%".$keyword."%' OR last_name like '%".$keyword."%'");
        return $request -> fetchAll();
    } 

/******************************************************************************/

}
