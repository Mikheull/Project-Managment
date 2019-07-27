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
     * Obtenir le role de l'utilisateur sous forme d'icon
     * 
     * Va renvoyer une span avec l'icon du role et son nom
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $role Le role ID
     * @return var
     */
    
    function getRoleFormated($role = '') {
        if($role == '1'){$role_format = '<span> <i class="fas fa-shield-alt fa-xs" data-tippy="Roi en ce royaume"></i> </span>' ;}
        else if($role == '3'){$role_format = '<span> <i class="fas fa-headset fa-xs" data-tippy="Membre du support"></i> </span>' ;}
        else if($role == '4'){$role_format = '<span> <i class="far fa-question-circle fa-xs" data-tippy="Helper"></i> </span>' ;}
        else if($role == '5'){$role_format = '<span> <i class="fas fa-headset fa-xs" data-tippy="Moderateur"></i> </span>' ;}
        else if($role == '6'){$role_format = '<span> <i class="fas fa-shield-alt fa-xs" data-tippy="Administrateur"></i> </span>' ;}
        else {$role_format = '<span></span>' ;}
        
        return $role_format;
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

        return (['success' => true, 'options' => ['content' => "Le mot de passe a été modifié !", 'theme' => 'success'] ]);
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
                return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
            }
            return (['success' => true, 'options' => ['content' => "Vous avez bloqué l\'utilisateur !", 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Vous avez déjà bloqué l\'utilisateur !", 'theme' => 'error'] ]);
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
                return (['success' => false, 'options' => ['content' => 'Une erreur est survenue !', 'theme' => 'error'] ]);
            }
            return (['success' => true, 'options' => ['content' => 'Vous avez débloqué l utilisateur !', 'theme' => 'success'] ]);
        }else{
            return (['success' => false, 'options' => ['content' => "Vous n\'avez pas bloqué l\'utilisateur !", 'theme' => 'error'] ]);
        }
    }  
  
/******************************************************************************/

}
