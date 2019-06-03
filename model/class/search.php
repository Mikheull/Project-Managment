<?php

class search extends db_connect {

    private $queryResult = [];

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
        foreach($request -> fetchAll() as $res){
            if(!in_array($res['public_token'], $this->queryResult)){
                array_push($this->queryResult, $res['public_token']);
            }
        }
    } 



    /**
     * Recherche d'équipe
     * 
     * Va rechercher des équipes selon un keyword donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $keyword la team a rechercher
     * @param string $user_token token public de l'utilisateur (optionel)
     * @return array
     */

    function searchTeam($keyword = '', $user_token = null) {

        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `name` LIKE '%$keyword%' AND public = '1'");
        foreach($request -> fetchAll() as $res){
            if(!in_array($res['public_token'], $this->queryResult)){
                array_push($this->queryResult, $res['public_token']);
            }
        }

        if(isset($user_token) AND $user_token !== null){
            $request = $this -> _db -> query("SELECT * FROM `pr_team_member` WHERE `team_token` LIKE '%$keyword%' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            foreach($request -> fetchAll() as $res){
                if(!in_array($res['team_token'], $this->queryResult)){
                    array_push($this->queryResult, $res['team_token']);
                }
            }
        }
        
    } 



    /**
     * Recherche de projets
     * 
     * Va rechercher des projets selon un keyword donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $keyword de projet a rechercher
     * @param string $user_token token public de l'utilisateur (optionel)
     * @return array
     */

    function searchProject($keyword = '', $user_token = null) {

        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `name` LIKE '%$keyword%' AND public = '1'");
        foreach($request -> fetchAll() as $res){
            if(!in_array($res['public_token'], $this->queryResult)){
                array_push($this->queryResult, $res['public_token']);
            }
        }

        if(isset($user_token) AND $user_token !== null){
            $request = $this -> _db -> query("SELECT * FROM `pr_project_member` WHERE `project_token` LIKE '%$keyword%' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            foreach($request -> fetchAll() as $res){
                if(!in_array($res['project_token'], $this->queryResult)){
                    array_push($this->queryResult, $res['project_token']);
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
