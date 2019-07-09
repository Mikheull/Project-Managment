<?php


/**
 * Script d'envoi de mail
 * Il gère les méthodes relative a la class sendmail
 * 
 * utilisé dans :
 *  (Direct) - view/landing/contact/index.php
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
 * @fichier d'execution = view/landing/contact/index.php
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
        $email = cleanVar($_POST['email']);
        $message = cleanVar($_POST['message']);

        $first_name = (isset($_POST['first_name']) ? cleanVar($_POST['first_name']) : 'undefined');
        $last_name = (isset($_POST['last_name']) ? cleanVar($_POST['last_name']) : 'undefined');
        $object = (isset($_POST['objet']) ? cleanVar($_POST['objet']) : 'Pas d\'objet');

        $errors = $sendmail -> send('contact@improove.co', $first_name.'-'.$last_name, $object, $message);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }

}

// End of file
/******************************************************************************/
