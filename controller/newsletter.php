<?php


/**
 * Script de la Newsletter
 * Il gère les méthodes relative à la newsletter
 * 
 * utilisé dans :
 *  (Direct) - view/landing/home/index.php
 *  (Direct) - view/landing/contact/index.php
 * 
 */

/******************************************************************************/



/**
 * Declaration des variables
 */
$newsletter = new newsletter($db);



/**
 * Formulaire pour s'inscrire a la newsletter
 * 
 * @fichier d'execution = view/landing/home/index.php - view/landing/contact/index.php
 * @variable d'execution = $_POST['subscribe_newsletter']                   : type = button
 * 
 * @variable obligatoire = $_POST['email_newsletter']                       : type = email
 * 
 */
if(isset($_POST['subscribe_newsletter'])){
    
    if(isset($_POST['email_newsletter']) AND !empty($_POST['email_newsletter'])){
        $email = htmlentities(addslashes($_POST['email_newsletter']));

        if($auth -> isConnected()){
            if($user -> getUserData($main -> getToken(), 'mail') == $email){
                $errors = $newsletter -> subscribe($email);
            }else{
                $errors = ['success' => false, 'message' => ['text' => "Email invalide !", 'theme' => 'dark', 'timeout' => 2000] ];
            }
        }else{
            $errors = ['success' => false, 'message' => ['text' => "Vous devez être connecté !", 'theme' => 'dark', 'timeout' => 2000] ];
        }

    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'dark', 'timeout' => 2000] ];
    }

}


// End of file
/******************************************************************************/
