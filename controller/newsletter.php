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
            if( $utils -> getData('imp_user', 'mail', 'public_token', $main -> getToken() ) == $email){
                $errors = $newsletter -> subscribe($email);
            }else{
                $errors = ['success' => false, 'options' => ['content' => "Email invalide !", 'theme' => 'error'] ];
            }
        }else{
            $errors = ['success' => false, 'options' => ['content' => "Vous devez être connecté ! <a class=\"margin-left btn primary-btn\" href=\"login\">Se connecter</a> ", 'theme' => 'error'] ];
        }

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }

}


// End of file
/******************************************************************************/
