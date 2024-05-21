<?php

namespace Lib;

class DB
{
    private static $DB = null;
    public static function DBGet()
    {
        if(is_null(self::$DB)) {
            self::$DB = new \PDO("mysql:host=localhost;dbname=swjb;charset=utf8mb4", "root", "");
        }
        return self::$DB;
    }   


    public static function execute($sql, $data = [])
    {
        $q = self::DBGet()->prepare($sql);
        return $q->execute($data);
    }



    public static function fetch($sql, $data = [], $mode = \PDO::FETCH_OBJ)
    {
        $q = self::DBGet()->prepare($sql);
        $q->execute($data);
        return $q->fetch($mode);
    }
    public static function fetchAll($sql, $data = [], $mode = \PDO::FETCH_OBJ)
    {
        $q = self::DBGet()->prepare($sql);
        $q->execute($data);
        return $q->fetchAll($mode);
    }
}