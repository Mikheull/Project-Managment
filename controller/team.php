<?php


/**
 * Script des équipes
 * Il gère les méthodes relative a la class team
 * 
 * utilisé dans :
 *  (Direct) - view/content/account/teams/components/card.php
 *  (Direct) - view/content/account/teams/components/invitation.php
 *  (Direct) - view/content/account/teams/index.php
 *  (Direct) - view/content/member/teams/components/card.php
 *  (Direct) - view/content/member/teams/index.php
 *  (Direct) - view/content/team/dashboard/index.php
 *  (Direct) - view/content/team/edit/index.php
 *  (Direct) - view/content/team/home/components/home.php
 *  (Direct) - view/content/team/homeindex.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$team = new team($db);



/**
 * Formulaire pour rejoindre une équipe via le modal
 * 
 * @fichier d'execution = view/content/account/teams/index.php
 * @variable d'execution = $_POST['project_token']                      : type = button
 * 
 */
if(isset($_POST['project_token'])){
    $project_token = htmlentities(addslashes($_POST['project_token']));

    $errors = $team -> joinTeam( $project_token, $main -> getToken() );
}



/**
 * Formulaire pour accepter une demande
 * 
 * @fichier d'execution = view/content/account/teams/components/invitation.php
 * @variable d'execution = $_POST['accept_invitation']                  : type = button
 * 
 * @variable obligatoire = $_POST['invitation']                         : type = text
 * 
 */
if(isset($_POST['accept_invitation'])){
    $project_token = htmlentities(addslashes($_POST['invitation']));

    $errors = $team -> setInvitationAnswer($project_token, $main -> getToken(), 'accept');
}



/**
 * Formulaire pour refuser une demande
 * 
 * @fichier d'execution = view/content/account/teams/components/invitation.php
 * @variable d'execution = $_POST['decline_invitation']                  : type = button
 * 
 * @variable obligatoire = $_POST['invitation']                         : type = text
 * 
 */
if(isset($_POST['decline_invitation'])){
    $project_token = htmlentities(addslashes($_POST['invitation']));

    $errors = $team -> setInvitationAnswer($project_token, $main -> getToken(), 'decline');
}



// End of file
/******************************************************************************/
