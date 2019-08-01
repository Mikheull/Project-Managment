<?php

class activity extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }


/******************************************************************************/

    /**
     * Créer un log
     * 
     * Générer un log, qui gardera une trace de l'action effectué
     *
     * @access public
     * @author Mikhaël Bailly
     * @param int $user Token de l'utilisateur
     * @param int $project_token Token du projet
     * @param int $ref Token de reference
     * @param int $type Type d'action
     * @param int $optional Type d'action
     * @return null
     */

    function addlog($user = '', $project_token = '', $ref = '', $type = '', $options = null){
        $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$ref', '$project_token', '$type', '$options') ");
    }



    /**
     * Get l'activité d'une tache
     * 
     * @access public
     * @author Mikhaël Bailly
     * @param int $project_token Token du projet
     * @param int $ref_token Token de la ref
     * @return array
     */
    
    function getActivity($project_token = '', $ref_token = ''){
        $task_request = $this -> _db -> query("SELECT * FROM `pr_log` WHERE `project_token` = '$project_token' AND `ref_token` = '$ref_token' AND `enable` = '1' ORDER BY date DESC");
        $res = $task_request->fetchAll();
        $count = $task_request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res,
        ]);
    }
/******************************************************************************/

}
