<?php
 
    namespace Controller;

    use App\DB;

    class MainController {
        function indexPage() {
            view("index", ["a", "b"]);
        }
        
        function storePage() {
            view("store", ["a", "b"]);
        }
        
        function knowhowsPage() {
            view("knowhows", []);
        }

        function knowhowsData() {
            $sql = user() ? "SELECT k.*, u.user_id, u.name, m.kid AS `write`, IFNULL(r.cnt, 0) AS cnt FROM knowhows AS k LEFT JOIN users AS u ON u.id = k.uid LEFT JOIN (SELECT kid, AVG(IFNULL(score, 0)) AS cnt FROM knowhow_r GROUP BY kid) AS r ON r.kid = k.id LEFT JOIN (SELECT kid FROM knowhow_r WHERE uid = ?) AS m ON m.kid = k.id ORDER BY k.id"
            : "SELECT k.*, u.user_id, u.name, IFNULL(r.cnt, 0) AS cnt FROM knowhows AS k LEFT JOIN users AS u ON u.id = k.uid LEFT JOIN (SELECT kid, AVG(IFNULL(score, 0)) AS cnt FROM knowhow_r GROUP BY kid) AS r ON r.kid = k.id ORDER BY k.id";

            $result = user() ? DB::fetchAll($sql, [user()->id]) : DB::fetchAll($sql, []);
            if($result) {
                echo json_encode([$result], JSON_UNESCAPED_UNICODE);
            } else {
                
            }
        }

        function knowhowsWrite() {
            extract($_POST);
            extract($_FILES);

            $before_img = Image_uploads($before_img, "knowhows/before_");
            $after_img = Image_uploads($after_img, "knowhows/after_");

            $sql = "INSERT INTO knowhows(uid, comment, before_img, after_img) VALUES (?, ?, ?, ?)";
            if(!DB::execute($sql, [user()->id, $contents, $before_img, $after_img])) {
                back("에러가 발생했습니다.");
            } else {
                go("정상적으로 등록되었습니다.", "/knowhows");
            }
        }

        function knowhowsRivew() {
            
            extract($_POST);

            $sql = "INSERT INTO knowhow_r VALUES (?, ?, ?)";

            if(DB::execute($sql, [$kid, user()->id, $score])) {
                $sql = "SELECT k.*, u.user_id, u.name, m.kid AS `write`, IFNULL(r.cnt, 0) AS cnt FROM knowhows AS k LEFT JOIN users AS u ON u.id = k.uid LEFT JOIN (SELECT kid, AVG(IFNULL(score, 0)) AS cnt FROM knowhow_r GROUP BY kid) AS r ON r.kid = k.id LEFT JOIN (SELECT kid FROM knowhow_r WHERE uid = ?) AS m ON m.kid = k.id";
                
            } else {
                
            }

        }

        function specialistPage() {

            $sql = "SELECT u.*, IFNULL(score, 0) AS score FROM users AS u LEFT JOIN (SELECT eid, FLOOR(AVG(IFNULL(score, 0))) AS score FROM special_r) AS r ON r.eid = u.id WHERE `grant` = 1";
            $users = DB::fetchAll($sql);
            $sql = "SELECT r.*, s.name, s.user_id, u.name AS write_name, u.user_id AS write_id FROM special_r AS r LEFT JOIN (SELECT * FROM users WHERE `grant` = 1 ) AS s ON s.id = r.eid LEFT JOIN users AS u ON u.id = r.uid ORDER BY r.id";   
            $reviews = DB::fetchAll($sql, []);

            view("specialist", ["users"=>$users, "reviews"=>$reviews]);
        }

        function specialistReview() {
            extract($_POST);

            if(!user()) back("로그인을 먼저 해 주세요");

            $sql = "INSERT INTO special_r VALUES (null, ?, ?, ?, ?, ?)";
            if(DB::execute($sql, [$eid, user()->id, $price, $contents, $score])) {
                
                go("후기가 등록되었습니다.", "/specialist");

            } else {
                back("에러가 발생하였습니다.");
            }
        }

        function estimatesPage() {

            $sql = user() ? "SELECT e.*, u.user_id, u.name, IFNULL(c.cnt, 0) AS cnt, r.eid AS `write` FROM estimates AS e LEFT JOIN users AS u ON u.id = e.uid LEFT JOIN (SELECT eid, COUNT(*) AS cnt FROM estimate_r GROUP BY eid) AS c ON c.eid = e.id LEFT JOIN (SELECT eid FROM estimate_r WHERE uid = ?) AS r ON r.eid = e.id" 
            : "SELECT  e.*, u.user_id, u.name, IFNULL(c.cnt, 0) AS cnt FROM estimates AS e LEFT JOIN users AS u ON u.id = e.uid LEFT JOIN (SELECT eid, COUNT(*) AS cnt FROM estimate_r GROUP BY eid) AS c ON c.eid = e.id";
            $requests = user() ? DB::fetchAll($sql, [user()->id]) : DB::fetchAll($sql);

            $responses = null;

            if(user() && user()->grant == 1) {
                $sql = "SELECT r.*, u.user_id, u.name, e.comment, e.date FROM estimate_r AS r LEFT JOIN estimates AS e ON e.id = r.eid LEFT JOIN users AS u ON u.id = e.uid WHERE r.uid = ?";
                $responses = DB::fetchAll($sql, [user()->id]);
            }

            view("estimates", ["requests"=>$requests, "responses"=>$responses]);
        }

        function estimatesWrite() {
            extract($_POST);

            $sql = "INSERT INTO estimates VALUES (null, ?, ?, ?)";
            if(DB::execute($sql, [user()->id, $contents, $start_date])) {
                go("성공적으로 요청되었습니다.", "/estimates");
            } else back("에러가 발생하였습니다.");
        }

        function estimatesReview() {
            extract($_POST);
            var_dump($_POST);

            $sql = "INSERT INTO estimate_r VALUES (null, ?, ?, DEFAULT, ?)";
            if(DB::execute($sql, [$eid, user()->id, $price])) {
                go("정상적으로 처리되었습니다.", "/estimates");
            } else {
                back("에러가 발생했습니다.");
            }
        }

        function estimatesGet() {
            $sql = "SELECT r.*, s.user_id, s.name FROM estimate_r AS r LEFT JOIN (SELECT * FROM users WHERE `grant` = 1) AS s ON s.id = r.uid WHERE r.eid = ? ORDER BY r.id";
            $result = DB::fetchAll($sql, [$_GET['id']]);

            echo json_encode($result, JSON_UNESCAPED_UNICODE);

        }

        function estimatesCheck() {
            extract($_POST);

            $sql = "UPDATE estimate_r SET status = '미선택' WHERE eid = ? AND id != ?";
            if(DB::execute($sql, [$eid, $id])) {
                $sql = "UPDATE estimates SET status = '완료' WHERE id = ?";
                if(DB::execute($sql, [$eid])) {
                    $sql = "UPDATE estimate_r SET status = '선택' WHERE eid = ? AND id = ?";
                    if(DB::execute($sql, [$eid, $id])) {    
                        json_encode(["성공적으로 처리되었습니다."], JSON_UNESCAPED_UNICODE);
                    } else json_encode(["에러가 발생했습니다."], JSON_UNESCAPED_UNICODE);
                } else json_encode(["에러가 발생했습니다."], JSON_UNESCAPED_UNICODE);
            } else json_encode(["에러가 발생했습니다."], JSON_UNESCAPED_UNICODE);
        }
    }