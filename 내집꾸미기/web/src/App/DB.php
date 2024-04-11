<?php
    
    namespace App;

    class DB {
        static $conn = null;
        static function getConn(){
            if(self::$conn === null){
                self::$conn = new \PDO("mysql:host=localhost;dbname=swjb;charset=utf8mb4", "root", "", [
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                ]);
            }
            return self::$conn;
        }

        static function execute($sql, $data = []){
            $q = self::getConn()->prepare($sql);
            $q->execute($data);
            return $q;
        }

        static function fetch($sql, $data = []){
            return self::execute($sql, $data)->fetch();
        }

        static function fetchAll($sql, $data = []){
            return self::execute($sql, $data)->fetchAll();
        }

        static function find($table, $id){
            return self::fetch("SELECT * FROM `$table` WHERE id = ?", [$id]);
        }

        static function who($user_id){
            return self::fetch("SELECT * FROM users WHERE user_id = ?", [$user_id]);
        }
    }