<?php
    namespace App;

    class Router {
        static $pages;
        static function __callStatic($name, $args)
        {   
            if(strtolower($_SERVER['REQUEST_METHOD']) == $name) {
                self::$pages[] = $args;
            }
        }

        static function connect() {
            $url = explode("?", $_SERVER['REQUEST_URI'])[0];
            foreach(self::$pages as $page) {
                if($page[0] === $url) {
                    $permission = $page[2] ?? null;

                    if($permission) {
                        if($permission == "guest" && user()) go("로그인한 회원을 접근할 수 없습니다.", "/");
                        if($permission == "login" && !user()) go("로그인 후 이용하실 수 있습니다.", "/");
                        if($permission == "user" && (manager() || admin())) go("일반회원만 이용할 수 있습니다.", "/");
                        if($permission == "manager" && !manager()) go("담당자만 이용할 수 있습니다.", "/");
                        if($permission == "admin" && !admin()) go("관리자만 이용할 수 있습니다.", "/");
                    }

                    $action = explode("@", $page[1]);
                    $conName = "Controller\\{$action[0]}";
                    $con = new $conName();
                    $con->{$action[1]}();
                    exit;
                }
            }
            http_response_code(404);
        }
    }