<?php


/**
 * Script de recherche utilisateur
 * Il gère les méthodes relative a la class recherche_utilisateur
 * 
 * utilisé dans :
 *  (Direct) - view/app/project/tools/recherche-utilisateur/home/index.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$recherche_utilisateur = new recherche_utilisateur($db);


/**
 * Formulaire pour créer une recherche utilisateur
 * 
 * @fichier d'execution = view/app/project/t/recherche-utilisatuer/index.php
 * @variable d'execution = $_POST['create_research']                    : type = button
 * 
 * @variable obligatoire = $_POST['name']                               : type = text
 * @variable obligatoire = $_POST['topic']                              : type = text
 * 
 */
if(isset($_POST['create_research'])){
    if(isset($_POST['name']) AND !empty($_POST['name']) AND isset($_POST['topic']) AND !empty($_POST['topic'])){

        $project_token = $router -> getRouteParam('2');
        $name = cleanVar($_POST['name']);
        $topic = cleanVar($_POST['topic']);

        $errors = $recherche_utilisateur -> createEtude($project_token, $name, $topic);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}


// End of file
/******************************************************************************/
