<?php

    function get() {
        $conn = new \PDO("mysql:host=localhost;dbname=swjb;charset=utf8mb4", "root", "", [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);

        return $conn;
    }

    function execute($sql, $data = []) {
        $q = get()->prepare($sql);
        $q->execute($data);
        return $q; 
    }

    function fetch($sql, $data = []) {
        return execute($sql, $data)->fetch();
    }
    
    function fetchAll($sql, $data = []) {
        return execute($sql, $data)->fetchAll();
    }