<?php

    require __DIR__ . "/App/DB.php";

    use App\DB;

    $sql = "INSERT INTO users VALUES (null, ?, '1234', ?, ?, 1)";

    for($i = 1; $i <= 4; $i++) {

        if(!DB::execute($sql, ["specialist$i", "전문가$i", "specialist$i.jpg"])) {
            
        }

    }
    