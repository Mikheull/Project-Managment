<?php

class project extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }


/**
 * function checkIfProjectExist($token)
 * 
 * Vérifie si un projet existe dans la BDD
 * @param 1 = Le token du projet
 * @return boolean
*/
    
    function checkIfProjectExist($token) {

        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `public_token` = '$token' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    } 



}


