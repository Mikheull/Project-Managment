<?php
require_once ('controller/utils.php');


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
        $old_password = cleanVar($_POST['old_password']);
        $new_password = cleanVar($_POST['new_password']);
        $confirm_password = cleanVar($_POST['confirm_password']);

        if($new_password == $confirm_password){

            if (password_verify($old_password, $utils -> getData('imp_user', 'password', 'public_token', $main -> getToken()) )) {
                if(strlen($new_password) >= 8){
                    $errors = $user -> editPassword($new_password);
                }else{
                    $errors = ['success' => false, 'options' => ['content' => "Le mot de passe est trop court (8 caractères minimum) !", 'theme' => 'error'] ];
                }
            }else{
                $errors = ['success' => false, 'options' => ['content' => "L\'ancien mot de passe est incorrect !", 'theme' => 'error'] ];
            }
        }else{
            $errors = ['success' => false, 'options' => ['content' => "Les mot de passes sont différents !", 'theme' => 'error'] ];
        }

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }

}



/**
 * Formulaire pour editer ses informations
 * 
 * @fichier d'execution = view/account/edit/index.php
 * @variable d'execution = $_POST['update_user_infos']                  : type = button
 * 
 */
if(isset($_POST['update_user_infos'])){
    
    if(isset($_POST['first_name']) AND !empty($_POST['first_name'])){
        $first_name = cleanVar($_POST['first_name']);
        $utils -> setData('imp_user', 'first_name', $first_name, 'public_token', $main -> getToken());
    }

    if(isset($_POST['last_name']) AND !empty($_POST['last_name'])){
        $last_name = cleanVar($_POST['last_name']);
        $utils -> setData('imp_user', 'last_name', $last_name, 'public_token', $main -> getToken());
    }

    if(isset($_POST['username']) AND !empty($_POST['username'])){
        $username = cleanVar($_POST['username']);
        if($utils -> getData('imp_user', 'username', 'public_token', $main -> getToken()) == $username OR $user -> usernameExist($username) == false){
            $utils -> setData('imp_user', 'username', $username, 'public_token', $main -> getToken());
        }else{
            $errors = ['success' => false, 'options' => ['content' => "Cet username est déjà utilisé !", 'theme' => 'error'] ];
        }
    }

    if(isset($_POST['bio'])){
        $bio = cleanVar($_POST['bio']);
        if(strlen($bio) <= 255){
            $utils -> setData('imp_user', 'bio', $bio, 'public_token', $main -> getToken());
        }else{
            $errors = ['success' => false, 'options' => ['content' => "La bio est trop longue (".strlen($bio)."/255) !", 'theme' => 'error'] ];
        }
    }

}



/**
 * Formulaire pour editer sa photo de profil
 * 
 * @fichier d'execution = view/account/edit/index.php
 * @variable d'execution = $_POST['update_profil_pic']                  : type = button
 * 
 */
if(isset($_POST['update_profil_pic'])){
    
    if(!is_dir('dist/uploads/u/'.$main -> getToken().'/profil_pic/')){
        mkdir('dist/uploads/u/'.$main -> getToken().'/profil_pic/', 0777, true);
        
        $path = "dist/uploads/u/".$main -> getToken()."/index.php";
        $file = fopen($path,"w");
        fwrite($file,"");
        fclose($file);

    }
    $tmpFilePath = $_FILES['imported_file']['tmp_name'];
    $shortname = $_FILES['imported_file']['name'];
    $filePath = "dist/uploads/u/".$main -> getToken()."/profil_pic/".$_FILES['imported_file']['name'];

    if(move_uploaded_file($tmpFilePath, $filePath)) {
        $errors = ['success' => false, 'options' => ['content' => "L'image a été téléchargée !", 'theme' => 'success'] ];
        $utils -> setData('imp_user', 'profil_image', $shortname, 'public_token', $main -> getToken());
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ];
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
