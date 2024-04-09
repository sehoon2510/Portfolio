<?php
header('Content-Type: application/json');
require_once("DB.php");

$db = new DB();

$fullData = [];

$data = $db->fetchAll("SELECT * FROM nav WHERE depth = 0", []);

for($i = 0; $i < count($data); $i++) {
    $sql = "SELECT * FROM nav WHERE depth = 1 AND parent = ?";

    $sub = $db->fetchAll($sql, [$data[$i]['id']]);

    $fullData[] = ['main' => $data[$i], 'sub' => $sub];
}

echo json_encode($fullData, JSON_UNESCAPED_UNICODE);