<?php


/**
 * Script des utilisateurs
 * Il gère les méthodes relative a la class user
 * 
 * utilisé dans :
 *  (Config) - config.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$user = new user($db);



/**
 * Formulaire pour editer son mot de passe
 * 
 * @fichier d'execution = view/account/edit/index.php
 * @variable d'execution = $_POST['update_user_pass']                   : type = button
 * 
 * @variable obligatoire = $_POST['old_password']                       : type = password
 * @variable obligatoire = $_POST['new_password']                       : type = password
 * @variable obligatoire = $_POST['confirm_password']                   : type = password
 * 
 */
if(isset($_POST['update_user_pass'])){
    
    if(isset($_POST['old_password']) AND !empty($_POST['old_password']) AND isset($_POST['new_password']) AND !empty($_POST['new_password']) AND isset($_POST['confirm_password']) AND !empty($_POST['confirm_password'])){
        $old_password = htmlentities(addslashes($_POST['old_password']));
        $new_password = htmlentities( addslashes($_POST['new_password']));
        $confirm_password = htmlentities( addslashes($_POST['confirm_password']));

        if($new_password == $confirm_password){

            if (password_verify($old_password, $user -> getUserData($main -> getToken(), 'password') )) {
                if(strlen($new_password) >= 8){
                    $errors = $user -> editPassword($new_password);
                }else{
                    $errors = ['success' => false, 'message' => ['text' => "Le mot de passe est trop court (8 caractères minimum) !", 'theme' => 'light', 'timeout' => 2000] ];
                }
            }else{
                $errors = ['success' => false, 'message' => ['text' => "L\'ancien mot de passe est incorrect !", 'theme' => 'light', 'timeout' => 2000] ];
            }
        }else{
            $errors = ['success' => false, 'message' => ['text' => "Les mot de passes sont différents !", 'theme' => 'light', 'timeout' => 2000] ];
        }

    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'light', 'timeout' => 2000] ];
    }

}



/**
 * Formulaire pour editer ses informations
 * 
 * @fichier d'execution = view/account/edit/index.php
 * @variable d'execution = $_POST['update_user_infos']                  : type = button
 * 
 * @variable obligatoire = $_POST['first_name']                         : type = text
 * @variable obligatoire = $_POST['last_name']                          : type = text
 * @variable obligatoire = $_POST['username']                           : type = text
 * @variable obligatoire = $_POST['bio']                                : type = text
 * 
 */
if(isset($_POST['update_user_infos'])){
    
    if(isset($_POST['first_name']) AND !empty($_POST['first_name']) AND isset($_POST['last_name']) AND !empty($_POST['last_name']) AND isset($_POST['username']) AND !empty($_POST['username']) AND isset($_POST['bio']) AND !empty($_POST['bio'])){
        $first_name = htmlentities(addslashes($_POST['first_name']));
        $last_name = htmlentities( addslashes($_POST['last_name']));
        $username = htmlentities( addslashes($_POST['username']));
        $bio = htmlentities( addslashes($_POST['bio']));

        if($user -> getUserData($main -> getToken(), 'username') == $username OR $user -> usernameExist($username) == false){

            if(strlen($bio) <= 255){
                $errors = $user -> editUserInfos($first_name, $last_name, $username, $bio);
            }else{
                $errors = ['success' => false, 'message' => ['text' => "La bio est trop longue (".strlen($bio)."/255) !", 'theme' => 'light', 'timeout' => 2000] ];
            }

        }else{
            $errors = ['success' => false, 'message' => ['text' => "Cet username est déjà utilisé !", 'theme' => 'light', 'timeout' => 2000] ];
        }

    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires ", 'theme' => 'light', 'timeout' => 2000] ];
    }

}



/**
 * Formulaire pour bloquer un utilisateur
 * 
 * @fichier d'execution = view/member/(*)/index.php
 * @variable d'execution = $_POST['block']                              : type = button
 * 
 */
if(isset($_POST['block'])){
    $errors = $user -> block($user -> usernameToToken($router -> getRouteParam('1')));
}



/**
 * Formulaire pour débloquer un utilisateur
 * 
 * @fichier d'execution = view/member/(*)/index.php
 * @variable d'execution = $_POST['unblock']                            : type = button
 * 
 */
if(isset($_POST['unblock'])){
    $errors = $user -> unblock($user -> usernameToToken($router -> getRouteParam('1')));
}


// End of file
/******************************************************************************/
