<?php

class task extends project {



/******************************************************************************/

    /**
     * Récupère les tableau de taches d'un projet
     * 
     * Va renvoyer tout les tableau de taches d'un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getTabs($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_task_tab` WHERE `project_token` = '$project_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }



    /**
     * Créer un tableau
     * 
     * Va créer un tableau pour un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $name Nom du tableau
     * @return array
     */
    
    function newTab($project_token = '', $name = '') {
        $tabs = $this -> getTabs($project_token);
        $pos = $tabs['count'];
        $pos ++;
        $tab_token = main::generateToken(10, 'uuid');

        $req = $this -> _db -> prepare("INSERT INTO `pr_task_tab` (`project_token`, `tab_token`, `position`, `name`) VALUES (:project_token, :tab_token, :position, :name)");

        $req->bindParam(':project_token', $project_token);
        $req->bindParam(':tab_token', $tab_token);
        $req->bindParam(':position', $pos);
        $req->bindParam(':name', $name);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
        return (['success' => true, 'options' => ['content' => "Le tableau a été crée !", 'theme' => 'success'] ]);

    } 
    
    

    /**
     * Supprimer un tableau de tache
     * 
     * Supprimer un tableau en supprimant les taches
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token du tableau
     * @return array
     */

    function disableTab($token = '') {
        $request = $this -> _db -> exec("UPDATE `pr_task_tab` SET `enable` = 0 WHERE `tab_token` = '$token' AND `enable` = '1' ");
        $request = $this -> _db -> exec("UPDATE `pr_task_item` SET `enable` = 0 WHERE `tab_token` = '$token' AND `enable` = '1' ");
        return (['success' => true, 'options' => ['content' => "Le tableau a été supprimée !", 'theme' => 'success'] ]);
    }



    /**
     * Renommer un tableau
     * 
     * Va renommer un tableau
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $tab_token Token du tableau
     * @param string $new_name Nouveau nom
     * @return array
     */

    function tabRename($tab_token = '', $new_name = '') {
        if($new_name !== ''){
            $request = $this -> _db -> exec("UPDATE `pr_task_tab` SET `name` = '$new_name' WHERE `tab_token` = '$tab_token' AND `enable` = '1' ");
            return (['success' => true, 'options' => ['content' => "Le nom a été changé !", 'theme' => 'success'] ]);
        }
        return (['success' => false, 'options' => ['content' => "Le nom est vide !", 'theme' => 'error'] ]);
    }


    /**
     * Assigner un tableau a des équipe
     * 
     * Va assigner un tableau a des équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $tab_token Token du tableau
     * @param string $assigned_teams Les équipes assignés
     * @return array
     */

    function tabAssignTeam($project_token = '', $tab_token = '', $assigned_teams = '') {
        if($assigned_teams !== ''){
            $teams = '';
            foreach($assigned_teams as $team){ 
                $teams .= $team.'|';
            }
            $request = $this -> _db -> exec("UPDATE `pr_task_tab` SET `assigned_teams` = '$teams' WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `enable` = '1' ");
        }else{
            $request = $this -> _db -> exec("UPDATE `pr_task_tab` SET `assigned_teams` = '' WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `enable` = '1' ");

        }
       
    }




    /**
     * Vérifier qu'un tableau est assignée a une team
     * 
     * Va vérifier si un tableau est assignée a une team donnée
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $tab_token Token du tableau
     * @param string $team_token Token de la team
     * @return array
     */
    function tabTeamIsAssigned($project_token, $tab_token, $team_token){
        $request = $this -> _db -> query("SELECT * FROM `pr_task_tab` WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `enable` = '1' ");
        $res = $request->fetch();
        $teams = $res['assigned_teams'];

        if (strpos($teams, $team_token."|") !== false) {
            return true;
        }
        return false;
    }



