<?php

class DB {
    private $connection = null;

    public function __construct() {
        $host = 'localhost'; // 호스트 이름
        $dbname = 'swjb'; // 데이터베이스 이름
        $charset = 'utf8mb4'; // 문자셋
        $user = 'root'; // 사용자 이름
        $pass = ''; // 암호

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->connection = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function execute($sql, $data = []) {
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    public function fetch($sql, $data = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch();
    }

    public function fetchAll($sql, $data = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetchAll();
    }
}
