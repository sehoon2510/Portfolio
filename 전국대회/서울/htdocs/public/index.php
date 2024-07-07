<?php

    session_start();

    define("ROOT", dirname(__DIR__));
    define("SRC", ROOT . "/src");
    define("VIEW", SRC . "/View");
    define("UPLOADS", ROOT . "/public/images");

    require SRC . "/autoload.php";
    require SRC . "/lib.php";
    require SRC . "/web.php";