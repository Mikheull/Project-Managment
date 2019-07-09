<?php

class team extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Récupère les équipes d'un utilisateur
     * 
     * Va renvoyer toutes les équipes d'un utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'utilisateur
     * @return array
     */
    
    function getUserTeam($user_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_team_member` WHERE `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }
 

    /**
     * Récupère les équipes archivés d'un utilisateur
     * 
     * Va renvoyer toutes les équipes archivés d'un utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'utilisateur
     * @return array
     */
    
    function getUserTeamArchived($user_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `founder_token` = '$user_token' AND `enable` = '0' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }



    /**
     * Récupère les invitations d'équipe d'un utilisateur
     * 
     * Va renvoyer toutes les invitations d'équipes pas encore acceptées ou refusées d'un utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'utilisateur
     * @return array
     */

    function getUserTeamInvitations($user_token) {
        $request = $this -> _db -> query("SELECT * FROM `pr_invitation_team` WHERE `user_public_token` = '$user_token' AND `enable`  =  '1' ");
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
        $request = $this -> _db -> query("SELECT * FROM `pr_team_member` WHERE `team_token` = '$team_token' AND `enable` = '1'");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }


    
    /**
     * Récupère la date d'ajout d'un utilisateur dans une équipe
     * 
     * Va renvoyer la date d'ajout d'un utilisateur dans une équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $team_token Token de la team
     * @param string $user_token Token de l'utilisateur'
     * @return var
     */
    
    function getMemberJoinDate($team_token = '', $user_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_team_member` WHERE `team_token` = '$team_token' AND `user_public_token` = '$user_token' AND `enable` = '1'");
        $res = $request->fetch();

        return $res['date_joined'];
    }

/******************************************************************************/



/******************************************************************************/

    /**
     * Récupère une information d'une team donnée
     * 
     * Va renvoyer une information d'une équipe donnée
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $team_token Token de l'équipe
     * @param string $info Information a récupérer
     * @return var
     */
 
    function getTeamData($team_token = '', $info = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public_token` = '$team_token' ");
        $res = $request->fetch();

        return $res[$info];
    }
    
    

    /**
     * Récupère les équipes dont on est créateur
     * 
     * Va renvoyer la liste de nos équipes
     *
     * @access public
     * @author Mikhaël Bailly
     * @return var
     */
 
    function getOwnedTeam() {
        $owner = main::getToken();
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `founder_token` = '$owner' AND `enable` = 1 ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
        return $request->fetch();
    }



    /**
     * Récupère les équipes publiques
     * 
     * Va renvoyer la liste des équipes publiques
     *
     * @access public
     * @author Mikhaël Bailly
     * @return array
     */
 
    function getPublicTeams() {
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public` = 1 AND `enable` = 1 ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
        return $request->fetch();
    }



    /**
     * Vérifie si une équipe existe
     * 
     * Va vérifier si une équipe existe selon un token donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @return boolean
     */

    function teamExist($token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public_token` = '$token' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    } 

 

    /**
     * Vérifie si un user a accès a une team
     * 
     * Va vérifier si un utilisateur a accès a une équipe selon le token donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @param string $user_token Token de l'utilisateur
     * @return boolean
     */

    function canAcess($token = '', $user_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_team_member` WHERE `team_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    }
    
    
    /**
     * Modifie les infos
     * 
     * Va modifier les infos de l'équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $name nom
     * @param string $desc description
     * @param string $status status
     * @param string $token token de l'équipe
     * @return array
     */
    
    function editTeamInfos($name = '', $desc = '', $status = '', $token = '') {
        $exec = $this -> _db -> exec("UPDATE `pr_team` SET `name` = '$name', `description` = '$desc', `public` = '$status' WHERE `public_token` = '$token' ");
        return (['success' => true, 'options' => ['content' => "Les informations on été modifiés !", 'theme' => 'success'] ]);
    }

/******************************************************************************/



