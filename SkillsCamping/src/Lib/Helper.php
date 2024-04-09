<?php

namespace Lib;

class Helper
{
    public static $categories = ["life", "art", "fashion", "technics", "etcs"];
    public static function MsgAndBack($msg)
    {
        echo "<script>";
        echo "alert('{$msg}');";
        echo "history.back();";
        echo "</script>";
    }

    public static function MsgAndGo($msg, $href)
    {
        echo "<script>";
        echo "alert('{$msg}');";
        echo "location.href='{$href}'";
        echo "</script>";
    }


    public static function json($value, $code = 200) {
        header("Content-Type: application/json", true, $code);
        echo json_encode($value, JSON_UNESCAPED_UNICODE);
        exit;
    }
}