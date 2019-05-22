<?php

class sendmail extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }


/**
 * function send($from, $to, $object, $content)
 * 
 * Envoi un mail
 * @param 1 = De
 * @param 2 = Pour
 * @param 3 = Objet
 * @param 4 = Contenu
 * @return array
*/
    
    function send($from, $to, $object, $content) {
        mail($to, $object, $content);

        return (
            [
                'success' => true, 
                'message' => 
                    [
                        'text' => 'from: '.$from.'<br>to: '.$to.'<br>object: '.$object.'<br>content: '.$content, 
                        'theme' => 'dark', 
                        'timeout' => 2000
                    ] 
            ]
        );

    }



}


