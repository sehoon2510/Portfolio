<?php
    namespace Controller;

    use App\DB;

    class ActionController {
        function init() {
            $exist = DB::who("admin");
            if(!$exist) {
                DB::execute("INSERT INTO users (user_id, password, user_name, type) VALUES (?, ?, ?, ?)", [
                    "admin", "1234", "관리자", "admin"
                ]);
            }
            
            $exist = DB::who("manager");
            if(!$exist) {
                DB::execute("INSERT INTO users (user_id, password, user_name, type) VALUES (?, ?, ?, ?)", [
                    "manager", "1234", "담당자", "manager"
                ]);
            }
        }

        function join() {
            checkEmpty();
            extract($_POST);

            if($captcha !== $captcha_result) {
                back("캡차 문자열이 일치하지 않습니다.");
            }

            if(!preg_match("/^[가-힣ㄱ-ㅎ]+$/", $user_name)) {
                back("이름은 한글만 입력이 가능합니다.");
            }
            
            if(!preg_match("/^[a-zA-Z0-9]+$/", $user_id) || !preg_match("/^(?=.*[a-zA-Z].*)(?=.*[0-9].*)[a-zA-Z0-9]+$/", $password)) {
                back("이름은 한글만 입력이 가능합니다.");
            }

            $exist = DB::who($user_id);
            if($exist) back("이미 존재하는 아이디 입니다.");

            if(DB::execute("INSERT INTO users VALUES (null, ?, ?, ?, ?, null)", [$user_id, $password, $user_name, 3])) {
                go("관리자 승인 대기중입니다.", "/");
            } else {
                back("에러가 발생했습니다.");
            }
        }

        function login() {
            checkEmpty();
            extract($_POST);

            $user = DB::who($login_id);

            if(!$user || $user->password !== $login_password || $user->grant != $type) {
                back("회원구분, 아이디 또는 비밀번호를 확인해주세요.");
            }

            $_SESSION['user'] = $user;

            $_SESSION['open_last_login'] = true;

            DB::execute("UPDATE users SET login_at = NOW() WHERE id = ?", [$user->id]);
            go("로그인 되었습니다.", "/");
        }

        function logout() {
            unset($_SESSION['user']);

            go("로그아웃 되었습니다.", "/");
        }
    }