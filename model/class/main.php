<?php

class main {

    /**
     * Generer un token selon une taille et un mode de génération
     * 
     * Faire générer un token aléatoire avec une taille précise,
     * et un type de génération (all = tout caractères normaux / numbers = que des nombres / letters = que des lettres)
     *
     * @access public
     * @author Mikhaël Bailly
     * @param int $length Taille
     * @param string $type Type de génération
     * @return var $token
     */
    
    function generateToken($length = 20, $type = 'all'){
        $pattern =  ($type == 'numbers') ? '0123456789' : (($type == 'letters') ? 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' : '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $token = substr(str_shuffle(str_repeat($pattern, ceil($length/strlen($pattern)) )),1,$length);

        return $token;
    }



    /**
     * Récupérer son token
     * 
     * Obtenir son token public stocké dans la variable de session (user_token)
     *
     * @access public
     * @author Mikhaël Bailly
     * @return var
     */
    
    function getToken(){
        return $_SESSION['user_token'];
    }

}