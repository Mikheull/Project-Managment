<?php


/**
 * Script des permission
 * Il gère les méthodes relative a la class permission
 * 
 * utilisé dans :
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$permission = new permission($db);


/**
 * Formulaire pour ajouter des permissions a un membre
 * 
 * @fichier d'execution = view/app/project/tool/gestion-equipe/member/edit/index.php
 * @variable d'execution = $_POST['add_perm_user']                      : type = button
 * 
 * @variable obligatoire = $_POST['permissions']                        : type = array checkbox
 * 
 */
if(isset($_POST['add_perm_user'])){
    
    if(isset($_POST['permissions']) AND !empty($_POST['permissions'])){
        $permissions = $_POST['permissions'];
        $user_token = $router -> getRouteParam('6');
        $project_token = $router -> getRouteParam('2');
        
        $errors = $permission -> addPermissions($user_token, $project_token, $permissions);
    }

}

// End of file
/******************************************************************************/
