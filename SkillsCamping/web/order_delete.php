<?php

session_start();

require_once("DB.php");
require_once("Lib.php");

$db = new DB();

$id = $_GET['id'];

if(!isset($id)){
    Helper::MsgAndBack('잘못된 접근입니다.');
}

if($_GET['type'] == "delete"){
    $sql = "UPDATE `order` SET `type` = ? WHERE id = ?";

    $result = $db->execute($sql, ['취소', $id]);

    if($result && $_SESSION['user']->userid == '000-0000-0000'){
        Helper::MsgAndGo('주문이 취소되었습니다.', './admin2.php');
    } else if($result && $_SESSION['user']->userid != '000-0000-0000'){
        Helper::MsgAndGo('주문이 취소되었습니다.', './sub3');
    }
} else if($_GET['type'] == "clear"){
    $sql = "UPDATE `order` SET `type` = ? WHERE id = ?";

    $result = $db->execute($sql, ['배달완료', $id]);

    if($result){
        Helper::MsgAndGo('배달이 완료되었습니다.', './admin2.php');
    }
}