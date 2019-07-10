<?php

/**
 * 
 * database.php
 * 
 * Fichier de connexion a la base de données
 * ( faire un fichier séparer sert principalement pour
 *   les codes en ajax qui ont besoin de la connexion a
 *   la base de données , mais aussi pour séparer. )
 * 
 * 
 * $host = l'hote de la base de données (localhost en local, l'ip de la machine en vps)
 * $dbname = le nom de la base de données
 * $user = l'utilisateur de connexion
 * $pass = le mot de passe de connexion
 * 
 */

$host = 'localhost';
$dbname = 'improove';
$user = 'root';
$pass = 'root';


try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $db -> exec("SET NAMES utf8mb4");
} catch (Exception $e) {
    throw new Exception('La base de donnée n\'a pas pu être connectée !');
}


function cleanVar($value) {
    if(!get_magic_quotes_gpc()) { $value = addslashes($value); }
    $value = strip_tags($value);
    return $value;
}

