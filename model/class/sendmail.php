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
        mail($to, $object, $content);

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
