<?php


/**
 * Script d'authentification
 * Il gère les actions a faire lors des envois de formulaires
 * 
 * utilisé dans :
 *  (Config) - config.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$auth = new authentication($db);


/**
 * Formulaire de connexion
 * 
 * @fichier d'execution = view/auth/login/index.php
 * @variable d'execution = $_POST['login_btn']          : type = button
 * 
 * @variable obligatoire = $_POST['email']              : type = email
 * @variable obligatoire = $_POST['password']           : type = password
 * @variable facultatif = $_POST['keep_session']        : type = boolean
 * 
 */
if(isset($_POST['login_btn'])){

    if(isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['password']) AND !empty($_POST['password'])){
        $email = htmlentities(addslashes($_POST['email']));
        $password = htmlentities( addslashes($_POST['password']));
            
        if(isset($_POST['keep_session']) ? $cookie = 'true' : $cookie = 'false');

        $errors = $auth -> login($email, $password, $cookie);
    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'light', 'timeout' => 2000] ];
    }

}



/**
 * Formulaire d'inscription
 * 
 * @fichier d'execution = view/auth/register/index.php
 * @variable d'execution = $_POST['register_btn']           : type = button
 * 
 * @variable obligatoire = $_POST['username']               : type = text
 * @variable obligatoire = $_POST['email']                  : type = email
 * @variable obligatoire = $_POST['password']               : type = password
 * @variable obligatoire = $_POST['confirm_password']       : type = password
 * @variable obligatoire = $_POST['accept_cgu']             : type = checkbox
 * 
 */
if(isset($_POST['register_btn'])){

    if(isset($_POST['username']) AND !empty($_POST['username']) AND isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['password']) AND !empty($_POST['password']) AND isset($_POST['confirm_password']) AND !empty($_POST['confirm_password'])){
        $username = htmlentities(addslashes($_POST['username']));
        $email = htmlentities(addslashes($_POST['email']));
        $password = htmlentities( addslashes($_POST['password']));
        $confirm_password = htmlentities( addslashes($_POST['confirm_password']));

        if(isset($_POST['accept_cgu']) AND $_POST['accept_cgu'] == true){
            if($password == $confirm_password){
                if(strlen($password) >= 8){
                    $errors = $auth -> register($username, $email, $password);
                }else{
                    $errors = ['success' => false, 'message' => ['text' => "Le mot de passe est trop court (8 caractères minimum) !", 'theme' => 'light', 'timeout' => 2000] ];
                }
            }else{
                $errors = ['success' => false, 'message' => ['text' => "Les mot de passes sont différents !", 'theme' => 'light', 'timeout' => 2000] ];
            }
        }else{
            $errors = ['success' => false, 'message' => ['text' => "Vous devez accepter nos conditions !", 'theme' => 'light', 'timeout' => 2000] ];
        }
    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'light', 'timeout' => 2000] ];
    }

}



/**
 * Formulaire de reset de mot de passe
 * 
 * @fichier d'execution = view/auth/reset-password/index.php
 * @variable d'execution = $_POST['reset-password_btn']     : type = button
 * 
 * @variable obligatoire = $_POST['email']                  : type = email
 * 
 */
if(isset($_POST['reset-password_btn'])){

    if(isset($_POST['email']) AND !empty($_POST['email'])){
        $email = htmlentities(addslashes($_POST['email']));

        if($auth -> emailExist($email) == true){
            $errors = $auth -> newPassResetDemand($email);
        }else{
            $errors = ['success' => false, 'message' => ['text' => "Le mail n\'existe pas !", 'theme' => 'light', 'timeout' => 2000] ];
        }
    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'light', 'timeout' => 2000] ];
    }

}



/**
 * Formulaire de modification de mot de passe
 * 
 * @fichier d'execution = view/auth/new-password/index.php
 * @variable d'execution = $_POST['new-password_btn']       : type = button
 * 
 * @variable obligatoire = $_POST['password']               : type = password
 * 
 */
if(isset($_POST['new-password_btn'])){

    if(isset($_POST['password']) AND !empty($_POST['password'])){
        $password = htmlentities(addslashes($_POST['password']));
        $public_token = $router -> getRouteParam(1);
        $token = $router -> getRouteParam(2);

        if(strlen($password) >= 8){
            $errors = $auth -> resetPassword($public_token, $token, $password);
        }else{
            $errors = ['success' => false, 'message' => ['text' => "Le mot de passe est trop court (8 caractères minimum) !", 'theme' => 'light', 'timeout' => 2000] ];
        }
    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'light', 'timeout' => 2000] ];
    }

}

// End of file
/******************************************************************************/
