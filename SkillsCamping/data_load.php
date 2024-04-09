<?php

require_once "./autoload.php";

use Lib\DB;
use Lib\Helper;

if($_GET['table'] == "reservation"){
    $addSql = "";

    $sql = "SELECT u.username, r.* FROM users AS u, reservation AS r WHERE u.userid = r.phone AND r.reservation_date BETWEEN ? AND ?";

    if(isset($_GET['seat'])) {
        $addSql = " AND r.seat = ?";
    }

    $sql .= $addSql . " ORDER BY r.reservation_date DESC";

    $data;

    if(isset($_GET['seat'])) {
        $data = DB::fetchAll($sql, [$_GET['start'], $_GET['end'], $_GET['seat']]);
    } else {
        $data = DB::fetchAll($sql, [$_GET['start'], $_GET['end']]);
    }
}

if($_GET['table'] == "order"){
    // 리스트 구하기

    $addSql = "";

    $sql = "SELECT rd.id, rd.username, rd.reservation_date, rd.seat, res.state, res.date, total
            FROM (SELECT * FROM `reservation` AS r, `users` AS u
                  WHERE u.userid = r.phone) AS rd
            LEFT JOIN (SELECT SUM(o.count * m.buy) AS total, m.menu, o.*
                       FROM `orders` AS o
                       LEFT JOIN `menus` AS m
                       ON m.id = o.mid
                      GROUP BY o.date, o.rid) AS res 
            ON res.rid = rd.id 
            WHERE rd.reservation_date BETWEEN ? AND ?
            AND res.rid IS NOT NULL";

    if(isset($_GET['seat'])) {
        $addSql = " AND rd.seat = ?";
    }

    $sql .= $addSql . " ORDER BY rd.reservation_date DESC, res.date DESC;";

    $data;

    if(isset($_GET['seat'])) {
        $data = DB::fetchAll($sql, [$_GET['start'], $_GET['end'], $_GET['seat']]);
    } else {
        $data = DB::fetchAll($sql, [$_GET['start'], $_GET['end']]);
    }
}

Helper::json($data, 200);
