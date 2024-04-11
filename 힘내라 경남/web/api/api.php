<?php

    require_once "../core/init.php";

    $url = explode("/", $_GET["request"]);
    $api = $url[0];

    $method = $_SERVER["REQUEST_METHOD"];

    if($api == "event") {
        if($method == "POST") {
            $sql = "SELECT * FROM `applicants` WHERE `phone` = ? AND `date` = ?";
            $result = fetch($sql, [$_POST['phone'], date("Y-m-d")]);
            if($result) {
                json(["message"=>"하루에 한번만 참여할 수 있습니다."], 401);
            }

            $sql = "INSERT INTO `applicants` VALUES (null, ?, ?, ?, NOW())";
            $result = execute($sql, [$_POST['name'], $_POST['phone'], $_POST['score']]);
            if($result) {
                json(["message"=>"이벤트에 참여해 주셔서 감사합니다."], 200);
            } else {
                json(["message"=>"오류가 발생했습니다. 다시 시도해 주세요."], 401);
            }
        } else {
            $get = $url[1];

            $returnArr = [];
            
            try {
                $sql = "SELECT * FROM `applicants` WHERE `phone` = ? ORDER BY `date` DESC LIMIT 0, 1";
                $data = fetch($sql, [$get]);
                if(!$data) {
                    json(["message"=>"출석정보가 없습니다."], 404);
                }

                $returnArr[] = $data->date;

                for($i = 1; $i < 3; $i++) {
                    $sql = "SELECT * FROM `applicants` WHERE `phone` = ? ORDER BY `date` DESC LIMIT $i, 1";
                    $find = fetch($sql, [$get]);
                    if($find) {
                        $returnArr[] = $find->date;
                    } else {
                        $returnArr = [];
                        $returnArr[] = $data->date;
                    }
                }   
                
                json(["stamps"=>$returnArr], 200);
            } catch(\Exception $e) {

                json(["message"=>"오류가 발생했습니다. 다시 시도해 주세요."], 401);

            }

        }
    }


