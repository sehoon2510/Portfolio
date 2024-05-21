<?php
    namespace Controller;

    use App\DB;

    class MainController {
        function indexPage() {
            view("index");
        }

        function getUser() {
            $sql = "SELECT user_id FROM users";
            json(["data"=>DB::fetchAll($sql)], 200);
        }

        function SignUp() {
            extract($_POST);
            if(user()) back("로그인한 회원은 접근할 수 없습니다.");
            if(!preg_match("/^[a-zA-Z0-9]+$/", $user_id) || !preg_match("/^[a-zA-Z0-9]+$/", $password) || !preg_match("/^[ㄱ-ㅎ가-힣]+$/", $user_name)) back("입력 형식이 잘못되었습니다.");
            if($cap_in !== $cap_out) back("자동입력방지문자가 잘못되었습니다.");

            $sql = "INSERT INTO users VALUES (null, ?, ?, ?, 3, null)";
            if(DB::execute($sql, [$user_id, $password, $user_name])) {
                go("관리자 승인 대기 중입니다.", "/");
            } else {
                back("에러가 발생했습니다.");
            }

            dd($_POST);
        }

        function SignIn() {
            extract($_GET);

            $sql = "SELECT * FROM users WHERE user_id = ? AND password = ? AND `grant` = ?";
            $user = DB::fetch($sql, [$id, $pass, $grant]);

            if($user) {
                $_SESSION['user'] = $user;
                $sql = "UPDATE users SET `login_at` = NOW() WHERE id = ?";
                if(!DB::execute($sql, [user()->id])) json(["data"=>"에러가 발생했습니다."], 400);
                $sql = "SELECT `login_at` FROM users WHERE id = ?";

                json(["data"=>DB::fetchAll($sql, [user()->id])], 200);
            } else {
                json(["data"=>"회원구분, 아이디 또는 비밀번호를 확인해주세요."], 400);
            }
        }

        function logout() {
            unset($_SESSION['user']);
            go("로그아웃 되었습니다.", "/");
        }

        function InformationPage() {
            view("sub01");
        }
        
        function StatisticsPage() {
            view("sub02");
        }
        
        function ReservationPage() {
            if(manager()) {
                $sql = "SELECT r.*, u.user_name, u.user_id
                        FROM `reservation` AS r
                        LEFT JOIN users AS u
                        ON u.id = r.uid WHERE r.status > -1";

                view("sub03-manager", ["data"=>DB::fetchAll($sql)]);
            } else if(admin()) {
                $sql = "UPDATE `reservation` SET `status` = -2 WHERE `date` = ? AND `status` < 3 AND `status` > -1";
                if(!DB::execute($sql, [date("Y-m-d", strtotime("+1 days"))])) {
                    back("에러가 발생했습니다.");
                }

                $sql = "SELECT r.*, u.user_name, u.user_id
                        FROM `reservation` AS r
                        LEFT JOIN users AS u
                        ON u.id = r.uid
                        WHERE r.status >= 2";

                view("sub03-admin", ["data"=>DB::fetchAll($sql)]);
            } else {
                view("sub03-user");
            }
        }

        function ReservationGameList() {
            $sql = "SELECT *, null AS 't' FROM games";
            $dataGames = DB::fetchAll($sql, []);
            $sql = "SELECT `game`, `date`, `time`, '예약됨' AS 't' FROM `reservation` WHERE `status` = 4";
            $dataRes = DB::fetchAll($sql, []);

            $newArr = [];
            foreach($dataGames as $item) {
                $newArr[] = $item;
            }

            foreach($dataRes as $item) {
                $newArr[] = $item;
            }

            if($newArr) {
                json(["data"=>$newArr], 200);
            } else {
                json(["msg"=>"에러가 발생했습니다."], 400);
            }
        }
        
        function ReservationAdd() {
            extract($_POST);

            $sql = "SELECT * FROM `reservation` WHERE `game` = ? AND `date` = ? AND `time` = ? AND `status` > 1";
            $data = DB::fetch($sql, [$game, $date, explode("시", $time)[0]]);

            $status = 1;
            if($data) {
                $status = 0;
            }

            $sql = "INSERT INTO `reservation` VALUES (null, ?, ?, ?, ?, ?, ?, ?)";
            if(DB::execute($sql, [user()->id, $game, explode("시", $time)[0], $date, $count, $price, $status])) {
                go("예약되었습니다.", "/reservation");
            } else {
                back("에러가 발생했습니다.");
            }
        }

        function ReservationDelete() {
            extract($_GET);

            $sql = "UPDATE `reservation` SET `status` = -1 WHERE id = ?";
            if(DB::execute($sql, [$id])) {
                go("정상처리되었습니다.", "/reservation");
            } else {
                back("에러가 발생하였습니다.");
            }
        }

        function ReservationPass() {
            extract($_GET);

            $sql = "SELECT * FROM `reservation` WHERE id = ?";
            $data = DB::fetch($sql, [$id]);

            $sql = "UPDATE `reservation` SET `status` = 0 WHERE `date` = ? AND `time` = ? AND `game` = ?";
            if(DB::execute($sql, [$data->date, $data->time, $data->game])) {
                $sql = "UPDATE `reservation` SET `status` = 2 WHERE id = ?";
                if(DB::execute($sql, [$id])) {
                    go("정상처리되었습니다.", "/reservation");
                } else {
                    back("에러가 발생하였습니다.");
                }
            } else {
                back("에러가 발생하였습니다.");
            }
        }

        function ReservationAdmin() {
            extract($_GET);
            $sql = "UPDATE `reservation` SET `status` = 4 WHERE id = ?";
            if(DB::execute($sql, [$id])) {
                go("정상 처리되었습니다.", "/reservation");
            } else {
                back("에러가 발생하였습니다.");
            }
        }

        function ReservationBuy() {
            extract($_GET);
            $sql = "UPDATE `reservation` SET `status` = 3 WHERE id = ?";
            if(DB::execute($sql, [$id])) {
                go("정상 처리되었습니다.", "/mypage");
            } else {
                back("에러가 발생하였습니다.");
            }
        }

        function ReservationRed() {
            extract($_POST);

            $arr = [
                ["game"=>"나이트리그", "time"=>"19"],
                ["game"=>"나이트리그", "time"=>"23"],
                ["game"=>"새벽리그", "time"=>"4"],
                ["game"=>"새벽리그", "time"=>"7"],
                ["game"=>"주말리그", "time"=>"9"],
                ["game"=>"주말리그", "time"=>"13"],
                ["game"=>"주말리그", "time"=>"15"]
            ];

            $sql = "INSERT INTO `games` VALUES (null, ?, ?, ?)";

            if($game == "all") {
                foreach($arr as $value) {
                    if(!DB::execute($sql, [$value["game"], $date, $value["time"]])) {
                        back("에러가 발생했습니다.");
                    }
                }

                go("정상 처리되었습니다.", "/reservation");
            } else {
                if(DB::execute($sql, [$game, $date, $time])) {
                    go("정상 처리되었습니다.", "/reservation");
                } else {
                    back("에러가 발생했습니다.");
                }
            }
            
        }

        function GoodsPage() {
            $sql = "SELECT * FROM goods";

            if(manager()) {
                view("sub04-manager", ["data"=>DB::fetchAll($sql)]);
            } else {
                view("sub04", ["data"=>DB::fetchAll($sql)]);
            }
        }

        function GoodsItems() {
            extract($_GET);
            $sql = "SELECT * FROM goods WHERE id = ?";

            view("sub04-item", ["data"=>DB::fetch($sql, [$id])]);
        }

        function BuyPage() {
            extract($_GET);

            $sql = "SELECT * FROM goods WHERE id = ?";

            view("buy", ["data"=>DB::fetch($sql, [$id]), "cnt"=>$cnt < 1 ? 1 : $cnt]);
        }

        function UserGoods() {
            extract($_GET);
            $sql = "SELECT * FROM usergoods WHERE `uid` = ? AND `pid` = ?";
            if(DB::fetch($sql, [user()->id, $id])) back("이미 관심goods로 등록된 상품입니다.");

            $sql = "INSERT INTO usergoods VALUES (?, ?)";
            if(DB::execute($sql, [user()->id, $id])) {
                go("정상 처리되었습니다.", "/mypage");
            } else {
                back("에러가 발생했습니다.");
            }
        }

        function CartGoods() {
            extract($_GET);
            $sql = "SELECT * FROM cartgoods WHERE `uid` = ? AND `pid` = ?";
            if(DB::fetch($sql, [user()->id, $id])) back("이미 관심goods로 등록된 상품입니다.");

            $sql = "INSERT INTO cartgoods VALUES (null, ?, ?)";
            if(DB::execute($sql, [user()->id, $id])) {
                go("정상 처리되었습니다.", "/mypage");
            } else {
                back("에러가 발생했습니다.");
            }
        }

        function BuyGoods() {
            extract($_POST);

            $sql = "INSERT INTO buy VALUES (null, ?, ?, ?)";

            if(DB::execute($sql, [user()->id, $id, isset($cnt) ? $cnt : 1])) {
                go("정상 처리되었습니다.", "/mypage");
            } else {
                back("에러가 발생했습니다.");
            }

        }

        function GoodsAdd() {
            extract($_POST);
            $sql = "INSERT INTO goods VALUES (null, ?, ?, ?, ?)";
            $fileName = imageUpload($_FILES['image']);
            if(!$fileName) back("에러가 발생하였습니다.");
            if(DB::execute($sql, [$name, $price, $comment . $comment2, $fileName])) {
                go("등록되었습니다.", "/goods");
            } else {
                back("에러가 발생하였습니다.");
            }
        }

        function Mypage() {
            $sql = "UPDATE `reservation` SET `status` = -2 WHERE `date` = ? AND `status` < 3 AND `status` > -1";
            if(!DB::execute($sql, [date("Y-m-d", strtotime("+1 days"))])) {
                back("에러가 발생했습니다.");
            }
            
            $sql = "SELECT * FROM `reservation` WHERE `uid` = ?";
            $res = DB::fetchAll($sql, [user()->id]);

            $sql = "SELECT g.* FROM usergoods AS u LEFT JOIN goods AS g ON g.id = u.pid WHERE u.uid = ?";
            $goods = DB::fetchAll($sql, [user()->id]);
            
            $sql = "SELECT c.id AS cid, g.* FROM cartgoods AS c LEFT JOIN goods AS g ON g.id = c.pid WHERE c.uid = ?";
            $cart = DB::fetchAll($sql, [user()->id]);
            
            $sql = "SELECT b.id AS bid, b.cnt AS cnt, g.* FROM buy AS b LEFT JOIN goods AS g ON g.id = b.pid WHERE b.uid = ?";
            $buy = DB::fetchAll($sql, [user()->id]);

            view("mypage", ["res"=>$res, "goods"=>$goods, "cart"=>$cart, "buy"=>$buy]);
        }
    }
