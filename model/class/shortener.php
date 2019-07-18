<?php

class shortener extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Raccourci une url
     * 
     * Raccourci une url donné pour la partage facilement
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $token Token du projet
     * @param string $type Type de partage
     * @param string $base_url Url de base
     * @param string $author_token Token de l'auteur
     * @return array
     */
    
    function newShortenerUrl($token = '', $type = '', $base_url = '', $author_token = '') {
        setlocale(LC_TIME, "fr_FR");
        $date = date("Y-m-d H:i:s");
        $new_token = main::generateToken(5, 'uuid');

        $req = $this -> _db -> prepare("INSERT INTO `pr_shortener` (`type`, `short_url`, `project_token`, `base_url`, `author_token`, `date_creation`) VALUES (:type, :short_url, :project_token, :base_url, :author_token, :date_creation)");

        $req->bindParam(':type', $type);
        $req->bindParam(':short_url', $new_token);
        $req->bindParam(':project_token', $token);
        $req->bindParam(':base_url', $base_url);
        $req->bindParam(':author_token', $author_token);
        $req->bindParam(':date_creation', $date);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
        ?> <script>document.location.href=rootUrl+'sharing/<?= $new_token ?>',target='_blank';</script> <?php
    }
    
    
    
    /**
    * Supprimer une url raccourci
    * 
    * @access public
    * @author Mikhaël Bailly
    * @param string $base_url Url de base
    * @return array
    */

   function deleteShortenerUrl($base_url = '') {
       $request = $this -> _db -> exec("UPDATE `pr_shortener` SET `enable` = 0 WHERE `base_url` = '$base_url' AND `enable` = '1' ");
       return (['success' => true, 'options' => ['content' => "Le fichier n\'est plus partagé !", 'theme' => 'success'] ]);
   }



   /**
     * Vérifie si un shortener partagé existe
     * 
     * Cherche dans la base de données une correspondace avec le short_url shortener partagé fourni
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $short_url Token du shortener partagé
     * @return boolean
     */

    function shortenerExist($short_url = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_shortener` WHERE `short_url` = '$short_url' AND `enable` = '1' ");
        $res = $request->fetch();
        
        return ($res ? true : false);
    }
    

    
/******************************************************************************/

}
