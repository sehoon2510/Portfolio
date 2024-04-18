<?php
require_once "./autoload.php";

use Lib\DB;
use Lib\Helper;


$userid = $_POST['userid'];
$pass = $_POST['pass'];

if(!isset($userid) || !isset($userid)){
    Helper::MsgAndBack('필수값에 공백이 있습니다.');
}

var_dump($userid);
var_dump($pass);

$db = new DB();

$sql = "SELECT * FROM `users` WHERE `userid` = '000-0000-0000' AND `password` = PASSWORD('관리자')";

$admin = DB::fetch($sql);

if($admin == null){
    $sql = "INSERT INTO `users` (`userid`, `username`, `password`) VALUES ('000-0000-0000', '관리자', PASSWORD('관리자'))";
    $adminPush = DB::execute($sql);
    if(!$adminPush){
        Helper::MsgAndBack('error');
    }
}

$sql = "SELECT * FROM `users` WHERE `userid` = ? AND `password` = PASSWORD(?)";

$user = DB::fetch($sql, [$userid, $pass]);

if($user != null){
    $_SESSION['user'] = $user;
    if($_POST['userid'] == '000-0000-0000' && $_POST['pass'] == '관리자'){
        Helper::MsgAndGo('로그인 되었습니다.', './admin1');
    } else {
        Helper::MsgAndGo('로그인 되었습니다.', './sub3');
    }   
} else {
    Helper::MsgAndBack('예약정보가 없습니다.');
}