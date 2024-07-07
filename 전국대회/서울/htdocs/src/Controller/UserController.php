<?php
    namespace Controller;
    use App\DB;

    class UserController {
        function signUp() {
            extract($_POST);
            $sql = "SELECT * FROM users WHERE company = ?";
            
            if(trim($company) != "" && DB::fetch($sql, [trim($company)])) {
                back("기업명은 중복될 수 없습니다.");
            }

            $sql = "INSERT INTO users (`userID`, `name`, `pass`, `type`, `company`) VALUES (?, ?, ?, ?, ?)";
            if(!DB::execute($sql, [$userID, $name, $pass, $type, trim($company) == "" ? null : trim($company)]))
                back("에러");

            go("회원가입이 되었습니다", "/login");
        }

        function login() {
            extract($_POST);
            $sql = "SELECT * FROM users WHERE `userID` = ? AND `pass` = ?";

            if(!$_SESSION['user'] = DB::fetch($sql, [$userID, $pass])) 
                back("아이디 혹은 비밀번호가 일치하지 않습니다");

            go("로그인 되었습니다.");
        }

        function logout() {
            unset($_SESSION['user']);
            go("로그아웃 되었습니다.", "/login");
        }
    }