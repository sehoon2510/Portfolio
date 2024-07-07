<?php
    namespace Controller;

    use App\DB;

    class MainController {
        function indexPage() {
            view("index");
        }
        
        function signupPage() {
            view("signup");
        }
        
        function loginPage() {
            view("login");
        }
        
        function messagePage() {
            $sql = "SELECT m.*, f.name, f.id AS fid FROM messages AS m LEFT JOIN festivals AS f ON f.id = m.fid WHERE m.uid = ? AND m.type = 1";

            view("message", ["messages" =>DB::fetchAll($sql, [user()->id])]);
        }
        
        function messageAction() {
            extract($_POST);

            $sql = "UPDATE messages SET `type` = 2 WHERE id = ?";
            DB::execute($sql, [$id]);

            echo "<script>";
            echo "location.href = '{$path}';";
            echo "</script>";
            exit;
        }

        function festivalListPage() {
            $sql = "SELECT * FROM festivals";
            view("festivalList", ["data" => DB::fetchAll($sql)]);
        }
        
        function festivalDataPage($id) {
            extract($id);
            $sql = "SELECT f.*, IFNULL(AVG(r.score), '리뷰 없음') AS score FROM festivals AS f LEFT JOIN reviews AS r ON r.fid = f.id WHERE f.id = ?";
            $data = DB::fetch($sql, [$id1]);
            $sql = "SELECT * FROM festivals WHERE id != ? AND city = ? LIMIT 0, 4";
            $festivals = DB::fetchAll($sql, [$data->id, $data->city]);
            $sql = "SELECT r.*, u.userID, u.name FROM reviews AS r LEFT JOIN users AS u ON u.id = r.uid WHERE `fid` = ? ORDER BY `date` DESC";
            $reviews = DB::fetchAll($sql, [$id1]);
            $sql = "SELECT q.*, u.userID, u.name FROM questions AS q LEFT JOIN users AS u ON u.id = q.uid WHERE `fid` = ? AND q.type = 'q' ORDER BY `date` DESC";
            $questions = [];
            foreach(DB::fetchAll($sql, [$id1]) as $key => $value) {
                $sql = "SELECT q.*, u.userID, u.name FROM questions AS q LEFT JOIN users AS u ON u.id = q.uid WHERE `fid` = ? AND `target` = ? ORDER BY `date` DESC";
                $questions[$key] = ["q"=>$value, "a"=>DB::fetch($sql, [$id1, $value->id])];
            }
            
            $sql = "SELECT f.id AS goodCheck, IFNULL(COUNT(g.id), 0) AS good FROM festivalGoods AS f LEFT JOIN festivalGoods AS g ON f.id = g.id WHERE g.uid = ? AND g.fid = ?";
            $goods = DB::fetch($sql, [user() ? user()->id : 0, $id1]);
            $message = null;
            if(user()) {
                $sql = "SELECT id AS acceptCheck FROM messageAccept WHERE `uid` = ? AND `fid` = ?";
                $message = DB::fetch($sql, [user()->id, $id1]);
            }

            view("festivalData", ["data" => $data, "goods"=>$goods, "message"=>$message, "list" => $festivals, "questions"=>$questions, "reviews"=>$reviews]);
        }
        
        function festivalNoticePage($id) {
            extract($id);
            
            $sql = "SELECT * FROM `festivals` WHERE `id` = ?";
            $festival = DB::fetch($sql, [$id1]);
            $sql = "SELECT n.*, u.name, u.userID FROM `notices` AS n LEFT JOIN users AS u ON u.id = `uid` WHERE `fid` = ? ORDER BY `date` DESC";
            $notices = DB::fetchAll($sql, [$id1]);

            view("festivalNotice", ["festival"=> $festival, "notices"=>$notices]);
        }
        
        function festivalNoticeDataPage($id) {
            extract($id);

            $sql = "SELECT * FROM notices WHERE id = ?";
            $data = DB::fetch($sql, [$id1]);
            $sql = "UPDATE notices SET `hit` = ? WHERE `id` = ?";
            DB::execute($sql, [(int)$data->hit + 1, $id1]);

            view("festivalNoticeData", ["data"=>$data]);
        }

        function festivalNoticeWrtiePage($id) {
            extract($id);
            view("festivalNoticeWrtie", ["id"=> $id1]);
        }
        
        function festivalAddPage() {
            view("festivalAdd");
        }
        
        function festivalEditPage($id) {
            extract($id);

            $sql = "SELECT * FROM festivals WHERE id = ?";

            view("festivalEdit", ["data" => DB::fetch($sql, [$id1])]);
        }
        
        function myPage() {
            $data = [];
            if(admin()) {
                $sql = "SELECT f.*, IFNULL(g.count, '좋아요 없음') AS good, IFNULL(r.score, '리뷰 없음') AS score, IFNULL(r.count, '리뷰 없음') AS review, IFNULL(b.count, '판매 없음') AS buy FROM festivals AS f LEFT JOIN (SELECT COUNT(id) AS count, fid FROM festivalgoods) AS g ON g.fid = f.id LEFT JOIN (SELECT AVG(score) AS score, COUNT(id) AS count, fid FROM reviews) AS r ON r.fid = f.id LEFT JOIN (SELECT SUM(count) AS count, fid FROM ticketbuy) AS b ON b.fid = f.id WHERE f.uid = ?";
                $data = DB::fetchAll($sql, [admin()->id]);
            } else {
                $sql = "SELECT t.id AS tid, t.count, t.price, t.type, f.* FROM TicketBuy AS t LEFT JOIN festivals AS f ON f.id = `fid` WHERE `uid` = ?";
                $data = DB::fetchAll($sql, [user()->id]);
            }

            view("mypage", ["data" => $data]);
        }
        
    }