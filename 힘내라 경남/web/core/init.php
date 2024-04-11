<?php 
    session_start();

    define("ROOT", $_SERVER['DOCUMENT_ROOT']);
    define('CORE', ROOT . "/core");

    require_once CORE . "/DB.php";
    require_once CORE . "/Helper.php";

