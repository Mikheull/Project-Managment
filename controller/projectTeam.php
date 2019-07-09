<?php


/**
 * Script des équipes de projets
 * Il gère les méthodes relative a la class projectTeam
 * 
 * utilisé dans :
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$projectTeam = new projectTeam($db);


/**
 * Formulaire pour Créer une team
 * 
 * @fichier d'execution = view/app/project/tool/gestion-equipe/team/create/index.php
 * @variable d'execution = $_POST['create_team']                        : type = button
 * 
 * @variable obligatoire = $_POST['name']                               : type = text
 * @variable obligatoire = $_POST['color']                              : type = color
 * @variable obligatoire = $_POST['permissions']                        : type = array checkbox
 * 
 */
if(isset($_POST['create_team'])){
    if(isset($_POST['name']) AND !empty($_POST['name'])){

        $name = cleanVar($_POST['name']);
        $color = cleanVar($_POST['color']);
        $permissions = $_POST['permissions'];
        $project_token = $router -> getRouteParam('2');

        $errors = $projectTeam -> createTeam($project_token, $name, $color, $permissions);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}



/**
 * Formulaire pour editer les informations d'une équipe
 * 
 * @fichier d'execution = view/app/project/tool/gestion-equipe/team/edit/index.php
 * @variable d'execution = $_POST['edit_team']                          : type = button
 * 
 * @variable obligatoire = $_POST['name']                               : type = text
 * @variable optionnelle = $_POST['color']                              : type = color
 * @variable obligatoire = $_POST['permissions']                        : type = array checkbox
 * 
 */
if(isset($_POST['edit_team'])){
    
    if(isset($_POST['name']) AND !empty($_POST['name'])){
        $name = cleanVar($_POST['name']);
        $color = cleanVar($_POST['color']);
        $permissions = $_POST['permissions'];
        $team_token = $router -> getRouteParam('6');

        $errors = $projectTeam -> editTeamInfos($name, $color, $permissions, $team_token);
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs ", 'theme' => 'error'] ];
    }

}



/**
 * Formulaire pour ajouter des équipes a un membre
 * 
 * @fichier d'execution = view/app/project/tool/gestion-equipe/member/edit/index.php
 * @variable d'execution = $_POST['add_team_user']                      : type = button
 * 
 * @variable obligatoire = $_POST['team']                               : type = array checkbox
 * 
 */
if(isset($_POST['add_team_user'])){
    
    if(isset($_POST['team']) AND !empty($_POST['team'])){
        $teams = $_POST['team'];
        $user_token = $router -> getRouteParam('6');

        foreach($teams as $tm){ 
            $errors = $projectTeam -> addMemberTeam($tm, $user_token);
        }
    }

}


// End of file
/******************************************************************************/
