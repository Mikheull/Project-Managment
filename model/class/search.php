<?php

class search extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/**
 * function searchUser($keyword)
 * 
 * Recherche un user dans la base de données selon un keyword
 * @param 1 = Le keyword
 * @return array
*/
    function searchUser($keyword) {

        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `username` LIKE '%$keyword%' OR first_name like '%".$keyword."%' OR last_name like '%".$keyword."%'");
        return $request -> fetchAll();

    } 

}


