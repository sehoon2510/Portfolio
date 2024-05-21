<?php
require_once "./autoload.php";

use Lib\DB;
use Lib\Helper;

$returnData = [];

$sql = "SELECT * FROM `orders` WHERE rid = ? GROUP BY date";

$dates = DB::fetchAll($sql, [$_GET['rid']]);

$sql = "SELECT * FROM `reservation` WHERE id = ?";

$rData = DB::fetch($sql, [$_GET['rid']]);

$sql = "SELECT * FROM `orders` AS o LEFT JOIN `menus` AS m ON o.mid = m.id WHERE rid = ? AND date = ?";

foreach($dates as $date) {
    $datas = [
        "data"=>DB::fetchAll($sql, [$_GET['rid'], $date->date]),
        "date"=>$date->date,
        "state"=>$date->state,
        "seat"=>$rData->seat,
        "rdate"=>$rData->reservation_date,
        "rid"=>$date->rid
    ];
    array_push($returnData, $datas);
}



Helper::json(["data"=>$returnData]);