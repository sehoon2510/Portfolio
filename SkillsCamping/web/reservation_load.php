<?php
require_once "./autoload.php";

use Lib\DB;
use Lib\Helper;

$sql = "SELECT r.*, IFNULL(total, 0) AS total
        FROM reservation AS r
        LEFT JOIN (SELECT rid, COUNT(*) AS total
                    FROM (SELECT DISTINCT rid, date FROM orders GROUP BY date, rid) AS cnt
                    GROUP BY rid) AS o
        ON o.rid = r.id
        WHERE phone = ?
        AND r.admintype <> 'W'
        ORDER BY r.reservation_date DESC;";

$data = DB::fetchAll($sql, [user()->userid]);

Helper::json($data, 200);