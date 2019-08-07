<?php

class projectTeam extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Récupère les équipes
     * 
     * Va renvoyer toutes les équipes
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token de la team
     * @return array
     */
    
    function getTeams($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_team` WHERE `project_token` = '$project_token' AND `enable` = '1'");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }


    /**
     * Récupère les utilisateurs d'une équipe
     * 
     * Va renvoyer tout les utilisateurs d'une équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $team_token Token de la team
     * @return array
     */
    
    function getTeamMembers($team_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_team_member` WHERE `project_team_token` = '$team_token' AND `enable` = '1'");
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
     * Ajoute un user dans une team
     * 
     * Va ajouter un utilisateur dans l'équipe donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $team_token Token de l'équipe du projet
     * @param string $user_token Token de l'utilisateur
     * @param string $project_token Token du projet
     * @return array
     */

    function addMemberTeam($team_token = '', $user_token = '', $project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_team_member` WHERE `project_team_token` = '$team_token' AND `project_token` = '$project_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if(!$res){
            $req = $this -> _db -> prepare("INSERT INTO `pr_project_team_member` (`project_team_token`, `user_public_token`, `project_token`) VALUES (:project_team_token, :user_public_token, :project_token)");

            $req->bindParam(':project_team_token', $team_token);
            $req->bindParam(':user_public_token', $user_token);
            $req->bindParam(':project_token', $project_token);

            $req->execute();
            $count = $req->rowCount();

            if($count !== 1){
                return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
            }else{

                // Log
                $user = main::getToken();
                $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$project_token', '$team_token', 'add-member-team', '$user_token') ");
                return (['success' => true, 'options' => ['content' => "L\'équipe a bien été ajoutée !", 'theme' => 'success'] ]);
            }
        }else{
            return (['success' => false, 'options' => ['content' => "Le membre a déjà l\'équipe !", 'theme' => 'error'] ]);
        }
    } 



    /**
     * Retire un utilisateur d'une équipe du projet
     * 
     * Retire un utilisateur d'une équipe du projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $team_token Token de l'équipe du projet
     * @param string $user_token Token de l'utilisateur
     * @param string $project_token Token du projet
     * @return array
     */

    function kickMember($team_token = '', $user_token = '', $project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_team_member` WHERE `project_team_token` = '$team_token' AND `project_token` = '$project_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("DELETE FROM `pr_project_team_member` WHERE `project_team_token` = '$team_token' AND `project_token` = '$project_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");

            // Log
            $user = main::getToken();
            $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$project_token', '$team_token', 'remove-member-team', '$user_token') ");
            return (['success' => true, 'options' => ['content' => "L\'utilisateur a été retiré !", 'theme' => 'success'] ]);
        }
    }
    
    

    /**
     * Vérifie si le membre a une équipe
     * 
     * Va vérifier si l'utilisateur a une équipe donnée
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $team_token Token de l'équipe du projet
     * @param string $user_token Token de l'utilisateur
     * @return array
     */

    function memberHasTeam($team_token = '', $user_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_team_member` WHERE `project_team_token` = '$team_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if($res){
            return true;
        }else{
            return false;
        }
    }


    /**
     * Récupère l'équipe la plus haute d'un utilisateur
     * 
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'utilisateur
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getHighTeamMember($user_token = '', $project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_team_member` WHERE `user_public_token` = '$user_token' AND `project_token` = '$project_token' AND `enable` = '1' ORDER BY `date_join` ASC LIMIT 1 ");
        $res = $request->fetch();
        $count = $request->rowCount();

        if($count == 0){
            return '';
        }

        return $res['project_team_token'];
    }

/******************************************************************************/



/******************************************************************************/

    /**
     * Créer une équipe dans un projet
     * 
     * Crée une équipe dans un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $name Nom de l'équipe
     * @param string $color Couleur de l'équipe
     * @param string $permissions Permissions
     * @return array
     */

    function createTeam($project_token = '', $name = '', $color = '', $permissions = [] ) {
        $token = $this -> generateToken(10, 'uuid');
        
        $request = $this -> _db -> query("SELECT * FROM `pr_project_team` WHERE `name` = '$name' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if(!$res){
            $perms = '';
            foreach($permissions as $p){ 
                $perms .= $p.'|';
            }

            $request = $this -> _db -> exec("INSERT INTO `pr_project_team` (`name`, `public_token`, `project_token`, `color`, `permissions`) VALUES ('$name', '$token', '$project_token', '$color', '$perms')");
            header('location: ../');
            
            // Log
            $user = main::getToken();
            $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$project_token', '$token', 'create-team', '$') ");
            return (['success' => true, 'options' => ['content' => "L\'équipe a été crée !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Une équipe avec ce même nom existe déjà !", 'theme' => 'error'] ]);
        }
    }
    
    

    /**
     * Modifie les infos
     * 
     * Va modifier les infos de l'équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $name Nom
     * @param string $color Couleur
     * @param string $permissions Permissions
     * @param string $team_token Token de l'équipe
     * @param string $project_token Token du projet
     * @return array
     */
    
    function editTeamInfos($name = '', $color = '', $permissions = '', $team_token = '', $project_token = '') {
        $perms = '';
        foreach($permissions as $p){ 
            $perms .= $p.'|';
        }

        $exec = $this -> _db -> exec("UPDATE `pr_project_team` SET `name` = '$name', `color` = '$color', `permissions` = '$perms' WHERE `public_token` = '$team_token' ");

        // Log
        $user = main::getToken();
        $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$project_token', '$team_token', 'edit-team', '') ");
        return (['success' => true, 'options' => ['content' => "Les informations on été modifiés !", 'theme' => 'success'] ]);
    }
    
    

    /**
     * Supprimer une équipe
     * 
     * Supprimer une équipe en supprimant les membres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @param string $project_token Token du projet
     * @return array
     */

    function disable($token = '', $project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_team` WHERE `public_token` = '$token' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("DELETE FROM `pr_project_team` WHERE `public_token` = '$token'");
            $request = $this -> _db -> exec("DELETE FROM `pr_project_team_member` WHERE `project_team_token` = '$token' AND `project_token` = '$project_token'");

            // Log
            $user = main::getToken();
            $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$project_token', '$token', 'disable-team', '') ");
            return (['success' => true, 'options' => ['content' => "L\'équipe a été supprimée !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Aucune équipe n\'a été trouvée !", 'theme' => 'error'] ]);
        }
    }  

    
/******************************************************************************/


    /**
     * function search($param1, $param2, $param3, $param4)
     * 
     * Cette fonction va retourner une information d'une team donné
     * 
     * @param 1 = le type de recherche (category, product ...)
     * @param 2 = la recherche (id, name ...)
     * @param 3 = le keyword
     * @param 4 = le mode de recherche (strict, like)
     * @return array
     * 
     */
    function search($type, $query, $keyword, $param){
        if($param == 'strict'){
            $request = $this -> _db -> query("SELECT * FROM `$type` WHERE `$query` = '$keyword' ");
        }else{
            $request = $this -> _db -> query("SELECT * FROM `$type` WHERE `$query` LIKE '%$keyword%' ");
        }
        return $request -> fetchAll();
    }
}
