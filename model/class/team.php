<?php

class team extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

    
/**
 * function getUserTeam($user_token)
 * 
 * Renvoi les équipes d'un utilisateur
 * @param 1 = Le token utilisateur
 * @return array
*/
    
function getUserTeam($user_token) {
    $request = $this -> _db -> query("SELECT * FROM `pr_team_member` WHERE `user_public_token` = '$user_token' ");
    $res = $request->fetchAll();
    $count = $request->rowCount();

    return ([ 
        'count' => $count, 
        'content' => $res
    ]);
}  
 

/**
 * function getUserTeamInvitations($user_token)
 * 
 * Renvoi les invitations d'équipes d'un utilisateur
 * @param 1 = Le token utilisateur
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
 * function getDataFromTeamToken($team_token, $info)
 * 
 * Récupère une information d'une team donnée
 * @param 1 = Le token de la team
 * @param 2 = L'information
 * @return var
*/
    
    function getDataFromTeamToken($team_token, $info) {
        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public_token` = '$team_token' ");
        $res = $request->fetch();

        return $res[$info];
    }  



/**
 * function checkIfTeamExist($token)
 * 
 * Vérifie si une team existe dans la BDD
 * @param 1 = Le token de la team
 * @return boolean
*/
    
    function checkIfTeamExist($token) {

        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public_token` = '$token' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    } 


/**
 * function canAcess($token, $user_token)
 * 
 * Vérifie si un user peut accéder a team
 * @param 1 = Le token de la team
 * @param 1 = Le token de l'user
 * @return boolean
*/
    function canAcess($token, $user_token) {

        $request = $this -> _db -> query("SELECT * FROM `pr_team_member` WHERE `team_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    } 


/**
 * function try_join($token, $user_token)
 * 
 * Vérifie si un user peut accéder a team
 * @param 1 = Le token de la team
 * @param 1 = Le token de l'user
 * @return boolean
*/
    function try_join($token, $user_token) {

        $request = $this -> _db -> query("SELECT * FROM `pr_team` WHERE `public_token` = '$token' ");
        $res = $request->fetch();

        if($res['public'] == true){
            $this -> join_user($token, $user_token);

            return (['success' => true, 'message' => ['text' => 'Vous avez rejoins l équipe publique !', 'theme' => 'dark', 'timeout' => 2000] ]);
        }else{
            $request = $this -> _db -> query("SELECT * FROM `pr_invitation_team` WHERE `team_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            $res = $request->fetch();
            if($res){
                $this -> join_user($token, $user_token);
                return (['success' => true, 'message' => ['text' => 'Vous avez rejoins l équipe !', 'theme' => 'dark', 'timeout' => 2000] ]);
            }else{
                return (['success' => true, 'message' => ['text' => 'Vous n etes pas autorisé a rejoindre cette équipe !', 'theme' => 'dark', 'timeout' => 2000] ]);
            }
        }

        
    } 


  
/**
 * function join_user($token, $user_token)
 * 
 * Ajoute un user dans une team
 * @param 1 = Le token de la team
 * @param 1 = Le token de l'user
 * @return array
*/
    function join_user($token, $user_token) {

        $req = $this -> _db -> prepare("INSERT INTO `pr_team_member` (`team_token`, `user_public_token`) VALUES (:team_token, :user_public_token)");

        $req->bindParam(':team_token', $token);
        $req->bindParam(':user_public_token', $user_token);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'message' => ['text' => 'Une erreur est survenue !', 'theme' => 'dark', 'timeout' => 2000] ]);
        }
    }  


/**
 * function setInvitationAnswer($token, $user_token, $choice)
 * 
 * Accepter une invitation
 * @param 1 = Le token de la team
 * @param 2 = Le token de l'user
 * @param 3 = Le choix (accept/decline)
 * @return array
*/
    function setInvitationAnswer($token, $user_token, $choice) {
        setlocale(LC_TIME, "fr_FR");
        $date = date("Y-m-d H:i:s");

        $request = $this -> _db -> query("SELECT * FROM `pr_invitation_team` WHERE `team_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
        $res = $request->fetch();
        if($res){
            $request = $this -> _db -> exec("UPDATE `pr_invitation_team` SET `enable`= 0, `date_end`= '$date' WHERE `team_token` = '$token' AND `user_public_token` = '$user_token' AND `enable` = '1' ");
            if($choice == 'accept'){
                $request = $this -> _db -> exec("INSERT INTO `pr_team_member` (`team_token`, `user_public_token`) VALUES ('$token', '$user_token')");
                return (['success' => true, 'message' => ['text' => 'Vous avez accepter l invitation !', 'theme' => 'dark', 'timeout' => 2000] ]);
            }else if($choice == 'decline'){
                return (['success' => true, 'message' => ['text' => 'Vous avez refuser l invitation !', 'theme' => 'dark', 'timeout' => 2000] ]);
            }
        }

        return (['success' => false, 'message' => ['text' => 'Une erreur est survenue !', 'theme' => 'dark', 'timeout' => 2000] ]);
    }  
    

}
