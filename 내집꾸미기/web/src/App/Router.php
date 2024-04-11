<?php

    namespace App;

    class Router {

        static $pages;

        static function __callStatic($name, $args) {
            if(strtolower($_SERVER['REQUEST_METHOD']) == $name) {
                self::$pages[] = $args;
            }
        }

        static function connect() {
            $url = explode("?", $_SERVER['REQUEST_URI'])[0];
            foreach(self::$pages as $page) {
                if($page[0] === $url) {
                    
                    if(isset($page[2]) && $page[2] === "user" && !user()) go("로그인해 주세요", "/");

                    $action = explode("@", $page[1]); // 받은 정보를 @를 기준으로 앞(컨트롤러 이름), 뒤(함수 이름)으로 분활
                    $conName = "Controller\\{$action[0]}"; // String 형식으로 use 작성
                    $con = new $conName(); // class형식으로 자동 형변환 되면서 use 호출 (autoload로 인하여 호출됨)
                    $con->{$action[1]}(); // 호출한 컨트롤러에서 함수 실행
                    exit;

                }
            }
            http_response_code(404);
        }
    }