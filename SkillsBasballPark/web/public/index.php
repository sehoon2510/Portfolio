<?php
    session_start();
    define("ROOT", dirname(__DIR__));
    define("SRC", ROOT . "/src");
    define("VIEW", SRC . "/View");
    define("UPLOAD", ROOT . "/public/uploads");

    require SRC . "/autoload.php";
    require SRC . "/lib.php";
    require SRC . "/web.php";