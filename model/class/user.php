<?php

class user extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Récupère une information d'un utilisateur donné
     * 
     * Va renvoyer une information d'un utilisateur donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token Token de l'utilisateur
     * @param string $info Information
     * @return var
     */
    
    function getUserData($user_token = '', $info = '') {
        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `public_token` = '$user_token' ");
        $res = $request->fetch();

        return $res[$info];
    } 



    /**
     * Transformer un username en token
     * 
     * Va renvoyer le token relié a l'username
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $username pseudo
     * @return var
     */

    function usernameToToken($username) {
        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `username` = '$username' ");
        $res = $request->fetch();

        return $res['public_token'];
    }  
    

    
    /**
     * Récupère les notifications
     * 
     * Récupére les notifications non lues de l'utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @return array
     */
    
    function getUnreadNotifs() {
        $token = $this -> getToken();

        $request = $this -> _db -> query("SELECT * FROM `imp_notification` WHERE `user_public_token` = '$token' AND `n_read` = '0' AND `enable` = '1' ");
        return $request->fetchAll();
    } 

/******************************************************************************/



/******************************************************************************/

    /**
     * Modifie le mot de passe
     * 
     * Va modifier le mot de passe de l'utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $new_password Nouveau mot de passe
     * @return array
     */
    
    function editPassword($new_password = '') {
        $token = $this -> getToken();

        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $exec = $this -> _db -> exec("UPDATE `imp_user` SET `password` = '$new_password' WHERE `public_token` = '$token' ");

        return (['success' => true, 'message' => ['text' => "Le mot de passe a été modifié !", 'theme' => 'light', 'timeout' => 2000] ]);
    }    



    /**
     * Vérifie l'username
     * 
     * Vérifie si un pseudo existe déjà dans la base de données
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $username Pseudo a vérifier
     * @return boolean
     */
    
    function usernameExist($username = '') {
        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `username` = '$username' ");
        $res = $request->fetch();

        return ($res ? true : false);
    }  



    /**
     * Vérifie si un user existe
     * 
     * Vérifie si un user existe déjà dans la base de données selon son token
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token token public de l'utilisateur
     * @return boolean
     */
    
    function userExist($token = '') {
        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `public_token` = '$token' ");
        $res = $request->fetch();

        return ($res ? true : false);
    }



    /**
     * Modifie les infos
     * 
     * Va modifier les infos de l'utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $first_name prénom
     * @param string $last_name nom
     * @param string $username pseudo
     * @param string $bio bio
     * @return array
     */
    
    function editUserInfos($first_name = '', $last_name = '', $username = '', $bio = '') {
        $token = $this -> getToken();
        $exec = $this -> _db -> exec("UPDATE `imp_user` SET `first_name` = '$first_name', `last_name` = '$last_name', `username` = '$username', `bio` = '$bio' WHERE `public_token` = '$token' ");

        return (['success' => true, 'message' => ['text' => "Les informations on été modifiés !", 'theme' => 'light', 'timeout' => 2000] ]);
    }     

/******************************************************************************/



/******************************************************************************/

    /**
     * Vérifie un user bloqué
     * 
     * Vérifie si l'utilisateur donné est bloqué par l'utilisateur actif
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $blocked user token de l'utilisateur a vérifier
     * @return boolean
     */

    function isBlocked($blocked = '') {
        $token = $this -> getToken();

        $request = $this -> _db -> query("SELECT * FROM `imp_blocked` WHERE (`user_public_token` = '$token' AND `blocked_user_token` = '$blocked') ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    } 



    /**
     * Bloque un utilisateur
     * 
     * Va essayer de bloquer un utilisateur selon le token donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token token de l'utilisateur a vérifier
     * @return array
     */

    function block($user_token = '') {
        if($this -> isBlocked($user_token) == false){
            $token = $this -> getToken();

            $req = $this -> _db -> prepare("INSERT INTO `imp_blocked` (`user_public_token`, `blocked_user_token`) VALUES (:user_public_token, :blocked_user_token)");
    
            $req->bindParam(':blocked_user_token', $user_token);
            $req->bindParam(':user_public_token', $token);
    
            $req->execute();
            $count = $req->rowCount();
    
            if($count !== 1){
                return (['success' => false, 'message' => ['text' => "Une erreur est survenue !", 'theme' => 'light', 'timeout' => 2000] ]);
            }
            return (['success' => true, 'message' => ['text' => "Vous avez bloqué l\'utilisateur !", 'theme' => 'light', 'timeout' => 2000] ]);
        }else{
            return (['success' => false, 'message' => ['text' => "Vous avez déjà bloqué l\'utilisateur !", 'theme' => 'light', 'timeout' => 2000] ]);
        }
    } 



    /**
     * Débloque un utilisateur
     * 
     * Va essayer de débloquer un utilisateur selon le token donné
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token token de l'utilisateur a vérifier
     * @return array
     */

    function unblock($user_token) {
        if($this -> isBlocked($user_token) == true){
            $token = $this -> getToken();

            $req = $this -> _db -> prepare("DELETE FROM `imp_blocked` WHERE `user_public_token` = :user_public_token AND `blocked_user_token` = :blocked_user_token AND `enable` = '1' ");

            $req->bindParam(':user_public_token', $token);
            $req->bindParam(':blocked_user_token', $user_token);

            $req->execute();
            $count = $req->rowCount();

            if($count !== 1){
                return (['success' => false, 'message' => ['text' => 'Une erreur est survenue !', 'theme' => 'light', 'timeout' => 2000] ]);
            }
            return (['success' => true, 'message' => ['text' => 'Vous avez débloqué l utilisateur !', 'theme' => 'light', 'timeout' => 2000] ]);
        }else{
            return (['success' => false, 'message' => ['text' => "Vous n\'avez pas bloqué l\'utilisateur !", 'theme' => 'light', 'timeout' => 2000] ]);
        }
    }  
  
/******************************************************************************/

}
