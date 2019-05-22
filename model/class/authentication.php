<?php

class authentication extends db_connect {



    function __construct($connect){
        parent::__construct($connect);


        if(isset($_COOKIE['user_email']) AND isset($_COOKIE['user_password'])){
            $this -> login($_COOKIE['user_email'], $_COOKIE['user_password'], true);
        }
    }



/******************************************************************************/

    /**
     * Vérifie si l'utilisateur est connecté
     * 
     * Cherche si la fonction 'logged_in' est set
     *
     * @access public
     * @author Mikhaël Bailly
     * @return boolean
     */

    function isConnected() {
        return (isset($_SESSION['logged_in']) ? true : false);
    }

/******************************************************************************/



/******************************************************************************/

    /**
     * Tente une connexion
     * 
     * Va essayer de connecter l'utilisateur en comparant ses données fournis
     * et celles stockés dans la base de données
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $email email
     * @param string $password mot de passe
     * @param string-boolean $cookie sauvegarde par cookie ou non
     * @return array
     */

    function login($email = '', $password = '' ,$cookie = 'false') {
        if($this -> isConnected() == false){

            $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `mail` = '$email' ");
            $res = $request->fetch();
            
            if($res AND password_verify($password, $res['password'])){
                $_SESSION['logged_in'] = true;
                $_SESSION['user_token'] = $res['public_token'];

                if($cookie == 'true'){
                    setcookie("user_email", $email, time() + 86400);
                    setcookie("user_password", $password, time() + 86400);
                }

                if(strpos($_SERVER['REQUEST_URI'], '?') !== false) {
                    $parameter = explode('?', $_SERVER['REQUEST_URI']);
                    $redirectUri = $parameter[1];

                    $redirectUri2 = explode('return_url=', $redirectUri);
                    $redirect = $redirectUri2[1];
                    $redirect = str_replace('%2F', '/', $redirect);

                    header('location: '. $redirect);
                }else {
                    header('location: account');
                }
                
            }else{
                return (['success' => false, 'message' => ['text' => "Identifiants incorrect !", 'theme' => 'light', 'timeout' => 2000] ]);
            }
    
        }else{
            return (['success' => false, 'message' => ['text' => "Vous êtes actuellement déjà connecté !", 'theme' => 'light', 'timeout' => 2000] ]);
        }
    }


    /**
     * Tente une inscription
     * 
     * Va essayer d'inscrire l'utilisateur en vérifiant que les données entrées
     * par l'utilisateur sont valides et qu'elles n'existent pas encore
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $username pseudo
     * @param string $email email
     * @param string $password mot de passe
     * @return array
     */
    
    function register($username = '', $email = '', $password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = $this -> generateToken(30);

        if($this -> isConnected() == false){
            $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `mail` = '$email' OR `username` = '$username' ");
            $res = $request->fetch();
            
            if(!$res){
                
                $_SESSION['logged_in'] = true;
                $_SESSION['user_token'] = $token;

                setcookie("user_email", $email, time() + 86400);
                setcookie("user_password", $password, time() + 86400);

                $request = $this -> _db -> exec("INSERT INTO `imp_user` (`username`, `mail`, `password`, `public_token`) VALUES ('$username', '$email', '$password', '$token') ");
                mkdir("dist/uploads/u/".$token."/", 0700);

                header('location: account');
            
            }else{
                return (['success' => false, 'message' => ['text' => "Un utilisateur existe déjà avec ce mail / username !", 'theme' => 'light', 'timeout' => 2000] ]);
            }

        }else{
            return (['success' => false, 'message' => ['text' => "Vous êtes actuellement déjà connecté !", 'theme' => 'light', 'timeout' => 2000] ]);
        }
    }

/******************************************************************************/


  
/******************************************************************************/

    /**
     * Vérifie si un mail existe
     * 
     * Cherche dans la base de données une correspondace avec le mail fourni
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $email mail
     * @return boolean
     */

    function emailExist($email = '') {
        $request = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `mail` = '$email' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    }

/******************************************************************************/



/******************************************************************************/

    /**
     * Vérifie si l'utilisateur a déjà une demande de reset de mot de passe en cours
     * 
     * Cherche dans la base de données une correspondace avec les token fournis et un status 'enable' a 1 (true)
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token token de l'user
     * @param string $token token de la demande
     * @return boolean
     */

    function passResetDemandeExist($user_token = '', $token = '') {

        $request = $this -> _db -> query("SELECT * FROM `imp_reset_password` WHERE `user_public_token` = '$user_token' AND `token` = '$token' AND `enable` = 1  ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    }



    /**
     * Création d'une demande de reset
     * 
     * Créer une demande de reset de mot de passe dans la base de données, puis envoi un email
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $email email de l'user
     * @return array
     */

    function newPassResetDemand($email = '') {
        $select = $this -> _db -> query("SELECT * FROM `imp_user` WHERE `mail` = '$email' ");
        $res = $select->fetch();

        $user_token = $res['public_token'];
        $token = $this -> generateToken(50);

        $select = $this -> _db -> query("SELECT * FROM `imp_reset_password` WHERE `user_public_token` = '$user_token' AND `enable` = 1 ");
        
        if($select -> rowCount() == 0){
            $request = $this -> _db -> exec("INSERT INTO `imp_reset_password` (`user_public_token`, `token`) VALUES ('$user_token', '$token') ");
            header('location: new-password/'. $user_token .'/'. $token);
        }else{
            return (['success' => false, 'message' => ['text' => "Une demande est déjà en cours avec ce mail !", 'theme' => 'light', 'timeout' => 2000] ]);
        }

    } 
    

    
    /**
     * Re-Set du mot de passe
     * 
     * Va redefinir le mot de passe de l'utilisateur, puis désactiver la demande
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $user_token token de l'user
     * @param string $token token de la demande
     * @param string $password nouveau mot de passe
     * @return array
     */

    function resetPassword($user_token = '', $token = '', $password = '') {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $select = $this -> _db -> query("SELECT * FROM `imp_reset_password` WHERE `user_public_token` = '$user_token' AND `token` = '$token' AND `enable` = 1 ");
        
        if($this -> passResetDemandeExist($user_token, $token) == true){
            $exec = $this -> _db -> exec("UPDATE `imp_reset_password` SET `enable` = 0 WHERE `user_public_token` = '$user_token' AND `token` = '$token' AND `enable` = 1 ");
            $exec = $this -> _db -> exec("UPDATE `imp_user` SET `password` = '$password' WHERE `public_token` = '$user_token' ");
            
            header('location: ../../login');
        }else{
            return (['success' => false, 'message' => ['text' => 'Une erreur est survenue !', 'theme' => 'light', 'timeout' => 2000] ]);
        }

    } 

/******************************************************************************/

  






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

    

}