/******************************************************************************/

    /**
     * Vérifie si un user peut accéder a team
     * 
     * Va vérifier si un utilisateur peut accéder a une équipe selon le token donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @param string $user_token Token de l'utilisateur
     * @return array
     */

    function joinTeam($token = '', $user_token = '') {

        if($this -> canAcess( $token, $user_token ) == false){
            $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public_token` = '$token' ");
            $res = $request->fetch();
    
            if($res['public'] == true){
                $this -> addUser($token, $user_token);
    
                return (['success' => true, 'options' => ['content' => "Vous avez rejoins l\'équipe publique !", 'theme' => 'success'] ]);
            }else{
                $request = $this -> _db -> query("SELECT * FROM `pr_invitation_team` WHERE `team_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
                $res = $request->fetch();
                if($res){
                    $this -> setInvitationAnswer($token, $user_token, 'accept');

                    return (['success' => true, 'options' => ['content' => "Vous avez rejoins l\'équipe !", 'theme' => 'success'] ]);
                }else{
                    return (['success' => true, 'options' => ['content' => "Vous n\'etes pas autorisé a rejoindre cette équipe !", 'theme' => 'error'] ]);
                }
            }
        }else{
            return(['success' => false, 'options' => ['content' => "Vous êtes déjà dans l\'équipe !", 'theme' => 'error'] ]);
        }

    } 



    /**
     * Ajoute un user dans une team
     * 
     * Va ajouter un utilisateur dans l'équipe donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @param string $user_token Token de l'utilisateur
     * @return array
     */

    function addUser($token = '', $user_token = '') {

        $req = $this -> _db -> prepare("INSERT INTO `pr_team_member` (`team_token`, `user_public_token`) VALUES (:team_token, :user_public_token)");

        $req->bindParam(':team_token', $token);
        $req->bindParam(':user_public_token', $user_token);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
    }  



    /**
     * Renommer une équipe
     * 
     * Va renommer une équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $team_token Token de l'équipe
     * @param string $new_name Nouveau nom
     * @return array
     */

    function teamRename($team_token = '', $new_name = '') {
        if($new_name !== ''){
            $request = $this -> _db -> exec("UPDATE `pr_team` SET `name` = '$new_name' WHERE `public_token` = '$team_token' ");
            return (['success' => true, 'options' => ['content' => "Le nom a été changé !", 'theme' => 'success'] ]);
        }
        return (['success' => false, 'options' => ['content' => "Le nom est vide !", 'theme' => 'error'] ]);
    
    }

/******************************************************************************/



