<?php
require_once "./autoload.php";

use Lib\Helper;

unset($_SESSION['user']);

Helper::MsgAndGo('로그아웃 되었습니다.', './index');