<?php

    session_start();

    define("ROOT", $_SERVER['DOCUMENT_ROOT']);
    define("SRC", ROOT . "/src");
    define("VIEW", SRC . "/View");
    define("UPLOADS", ROOT . "/uploads");

    require SRC . "/autoload.php";
    require SRC . "/helper.php";
    require SRC . "/web.php";


    