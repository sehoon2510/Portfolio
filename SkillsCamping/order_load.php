<?php
require_once "./autoload.php";

use Lib\DB;
use Lib\Helper;

$returnData = [];

$sql = "SELECT * FROM `reservation` WHERE id = ?";

$rData = DB::fetch($sql, [$_GET['rid']]);

$sql = "SELECT * FROM `orders` AS o LEFT JOIN `menus` AS m ON o.mid = m.id WHERE rid = ? AND date = ?";

$order = DB::fetch($sql, [$_GET['rid'], $_GET['date']]);

$data = [
    "data"=>DB::fetchAll($sql, [$_GET['rid'], $_GET['date']]),
    "date"=>$order->date,
    "state"=>$order->state,
    "seat"=>$rData->seat,
    "rdate"=>$rData->reservation_date
];

Helper::json(["data"=>[$data]]);