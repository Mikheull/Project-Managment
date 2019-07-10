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
     * @param string $type Type de partage
     * @param string $base_url Url de base
     * @param string $author_token Token de l'auteur
     * @return array
     */
    
    function newShortenerUrl($type = '', $base_url = '', $author_token = '') {
        setlocale(LC_TIME, "fr_FR");
        $date = date("Y-m-d H:i:s");
        $new_token = main::generateToken(5, 'uuid');

        $req = $this -> _db -> prepare("INSERT INTO `pr_shortener` (`type`, `short_url`, `base_url`, `author_token`, `date_creation`) VALUES (:type, :short_url, :base_url, :author_token, :date_creation)");

        $req->bindParam(':type', $type);
        $req->bindParam(':short_url', $new_token);
        $req->bindParam(':base_url', $base_url);
        $req->bindParam(':author_token', $author_token);
        $req->bindParam(':date_creation', $date);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
        ?> <script>document.location.href=rootUrl+'sharing/<?= $new_token ?>',target='_blank';</script> <?php
        return (['success' => true, 'options' => ['content' => "Le document a bien été partagé (https://www.improove.tk/sharing/'.$new_token.') !", 'theme' => 'success'] ]);
    }

/******************************************************************************/

}
