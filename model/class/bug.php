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

}
