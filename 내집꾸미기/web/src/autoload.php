<?php
    function classLoader($className) {
        $filePath = SRC . "/$className.php";
        if(is_file($filePath)) require $filePath;
    }

    spl_autoload_register("classLoader");