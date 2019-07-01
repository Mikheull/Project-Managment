<?php

class sendmail extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }

/******************************************************************************/

    /**
     * Envoi de mail
     * 
     * Va envoyer un email a l'utilisateur
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $from Sender
     * @param string $to Destinataire
     * @param string $object Objet
     * @param string $content Contenu
     * @return boolean
     */
    
    function send($from = '', $to = '', $object = 'undefined', $content = '') {
        $sender = $from;
        $recipient = $to;

        $subject = $object;
        $message = $content;
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'From: ' . $sender. "\r\n";  

        if (mail($recipient, $subject, $message, $headers)){
            echo "Message accepted";
        }else{
            echo "Error: Message not accepted";
        }

        return (
            [
                'success' => true, 
                'options' => 
                    [
                        'content' => 'from: '.$from.'<br>to: '.$to.'<br>object: '.$object.'<br>content: '.$content, 
                        'theme' => 'success'
                    ] 
            ]
        );

    }

/******************************************************************************/

}
