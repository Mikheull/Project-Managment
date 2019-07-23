<?php

class recherche_utilisateur extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }



/******************************************************************************/

    /**
     * Récupère les études de recherche
     * 
     * Va renvoyer toutes les études de recherche d'un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getEtudes($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_user_research` WHERE `project_token` = '$project_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }



    /**
     * Créer une étude de recherche
     * 
     * Va créer une étude de recherche utilisateur pour le projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $name Nom de la recherche
     * @param string $topic Topic de la recherche
     * @return array
     */
    
    function createEtude($project_token = '', $name = '', $topic = '') {
        $etude_token = main::generateToken(10, 'uuid');

        $req = $this -> _db -> prepare("INSERT INTO `pr_user_research` (`project_token`, `research_token`, `name`, `topic`) VALUES (:project_token, :research_token, :name, :topic)");

        $req->bindParam(':project_token', $project_token);
        $req->bindParam(':research_token', $etude_token);
        $req->bindParam(':name', $name);
        $req->bindParam(':topic', $topic);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
        return (['success' => true, 'options' => ['content' => "L\'étude a été crée !", 'theme' => 'success'] ]);

    } 



    /**
     * Vérifie si une étude existe
     * 
     * Cherche dans la base de données une correspondace avec le token étude fourni
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'étude
     * @return boolean
     */

    function etudeExist($token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_user_research` WHERE `research_token` = '$token' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    }



    /**
     * Créer une sondage
     * 
     * Va créer une sondage de recherche utilisateur pour le projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $etude_token Token de l'étude
     * @param string $name Nom de la recherche
     * @param string $topic Topic de la recherche
     * @param string $nb Nombre de questions
     * @return array
     */
    
    function createSurvey($project_token = '', $etude_token = '', $name = '', $topic = '', $nb = '') {
        $survey_token = main::generateToken(10, 'uuid');

        // Survey
        $req = $this -> _db -> prepare("INSERT INTO `pr_user_research_survey` (`project_token`, `research_token`, `survey_token`, `name`, `topic`) VALUES (:project_token, :research_token, :survey_token, :name, :topic)");

        $req->bindParam(':project_token', $project_token);
        $req->bindParam(':research_token', $etude_token);
        $req->bindParam(':survey_token', $survey_token);
        $req->bindParam(':name', $name);
        $req->bindParam(':topic', $topic);

        $req->execute();


        // Questions
        for($i = 1; $i <= $nb; $i++){

            $question_token = main::generateToken(10, 'uuid');

            $question_name = addslashes(htmlentities($_POST['question'.$i]));
            $question_type = addslashes(htmlentities($_POST['answer_type'.$i]));
            $question_answers = "";
            foreach($_POST['answer'.$i] as $answer){
                $question_answers .= $answer.'[|-*-|]';
            }

            $req = $this -> _db -> prepare("INSERT INTO `pr_user_research_survey_question` (`project_token`, `research_token`, `survey_token`, `question_token`, `question`, `type`, `answers`) VALUES (:project_token, :research_token, :survey_token, :question_token, :question, :type, :answers)");

            $req->bindParam(':project_token', $project_token);
            $req->bindParam(':research_token', $etude_token);
            $req->bindParam(':survey_token', $survey_token);
            $req->bindParam(':question_token', $question_token);
            $req->bindParam(':question', $question_name);
            $req->bindParam(':type', $question_type);
            $req->bindParam(':answers', $question_answers);

            $req->execute();
        }

        return (['success' => true, 'options' => ['content' => "Le sondage a été crée !", 'theme' => 'success'] ]);

    } 



    /**
     * Vérifie si un sondage existe
     * 
     * Cherche dans la base de données une correspondace avec le token sondage fourni
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token du sondage
     * @return boolean
     */

    function surveyExist($token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_user_research_survey` WHERE `survey_token` = '$token' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    }



    /**
     * Récupère les questions d'un sondage
     * 
     * Va renvoyer toutes les questions d'un sondage
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getSurveyQuestions($survey_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_user_research_survey_question` WHERE `survey_token` = '$survey_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }
    
    

/******************************************************************************/

}
