<?php

class utils extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }


/******************************************************************************/

    /**
     * Get une donnée
     * 
     * Récupère une donnée dans la bdd en prenant plusieurs paramètres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $table Nom de la table
     * @param string $col Nom de la colonne
     * @param string $where_condition Condition du Where
     * @param string $where_value Valeur du Where
     * @return var
     */
    
    function getData($table = '', $col = '', $where_condition = '', $where_value = ''){
        $request = $this -> _db -> query("SELECT $col FROM $table WHERE $where_condition = '$where_value' ");
        $res = $request->fetch();
        
        return $res[$col];
    }



    /**
     * Set une donnée
     * 
     * Défini une donnée dans la bdd en prenant plusieurs paramètres
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $table Nom de la table
     * @param string $col Nom de la colonne
     * @param string $value Nouvelle valeur
     * @param string $where_condition Condition du Where
     * @param string $where_value Valeur du Where
     * @return var
     */
    
    function setData($table = '', $col = '', $value = '', $where_condition = '', $where_value = ''){
        $exec = $this -> _db -> exec("UPDATE `$table` SET `$col` = '$value' WHERE `$where_condition` = '$where_value' ");
        return $value;
    }



    /**
     * Créer un log
     * 
     * Générer un log, qui gardera une trace de l'action effectué
     *
     * @access public
     * @author Mikhaël Bailly
     * @param int $user Token de l'utilisateur
     * @param int $ref Token de reference
     * @param int $table Table SQL de l'action
     * @param int $type Type d'action
     * @return null
     */
    
    function addlog($user = '', $ref = '', $table = '', $type = '', $options = null){
        $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `ref_token`, `ref_table`, `type`, `optional`, `date`) VALUES ('$user', '$ref', '$table', '$type', '$options', NOW()) ");
    }

/******************************************************************************/



/******************************************************************************/

    /**
     * Récupère un réglage
     * 
     * Récupère un réglage dans la bdd
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $setting Chemin du setting
     * @param string $col Nom de la colonne de réglage
     * @param string $token Token du projet
     * @return var
     */
    
    function getSetting($setting = '', $col = '', $token = ''){
        $request = $this -> _db -> query("SELECT $col FROM `pr_settings` WHERE `token` = '$token' ");
        $res = $request->fetch();

        $arr = json_decode($res[$col]);
        return $arr -> {$setting};
    }

/******************************************************************************/


}
