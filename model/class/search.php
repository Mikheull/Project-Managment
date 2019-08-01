<?php

class search extends db_connect {

    private $queryResult = [];

    function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Recherche
     * 
     * Va faire une recherche selon un keyword donné et un type
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $keyword le mot a rechercher
     * @param string $type le type de recherche
     * @param string $table nom de la table sql
     * @return array
     */

    function searchContent($keyword = '', $type = '', $token = '') {

        if($type == 'member'){
            $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE username LIKE '%$keyword%' OR first_name like '%".$keyword."%' OR last_name like '%".$keyword."%'");
            foreach($request -> fetchAll() as $res){
                if(!in_array($res['public_token'], $this->queryResult)){
                    array_push($this->queryResult, $res['public_token']);
                }
            }
        }


        if($type == 'project'){
            $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `name` LIKE '%$keyword%' AND public = '1'");
            foreach($request -> fetchAll() as $res){
                if(!in_array($res['public_token'], $this->queryResult)){
                    array_push($this->queryResult, $res['public_token']);
                }
            }

            if($token !== null){
                $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `name` LIKE '%$keyword%'");
                foreach($request -> fetchAll() as $pre){
                    $public_token = $pre['public_token'];
                    $request = $this -> _db -> query("SELECT * FROM `pr_project_member` WHERE `project_token` LIKE '$public_token' AND `user_public_token` = '$token' AND `enable` = '1' ");
                    foreach($request -> fetchAll() as $res){
                        if(!in_array($res['project_token'], $this->queryResult)){
                            array_push($this->queryResult, $res['project_token']);
                        }
                    }
                }
                
            }
        }
    }



    /**
     * Récupérer les résultats
     * 
     * @access public
     * @author Mikhaël Bailly
     * @return array
     */

    function getQueryResult() {
        return $this->queryResult;
    } 
/******************************************************************************/

}
