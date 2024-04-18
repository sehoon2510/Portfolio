<?php

require_once "./autoload.php";
use Lib\Helper;
use Lib\DB;


$sql = "SELECT m.*, s.class, s.text, s.color FROM `menus` AS m LEFT JOIN special AS s ON m.special = s.id AND m.special IS NOT NULL";

$datas = DB::fetchAll($sql, []);

Helper::json($datas, 200);