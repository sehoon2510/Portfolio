<?php
    namespace App;
    class Router {
        static $pages = [];
        static function __callStatic($name, $arguments)
        {
            if($name == strtolower($_SERVER["REQUEST_METHOD"])) {
                self::$pages[] = $arguments;
            }
        }

        static function RouterStart() {
            $currentURL = explode("?", $_SERVER['REQUEST_URI'])[0];
            foreach(self::$pages as $page) {
                $url = $page[0];
                $action = explode("@", $page[1]);
                $permission = $page[2] ?? null;

                $regex = preg_replace("/({[^\/]+})/", "([^/]+)", $url);
                $regex = preg_replace("/\//", "\\/", $regex);
                if(preg_match("/^{$regex}$/", $currentURL, $metches)) {
                    unset($metches[0]);
                    $conName = "Controller\\{$action[0]}";
                    $con = new $conName();
                    
                    $con->{$action[1]}(array_combine(array_map(fn($i) => "id{$i}", array_keys($metches)), $metches));
                    exit;
                }
            }
            http_response_code(404);
        }
    }