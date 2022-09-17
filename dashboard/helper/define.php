<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once "database/config.php";
    
    if(!session_start()){
        session_start();
    }

    $url = 'http://'.$_SERVER['HTTP_HOST'].'/';
    define("ROOT","$url");

    // DATABASE SETTINGS
    define("HOST","localhost");
    define("USER","root");
    define("PASSWORD","");
    define("DB_NAME","lenskart");

?>