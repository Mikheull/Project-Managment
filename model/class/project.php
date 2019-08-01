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
     * Récupère la liste des membres
     * 
     * Va renvoyer la liste des membres d'un projet donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
 
    function getProjectUser($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_project_member` WHERE `project_token` = '$project_token' AND `enable`  =  '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    } 



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
     * Récupère les projets public
     * 
     * Va renvoyer la liste des projets public
     *
     * @access public
     * @author Mikhaël Bailly
     * @return array
     */
 
    function getPublicProjects() {
        $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `public` = 1 AND `enable` = 1 ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
        return $request->fetch();
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
                   
            // Log
            $user = main::getToken();
            $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$project_token', '$project_token', 'rename-project', '$new_name') ");
            return (['success' => true, 'options' => ['content' => "Le nom a été changé !", 'theme' => 'success'] ]);
        }
        return (['success' => false, 'options' => ['content' => "Le nom est vide !", 'theme' => 'error'] ]);
    
    }

/******************************************************************************/



/******************************************************************************/

    /**
     * Vérifie si un user peut accéder a un projet
     * 
     * Va vérifier si un utilisateur peut accéder a un projet selon le token donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token du projet
     * @param string $user_token Token de l'utilisateur
     * @return array
     */

    function joinProject($token = '', $user_token = '') {

        if($this -> canAcess( $token, $user_token ) == false){
            $request = $this -> _db -> query("SELECT * FROM `pr_project` WHERE `public_token` = '$token' ");
            $res = $request->fetch();
    
            if($res['public'] == true){
                $this -> addUser($token, $user_token);
           
                return (['success' => true, 'options' => ['content' => "Vous avez rejoins le projet publique !", 'theme' => 'success'] ]);
            }else{
                $request = $this -> _db -> query("SELECT * FROM `pr_invitation_project` WHERE `project_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
                $res = $request->fetch();
                if($res){
                    $this -> setInvitationAnswer($token, $user_token, 'accept');
       
                    return (['success' => true, 'options' => ['content' => "Vous avez rejoins le projet !", 'theme' => 'success'] ]);
                }else{
                    return (['success' => true, 'options' => ['content' => "Vous n\'etes pas autorisé a rejoindre ce projet !", 'theme' => 'error'] ]);
                }
            }
        }else{
            return(['success' => false, 'options' => ['content' => "Vous êtes déjà dans le projet !", 'theme' => 'error'] ]);
        }

    } 

    

    /**
     * Modifie les infos
     * 
     * Va modifier les infos du projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $name nom
     * @param string $desc description
     * @param string $status status
     * @param string $token token du projet
     * @return array
     */
    
    function editProjectInfos($name = '', $desc = '', $status = '', $token = '') {
        $exec = $this -> _db -> exec("UPDATE `pr_project` SET `name` = '$name', `description` = '$desc', `public` = '$status' WHERE `public_token` = '$token' ");
               
        // Log
        $user = main::getToken();
        $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$token', '$token', 'edit-project', '') ");
        return (['success' => true, 'options' => ['content' => "Les informations on été modifiés !", 'theme' => 'success'] ]);
    }



    /**
     * Ajoute un user dans un projet
     * 
     * Va ajouter un utilisateur dans le projet donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @param string $user_token Token de l'utilisateur
     * @return array
     */

    function addUser($token = '', $user_token = '') {

        $req = $this -> _db -> prepare("INSERT INTO `pr_project_member` (`project_token`, `user_public_token`) VALUES (:project_token, :user_public_token)");

        $req->bindParam(':project_token', $token);
        $req->bindParam(':user_public_token', $user_token);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
               
        // Log
        $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user_token', '$token', '$token', 'join-project', '') ");
    }  



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
                return (['success' => true, 'options' => ['content' => "L\'utilisateur est déjà dans le projet !", 'theme' => 'error'] ]);
            }else{

                $request = $this -> _db -> query("SELECT * FROM `pr_invitation_project` WHERE `project_token` = '$project_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
                $res = $request->fetch();
                if($res){
                    return (['success' => false, 'options' => ['content' => "Une invitation lui a déjà été envoyé !", 'theme' => 'success'] ]);
                }else{
                    $request = $this -> _db -> exec("INSERT INTO `pr_invitation_project` (`project_token`, `user_public_token`, `message`) VALUES ('$project_token', '$user_token', '$message')");
                    
                    $notif_content = 
                        [
                            'sender' => main::getToken(),
                            'message' => '%sender% vous a inviter dans un projet'
                        ];
                    $notif_content = json_encode($notif_content);
                    $exec = $this -> _db -> exec("INSERT INTO `imp_notification`( `user_public_token`, `type`, `content`) VALUES ('$user_token', 'project_invite', '$notif_content') ");
        
                    // Log
                    $user = main::getToken();
                    $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$project_token', '$project_token', 'invite-project', '$user_token') ");
                    return (['success' => true, 'options' => ['content' => "Vous avez envoyer l\'invitation !", 'theme' => 'success'] ]);
                }
                
            }
        }else{
            return (['success' => true, 'options' => ['content' => "Aucun utilisateur trouvé !", 'theme' => 'error'] ]);
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

        $request = $this -> _db -> query("SELECT * FROM `pr_invitation_project` WHERE `project_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("UPDATE `pr_invitation_project` SET `enable`= 0, `date_end`= NOW() WHERE `project_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            
            if($choose == 'accept'){
                $request = $this -> _db -> exec("INSERT INTO `pr_project_member` (`project_token`, `user_public_token`) VALUES ('$token', '$user_token')");

                // Log
                $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user_token', '$token', '$token', 'accept-invitation-project', '') ");
                return (['success' => true, 'options' => ['content' => "Vous avez accepter l\'invitation !", 'theme' => 'success'] ]);
            }else if($choose == 'decline'){
                return (['success' => true, 'options' => ['content' => "Vous avez refuser l\'invitation !", 'theme' => 'success'] ]);
            }
        }

        return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
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
            $request = $this -> _db -> exec("INSERT INTO `pr_project_member` (`user_public_token`, `project_token`, `role`, `permissions`) VALUES ('$owner', '$token', '1', '*')");
            
            foreach($invitations as $invite){
                $invite = $invite;
                $this -> inviteMember($invite, $token);
            }

            header('location: ../project/'. $token);

            if(!is_dir('dist/uploads/p/'.$token.'/docs/')){
                mkdir('dist/uploads/p/'.$token.'/docs/', 0777, true);
                fopen('dist/uploads/p/'.$token.'/docs/index.php', "w");
            }

            // Log
            $user = main::getToken();
            $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$token', '$token', 'create-project', '') ");
            return (['success' => true, 'options' => ['content' => "Le projet a été crée !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Un projet avec ce même nom existe déjà !", 'theme' => 'error'] ]);
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
            
            // Log
            $user = main::getToken();
            $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$token', '$token', 'disable-project', '') ");
            return (['success' => true, 'options' => ['content' => "Le projet a été supprimée !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Aucun projet n\'a été trouvée !", 'theme' => 'error'] ]);
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
            
            // Log
            $user = main::getToken();
            $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$token', '$token', 'archive-project', '') ");
            return (['success' => true, 'options' => ['content' => "Le projet a été archivé !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Aucune équipe n\'a été trouvée !", 'theme' => 'error'] ]);
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
    
            // Log
            $user = main::getToken();
            $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$token', '$token', 'unarchive-project', '') ");
            return (['success' => true, 'options' => ['content' => "Le projet a été désarchivé !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Aucune équipe n\'a été trouvée !", 'theme' => 'error'] ]);
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

            // Log
            $user = main::getToken();
            $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `project_token`, `ref_token`, `type`, `optional`) VALUES ('$user', '$project_token', '$project_token', 'kick-member-project', '$user_token') ");
            return (['success' => true, 'options' => ['content' => "L\'utilisateur a été retiré !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "L\'utilisateur n\'est pas dans le projet !", 'theme' => 'error'] ]);
        }
    } 


/******************************************************************************/

}
