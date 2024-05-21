<?php
require_once "./autoload.php";

use Lib\DB;
use Lib\Helper;

if(!isset($_SESSION['user'])){
 Helper::MsgAndGo('로그인 후 이용할 수 있습니다.', './login.php');
}

if($_SESSION['user']->userid != '000-0000-0000' && $_SESSION['user']->username != '관리자'){
    Helper::MsgAndBack('관리자만 이용할 수 있습니다.');
}

$sql = "SELECT DISTINCT seat FROM reservation ORDER BY seat ASC";

$today = date("Y-m-d", time());

$endDay = date("Y-m-d", strtotime($today . "+13 day"));

$data = DB::fetchAll($sql, []);

?>
<!DOCTYPE html>
<html lang="kr">
<?php require_once "./layout/head.php" ?>
<body>
    <div class="wrap sub3">
        <?php require_once "./layout/header.php" ?>
        <div class="col-12 contents sub3 sub">
            <?php require_once "./layout/slide.php" ?>
            <div class="area row data-list col-10 offset-1">
                <div class="content-title dis-col dis-center mt-5">
                    <p class="font-malgun">관리자 페이지</p>
                    <p class="font-malgun-bold">예약관리</p>
                </div>
                <div class="d-flex mb-3 mt-3">
                    <a href="./admin1">예약관리</a>
                    <a class="mx-3" href="./admin2">주문관리</a>
                </div>
                <div class="form col-4">
                    <div class="col-9 d-flex justify-content-start align-items-center">
                        <div>
                            <input type="date" class="form-control" id="start" value="<?= $today ?>" name="start">
                        </div>
                        <p class="mb-0 mx-3">~</p>
                        <div>
                            <input type="date" class="form-control" value="<?= $endDay ?>" id="end" name="end">
                        </div>
                    </div>
                    <div class="col-12 d-flex mt-3">
                        <div class="col-4">
                            <select class="form-select" id="seat" aria-label="Default select example">
                                <option selected value="none">자리 필터</option>
                                <?php foreach($data as $seat) : ?>
                                    <option value="<?= $seat->seat ?>"><?= $seat->seat ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <button id="check" class="btn btn-primary mx-4">조회하기</button>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <p>총 예약건수 : <span id="count">0</span>건</p>
                    <p>합계금액 : <span id="totlebuy">0</span>원</p>
                </div>
                <div class="title d-flex">
                    <div class="dis-row dis-center date">
                        <p>날자</p>
                    </div>
                    <div class="dis-row dis-center set">
                        <p>자리</p>
                    </div>
                    <div class="dis-row dis-center user">
                        <p>사용자</p>
                    </div>
                    <div class="dis-row dis-center phone">
                        <p>전화번호</p>
                    </div>
                    <div class="dis-row dis-center rstate">
                        <p>예약상태</p>
                    </div>
                    <div class="dis-row dis-center rdate">
                        <p>신청일</p>
                    </div>
                    <div class="dis-row dis-center button">
                        <p>버튼</p>
                    </div>
                </div>
                <ul id="reservation-list">
                   
                </ul>
            </div>
        </div>
        <div class="Msg">
            <ul id="msg-Ul">

            </ul>
        </div>
        <?php require_once "./layout/footer.php" ?>
    </div>
    <script>
        const startInput = document.querySelector('#start');
        const endInput = document.querySelector('#end');
        const seatInput = document.querySelector('#seat');
        window.onload = function() {
            TableLoad();
        }

        async function TableLoad(){
            let json;

            if(seatInput.value == "none") {
                json = await ajax("GET", `./data_load?start=${startInput.value}&end=${endInput.value}&table=reservation`);
            } else {
                json = await ajax("GET", `./data_load?start=${startInput.value}&end=${endInput.value}&table=reservation&seat=${seatInput.value}`);
            }

            try{
                console.log(json);
                MakeList(json);
            } catch(e) {
                new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
            }

        }

        document.querySelector("#check").addEventListener('click', e => {
            TableLoad();
        });

        function MakeList(data){
            $('#reservation-list')[0].innerHTML = '';
            let totle = 0;

            data.forEach(list => {

                let type = '대기중';
                if(list.admintype == "C"){
                    type = '예약완료';
                } else if(list.admintype == "W"){
                    type = '취소됨';
                }
                
                let ConBtn = '';

                if(list.admintype == "R") {
                    ConBtn = `
                        <button data-id="${list.id}" class="accept btn btn-success mx-2">승인</button>
                        <button data-id="${list.id}" class="refuse btn btn-danger mx-2">취소</button>`;
                }

                $('#reservation-list')[0].innerHTML += 
                `
                    <li id="${list.reservation_date}S${list.seat}" class="d-flex align-items-center">
                        <div class="dis-row dis-center date">
                            ${list.reservation_date}
                        </div>
                        <div class="dis-row dis-center set">
                            ${list.seat}
                        </div>
                        <div class="dis-row dis-center user">
                            ${list.username}
                        </div>
                        <div class="dis-row dis-center phone">
                            ${list.phone}
                        </div>
                        <div class="dis-row dis-center rstate">
                            ${type}
                        </div>
                        <div class="dis-row dis-center rdate">
                            ${list.date}
                        </div>
                        <div class="d-flex align-items-center justify-content-center button">
                            ${ConBtn}
                        </div>
                    </li>
                `;

                totle = totle + list.buy;
            });

            $('#totlebuy')[0].innerText = totle.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $('#count')[0].innerText = data.length;
        }

        document.querySelector('#reservation-list').addEventListener("click", async e => {
            let formData = new FormData();
            if(e.target.classList.contains('accept')){
                formData.append('id', e.target.dataset.id);
                formData.append('type', 'C');
                formData.append('table', 'reservation');
                let json = await ajax("POST", "./admin_process", formData);
                try{
                    console.log(json);
                    if(json) {
                        new Msg("성공적으로 완료되었습니다.", "msg", "fa-envelope");
                        TableLoad();
                    } else {
                        new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
                    }
                }catch(e) {
                    new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
                }
            } else if(e.target.classList.contains('refuse')){
                formData.append('id', e.target.dataset.id);
                formData.append('type', 'W');
                formData.append('table', 'reservation');
                let json = await ajax("POST", "./admin_process", formData);
                try{
                    console.log(json);
                    if(json) {
                        new Msg("성공적으로 취소되었습니다.", "msg", "fa-envelope");
                        TableLoad();
                    } else {
                        new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
                    }
                }catch(e) {
                    new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
                }
            }
        }); 

    </script>
</body>
</html>