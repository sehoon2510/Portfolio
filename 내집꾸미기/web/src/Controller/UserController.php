<?php
 
    namespace Controller;

    use App\DB;

    class UserController {
        
        function signUp() {
            extract($_POST);
            extract($_FILES);

            if($cap_answer !== $cap_input) back("자동입력방지 문자를 잘못 입력하였습니다.");
            
            $tester = DB::fetch("SELECT * FROM users WHERE user_id = ?", [$user_id]);
            if($tester) back("중복되는 아이디입니다. 다른 아이디를 사용해주세요.");
            
            $photo = Image_uploads($photo, "user/$user_id");
            
            $sql = "INSERT INTO users VALUES (null, ?, ?, ?, ?, 0)";

            if(DB::execute($sql, [$user_id, $password, $user_name, $photo])) {
                go("회원가입 되었습니다.", "/");
            } else {
                back("에러가 발생하였습니다.");
            }
        }

        function signIn() {
            extract($_POST);

            $sql = "SELECT * FROM users WHERE user_id = ? AND password = ?";
            $user = DB::fetch($sql, [$user_id, $password]);
            if($user) {
                $_SESSION['user'] = $user;
                go("로그인 되었습니다.", "/");
            } else {
                back("에러가 발생하였습니다.");
            }
        }

        function logout() {
            
            unset($_SESSION['user']);
            go("로그아웃 되었습니다.", "/");

        }

    }