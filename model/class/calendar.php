<?php

class calendar extends project {


/******************************************************************************/

    /**
     * Récupère les tableau de taches d'un projet
     * 
     * Va renvoyer tout les tableau de taches d'un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getEvents($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_event` WHERE `project_token` = '$project_token' AND `enable` = '1' ");
        return $request->fetchAll();
    }



    /**
     * Créer un tableau
     * 
     * Va créer un evenement sur le calendrier
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $name Nom de l'event
     * @param string $start Date de début
     * @param string $end Date de fin
     * @return array
     */
    
    function newEvent($project_token = '', $name = '', $start = '', $end = '') {
        $event_token = main::generateToken(10, 'uuid');
        
        $req = $this -> _db -> prepare("INSERT INTO `pr_event` (`project_token`, `event_token`, `name`, `date_begin`, `date_end`) VALUES (:project_token, :event_token, :name, :date_begin, :date_end)");

        $req->bindParam(':project_token', $project_token);
        $req->bindParam(':event_token', $event_token);
        $req->bindParam(':name', $name);
        $req->bindParam(':date_begin', $start);
        $req->bindParam(':date_end', $end);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
        return (['success' => true, 'options' => ['content' => "L'evenement a été ajouté !", 'theme' => 'success'] ]);

    } 



    /**
     * Supprimer un évènement
     * 
     * Supprimer un évènement
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token de l'event
     * @return array
     */

    function disableEvent($token = '') {
        $request = $this -> _db -> exec("UPDATE `pr_event` SET `enable` = 0 WHERE `event_token` = '$token' AND `enable` = '1' ");
        return (['success' => true, 'options' => ['content' => "L'event a été supprimé !", 'theme' => 'success'] ]);
    }



    /**
     * Modifie les infos
     * 
     * Va modifier les infos de l'event
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $name nom
     * @param string $description Description de l'event
     * @param string $token Token de l'event
     * @return array
     */
    
    function editEvent($name = '', $description = '', $token = '') {
        $exec = $this -> _db -> exec("UPDATE `pr_event` SET `name` = '$name', `description` = '$description' WHERE `event_token` = '$token' ");
        return (['success' => true, 'options' => ['content' => "Les informations on été modifiés !", 'theme' => 'success'] ]);
    }


    /**
     * Déplace un event
     * 
     * Va déplacer la date d'un event
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $date Nouvelle date de l'event
     * @param string $token Token de l'event
     * @return array
     */
    
    function moveEvent($date = '', $token = '') {
        $req = $this -> _db -> prepare("UPDATE `pr_event` SET `date_begin` = :date_begin, `date_end` = :date_end WHERE `event_token` = :token ");

        $req->bindParam(':token', $token);
        $req->bindParam(':date_begin', $date);
        $req->bindParam(':date_end', $date);

        $req->execute();
    }
    

/******************************************************************************/

}
