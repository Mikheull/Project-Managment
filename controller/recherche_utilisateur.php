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



/**
 * Formulaire pour créer un sondage
 * 
 * @fichier d'execution = view/app/project/t/recherche-utilisatuer/survey/create/index.php
 * @variable d'execution = $_POST['create_survey']                      : type = button
 * 
 * @variable obligatoire = $_POST['name']                               : type = text
 * @variable obligatoire = $_POST['topic']                              : type = text
 * @variable obligatoire = $_POST['nb']                                 : type = hidden
 * @variable obligatoire = $_POST['question1']                          : type = text
 * @variable obligatoire = $_POST['answer_type1']                       : type = text
 * @variable obligatoire = $_POST['answser1']                           : type = text
 * 
 */
if(isset($_POST['create_survey'])){
    if(isset($_POST['name']) AND !empty($_POST['name']) AND isset($_POST['nb']) AND !empty($_POST['nb']) AND isset($_POST['question1']) AND !empty($_POST['question1']) AND isset($_POST['answer_type1']) AND !empty($_POST['answer_type1']) AND isset($_POST['answer1']) AND !empty($_POST['answer1'])){

        $project_token = $router -> getRouteParam('2');
        $etude_token = $router -> getRouteParam('5');
        $name = cleanVar($_POST['name']);
        $topic = isset($_POST['topic']) ? $_POST['topic'] : '';
        $nb = cleanVar($_POST['nb']);

        $errors = $recherche_utilisateur -> createSurvey($project_token, $etude_token, $name, $topic, $nb);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}


/**
 * Formulaire pour envoyer une réponse a un sondage
 * 
 * @fichier d'execution = view/app/project/ur/survey/index.php
 * @variable d'execution = $_POST['send_survey']                        : type = button
 * 
 * @variable obligatoire = $_POST['answser1']                           : type = text
 * 
 */
if(isset($_POST['send_survey'])){
    $survey_token = $router -> getRouteParam('1');
    $allSurveys = $recherche_utilisateur -> getSurveyQuestions( $router -> getRouteParam('1') );

    if($recherche_utilisateur -> surveyIsOpen($survey_token) == true){
        $nb = 1;
        $userSessionToken = 'demo_user_token6';
        $recherche_utilisateur -> checkIfSurveyIsAlreadySend($userSessionToken, $survey_token);
        
        foreach($allSurveys['content'] as $surv){

            if($surv['type'] == 'text'){
                $answer = cleanVar($_POST['answer'.$nb]);
                if(isset($answer) AND !empty($answer)){
                    $recherche_utilisateur -> setSurveyAnswer( $router -> getRouteParam('1'), $surv['question_token'], $userSessionToken, $answer );
                }else{
                    $recherche_utilisateur -> setSurveyAnswer( $router -> getRouteParam('1'), $surv['question_token'], $userSessionToken, 'undefined' );
                }

            }else if($surv['type'] == 'checkbox'){
                foreach($_POST['answer'.$nb] as $ans){
                    $recherche_utilisateur -> setSurveyAnswer( $router -> getRouteParam('1'), $surv['question_token'], $userSessionToken, cleanVar($ans) );
                }

            }else if($surv['type'] == 'radio'){
                $answer = cleanVar($_POST['answer'.$nb]);
                if(isset($answer) AND !empty($answer)){
                    $recherche_utilisateur -> setSurveyAnswer( $router -> getRouteParam('1'), $surv['question_token'], $userSessionToken, $answer );
                }
            }
            $nb ++;
        }

    }

}





/**
 * Formulaire pour créer un diagramme d'affinité
 * 
 * @fichier d'execution = view/app/project/t/recherche-utilisatuer/index.php
 * @variable d'execution = $_POST['create_diagram-affinity']            : type = button
 * 
 * @variable obligatoire = $_POST['name']                               : type = text
 * @variable obligatoire = $_POST['topic']                              : type = text
 * @variable obligatoire = $_POST['approve_idea']                       : type = checkbox
 * 
 */
if(isset($_POST['create_diagram-affinity'])){
    if(isset($_POST['name']) AND !empty($_POST['name']) AND isset($_POST['topic']) AND !empty($_POST['topic'])){

        $project_token = $router -> getRouteParam('2');
        $etude_token = $router -> getRouteParam('5');
        $name = cleanVar($_POST['name']);
        $topic = cleanVar($_POST['topic']);
        if(isset($_POST['approve_idea']) ? $approve_idea = '1' : $approve_idea = '0');

        $errors = $recherche_utilisateur -> createAffinityDiagram($project_token, $etude_token, $name, $topic, $approve_idea);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}

// End of file
/******************************************************************************/
