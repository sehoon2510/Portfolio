<?php
    function classautoload($name) {
        $filePath = SRC . "/$name.php";
        if(is_file($filePath)) {
            require $filePath;
        }
    }

    spl_autoload_register("classautoload");