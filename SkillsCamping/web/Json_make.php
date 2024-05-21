<?php

require_once("DB.php");

header("Content-type: application/json");

$db = new DB();

$Totleresult = array();

$db->execute("DELETE FROM reservationjson");

for($i = 0; $i < 14; $i++){
    $sql = "INSERT INTO reservationjson (`seat`, `date`, `type`) VALUES (?, ?, ?)";
    for($a = 1; $a < 8; $a++){
        $result = $db->execute($sql, ['A0' . $a, $i, 'W']);
        array_push($Totleresult, $result);
    }

    for($t = 1; $t < 11; $t++){
        $pushT = $t;
        if($t < 10){
            $pushT = 0 . $t;
        }

        $result = $db->execute($sql, ['T'.$pushT, $i, 'W']);
        array_push($Totleresult, $result);
    }
}

echo json_encode($Totleresult, JSON_UNESCAPED_UNICODE);