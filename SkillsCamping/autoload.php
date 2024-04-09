<?php

session_start();

function myLoader($name) {
    $base_dir = __DIR__ . "/src/";
    $realName = str_replace("\\", "/", $name);
    $file = "{$base_dir}{$realName}.php";
    if(file_exists($file))
    include_once $file;
}

function user() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}

spl_autoload_register("myLoader");