    /**
     * Récupérer les teams assignés a un tableau
     * 
     * Va récupérer les équipes assignés a un tableau
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $tab_token Token du tableau
     * @return array
     */
    function getTeamAssignedTab($project_token = '', $tab_token = ''){
        $request = $this -> _db -> query("SELECT * FROM `pr_task_tab` WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `enable` = '1' ");
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
     * Assigner un tableau a des membres
     * 
     * Va assigner un tableau a des membres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $tab_token Token du tableau
     * @param string $assigned_teams Les membres assignés
     * @return array
     */

    function tabAssignMember($project_token = '', $tab_token = '', $assigned_members = '') {
        if($assigned_members !== ''){
            $members = '';
            foreach($assigned_members as $member){ 
                $members .= $member.'|';
            }
            $request = $this -> _db -> exec("UPDATE `pr_task_tab` SET `assigned_members` = '$members' WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `enable` = '1' ");
        }else{
            $request = $this -> _db -> exec("UPDATE `pr_task_tab` SET `assigned_members` = '' WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `enable` = '1' ");

        }
    }



    /**
     * Vérifier qu'un tableau est assignée a un membre
     * 
     * Va vérifier si un tableau est assignée a un membre donnée
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $tab_token Token du tableau
     * @param string $team_token Token de l'utilisateur
     * @return array
     */
    function tabMemberIsAssigned($project_token, $tab_token, $user_token){
        $request = $this -> _db -> query("SELECT * FROM `pr_task_tab` WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `enable` = '1' ");
        $res = $request->fetch();
        $users = $res['assigned_members'];

        if (strpos($users, $user_token."|") !== false) {
            return true;
        }
        return false;
    }
    


    /**
     * Récupérer les membres assignés a un tableau
     * 
     * Va récupérer les membres assignés a un tableau
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $tab_token Token du tableau
     * @return array
     */
    function getMemberassignedTab($project_token = '', $tab_token = ''){
        $request = $this -> _db -> query("SELECT * FROM `pr_task_tab` WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `enable` = '1' ");
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



/******************************************************************************/

    /**
     * Récupère les taches d'un tableau
     * 
     * Va renvoyer tout les taches d'un tableau
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $tab_token Token du tableau
     * @return array
     */
    
    function getTabTasks($tab_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `tab_token` = '$tab_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }


    /**
     * Récupère les taches d'un projet
     * 
     * Va renvoyer tout les taches d'un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getAllTasks($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }
    


    /**
     * Créer un tableau
     * 
     * Va créer un tableau pour un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $tab_token Token du tableau
     * @param string $task_name Nom de la tache
     * @param string $deadline Deadline
     * @param string $duration Durée
     * @return array
     */
    
    function newTask($project_token = '', $tab_token = '', $task_name = '', $deadline = '', $duration = '') {
        $tabs = $this -> getTabTasks($tab_token);
        $pos = $tabs['count'];
        $pos ++;
        $task_token = main::generateToken(10, 'uuid');

        $req = $this -> _db -> prepare("INSERT INTO `pr_task_item` (`project_token`, `tab_token`, `task_token`, `position`, `name`, `deadline`, `duration`) VALUES (:project_token, :tab_token, :task_token, :position, :name, :deadline, :duration)");

        $req->bindParam(':project_token', $project_token);
        $req->bindParam(':tab_token', $tab_token);
        $req->bindParam(':task_token', $task_token);
        $req->bindParam(':position', $pos);
        $req->bindParam(':name', $task_name);
        $req->bindParam(':deadline', $deadline);
        $req->bindParam(':duration', $duration);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
        return (['success' => true, 'options' => ['content' => "La tâche a été crée !", 'theme' => 'success'] ]);

    } 
    
    
    
    /**
    * Supprimer une tache d'un tableau
    * 
    * Supprimer une tache d'un tableau
    *
    * @access public
    * @author Mikhaël Bailly
    * @param string $token Token de la tache
    * @return array
    */

   function disableTask($token = '') {
       $request = $this -> _db -> exec("UPDATE `pr_task_item` SET `enable` = 0 WHERE `task_token` = '$token' AND `enable` = '1' ");
       return (['success' => true, 'options' => ['content' => "La tache a été supprimée !", 'theme' => 'success'] ]);
   }



   /**
     * Modifie les infos
     * 
     * Va modifier les infos de la tache
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $name nom
     * @param string $deadline Date de fin attendue
     * @param string $duration Durée prévue
     * @param string $token Token de la tache
     * @return array
     */
    
    function editTask($name = '', $deadline = '', $duration = '', $token = '') {
        $exec = $this -> _db -> exec("UPDATE `pr_task_item` SET `name` = '$name', `deadline` = '$deadline', `duration` = '$duration' WHERE `task_token` = '$token' ");
        return (['success' => true, 'options' => ['content' => "Les informations on été modifiés !", 'theme' => 'success'] ]);
    }
    
    
    
    /**
    * Clore une tache d'un tableau
    * 
    * Clore une tache d'un tableau
    *
    * @access public
    * @author Mikhaël Bailly
    * @param string $token Token de la tache
    * @return array
    */

   function closeTask($token = '') {
        $request = $this -> _db -> exec("UPDATE `pr_task_item` SET `date_end` = NOW() WHERE `task_token` = '$token' AND `enable` = '1' ");
        return (['success' => true, 'options' => ['content' => "La tache a été close !", 'theme' => 'success'] ]);
   }
    
    
    
   /**
   * Ré-ouvrir une tache d'un tableau
   * 
   * Ré-ouvrir une tache d'un tableau
   *
   * @access public
   * @author Mikhaël Bailly
   * @param string $token Token de la tache
   * @return array
   */

    function reopenTask($token = '') {
        $request = $this -> _db -> exec("UPDATE `pr_task_item` SET `date_end` = null WHERE `task_token` = '$token' AND `enable` = '1' ");
        return (['success' => true, 'options' => ['content' => "La tache a été réouverte !", 'theme' => 'success'] ]);
    }



    /**
     * Lance un timer 
     * 
     * Va lancer un timer pour une tache
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @return array
     */

    function launchTimer($project_token = '', $task_token = '') {
        $user_token = main::getToken();
        $this -> stopAllUserTimer($project_token, $task_token);

        $req = $this -> _db -> prepare("INSERT INTO `pr_task_timer` (`project_token`, `task_token`, `user_token`) VALUES (:project_token, :task_token, :user_token)");

        $req->bindParam(':project_token', $project_token);
        $req->bindParam(':task_token', $task_token);
        $req->bindParam(':user_token', $user_token);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
    }



    /**
     * Arrete un timer 
     * 
     * Va arreter le dernier timer de l'user pour une tache
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @param string $time_duration Temps passé
     * @return array
     */

    function stopTimer($project_token = '', $task_token = '', $time_duration = '') {
        $user_token = main::getToken();
        $request = $this -> _db -> exec("UPDATE `pr_task_timer` SET `date_end` = NOW(), `time_duration` = '$time_duration' WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `user_token` = '$user_token' AND `enable` = '1' ORDER BY ID DESC LIMIT 1");
    }


    /**
     * Arrete les timers d'un user 
     * 
     * Va arreter les timers de taches d'un utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @return array
     */

    function stopAllUserTimer($project_token = '', $task_token = '') {
        $user_token = main::getToken();
        $request = $this -> _db -> exec("UPDATE `pr_task_timer` SET `date_end` = NOW(), `time_duration` = '00:00:00' WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `user_token` = '$user_token' AND `enable` = '1' AND `date_end` IS NULL");
    }


    /**
     * Récupérer le timer d'une tache
     * 
     * Va récupérer le timer d'une tache
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @return array
     */
    function getTaskTimer($project_token = '', $task_token = ''){
        $request = $this -> _db -> query("SELECT * FROM `pr_task_timer` WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `date_end` IS NOT NULL AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        $time = date("H:i:s", strtotime('00:00:00'));
        if($count == 0){
            return $time;
        }else{
            foreach($res as $t){
                $time = date("H:i:s", strtotime($time) + strtotime($t['time_duration']) );
            }
            return $time;
        }
    }


    /**
     * Récupérer les timer d'une tache
     * 
     * Va récupérer les timer d'une tache
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @return array
     */
    function getAllTasksTimers($project_token = '', $task_token = ''){
        $request = $this -> _db -> query("SELECT * FROM `pr_task_timer` WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `date_end` IS NOT NULL AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res,
        ]);
    }



    /**
     * Detecte si un timer est lancé pour un user
     * 
     * Va detecter si un timer est lancé pour un user et va retourner le task_token
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    function timerIsLaunched($project_token = ''){
        $user_token = main::getToken();
        $request = $this -> _db -> query("SELECT * FROM `pr_task_timer` WHERE `project_token` = '$project_token' AND `user_token` = '$user_token' AND `date_end` IS NULL AND `enable` = '1' ORDER BY ID DESC LIMIT 1");
        $res = $request->fetch();
        $count = $request->rowCount();

        if($count == 0){
            return false;
        }else{
            return true;
        }
    }
    function getLastTimer($project_token = ''){
        $user_token = main::getToken();
        $request = $this -> _db -> query("SELECT * FROM `pr_task_timer` WHERE `project_token` = '$project_token' AND `user_token` = '$user_token' AND `date_end` IS NULL AND `enable` = '1' ORDER BY ID DESC LIMIT 1");
        $res = $request->fetch();

        return $res['ID'];
    }

    

    /**
     * Assigner une tache a des équipe
     * 
     * Va assigner une tache a des équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @param string $assigned_teams Les équipes assignés
     * @return array
     */

    function assignTeam($project_token = '', $task_token = '', $assigned_teams = '') {
        if($assigned_teams !== ''){
            $teams = '';
            foreach($assigned_teams as $team){ 
                $teams .= $team.'|';
            }
            $request = $this -> _db -> exec("UPDATE `pr_task_item` SET `assigned_teams` = '$teams' WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `enable` = '1' ");
        }else{
            $request = $this -> _db -> exec("UPDATE `pr_task_item` SET `assigned_teams` = '' WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `enable` = '1' ");

        }
       
    }



    /**
     * Vérifier qu'une tache est assignée a une team
     * 
     * Va vérifier si une tache est assignée a une team donnée
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @param string $team_token Token de la team
     * @return array
     */
    function teamIsAssigned($project_token, $task_token, $team_token){
        $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `enable` = '1' ");
        $res = $request->fetch();
        $teams = $res['assigned_teams'];

        if (strpos($teams, $team_token."|") !== false) {
            return true;
        }
        return false;
    }



    /**
     * Récupérer les teams assignés a une tache
     * 
     * Va récupérer les équipes assignés a une tache
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @return array
     */
    function getTeamAssigned($project_token = '', $task_token = ''){
        $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `date_end` IS NULL AND `enable` = '1' ");
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
     * Assigner une tache a des membres
     * 
     * Va assigner une tache a des membres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @param string $assigned_teams Les membres assignés
     * @return array
     */

    function assignMember($project_token = '', $task_token = '', $assigned_members = '') {
        if($assigned_members !== ''){
            $members = '';
            foreach($assigned_members as $member){ 
                $members .= $member.'|';
            }
            $request = $this -> _db -> exec("UPDATE `pr_task_item` SET `assigned_members` = '$members' WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `enable` = '1' ");
        }else{
            $request = $this -> _db -> exec("UPDATE `pr_task_item` SET `assigned_members` = '' WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `enable` = '1' ");

        }
    }



    /**
     * Vérifier qu'une tache est assignée a un membre
     * 
     * Va vérifier si une tache est assignée a un membre donnée
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @param string $team_token Token de l'utilisateur
     * @return array
     */
    function memberIsAssigned($project_token, $task_token, $user_token){
        $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `enable` = '1' ");
        $res = $request->fetch();
        $users = $res['assigned_members'];

        if (strpos($users, $user_token."|") !== false) {
            return true;
        }
        return false;
    }
    


    /**
     * Récupérer les membres assignés a une tache
     * 
     * Va récupérer les membres assignés a une tache
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $task_token Token de la tache
     * @return array
     */
    function getMemberassigned($project_token = '', $task_token = ''){
        $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `task_token` = '$task_token' AND `date_end` IS NULL AND `enable` = '1' ");
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



/******************************************************************************/

    /**
     * Récupère toutes les actions des taches
     * 
     * Va renvoyer toutes les actions des taches pour faire une timeline d'activité
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getActivity($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_task_tab` WHERE `project_token` = '$project_token' AND `enable` = '1' ORDER BY date_creation DESC");
        $res = $request->fetchAll();
        $count = $request->rowCount();
        
        $task_request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `enable` = '1' ORDER BY date_creation DESC");
        $task_res = $task_request->fetchAll();
        $task_count = $task_request->rowCount();

        return ([ 
            'count' => $count + $task_count, 
            'tab_content' => $res,
            'task_content' => $task_res
        ]);
    }


    /**
     * Récupère toutes les actions des taches
     * 
     * Va renvoyer toutes les actions des taches pour faire une timeline d'activité
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $status Status de la tache
     * @param string $removeDay Nombre de jour a retirer
     * @return array
     */
    
    function getActivityPerDate($project_token = '', $status = '', $removeDay) {

        if($status == 'created'){ 
            if($removeDay == 0){
                $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `date_creation` >= CURDATE() AND `enable` = '1'");
            }else{
                $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `date_creation` >= CURDATE() - $removeDay  AND `date_creation` <= CURDATE() - $removeDay + 1 AND `enable` = '1'");
            }
        }else if($status == 'ended'){
            if($removeDay == 0){
                $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `date_end` >= CURDATE() AND `enable` = '1'");
            }else{
                $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `date_end` >= CURDATE() - $removeDay AND `date_end` <= CURDATE() - $removeDay + 1 AND `enable` = '1'");
            }

        }else{
            return ([ 'count' => 0, 'content' => [] ]);
        }
        $count = $request->rowCount();

        return $count;
    }

/******************************************************************************/

}
