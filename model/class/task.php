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
        $now = date("Y-m-d H:i:s");
        $request = $this -> _db -> exec("UPDATE `pr_task_item` SET `date_end` = '$now' WHERE `task_token` = '$token' AND `enable` = '1' ");
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
        $now = date("Y-m-d H:i:s");
        $request = $this -> _db -> exec("UPDATE `pr_task_item` SET `date_end` = null WHERE `task_token` = '$token' AND `enable` = '1' ");
        return (['success' => true, 'options' => ['content' => "La tache a été réouverte !", 'theme' => 'success'] ]);
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

/******************************************************************************/

}
