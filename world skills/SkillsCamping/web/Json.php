<?php

require_once "./autoload.php";

use Lib\DB;
use Lib\Helper;

$today = date("Y-m-d", time());

$totalArrData = [];

$sql = "SELECT * FROM reservationjson";
$data = DB::fetchAll($sql);

for($i = 0; $i < 14; $i++){

    $dataName = 'D+'.$i;
    
    $nowDate = date("Y-m-d", strtotime($today . "+" . $i ." day"));


    foreach($data as $list){
        $sql = "SELECT * FROM reservation WHERE `reservation_date` BETWEEN ? AND ? AND `seat` = ?";
        $reservation = DB::fetch($sql, [$nowDate, $nowDate, $list->seat]);
        if($reservation != null){
            $totalArrData[$i][$dataName][] = ["loc_num"=>$reservation->seat,"status"=>$reservation->type];
        } else {
            $totalArrData[$i][$dataName][] = ["loc_num"=>$list->seat,"status"=>$list->type];
        }    
    };
};

Helper::json(["msg"=>"성공적으로 조회되었습니다.", "today"=>$today, "reservition"=>$totalArrData], 200);

// echo json_encode(['today'=>$today, 'reservition'=>$totalArrData], JSON_UNESCAPED_UNICODE);