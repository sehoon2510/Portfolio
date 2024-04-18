<?php
require_once "./autoload.php";

use Lib\DB;
use Lib\Helper;

if(!isset($_POST)) {
    Helper::json([
        'type'=>'err', 
        'class'=>'fa-triangle-exclamation', 
        'msg'=>'에러가 발생하였습니다.'
    ], 400);
}

$sql = "SELECT * FROM `reservation` WHERE reservation_date = ? AND seat = ? AND phone = ?";

$rdata = DB::fetch($sql, [$_POST['day'], $_POST['seat'], user()->userid]);

if(!$rdata) {
    Helper::json([
        'type'=>'err', 
        'class'=>'fa-triangle-exclamation', 
        'msg'=>'에러가 발생하였습니다.'
    ], 400);
}

$sql = "INSERT INTO `orders` (`rid`, `mid`, `count`, `state`, `date`)
        VALUES (?, ?, ?, ?, ?)";

$result = DB::execute($sql, [$rdata->id, $_POST['id'], $_POST['cnt'], "접수", $_POST['date']]);

if($result) {
    Helper::json([
        'type'=>
        'msg',
        'class'=>
        'fa-envelope',
        'msg'=>
        '성공적으로 접수처리 되었습니다.'
    ], 200);
} else {
    Helper::json([
        'type'=>'err', 
        'class'=>'fa-triangle-exclamation', 
        'msg'=>'에러가 발생하였습니다.'
    ], 400);
}

