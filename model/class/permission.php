<?php

class permission extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Récupère les permissions d'un certain type
     * 
     * Va renvoyer toutes les permissions d'un type
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $type Type de permission
     * @return array
     */
    
    function getPermissionsPerType($type = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_permission` WHERE `type` = '$type'");
        return $request->fetchAll();
    }



    /**
     * Récupère les permissions d'une équipe
     * 
     * Va renvoyer toutes les permissions d'une équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $team_token Token de l'équipe de projet
     * @return array
     */
    
    function getProjectTeamPermissions($team_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_team` WHERE `public_token` = '$team_token'");
        $res = $request->fetch();
        return $res['permissions'];
    }



    /**
     * Récupère les permissions d'un utilisateur
     * 
     * Va renvoyer toutes les permissions d'un utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'équipe de projet
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getMemberPermissions($user_token = '', $project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_member` WHERE `user_public_token` = '$user_token' AND `project_token` = '$project_token' AND `enable` = '1' ");
        $res = $request->fetch();
        return $res['permissions'];
    }



    /**
     * Récupère les équipes d'un utilisateur
     * 
     * Va renvoyer toutes les équipes d'un utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'équipe de projet
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getMemberTeams($user_token = '', $project_token = '') {
        $array = [];
        $request = $this -> _db -> query("SELECT * FROM `pr_project_team` WHERE `project_token` = '$project_token' AND `enable` = '1'");
        $allTeams = $request->fetchAll();

        foreach($allTeams as $team){
            $team_token = $team['public_token'];

            $request = $this -> _db -> query("SELECT * FROM `pr_project_team_member` WHERE `project_team_token` = '$team_token' AND `project_token` = '$project_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            $res = $request->fetch();
            if($res){
                array_push($array, $team['public_token']);
            }
        }
        return $array;
    }


    /**
     * Test si l'utilisateur est le créateur du projet
     * 
     * Va tester si l'utilisateur est le créateur du projet, par conséquent il aura automatiquement toutes les permissions
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'équipe de projet
     * @param string $project_token Token du projet
     * @return array
     */
    
    function isProjectOwner($user_token = '', $project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_member` WHERE `user_public_token` = '$user_token' AND `project_token` = '$project_token' AND `enable` = '1' ");
        $res = $request->fetch();
        return $res['role'] == 1 ? true : false;
    }



    /**
     * Vérifier qu'un utilisateur a une permission
     * 
     * Va vérifier si un utilisateur possède la permission donnée
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'utilisateur
     * @param string $project_token Token du projet
     * @param string $permission Permission
     * @return array
     */
    function hasPermission($user_token, $project_token, $permission){
        $perms = $this -> getMemberPermissions($user_token, $project_token);


        $allTeams = $this -> getMemberTeams($user_token, $project_token);
        foreach($allTeams as $team){
            if($this -> projectTeamHasPermission($team, $permission) == true){
                return true;
            }
        }


        if ($this -> isProjectOwner($user_token, $project_token) == true) { 
            return true; 
        }

        if (strpos($perms, "'*'") !== false) { 
            return true; 
        }
        if (strpos($perms, $permission."|") !== false) {
            return true;
        }
        
        return false;
    }


    
    /**
     * Vérifier qu'une équipe a une permission
     * 
     * Va vérifier si une équipe possède la permission donnée
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $team_token Token de l'équipe de projet
     * @param string $permission Permission
     * @return array
     */
    function projectTeamHasPermission($team_token, $permission){
        $perms = $this -> getProjectTeamPermissions($team_token);
        if (strpos($perms, "'*'") !== false) { 
            return true; 
        }
        if (strpos($perms, $permission."|") !== false) {
            return true;
        }
        return false;
    }


    /**
     * Ajoute des permissions a un utilisateur pour un projet
     * 
     * Va ajouter des permissions a un utilisateur pour un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'utilisateur
     * @param string $project_token Token du projet
     * @param string $permissions Permissions
     * @return array
     */
    function addPermissions($user_token, $project_token ,$permissions){
        $perms = '';
        foreach($permissions as $p){ 
            $perms .= $p.'|';
        }
        $request = $this -> _db -> exec("UPDATE `pr_project_member` SET `permissions` = '$perms' WHERE `user_public_token` = '$user_token' AND `project_token` = '$project_token' AND `enable` = '1' ");
    }

/******************************************************************************/

}
