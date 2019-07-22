<?php

class bug extends project {



/******************************************************************************/

    /**
     * Récupère les bugs d'un projet
     * 
     * Va renvoyer tout les bugs d'un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getBugs($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_bug` WHERE `project_token` = '$project_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }



    /**
     * Récupère les bugs d'un projet selon leur level
     * 
     * Va renvoyer tout les bugs d'un projet selon leur level
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $level Level du bug
     * @return array
     */
    
    function getBugsPerLevel($project_token = '', $level = 1) {
        $request = $this -> _db -> query("SELECT * FROM `pr_bug` WHERE `project_token` = '$project_token' AND `enable` = '1' AND `level` = '$level' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }

 
/******************************************************************************/



/******************************************************************************/


    /**
     * Créer un rapport de bug
     * 
     * Va créer un rapport de bug pour un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $bug_name Nom du bug
     * @param string $bug_desc Description du bug
     * @return array
     */
    
    function newBug($project_token = '', $bug_name = '', $bug_desc = '') {
        $bug_token = main::generateToken(6, 'numbers');

        $req = $this -> _db -> prepare("INSERT INTO `pr_bug` (`project_token`, `bug_token`, `name`, `description`) VALUES (:project_token, :bug_token, :name, :description)");

        $req->bindParam(':project_token', $project_token);
        $req->bindParam(':bug_token', $bug_token);
        $req->bindParam(':name', $bug_name);
        $req->bindParam(':description', $bug_desc);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
        return (['success' => true, 'options' => ['content' => "Le rapport de bug a été crée !", 'theme' => 'success'] ]);

    } 
    
    
    
    /**
    * Supprimer un bug
    * 
    * Supprimer un bug
    *
    * @access public
    * @author Mikhaël Bailly
    * @param string $token Token de la tache
    * @return array
    */

   function disableBug($token = '') {
       $request = $this -> _db -> exec("UPDATE `pr_bug` SET `enable` = 0 WHERE `bug_token` = '$token' AND `enable` = '1' ");
       return (['success' => true, 'options' => ['content' => "Le rapport de bug a été supprimé !", 'theme' => 'success'] ]);
   }
    
    
    /**
    * Défini le statut d'un bug sur (en cours)
    * 
    * Défini le statut d'un bug sur (en cours)
    *
    * @access public
    * @author Mikhaël Bailly
    * @param string $token Token de la tache
    * @return array
    */

   function setWorkinBug($token = '') {
        $now = date("Y-m-d H:i:s");
        $request = $this -> _db -> exec("UPDATE `pr_bug` SET `date_working` = '$now', `level` = '2' WHERE `bug_token` = '$token' AND `enable` = '1' ");
        return (['success' => true, 'options' => ['content' => "Le bug a été mis en statut (en cours) !", 'theme' => 'success'] ]);
   }
    
    
   /**
   * Défini le statut d'un bug sur (terminé)
   * 
   * Défini le statut d'un bug sur (terminé)
   *
   * @access public
   * @author Mikhaël Bailly
   * @param string $token Token de la tache
   * @return array
   */

  function setEndBug($token = '') {
       $now = date("Y-m-d H:i:s");
       $request = $this -> _db -> exec("UPDATE `pr_bug` SET `date_end` = '$now', `level` = '3' WHERE `bug_token` = '$token' AND `enable` = '1' ");
       return (['success' => true, 'options' => ['content' => "Le bug a été mis en statut (terminé) !", 'theme' => 'success'] ]);
  }


/******************************************************************************/


    /**
     * Assigner un bug a des équipe
     * 
     * Va assigner un bug a des équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $bug_token Token du bug
     * @param string $assigned_teams Les équipes assignés
     * @return array
     */

    function assignTeam($project_token = '', $bug_token = '', $assigned_teams = '') {
        if($assigned_teams !== ''){
            $teams = '';
            foreach($assigned_teams as $team){ 
                $teams .= $team.'|';
            }
            $request = $this -> _db -> exec("UPDATE `pr_bug` SET `assigned_teams` = '$teams' WHERE `project_token` = '$project_token' AND `bug_token` = '$bug_token' AND `enable` = '1' ");
        }else{
            $request = $this -> _db -> exec("UPDATE `pr_bug` SET `assigned_teams` = '' WHERE `project_token` = '$project_token' AND `bug_token` = '$bug_token' AND `enable` = '1' ");

        }
    }



    /**
     * Vérifier qu'un bug est assignée a une team
     * 
     * Va vérifier si un bug est assignée a une team donnée
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $bug_token Token du bug
     * @param string $team_token Token de la team
     * @return array
     */
    function teamIsAssigned($project_token, $bug_token, $team_token){
        $request = $this -> _db -> query("SELECT * FROM `pr_bug` WHERE `project_token` = '$project_token' AND `bug_token` = '$bug_token' AND `enable` = '1' ");
        $res = $request->fetch();
        $teams = $res['assigned_teams'];

        if (strpos($teams, $team_token."|") !== false) {
            return true;
        }
        return false;
    }



    /**
     * Récupérer les teams assignés a un bug
     * 
     * Va récupérer les équipes assignés a un bug
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $bug_token Token du bug
     * @return array
     */
    function getTeamAssigned($project_token = '', $bug_token = ''){
        $request = $this -> _db -> query("SELECT * FROM `pr_bug` WHERE `project_token` = '$project_token' AND `bug_token` = '$bug_token' AND `enable` = '1' ");
        $res = $request->fetch();
        $teams = $res['assigned_teams'];

        $allTeams = array();
        if (strpos($teams, "|") !== false) {
            $allTeams = explode('|', $teams);
        }
        return ([ 
            'count' => sizeof($allTeams), 
            'content' => $allTeams,
        ]);
    }



    /**
     * Assigner un bug a des membres
     * 
     * Va assigner un bug a des membres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $bug_token Token du bug
     * @param string $assigned_teams Les membres assignés
     * @return array
     */

    function assignMember($project_token = '', $bug_token = '', $assigned_members = '') {
        if($assigned_members !== ''){
            $members = '';
            foreach($assigned_members as $member){ 
                $members .= $member.'|';
            }
            $request = $this -> _db -> exec("UPDATE `pr_bug` SET `assigned_members` = '$members' WHERE `project_token` = '$project_token' AND `bug_token` = '$bug_token' AND `enable` = '1' ");
        }else{
            $request = $this -> _db -> exec("UPDATE `pr_bug` SET `assigned_members` = '' WHERE `project_token` = '$project_token' AND `bug_token` = '$bug_token' AND `enable` = '1' ");

        }
    }



    /**
     * Vérifier qu'un bug est assignée a un membre
     * 
     * Va vérifier si un bug est assignée a un membre donnée
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $bug_token Token du bug
     * @param string $team_token Token de l'utilisateur
     * @return array
     */
    function memberIsAssigned($project_token, $bug_token, $user_token){
        $request = $this -> _db -> query("SELECT * FROM `pr_bug` WHERE `project_token` = '$project_token' AND `bug_token` = '$bug_token' AND `enable` = '1' ");
        $res = $request->fetch();
        $users = $res['assigned_members'];

        if (strpos($users, $user_token."|") !== false) {
            return true;
        }
        return false;
    }
    


    /**
     * Récupérer les membres assignés a un bug
     * 
     * Va récupérer les membres assignés a un bug
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $bug_token Token du bug
     * @return array
     */
    function getMemberassigned($project_token = '', $bug_token = ''){
        $request = $this -> _db -> query("SELECT * FROM `pr_bug` WHERE `project_token` = '$project_token' AND `bug_token` = '$bug_token' AND `enable` = '1' ");
        $res = $request->fetch();
        $users = $res['assigned_members'];

        $allUsers = array();
        if (strpos($users, "|") !== false) {
            $allUsers = explode('|', $users);
        }
        return ([ 
            'count' => sizeof($allUsers), 
            'content' => $allUsers,
        ]);
    }

/******************************************************************************/

}
