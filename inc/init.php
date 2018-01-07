<?php
    include_once 'User.php'; 
    include_once 'TesztKerdes.php';
    session_start();    
    include_once 'configure.php';
 
    include_once 'common.php';    
    
    // hagyományos adatbáziskezelés: mysql, mysqli
    // Korszerű adatbáziscsatlakozás PDO 
    
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname",
                  $dbuser,
                  $dbpass,
                  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
    
?>
