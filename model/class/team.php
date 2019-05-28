<?php

class team extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Récupère les équipe d'un utilisateur
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
    
                return (['success' => true, 'message' => ['text' => "Vous avez rejoins l\'équipe publique !", 'theme' => 'dark', 'timeout' => 2000] ]);
            }else{
                $request = $this -> _db -> query("SELECT * FROM `pr_invitation_team` WHERE `team_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
                $res = $request->fetch();
                if($res){
                    $this -> addUser($token, $user_token);

                    return (['success' => true, 'message' => ['text' => "Vous avez rejoins l\'équipe !", 'theme' => 'dark', 'timeout' => 2000] ]);
                }else{
                    return (['success' => true, 'message' => ['text' => "Vous n etes pas autorisé a rejoindre cette équipe !", 'theme' => 'dark', 'timeout' => 2000] ]);
                }
            }
        }else{
            $errors = ['success' => false, 'message' => ['text' => "Vous êtes déjà dans l\'équipe !", 'theme' => 'dark', 'timeout' => 2000] ];
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
            return (['success' => false, 'message' => ['text' => "Une erreur est survenue !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }
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
                return (['success' => true, 'message' => ['text' => "L\'utilisateur est déjà dans l\'équipe !", 'theme' => 'dark', 'timeout' => 2000] ]);
            }else{

                $request = $this -> _db -> query("SELECT * FROM `pr_invitation_team` WHERE `team_token` = '$team_token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
                $res = $request->fetch();
                if($res){
                    return (['success' => false, 'message' => ['text' => "Une invitation lui a déjà été envoyé !", 'theme' => 'dark', 'timeout' => 2000] ]);
                }else{
                    $request = $this -> _db -> exec("INSERT INTO `pr_invitation_team` (`team_token`, `user_public_token`, `message`) VALUES ('$team_token', '$user_token', '$message')");
                    return (['success' => true, 'message' => ['text' => "Vous avez envoyer l\'invitation !", 'theme' => 'dark', 'timeout' => 2000] ]);
                }
                
            }
        }else{
            return (['success' => true, 'message' => ['text' => "Aucun utilisateur trouvé !", 'theme' => 'dark', 'timeout' => 2000] ]);
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
                return (['success' => true, 'message' => ['text' => "Vous avez accepter l\'invitation !", 'theme' => 'dark', 'timeout' => 2000] ]);
            }else if($choose == 'decline'){
                return (['success' => true, 'message' => ['text' => "Vous avez refuser l\'invitation !", 'theme' => 'dark', 'timeout' => 2000] ]);
            }
        }

        return (['success' => false, 'message' => ['text' => "Une erreur est survenue !", 'theme' => 'dark', 'timeout' => 2000] ]);
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
     * @return array
     */

    function createTeam($name = '', $desc = '', $status = '') {
        $owner = $this -> getToken();
        $token = $this -> generateToken(10, 'numbers');
        $status_team = ( $status == 'public' ? 1 : 0 );
        
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `name` = '$name' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if(!$res){
            $request = $this -> _db -> exec("INSERT INTO `pr_team` (`name`, `description`, `public_token`, `public`, `founder_token`) VALUES ('$name', '$desc', '$token', '$status_team', '$owner')");
            $request = $this -> _db -> exec("INSERT INTO `pr_team_member` (`user_public_token`, `team_token`, `role`) VALUES ('$owner', '$token', '1')");
            
            header('location: team/'. $token);
            return (['success' => true, 'message' => ['text' => "L\'équipe a été crée !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }else{
            return (['success' => false, 'message' => ['text' => "Une équipe avec ce même nom existe déjà !", 'theme' => 'dark', 'timeout' => 2000] ]);
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
        
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public_token` = '$token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        if($res){

            $request = $this -> _db -> exec("UPDATE `pr_team` SET `enable`= 0 WHERE `public_token` = '$token' AND `founder_token` = '$owner' AND `enable` = '1' ");
            $request = $this -> _db -> exec("UPDATE `pr_team_member` SET `enable`= 0 WHERE `team_token` = '$token' AND `enable` = '1' ");
            
            return (['success' => true, 'message' => ['text' => "L\'équipe a été supprimée !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }else{
            return (['success' => false, 'message' => ['text' => "Aucune équipe n\'a été trouvée !", 'theme' => 'dark', 'timeout' => 2000] ]);
        }
    }  
    

    
/******************************************************************************/

}