/******************************************************************************/

    /**
     * Invite un membre
     * 
     * Invite un utilisateur dans une équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_mail Mail de l'utilisateur
     * @param string $team_token Token de la team
     * @param string $message Message customisé
     * @return array
     */

    function inviteMember($user_mail = '', $team_token = '', $message = '') { 
        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `mail` = '$user_mail' ");
        $res = $request->fetch();

        if($res){
            $user_token = $res['public_token'];
            
            $request = $this -> _db -> query("SELECT * FROM `pr_team_member` WHERE `team_token` = '$team_token' AND `user_public_token` = '$user_token' ");
            $res = $request->fetch();

            if($res){
                return (['success' => true, 'options' => ['content' => "L\'utilisateur est déjà dans l\'équipe !", 'theme' => 'error'] ]);
            }else{

                $request = $this -> _db -> query("SELECT * FROM `pr_invitation_team` WHERE `team_token` = '$team_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
                $res = $request->fetch();
                if($res){
                    return (['success' => false, 'options' => ['content' => "Une invitation lui a déjà été envoyé !", 'theme' => 'error'] ]);
                }else{
                    $request = $this -> _db -> exec("INSERT INTO `pr_invitation_team` (`team_token`, `user_public_token`, `message`) VALUES ('$team_token', '$user_token', '$message')");
                    return (['success' => true, 'options' => ['content' => "Vous avez envoyer l\'invitation !", 'theme' => 'success'] ]);
                }
                
            }
        }else{
            return (['success' => true, 'options' => ['content' => "Aucun utilisateur trouvé !", 'theme' => 'error'] ]);
        }
   
    }



    /**
     * Envoi une réponse a une invation d'équipe
     * 
     * Défini si l'utilisateur accepte ou refuse une invitation d'équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @param string $user_token Token de l'utilisateur
     * @param string $choose le choix (accept, decline)
     * @return array
     */

    function setInvitationAnswer($token = '', $user_token = '', $choose = '') {
        setlocale(LC_TIME, "fr_FR");
        $date = date("Y-m-d H:i:s");

        $request = $this -> _db -> query("SELECT * FROM `pr_invitation_team` WHERE `team_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("UPDATE `pr_invitation_team` SET `enable`= 0, `date_end`= '$date' WHERE `team_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            
            if($choose == 'accept'){
                $request = $this -> _db -> exec("INSERT INTO `pr_team_member` (`team_token`, `user_public_token`) VALUES ('$token', '$user_token')");
                return (['success' => true, 'options' => ['content' => "Vous avez accepter l\'invitation !", 'theme' => 'success'] ]);
            }else if($choose == 'decline'){
                return (['success' => true, 'options' => ['content' => "Vous avez refuser l\'invitation !", 'theme' => 'success'] ]);
            }
        }

        return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
    }  



    /**
     * Créer une équipe
     * 
     * Crée une équipe en ajoutant le créateur dedans
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $name Nom de l'équipe
     * @param string $desc Description de l'équipe
     * @param string $status Publique ou privée
     * @param string $invitations Mails d'invitations
     * @return array
     */

    function createTeam($name = '', $desc = '', $status = '', $invitations = [] ) {
        $owner = $this -> getToken();
        $token = $this -> generateToken(10, 'numbers');
        $status_team = ( $status == 'public' ? 1 : 0 );
        
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `name` = '$name' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if(!$res){
            $request = $this -> _db -> exec("INSERT INTO `pr_team` (`name`, `description`, `public_token`, `public`, `founder_token`) VALUES ('$name', '$desc', '$token', '$status_team', '$owner')");
            $request = $this -> _db -> exec("INSERT INTO `pr_team_member` (`user_public_token`, `team_token`, `role`) VALUES ('$owner', '$token', '1')");
            
            foreach($invitations as $invite){
                $invite = cleanVar($invite);
                $this -> inviteMember($invite, $token);
            }

            header('location: ../team/'. $token);
            return (['success' => true, 'options' => ['content' => "L\'équipe a été crée !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Une équipe avec ce même nom existe déjà !", 'theme' => 'error'] ]);
        }
    } 
    
    

    /**
     * Supprimer une équipe
     * 
     * Supprimer une équipe en supprimant les membres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @return array
     */

    function disable($token = '') {
        $owner = $this -> getToken();
        
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public_token` = '$token' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("DELETE FROM `pr_team` WHERE `public_token` = '$token' AND `founder_token` = '$owner'");
            $request = $this -> _db -> exec("DELETE FROM `pr_team_member` WHERE `team_token` = '$token'");
            
            return (['success' => true, 'options' => ['content' => "L\'équipe a été supprimée !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Aucune équipe n\'a été trouvée !", 'theme' => 'error'] ]);
        }
    }
    
    

    /**
     * Archiver une équipe
     * 
     * Archiver une équipe temporairement en gardant les membres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @return array
     */

    function archive($token = '') {
        $owner = $this -> getToken();
        
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public_token` = '$token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("UPDATE `pr_team` SET `enable`= 0 WHERE `public_token` = '$token' AND `founder_token` = '$owner' AND `enable` = '1' ");
            $request = $this -> _db -> exec("UPDATE `pr_team_member` SET `enable`= 0 WHERE `team_token` = '$token' AND `enable` = '1' ");
            
            return (['success' => true, 'options' => ['content' => "L\'équipe a été archivé !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Aucune équipe n\'a été trouvée !", 'theme' => 'error'] ]);
        }
    } 
    
    

    /**
     * Désarchiver une équipe
     * 
     * Désarchiver une équipe en remettant les membres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'équipe
     * @return array
     */

    function unarchive($token = '') {
        $owner = $this -> getToken();
        
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public_token` = '$token' AND `enable` = '0' ");
        $res = $request->fetch();
        
        if($res){
            $request = $this -> _db -> exec("UPDATE `pr_team` SET `enable`= 1 WHERE `public_token` = '$token' AND `founder_token` = '$owner' AND `enable` = '0' ");
            $request = $this -> _db -> exec("UPDATE `pr_team_member` SET `enable`= 1 WHERE `team_token` = '$token' AND `enable` = '0' ");
            
            return (['success' => true, 'options' => ['content' => "L\'équipe a été désarchivé !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Aucune équipe n\'a été trouvée !", 'theme' => 'error'] ]);
        }
    }    
    
    

    /**
     * Retire un utilisateur d'une équipe
     * 
     * Retire un utilisateur d'une équipe
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $team_token Token de l'équipe
     * @param string $user_token Token de l'utilisateur
     * @return array
     */

    function kickMember($team_token = '', $user_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_team_member` WHERE `team_token` = '$team_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if($res){
            // $request = $this -> _db -> exec("UPDATE `pr_team_member` SET `enable`= 0 WHERE `team_token` = '$team_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            $request = $this -> _db -> exec("DELETE FROM `pr_team_member` WHERE `team_token` = '$team_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            return (['success' => true, 'options' => ['content' => "L\'utilisateur a été retiré !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "L\'utilisateur n\'est pas dans l\'équipe !", 'theme' => 'error'] ]);
        }
    } 
    

    
/******************************************************************************/

}
