<?php

class project extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }


/******************************************************************************/

    /**
     * Récupère les projets d'un utilisateur
     * 
     * Va renvoyer tout les projets d'un utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'utilisateur
     * @return array
     */
    
    function getUserProject($user_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_member` WHERE `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }
 

    /**
     * Récupère les projets archivés d'un utilisateur
     * 
     * Va renvoyer tout les projets archivés d'un utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'utilisateur
     * @return array
     */
    
    function getUserProjectArchived($user_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `founder_token` = '$user_token' AND `enable` = '0' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }
 


    /**
     * Récupère les invitations de projet d'un utilisateur
     * 
     * Va renvoyer toutes les invitations de projet pas encore acceptées ou refusées d'un utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'utilisateur
     * @return array
     */

    function getUserProjectInvitations($user_token) {
        $request = $this -> _db -> query("SELECT * FROM `pr_invitation_project` WHERE `user_public_token` = '$user_token' AND `enable`  =  '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    } 


    
    /**
     * Récupère les utilisateurs d'un projet
     * 
     * Va renvoyer tout les utilisateurs d'un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token de la project
     * @return array
     */
    
    function getProjectMembers($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_member` WHERE `project_token` = '$project_token' AND `enable` = '1'");
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
     * Récupère une information d'un projet donné
     * 
     * Va renvoyer une information d'un projet donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $info Information a récupérer
     * @return var
     */
 
    function getProjectData($project_token = '', $info = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `public_token` = '$project_token' ");
        $res = $request->fetch();

        return $res[$info];
    } 



    /**
     * Vérifie si un projet existe
     * 
     * Va vérifier si un project existe selon un token donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token du projet
     * @return boolean
     */

    function projectExist($token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `public_token` = '$token' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    } 



    /**
     * Vérifie si un user a accès a un projet
     * 
     * Va vérifier si un utilisateur a accès a un projet selon le token donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token du projet
     * @param string $user_token Token de l'utilisateur
     * @return boolean
     */

    function canAcess($token = '', $user_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_member` WHERE `project_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    }  



    /**
     * Renommer un projet
     * 
     * Va renommer un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $new_name Nouveau nom
     * @return array
     */

    function projectRename($project_token = '', $new_name = '') {
        if($new_name !== ''){
            $request = $this -> _db -> exec("UPDATE `pr_project` SET `name` = '$new_name' WHERE `public_token` = '$project_token' ");
            return (['success' => true, 'message' => ['text' => "Le nom a été changé !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }
        return (['success' => false, 'message' => ['text' => "Le nom est vide !", 'theme' => 'dark', 'timeout' => 2000] ]);
    
    }

/******************************************************************************/



/******************************************************************************/

    /**
     * Invite un membre
     * 
     * Invite un utilisateur dans un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_mail Mail de l'utilisateur
     * @param string $project_token Token du projet
     * @param string $message Message customisé
     * @return array
     */

    function inviteMember($user_mail = '', $project_token = '', $message = '') { 
        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `mail` = '$user_mail' ");
        $res = $request->fetch();

        if($res){
            $user_token = $res['public_token'];
            
            $request = $this -> _db -> query("SELECT * FROM `pr_project_member` WHERE `project_token` = '$project_token' AND `user_public_token` = '$user_token' ");
            $res = $request->fetch();

            if($res){
                return (['success' => true, 'message' => ['text' => "L\'utilisateur est déjà dans le projet !", 'theme' => 'dark', 'timeout' => 2000] ]);
            }else{

                $request = $this -> _db -> query("SELECT * FROM `pr_invitation_project` WHERE `project_token` = '$project_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
                $res = $request->fetch();
                if($res){
                    return (['success' => false, 'message' => ['text' => "Une invitation lui a déjà été envoyé !", 'theme' => 'dark', 'timeout' => 2000] ]);
                }else{
                    $request = $this -> _db -> exec("INSERT INTO `pr_invitation_project` (`project_token`, `user_public_token`, `message`) VALUES ('$project_token', '$user_token', '$message')");
                    return (['success' => true, 'message' => ['text' => "Vous avez envoyer l\'invitation !", 'theme' => 'dark', 'timeout' => 2000] ]);
                }
                
            }
        }else{
            return (['success' => true, 'message' => ['text' => "Aucun utilisateur trouvé !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }
   
    }



    /**
     * Envoi une réponse a une invation de projet
     * 
     * Défini si l'utilisateur accepte ou refuse une invitation de projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token du projet
     * @param string $user_token Token de l'utilisateur
     * @param string $choose le choix (accept, decline)
     * @return array
     */

    function setInvitationAnswer($token = '', $user_token = '', $choose = '') {
        setlocale(LC_TIME, "fr_FR");
        $date = date("Y-m-d H:i:s");

        $request = $this -> _db -> query("SELECT * FROM `pr_invitation_project` WHERE `project_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("UPDATE `pr_invitation_project` SET `enable`= 0, `date_end`= '$date' WHERE `project_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            
            if($choose == 'accept'){
                $request = $this -> _db -> exec("INSERT INTO `pr_project_member` (`project_token`, `user_public_token`) VALUES ('$token', '$user_token')");
                return (['success' => true, 'message' => ['text' => "Vous avez accepter l\'invitation !", 'theme' => 'dark', 'timeout' => 2000] ]);
            }else if($choose == 'decline'){
                return (['success' => true, 'message' => ['text' => "Vous avez refuser l\'invitation !", 'theme' => 'dark', 'timeout' => 2000] ]);
            }
        }

        return (['success' => false, 'message' => ['text' => "Une erreur est survenue !", 'theme' => 'dark', 'timeout' => 2000] ]);
    }  


    /**
     * Créer un projet
     * 
     * Crée un projet en ajoutant le créateur dedans
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $name Nom du projet
     * @param string $desc Description du projet
     * @param string $status Publique ou privée
     * @param string $invitations Mails d'invitations
     * @return array
     */

    function createProject($name = '', $desc = '', $status = '', $invitations = [] ) {
        $owner = main::getToken();
        $token = $this -> generateToken(10, 'numbers');
        $status_team = ( $status == 'public' ? 1 : 0 );
        
        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `name` = '$name' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if(!$res){
            $request = $this -> _db -> exec("INSERT INTO `pr_project` (`name`, `description`, `public_token`, `public`, `founder_token`) VALUES ('$name', '$desc', '$token', '$status_team', '$owner')");
            $request = $this -> _db -> exec("INSERT INTO `pr_project_member` (`user_public_token`, `project_token`, `role`) VALUES ('$owner', '$token', '1')");
            
            foreach($invitations as $invite){
                $invite = htmlentities(addslashes($invite));
                $this -> inviteMember($invite, $token);
            }

            header('location: ../project/'. $token);
            return (['success' => true, 'message' => ['text' => "Le projet a été crée !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }else{
            return (['success' => false, 'message' => ['text' => "Un projet avec ce même nom existe déjà !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }
    }
    

    
    /**
     * Supprimer un projet
     * 
     * Supprimer un projet en supprimant les membres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @return array
     */

    function disable($token = '') {
        $owner = main::getToken();
        
        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `public_token` = '$token' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("DELETE FROM `pr_project` WHERE `public_token` = '$token' AND `founder_token` = '$owner'");
            $request = $this -> _db -> exec("DELETE FROM `pr_project_member` WHERE `project_token` = '$token'");
            
            return (['success' => true, 'message' => ['text' => "Le projet a été supprimée !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }else{
            return (['success' => false, 'message' => ['text' => "Aucun projet n\'a été trouvée !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }
    } 



    /**
     * Archiver un projet
     * 
     * Archiver un projet temporairement en gardant les membres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token du projet
     * @return array
     */

    function archive($token = '') {
        $owner = $this -> getToken();
        
        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `public_token` = '$token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("UPDATE `pr_project` SET `enable`= 0 WHERE `public_token` = '$token' AND `founder_token` = '$owner' AND `enable` = '1' ");
            $request = $this -> _db -> exec("UPDATE `pr_project_member` SET `enable`= 0 WHERE `project_token` = '$token' AND `enable` = '1' ");
            
            return (['success' => true, 'message' => ['text' => "Le projet a été archivé !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }else{
            return (['success' => false, 'message' => ['text' => "Aucune équipe n\'a été trouvée !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }
    } 
    
    

    /**
     * Désarchiver un projet
     * 
     * Désarchiver un projet en remettant les membres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token du projet
     * @return array
     */

    function unarchive($token = '') {
        $owner = $this -> getToken();
        
        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `public_token` = '$token' AND `enable` = '0' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("UPDATE `pr_project` SET `enable`= 1 WHERE `public_token` = '$token' AND `founder_token` = '$owner' AND `enable` = '0' ");
            $request = $this -> _db -> exec("UPDATE `pr_project_member` SET `enable`= 1 WHERE `project_token` = '$token' AND `enable` = '0' ");
            
            return (['success' => true, 'message' => ['text' => "Le projet a été désarchivé !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }else{
            return (['success' => false, 'message' => ['text' => "Aucune équipe n\'a été trouvée !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }
    }    
    


   /**
     * Retire un utilisateur d'un projet
     * 
     * Retire un utilisateur d'un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $user_token Token de l'utilisateur
     * @return array
     */

    function kickMember($project_token = '', $user_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_member` WHERE `project_token` = '$project_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("DELETE FROM `pr_project_member` WHERE `project_token` = '$project_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            header('location: ');
            return (['success' => true, 'message' => ['text' => "L\'utilisateur a été retiré !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }else{
            return (['success' => false, 'message' => ['text' => "L\'utilisateur n\'est pas dans le projet !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }
    } 


/******************************************************************************/

}
