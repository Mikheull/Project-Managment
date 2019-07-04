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

/******************************************************************************/

}
