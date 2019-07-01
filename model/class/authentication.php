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
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<body>
    <div style="">
    <div style="Margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                    <tr>
                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                        <tbody>
                            <tr>
                            <td style="width:100px;"> <img height="auto" src="http://localhost:8888/Improove/dist/images/logo_blue.png" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;" width="100" /> </td>
                            </tr>
                        </tbody>
                        </table>
                    </td>
                    </tr>
                </table>
                </div>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
    <div style="background:#262E3E;background-color:#262E3E;Margin:0px auto;border-radius:6px;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#262E3E;background-color:#262E3E;width:100%;border-radius:6px;">
        <tbody>
            <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 20px;text-align:center;vertical-align:top;">
                <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                    <tr>
                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:20px;font-weight:500;line-height:1;text-align:center;color:#FFFFFF;"> Réinitialisation de mot de passe </div>
                    </td>
                    </tr>
                </table>
                </div>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
    <div style="Margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:50px;text-align:center;vertical-align:top;">
                <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                    <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:20px;font-weight:bold;line-height:1;text-align:left;color:#4C6CF6;"> Bonjour </div>
                    </td>
                    </tr>
                    <tr>
                    <td style="font-size:0px;word-break:break-word;">
                    </td>
                    </tr>
                    <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:16px;line-height:1;text-align:left;color:#637381;"> Vous avez récemment fait une demande de réinitialisation de mot de passe. <br></br> - date : <?= date("Y-m-d H:i:s"); ?><br></br> - IP : 111.20.101.21<br></br> - Localisation : Massy. Ile de France </div>
                    </td>
                    </tr>
                    <tr>
                    <td style="font-size:0px;word-break:break-word;">
                        <div style="height:30px;"> &nbsp; </div>
                    </td>
                    </tr>
                    <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:16px;line-height:1;text-align:left;color:#637381;"> Voici les étapes à suivre : </div>
                    </td>
                    </tr>
                    <tr>
                    <td style="font-size:0px;word-break:break-word;">
                        <div style="height:10px;"> &nbsp; </div>
                    </td>
                    </tr>
                    <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:16px;line-height:1;text-align:left;color:#637381;"> 1) Cliquez sur le lien ci dessous <br></br> <a color="#637381" href="http://localhost:8888/Improove/new-password/<?= $user_token ?>/<?= $token ?>">http://localhost:8888/Improove/new-password/<?= $user_token ?>/<?= $token ?></a>                        </div>
                    </td>
                    </tr>
                    <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:16px;line-height:1;text-align:left;color:#637381;"> 2) Entrez votre nouveau mot de passe avant de confirmer<br></br> 3) Connectez vous avec votre nouvel identifiant<br></br>
                        </div>
                    </td>
                    </tr>
                    <tr>
                    <td style="font-size:0px;word-break:break-word;">
                        <div style="height:10px;"> &nbsp; </div>
                    </td>
                    </tr>
                    <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;font-style:italic;line-height:1;text-align:left;color:#262E3E;"> Si vous n’êtes pas a l’origine de ce mail, ignorez le. </div>
                    </td>
                    </tr>
                </table>
                </div>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
    <div style="Margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                    <tr>
                    <td style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <p style="border-top:solid 2px #EDEDED;font-size:1;margin:0px auto;width:100%;"> </p>
                    </td>
                    </tr>
                    <tr>
                    <td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px;padding-top:50px;padding-bottom:50px;word-break:break-word;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                        <tr>
                            <td align="center" bgcolor="#4C6CF6" role="presentation" style="border:none;border-radius:3px;cursor:auto;padding:10px 25px;background:#4C6CF6;" valign="middle"> <a href="https://improove.co" style="background:#4C6CF6;color:#FFFFFF;font-family:Helvetica;font-size:13px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;" target="_blank">
                Aller sur la plateforme
            </a> </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                    <tr>
                    <td style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <p style="border-top:solid 2px #EDEDED;font-size:1;margin:0px auto;width:100%;"> </p>
                    </td>
                    </tr>
                </table>
                </div>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
    <div style="Margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                    <tr>
                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                        <tr>
                            <td style="padding:4px;">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#000000;border-radius:3px;width:30px;">
                                <tr>
                                <td style="font-size:0;height:30px;vertical-align:middle;width:30px;"> <a href="https://github.com/" target="_blank">
                    <img
                        height="30" src="https://www.mailjet.com/images/theme/v1/icons/ico-social/github.png" style="border-radius:3px;" width="30"
                    />
                    </a> </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        </table>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                        <tr>
                            <td style="padding:4px;">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#0077b5;border-radius:3px;width:30px;">
                                <tr>
                                <td style="font-size:0;height:30px;vertical-align:middle;width:30px;"> <a href="https://linkedin.com/" target="_blank">
                    <img
                        height="30" src="https://www.mailjet.com/images/theme/v1/icons/ico-social/linkedin.png" style="border-radius:3px;" width="30"
                    />
                    </a> </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        </table>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                        <tr>
                            <td style="padding:4px;">
                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#55acee;border-radius:3px;width:30px;">
                                <tr>
                                <td style="font-size:0;height:30px;vertical-align:middle;width:30px;"> <a href="https://twitter.com/" target="_blank">
                    <img
                        height="30" src="https://www.mailjet.com/images/theme/v1/icons/ico-social/twitter.png" style="border-radius:3px;" width="30"
                    />
                    </a> </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                </table>
                </div>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
    <div style="Margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
            <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                    <tr>
                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:10px;line-height:1;text-align:center;color:#262E3E;"> Improove 2019. Tout droits réservés </div>
                    </td>
                    </tr>
                </table>
                </div>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
    </div>
</body>

</html>
            
<?php
$content_email = ob_get_clean();

            $sender = 'mikhae.bailly@gmail.com';
            $recipient = 'mikhae.bailly@gmail.com';

            $subject = 'Demande de réinitialisation de mot de passe';
            $message = $content_email;
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // Additional headers
            $headers .= 'From: ' . $sender. "\r\n";  

            if (mail($recipient, $subject, $message, $headers)){
                echo "Message accepted";
            }else{
                echo "Error: Message not accepted";
            }
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