<?php
    namespace Controller;

    use App\DB;

    class FestivalController {
        function GoodAdd() {
            extract($_POST);

            $sql = "SELECT * FROM festivalGoods WHERE `uid` = ? AND `fid` = ?";
            if(DB::fetch($sql, [user()->id, $id])) {

                $sql = "DELETE FROM festivalGoods WHERE `uid` = ? AND `fid` = ?";
                DB::execute($sql, [user()->id, $id]);
                json(["msg"=>"성공", "type"=>"delete"]);

            } else {

                $sql = "INSERT INTO festivalGoods (`uid`, `fid`) VALUES (?, ?)";
                DB::execute($sql, [user()->id, $id]);
                json(["msg"=>"성공", "type"=>"add"]);

            }

            json(["msg"=>"에러"]);
        }

        function messageAccept() {
            extract($_POST);

            $sql = "SELECT * FROM messageAccept WHERE `uid` = ? AND `fid` = ?";
            if(DB::fetch($sql, [user()->id, $id])) {

                $sql = "DELETE FROM messageAccept WHERE `uid` = ? AND `fid` = ?";
                DB::execute($sql, [user()->id, $id]);
                json(["msg"=>"성공", "type"=>"refuse"]);

            } else {

                $sql = "INSERT INTO messageAccept (`uid`, `fid`) VALUES (?, ?)";
                DB::execute($sql, [user()->id, $id]);
                json(["msg"=>"성공", "type"=>"accept"]);

            }

            json(["msg"=>"에러"]);
        }

        function TicketBuy() {
            extract($_POST);

            $sql = "INSERT INTO TicketBuy (`uid`, `fid`, `count`, `price`) VALUES (?, ?, ?, ?)";
            if(!DB::execute($sql, [user()->id, $id, $count, $price * $count]))
                back("에러");

            go("등록되었습니다.", "/mypage");
        }

        function QuestionAdd() {
            extract($_POST);

            $sql = "INSERT INTO questions (`uid`, `fid`, `type`, `content`, `date`) VALUES (?, ?, ?, ?, NOW())";
            if(!DB::execute($sql, [user()->id, $id, "q", $content]))
                back("에러");
            
            $festival = DB::fetch("SELECT `uid` FROM festivals WHERE id = ?", [$id]);
            $sql = "INSERT INTO messages (`uid`, `fid`, `target` `msgType`, `comment`, `date`) VALUES (?, ?, ?, ?, ?, NOW())";
            DB::execute($sql, [$festival->uid, $id, $id, "축제 질문", "에 대한 문의가 왔습니다"]);       

            go("등록되었습니다.", "/festivalData/$id");
        }

        function AnswerAdd() {
            extract($_POST);

            $sql = "INSERT INTO questions (`uid`, `fid`, `target`, `type`, `content`, `date`) VALUES (?, ?, ?, ?, ?, NOW())";
            if(!DB::execute($sql, [admin()->id, $fid, $qid, "a", $content]))
                back("에러");

            $sql = "INSERT INTO messages (`uid`, `fid`, `target`, `msgType`, `comment`, `date`) VALUES (?, ?, ?, ?, ?, NOW())";
            DB::execute($sql, [$qid, $fid, $fid, "질문 답변", "에 질문 답변이 왔습니다"]);

            go("등록되었습니다.", "/festivalData/$fid");
        }

        function FestivalAttend() {
            extract($_POST);
            $sql = "UPDATE TicketBuy SET `type` = 2 WHERE `id` = ?";
            DB::execute($sql, [$id]);
            go("참가되었습니다.", "/mypage");
        }

        function FestivalReview() {
            extract($_POST);
            $sql = "SELECT * FROM ticketbuy WHERE `type` > 1 AND `uid` = ?";
            $find = DB::fetch($sql, [user()->id]);
            if(!$find) back("이 축제에 참여하지 않았습니다");

            $sql = "INSERT INTO reviews (`uid`, `fid`, `score`, `content`, `images`, `date`) VALUES (?, ?, ?, ?, ?, NOW())";
            $files = [];
            $data = $_FILES['files'];
            if(trim($data["name"][0]) != "") for($i = 0; $i < count($data["name"]); $i++) {
                $makeImageData = ["name"=>$data["name"][$i], "tmp_name"=>$data["tmp_name"][$i]];
                $files[] = image_upload($makeImageData, "reviews");
            }

            DB::execute($sql, [user()->id, $id, $score, $content, json_encode($files, JSON_UNESCAPED_UNICODE)]);

            $festival = DB::fetch("SELECT `uid` FROM festivals WHERE id = ?", [$id]);
            $sql = "INSERT INTO messages (`uid`, `fid`, `target`, `msgType`, `comment`, `date`) VALUES (?, ?, ?, ?, ?, NOW())";
            DB::execute($sql, [$festival->uid, $id, $id, "리뷰", "에 리뷰가 달렸습니다"]);    

            go("정상젹으로 등록되었습니다.", "/festivalData/$id");
        }

        function FestivalAdd() {
            extract($_POST);
            extract($_FILES);

            $sql = "INSERT INTO festivals (`uid`, `img`, `name`, `description`, `address`, `startDate`, `endDate`, `company`, `city`, `phone`, `ticketPrice`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $fileName = image_upload($image, "festivals");
            DB::execute($sql, [admin()->id, $fileName, $name, $content, $address, date("Y-m-d h:i:s", strtotime("$StartDate $StartTime")), date("Y-m-d h:i:s", strtotime("$EndDate $EndTime")), $company, $city, $phone, $price]);

            $sql = "SELECT * FROM festivals ORDER BY `id` DESC LIMIT 0, 1";
            $data = DB::fetch($sql);

            go("성공", "/festivalData/{$data->id}");
        }

        function FestivalEdit() {
            extract($_FILES);

            if(trim($image["name"]) != "") {
                $file = image_upload($image, "festivals");
                $sql = "UPDATE festivals SET img = ? WHERE id = ?";
                DB::execute($sql, [$file, $_POST['id']]);
            }

            foreach($_POST as $key => $value) {
                $data = $value;
                if($key == "StartDate") {
                    $time = $_POST["StartTime"];
                    $data = date("Y-m-d h:i:s", strtotime("$value $time"));
                } else if($key == "EndDate") {
                    $time = $_POST["EndTime"];
                    $data = date("Y-m-d h:i:s", strtotime("$value $time"));
                }

                if($key == "StartTime" || $key == "EndTime" || $key == "image") {continue;}

                $sql = "UPDATE festivals SET $key = '{$data}' WHERE id = ?";
                DB::execute($sql, [$_POST['id']]);
            }
            
            $id = $_POST['id'];
            $users = array_unique((array)array_merge(
                DB::fetchAll("SELECT u.id FROM messageaccept AS m LEFT JOIN users AS u ON u.id = m.uid WHERE m.fid = ?", [$id]),
                DB::fetchAll("SELECT u.id FROM ticketbuy AS t LEFT JOIN users AS u ON u.id = t.uid WHERE t.fid = ?", [$id]),
            ));

            foreach($users as $value) {
                $sql = "INSERT INTO messages (`uid`, `fid`, `target`, `msgType`, `comment`, `date`) VALUES (?, ?, ?, ?, ?, NOW())";
                DB::execute($sql, [$value->id, $id, $id, "축제 수정", "이/가 수정 되었습니다"]);       
            }

            go("성공", "/festivalData/{$id}");
        }

        function festivalNoticeWrtie() {
            extract($_POST);

            $data = $_FILES['files'];
            $files = [];
            if(trim($data["name"][0]) != "") for($i = 0; $i < count($data["name"]); $i++) {
                $makeImageData = ["name"=>$data["name"][$i], "tmp_name"=>$data["tmp_name"][$i]];
                $files[] = image_upload($makeImageData, "notices");
            }

            $sql = "INSERT INTO notices (`uid`, `fid`, `title`, `content`, `files`, `date`) VALUES (?, ?, ?, ?, ?, NOW())";
            DB::execute($sql, [admin()->id, $id, $title, $content, json_encode($files, JSON_UNESCAPED_UNICODE)]);

            $sql = "SELECT id FROM notices WHERE `uid` = ? AND `fid` = ? ORDER BY `id` DESC LIMIT 0, 1";
            $target = DB::fetch($sql, [admin()->id, $id]);

            $users = array_merge(
                DB::fetchAll("SELECT u.id FROM messageaccept AS m LEFT JOIN users AS u ON u.id = m.uid WHERE m.fid = ?", [$id]),
                DB::fetchAll("SELECT u.id FROM ticketbuy AS t LEFT JOIN users AS u ON u.id = t.uid WHERE t.fid = ?", [$id]),
            );

            for($i = 0; $i < count($users); $i++) {
                $users[$i] = (int)$users[$i]->id;
            }
            
            foreach(array_unique($users) as $value) {
                $sql = "INSERT INTO messages (`uid`, `fid`, `target`, `msgType`, `comment`, `date`) VALUES (?, ?, ?, ?, ?, NOW())";
                DB::execute($sql, [$value, $id, $target->id, "축제 공지", "에 새로운 공지가 있습니다"]);       
            }

            go("등록되었습니다.", "/festivalData/{$id}");
        }
    }
