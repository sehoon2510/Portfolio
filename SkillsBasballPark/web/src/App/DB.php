<?php
    namespace App;

    class DB {
        static $conn = null;

        static function GetConn() {
            if(self::$conn === null) {
                self::$conn = new \PDO("mysql:host=localhost;dbname=swjb;charset=utf8mb4", "root", "", [
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                ]);
            }
            return self::$conn;
        }

        static function execute($sql, $data = []) {
            $q = self::GetConn()->prepare($sql);
            $q->execute($data);
            return $q;
        }

        static function fetch($sql, $data = []) {
            return self::execute($sql, $data)->fetch();
        }
        
        static function fetchAll($sql, $data = []) {
            return self::execute($sql, $data)->fetchAll();
        }
    }