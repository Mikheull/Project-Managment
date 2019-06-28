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
                    header('location: ./');
                }
                
            }else{
                return (['success' => false, 'options' => ['content' => "Identifiants incorrect !", 'theme' => 'error'] ]);
            }
    
        }else{
            return (['success' => false, 'options' => ['content' => "Vous êtes actuellement déjà connecté !", 'theme' => 'error'] ]);
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
                return (['success' => false, 'options' => ['content' => "Un utilisateur existe déjà avec ce mail / username !", 'theme' => 'error'] ]);
            }

        }else{
            return (['success' => false, 'options' => ['content' => "Vous êtes actuellement déjà connecté !", 'theme' => 'error'] ]);
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
            
ob_start();
?>
<html lang="en">

  <body style="margin:0; padding:0; background-color:#FFF;font-family: Arial, Helvetica, sans-serif">

      <center>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center" valign="top" style="color: #4C6CF6;padding: 2vh 0;font-weight: bold;font-size: 1.5rem">
                  <h1> IMPROOVE </h1>
                </td>
            </tr>
        </table>
      </center>

      <table width="60%" cellpadding="0" cellspacing="0" border="0" style="margin: 0 20%">
        <tr>
          <td>
            <p>
              Bonjour. <br><br>
              Vous avez récemment fait une demande de réinitialisation de mot de passe.  <br><br>

              - date : 26 avril 2019 à 19h05 <br>
              - IP : 111.20.101.21 <br>
              - Localisation : Massy. Ile de France <br><br>


              Voici les étapes à suivre : <br><br>

              1) Cliquez sur le lien ci dessous <br>
              <a href="http://localhost:8888/Improove/new-password/<?= $user_token ?>/<?= $token ?>" target="_blank" style="color:#4C6CF6; text-decoration:underline;">http://localhost:8888/Improove/new-password/<?= $user_token ?>/<?= $token ?></a><br>
              2) Entrez votre nouveau mot de passe avant de confirmer <br>
              3) Connectez vous avec votre nouvel identifiant <br><br>

              Si vous n’êtes pas a l’origine de ce mail, ignorez le. <br>
            </p>
          </td>
        </tr>
      </table>

  </body>
</html>
<?php
$content_email = ob_get_clean();


            sendmail::send('mikhae.bailly@gmail.com', 'mikhae.bailly@gmail.com', 'Demande de réinitialisation de mot de passe', $content_email);
            header('location: login');
        }else{
            return (['success' => false, 'options' => ['content' => "Une demande est déjà en cours avec ce mail !", 'theme' => 'error'] ]);
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
            return (['success' => false, 'options' => ['content' => 'Une erreur est survenue !', 'theme' => 'error'] ]);
        }

    } 

/******************************************************************************/

}