<?php

class uml extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }


/******************************************************************************/

    /**
     * Get les diagrammes
     * 
     * Récupère les diagrammes d'un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getDiagrams($project_token = ''){
        $request = $this -> _db -> query("SELECT * FROM `pr_uml` WHERE `project_token` = '$project_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }



    /**
     * Importer un diagram
     * 
     * Va importer un diagramme dans le projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $name Nom du diagramme
     * @param string $type Type de diagramme
     * @param string $content Contenu brut
     * @param string $project_token Token du projet
     * @return array
     */
    
    function importDiagram($name = '', $type = '', $content = '', $project_token = '') {
        $uml_token = main::generateToken(10, 'uuid');

        $req = $this -> _db -> prepare("INSERT INTO `pr_uml` (`project_token`, `uml_token`, `name`, `type`, `content`) VALUES (:project_token, :uml_token, :name, :type, :content)");

        $req->bindParam(':project_token', $project_token);
        $req->bindParam(':uml_token', $uml_token);
        $req->bindParam(':name', $name);
        $req->bindParam(':type', $type);
        $req->bindParam(':content', $content);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
        return (['success' => true, 'options' => ['content' => "Le diagramme a été importé !", 'theme' => 'success'] ]);

    } 



    /**
     * Editer un diagram
     * 
     * Va editer le diagramme
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $name Nom du diagramme
     * @param string $type Type de diagramme
     * @param string $content Contenu brut
     * @param string $uml_token Token du projet
     * @return array
     */
    
    function editDiagram($name = '', $type = '', $content = '', $uml_token = '') {
        $req = $this -> _db -> prepare("UPDATE `pr_uml` (`name`, `type`, `content`) VALUES (:name, :type, :content) WHERE `uml_token` = '$uml_token' AND `enable` = '1'");

        $req->bindParam(':name', $name);
        $req->bindParam(':type', $type);
        $req->bindParam(':content', $content);
        
        $req->execute();

        return (['success' => true, 'options' => ['content' => "Le diagramme a été edité !", 'theme' => 'success'] ]);

    } 



    /**
     * Supprimer un diagram
     * 
     * Va supprimer le diagramme
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $uml_token Token de l'uml
     * @return array
     */
    
    function deleteDiagram($uml_token = '') {
        $request = $this -> _db -> exec("DELETE FROM `pr_uml` WHERE `uml_token` = '$uml_token' AND `enable` = '1' ");
        return (['success' => true, 'options' => ['content' => "Le diagramme a été supprimé !", 'theme' => 'success'] ]);

    } 
    


    


/******************************************************************************/

}
