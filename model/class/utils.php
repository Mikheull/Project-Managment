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
        setlocale(LC_TIME, "fr_FR");
        $date = date("Y-m-d H:i:s");

        $request = $this -> _db -> exec("INSERT INTO `pr_log` (`user_public_token`, `ref_token`, `ref_table`, `type`, `optional`, `date`) VALUES ('$user', '$ref', '$table', '$type', '$options', '$date') ");
    }

/******************************************************************************/

}
