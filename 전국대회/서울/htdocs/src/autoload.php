<?php
    function classLoader($c) {
        $fileName = SRC . "/$c.php";
        if(is_file($fileName)) require $fileName;
    }

    spl_autoload_register("classLoader");