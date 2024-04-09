<?php
require_once("DB.php");


session_start();

$db = new DB();

$id = $_POST['id'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM users WHERE `userid` = ? AND `password` = PASSWORD(?)";

$user = $db->fetch($sql, [$id, $pass.$id]);

if($user) {
    $_SESSION['user'] = $user;
    echo '<script>alert("로그인 되었습니다."); location.href = "./";</script>';
} else {
    var_dump($user);
    echo '<script>alert("아이디 또는 비밀번호가 틀렸습니다."); history.back();</script>';
}