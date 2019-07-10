<?php


/**
 * Script des messages
 * Il gère les méthodes relative a la class messenger
 * 
 * utilisé dans :
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$messenger = new messenger($db);


/**
 * Formulaire pour Envoyer un message
 * 
 * @fichier d'execution = view/app/project/tool/messenger/conv/index.php
 * @variable d'execution = $_POST['message_send']                       : type = button
 * 
 * @variable obligatoire = $_POST['message_content']                    : type = textarea
 * 
 */
if(isset($_POST['message_send'])){
    if(isset($_POST['message_content']) AND !empty($_POST['message_content'])){

        $content = $_POST['message_content'];
        $project_token = $router -> getRouteParam("2");
        $channel_token = $router -> getRouteParam("5");

        $errors = $messenger -> newMessage($content, $project_token, $channel_token);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir le champ !", 'theme' => 'error'] ];
    }
}

// End of file
/******************************************************************************/
