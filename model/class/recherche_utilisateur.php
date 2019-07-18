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

/******************************************************************************/

}
