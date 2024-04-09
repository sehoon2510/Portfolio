<?php
require_once("DB.php");

$db = new DB();

$id = $_POST['id'];
$pass = $_POST['pass'];
$name = $_POST['name'];
$email = $_POST['email'];

$sql = "SELECT * FROM users WHERE `userid` = ? AND `password` = PASSWORD(?)";

$result = $db->fetch($sql, [$id, $pass.$id]);

if($result) {
    echo '<script>alert("이미 사용중인 아이디입니다."); history.back();</script>';
} else {
    $sql = "INSERT INTO users (`userid`, `password`, `salt`, `name`, `email`, `date`) VALUE (?, PASSWORD(?), ?, ?, ?, NOW())";

    $result = $db->execute($sql, [$id, $pass.$id, $id, $name, $email]);

    if($result) {
        echo '<script>location.href = "./";</script>';
    } else {
        echo '<script>alert("error"); history.back();</script>';
    }
}