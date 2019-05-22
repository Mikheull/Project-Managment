<?php


/**
 * Script d'envoi de mail
 * Il gère les méthodes relative a la class sendmail
 * 
 * utilisé dans :
 *  (Direct) - view/content/landing/contact/index.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$sendmail = new sendmail($db);

    

/**
 * Formulaire de contact
 * 
 * @fichier d'execution = view/content/landing/contact/index.php
 * @variable d'execution = $_POST['new-send_contact_button']        : type = button
 * 
 * @variable obligatoire = $_POST['password']                       : type = password
 * @variable obligatoire = $_POST['message']                        : type = textarea
 * @variable facultatif = $_POST['first_name']                      : type = text
 * @variable facultatif = $_POST['last_name']                       : type = text
 * @variable facultatif = $_POST['objet']                           : type = text
 * 
 */
if(isset($_POST['send_contact_button'])){
    
    if(isset($_POST['email']) AND isset($_POST['message']) AND !empty($_POST['email']) AND !empty($_POST['message'])){
        $email = htmlentities(addslashes($_POST['email']));
        $message = htmlentities( addslashes($_POST['message']));

        $first_name = (isset($_POST['first_name']) ? htmlentities( addslashes($_POST['first_name'])) : 'undefined');
        $last_name = (isset($_POST['last_name']) ? htmlentities( addslashes($_POST['last_name'])) : 'undefined');
        $object = (isset($_POST['objet']) ? htmlentities( addslashes($_POST['objet'])) : 'Pas d\'objet');

        $errors = $sendmail -> send('contact@improove.co', $first_name.'-'.$last_name, $object, $message);

    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'dark', 'timeout' => 2000] ];
    }

}

// End of file
/******************************************************************************/
