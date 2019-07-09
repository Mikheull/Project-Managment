<?php

class messenger extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Récupère les channels d'un projet
     * 
     * Va renvoyer tout les channels d'un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getProjectChannels($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_messenger_channels` WHERE `project_token` = '$project_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }



    /**
     * Récupère les messages posté dans une conv
     * 
     * Va renvoyer les messages posté dans une conv
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $channel_token Token du channel
     * @return array
     */
    
    function getMessages($channel_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_messenger_message` WHERE `channel_token` = '$channel_token' AND `enable` = '1' ORDER BY ID DESC");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }



    /**
     * Récupère le dernier message posté dans une conv
     * 
     * Va renvoyer le dernier message posté dans une conv
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $channel_token Token du channel
     * @return array
     */
    
    function getLastMessagePosted($channel_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pr_messenger_message` WHERE `channel_token` = '$channel_token' AND `enable` = '1' ORDER BY ID DESC LIMIT 1");
        return $request->fetch();
    }

/******************************************************************************/

}
