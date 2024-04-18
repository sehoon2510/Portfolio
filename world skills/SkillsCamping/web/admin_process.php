<?php
require_once "./autoload.php";

use Lib\DB;
use Lib\Helper;

if($_POST['table'] == 'reservation'){
    $sql = "UPDATE `reservation` SET `admintype` = ?, `type` = ? WHERE `id` = ?";

    $result = DB::execute($sql, [$_POST['type'], $_POST['type'], $_POST['id']]);

    DB::execute("DELETE FROM `orders` WHERE rid = ?", [$_POST['id']]);

}

if($_POST['table'] == 'order'){
    $sql = "UPDATE `orders` SET `state` = ? WHERE `rid` = ? AND `date` = ?";

    $result = DB::execute($sql, [$_POST['state'], $_POST['id'], $_POST['date']]);

}

if($result){

    Helper::json($result, 200);

}