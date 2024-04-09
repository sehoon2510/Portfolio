<?php 

require_once "./autoload.php";

use Lib\DB;
use Lib\Helper;


$phone = $_POST['userid'];
$password = $_POST['password'];
$reservation_date = $_POST['date'];
$seat = $_POST['seat'];
$buy = $_POST['buy'];

if($phone == '000-0000-0000'){
    Helper::json([
        'type'=>'err', 
        'class'=>'fa-triangle-exclamation', 
        'msg'=>'<p>사용할수 없는 휴대폰 번호 입니다.</p>'
    ], 400);
}

$sql = "SELECT * FROM users WHERE userid = ? AND username = ?";

$user = DB::fetch($sql, [$phone, $password]);
if($user == null && $phone != '000-0000-0000'){
    $sql = "INSERT INTO users (`userid`, `username`, `password`) VALUES (?, ?, PASSWORD(?))";
    $result = DB::execute($sql, [$phone, $password, $password]);
    if(!$result){
        Helper::json([
            'type'=>'err', 
            'class'=>'fa-triangle-exclamation', 
            'msg'=>'<p>DB error</p>'
        ], 400);
    } else {
        $sql = "SELECT * FROM reservation WHERE reservation_date = ? AND seat = ? AND admintype <> 'W'";
        $data = DB::fetch($sql, [$reservation_date, $seat]);
        if($data == null){
            $sql = "INSERT INTO reservation (`phone`, `reservation_date`, `seat`, `buy`, `type`, `admintype`, `date`) VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $result = DB::execute($sql, [$phone, $reservation_date, $seat, $buy, 'R', 'R']);
            if($result){
                $user = DB::fetch("SELECT * FROM users WHERE `userid` = ? AND `PASSWORD` = PASSWORD(?)", [$phone, $password]);

                $_SESSION['user'] = $user;

                Helper::json([
                    'type'=>
                    'msg',
                    'class'=>
                    'fa-envelope',
                    'msg'=>
                    '예약정보가 정상적으로 등록되었습니다.
                     <br>관리자 승인 후 예약이 최종 완료 됩니다.'
                ], 200);
            }
        } else {
            Helper::json([
                'type'=>
                'err',
                'class'=>
                'fa-triangle-exclamation',
                'msg'=>
                '이미 예약이 완료된 자리 입니다.'
            ], 400); 
        }
    }
} else if($phone != '000-0000-0000'){
    $sql = "SELECT * FROM reservation WHERE reservation_date = ? AND seat = ? AND admintype <> 'W'";
    $data = DB::fetch($sql, [$reservation_date, $seat]);
    if($data == null){
        $sql = "INSERT INTO reservation (`phone`, `reservation_date`, `seat`, `buy`, `type`, `admintype`, `date`) VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $result = DB::execute($sql, [$phone, $reservation_date, $seat, $buy, 'R', 'R']);
        if($result){

            $_SESSION['user'] = $user;
            
            Helper::json([
                'type'=>
                'msg',
                'class'=>
                'fa-envelope',
                'msg'=>
                '예약정보가 정상적으로 등록되었습니다.
                 <br>관리자 승인 후 예약이 최종 완료 됩니다.'
            ], 200);
        }
    } else {
        Helper::json([
            'type'=>
            'err',
            'class'=>
            'fa-triangle-exclamation',
            'msg'=>
            '이미 예약이 완료된 자리 입니다.'
        ], 400); 
    }
}
