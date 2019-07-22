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
        $request = $this -> _db -> query("SELECT * FROM `pr_messenger_message` WHERE `channel_token` = '$channel_token' AND `enable` = '1' ORDER BY ID ASC");
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




    /**
     * Créer un channel
     * 
     * Créer un channel dans le projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $name Nom du channel
     * @param string $topic Topic du channel
     * @return boolean
     */

    function newChannel($project_token = '', $name = '', $topic = ''){

        $channel_token = $this -> generateToken(15, 'numbers');
        $request = $this -> _db -> exec("INSERT INTO `pr_messenger_channels` (`project_token`, `channel_token`, `name`, `subject`) VALUES ('$project_token','$channel_token','$name','$topic')");
        return (['success' => true, 'options' => ['content' => "Le channel a été créer !", 'theme' => 'success'] ]);
    } 
    


    /**
     * Envoyer un message
     * 
     * Envoie un message dans un channel de projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $content Contenu du message
     * @param string $project_token Token du projet
     * @param string $channel_token Token du channel
     * @return boolean
     */

    function newMessage($content = '', $project_token = '', $channel_token = ''){

        $author_token = main::getToken();
        $message_token = $this -> generateToken(20, 'numbers');
        $request = $this -> _db -> exec("INSERT INTO `pr_messenger_message` (`project_token`, `channel_token`, `message_token`, `author_token`, `content`) VALUES ('$project_token','$channel_token','$message_token','$author_token','$content')");
    } 
    


    /**
     * Editer un message
     * 
     * Editer un message dans un channel de projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $content Contenu du message
     * @param string $message_token Token du message
     * @return boolean
     */

    function editMessage($content = '', $message_token){
        
        $author_token = main::getToken();
        $request = $this -> _db -> exec("UPDATE `pr_messenger_message` SET `content_edited` = '$content', `date_edited` = NOW() WHERE `message_token` = '$message_token' AND `author_token` = '$author_token' AND `enable` = '1'");
    } 

    



    /**
     * Supprimer un message
     * 
     * Supprimer un message dans un channel de projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $message_token Token du message
     * @return boolean
     */

    function deleteMessage($message_token = ''){

        $request = $this -> _db -> exec("UPDATE `pr_messenger_message` SET `enable` = '0' WHERE `message_token` = '$message_token' AND `enable` = '1'");
        return (['success' => true, 'options' => ['content' => "Le message à été supprimé !", 'theme' => 'success'] ]);
    } 


    
    /**
    * Markdown
    * 
    * Transforme les éléments transformable en html
    *
    * @access public
    * @author Mikhaël Bailly
    * @param string $text Texte a check
    * @param string $project_token Token du projet
    * @return text
    */

    function convertMarkdown($text = '', $project_token = ''){
        $text = htmlspecialchars($text, ENT_QUOTES, "UTF-8"); 
        
        $text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text); // Italic
        $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text); // Bold
        $text = preg_replace('/\*\**(.+?)\*\**/s', '<em><strong>$1</strong></em>', $text); // Italic Bold
        $text = preg_replace('/\~\~(.+?)\~\~/s', '<s>$1</s>', $text); // Barré
        $text = preg_replace('/__(.+?)__/s', '<u>$1</u>', $text); // Underline
        $text = preg_replace('/__\*(.+?)\*__/s', '<em><u>$1</u><\em>', $text); // Italic Underline
        $text = preg_replace('/__\*\*(.+?)\*\*__/s', '<strong><u>$1</u><\strong>', $text); // Bold Underline
        $text = preg_replace('/__\*\*\*(.+?)\*\*\*__/s', '<em><strong><u>$1</u><\strong><\em>', $text); // Italic Bold Underline
        
        $text = preg_replace('/\`\`\`([^\*]+)\`\`\`/', '<code>$1</code>', $text); // CodeBlock
        $text= preg_replace("/(?<!a href=\")(?<!src=\")((http|ftp)+(s)?:\/\/[^<>\s]+)/i", "<a href=\"\\0\" target=\"blank\">\\0</a>", $text); // Links
        
        $text = str_replace("    ", "\t", $text); // replace space to tab

        if( strpos( $text, '#' ) !== false ){
            $request = $this -> _db -> query("SELECT * FROM `pr_messenger_channels` WHERE `project_token` = '$project_token' AND `enable` = '1' ");
            foreach($request->fetchAll() as $res){
                $text = str_ireplace('#'.$res['name'], '<a href="'. $res['channel_token'] .'" class="btn dark-btn btn-xs">#'. $res['name'] .'</a>', $text);
            }
        }

        return $text;
    }



/******************************************************************************/

}
