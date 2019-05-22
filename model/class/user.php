<?php

class user extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/**
 * function myToken()
 * 
 * Renvoi son token public
 * @return varchar
*/
    
    function myToken() {
        return $_SESSION['user_token'];
    } 


/**
 * function getDataFromUserToken($user_token, $info)
 * 
 * Récupère une information d'un utilisateur donné
 * @param 1 = Le token de l'utilisateur
 * @param 2 = L'information
 * @return var
*/
    
    function getDataFromUserToken($user_token, $info) {
        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `public_token` = '$user_token' ");
        $res = $request->fetch();

        return $res[$info];
    } 

 
/**
 * function editPassword($new_password)
 * 
 * Editer le mot de passe de l'utilisateur
 * @param 1 = Le nouveau mot de passe
 * @return array
*/
    
    function editPassword($new_password) {
        $token = $this -> myToken();
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $exec = $this -> _db -> exec("UPDATE `imp_user` SET `password` = '$new_password' WHERE `public_token` = '$token' ");

        return (['success' => true, 'message' => ['text' => 'Le mot de passe a été modifié !', 'theme' => 'light', 'timeout' => 2000] ]);
    }    


/**
 * function verifyUsername($username)
 * 
 * Vérifie si un username existe
 * @param 1 = l'username
 * @return boolean
*/
    
    function verifyUsername($username) {

        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `username` = '$username' ");
        $res = $request->fetch();

        if($res){
            return true;        
        }
        return false;
    }  


 /**
 * function editUserInfos($first_name, $last_name, $username, $bio)
 * 
 * Editer les infos de l'utilisateur
 * @param 1 = Le nouveau prénom
 * @param 2 = Le nouveau nom de famille
 * @param 3 = Le nouveau pseudo
 * @param 4 = La nouvelle bio
 * @return array
*/
    
function editUserInfos($first_name, $last_name, $username, $bio) {
    $token = $this -> myToken();

    $exec = $this -> _db -> exec("UPDATE `imp_user` SET `first_name` = '$first_name', `last_name` = '$last_name', `username` = '$username', `bio` = '$bio' WHERE `public_token` = '$token' ");

    return (['success' => true, 'message' => ['text' => 'Les informations on été modifiés !', 'theme' => 'light', 'timeout' => 2000] ]);
}     




/**
 * function usernameToToken($username)
 * 
 * Transformer un username en token
 * @param 1 = Username
 * @return array
*/
    function usernameToToken($username) {
        
        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `username` = '$username' ");
        $res = $request->fetch();

        return $res['public_token'];
    }   

/**
 * function isBlocked($blocked)
 * 
 * Vérifie si l'user actif a bloquer un user
 * @param 1 = Le token de l'utilisateur a vérifier
 * @return boolean
*/
    function isBlocked($blocked) {
        $token = $this -> myToken();

        $request = $this -> _db -> query("SELECT * FROM `imp_blocked` WHERE (`user_public_token` = '$token' AND `blocked_user_token` = '$blocked') ");
        $res = $request->fetch();
        
        if($res){
            return true;        
        }
        return false;
    } 


/**
 * function block($user_token)
 * 
 * Bloque un utilisateur
 * @param 1 = Le token de l'utilisateur
 * @return array
*/
    function block($user_token) {
        $token = $this -> myToken();

        $req = $this -> _db -> prepare("INSERT INTO `imp_blocked` (`user_public_token`, `blocked_user_token`) VALUES (:user_public_token, :blocked_user_token)");

        $req->bindParam(':blocked_user_token', $user_token);
        $req->bindParam(':user_public_token', $token);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'message' => ['text' => 'Une erreur est survenue !', 'theme' => 'light', 'timeout' => 2000] ]);
        }
        return (['success' => true, 'message' => ['text' => 'Vous avez bloqué l utilisateur !', 'theme' => 'light', 'timeout' => 2000] ]);
    } 


/**
 * function unblock($user_token)
 * 
 * Débloquer un utilisateur
 * @param 1 = Le token de l'utilisateur
 * @return array
*/
    function unblock($user_token) {
        $token = $this -> myToken();

        $req = $this -> _db -> prepare("DELETE FROM `imp_blocked` WHERE `user_public_token` = :user_public_token AND `blocked_user_token` = :blocked_user_token AND `enable` = '1' ");

        $req->bindParam(':user_public_token', $token);
        $req->bindParam(':blocked_user_token', $user_token);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'message' => ['text' => 'Une erreur est survenue !', 'theme' => 'light', 'timeout' => 2000] ]);
        }
        return (['success' => true, 'message' => ['text' => 'Vous avez débloqué l utilisateur !', 'theme' => 'light', 'timeout' => 2000] ]);
    }  
  
    
/**
 * function getUnreadNotifs()
 * 
 * Récupère les notifications pas lu
 * @return array
*/
    function getUnreadNotifs() {
        $token = $this -> myToken();

        $request = $this -> _db -> query("SELECT * FROM `imp_notification` WHERE `user_public_token` = '$token' AND `n_read` = '0' AND `enable` = '1' ");
        return $request->fetchAll();
    } 

    
    

}
