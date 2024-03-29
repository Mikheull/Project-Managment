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
        $email = cleanVar($_POST['email']);
        $password = cleanVar($_POST['password']);
            
        if(isset($_POST['keep_session']) ? $cookie = 'true' : $cookie = 'false');

        $errors = $auth -> login($email, $password, $cookie);
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
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
        $username = cleanVar($_POST['username']);
        $email = cleanVar($_POST['email']);
        $password = cleanVar($_POST['password']);
        $confirm_password = cleanVar($_POST['confirm_password']);

        if(isset($_POST['accept_cgu']) AND $_POST['accept_cgu'] == true){
            if($password == $confirm_password){
                if(strlen($password) >= 8){
                    $errors = $auth -> register($username, $email, $password);
                }else{
                    $errors = ['success' => false, 'options' => ['content' => "Le mot de passe est trop court (8 caractères minimum) !", 'theme' => 'error'] ];
                }
            }else{
                $errors = ['success' => false, 'options' => ['content' => "Les mot de passes sont différents !", 'theme' => 'error'] ];
            }
        }else{
            $errors = ['success' => false, 'options' => ['content' => "Vous devez accepter nos conditions !", 'theme' => 'error'] ];
        }
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
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
        $email = cleanVar($_POST['email']);

        if($auth -> emailExist($email) == true){
            $errors = $auth -> newPassResetDemand($email);
        }else{
            $errors = ['success' => false, 'options' => ['content' => "Le mail n\'existe pas !", 'theme' => 'error'] ];
        }
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
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
        $password = cleanVar($_POST['password']);
        $public_token = $router -> getRouteParam(1);
        $token = $router -> getRouteParam(2);

        if(strlen($password) >= 8){
            $errors = $auth -> resetPassword($public_token, $token, $password);
        }else{
            $errors = ['success' => false, 'options' => ['content' => "Le mot de passe est trop court (8 caractères minimum) !", 'theme' => 'error'] ];
        }
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }

}

// End of file
/******************************************************************************/
