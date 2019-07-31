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
