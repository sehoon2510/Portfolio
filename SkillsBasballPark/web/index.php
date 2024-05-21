<?php
    session_start();

    define("ROOT", $_SERVER['DOCUMENT_ROOT']);
    define("SRC", ROOT . "/src");
    define("VIEW", SRC . "/View");

    require_once SRC . "/autoload.php";
    require_once SRC . "/helper.php";
    require_once SRC . "/web.php";
