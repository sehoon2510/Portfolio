<?php
require_once "./autoload.php";

use Lib\Helper;
use Lib\DB;

if(!isset($_SESSION['user'])){
    Helper::MsgAndGo('로그인 후 이용할 수 있습니다.', './login.php');
}

if($_SESSION['user']->userid != '000-0000-0000' && $_SESSION['user']->username != '관리자'){
    Helper::MsgAndBack('관리자만 이용할 수 있습니다.');
}

$sql = "SELECT DISTINCT r.seat FROM `reservation` AS r LEFT JOIN `orders` AS o ON r.id = o.rid WHERE o.rid IS NOT NULL ORDER BY r.seat ASC";

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
        <div class="contents sub sub3">
            <?php require_once "./layout/slide.php" ?>
            <div class="area row data-list col-10 offset-1">
                <div class="content-title dis-col dis-center mt-5">
                    <p class="font-malgun">관리자 페이지</p>
                    <p class="font-malgun-bold">주문관리</p>
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
                    <p>주문접수 : <span id="totle">0</span>건</p>
                    <p>주문취소 : <span id="delete">0</span>건</p>
                    <p>배달완료 : <span id="clear">0</span>건</p>
                    <p>합계금액 : <span id="totlebuy">0</span>원</p>
                </div>
                <div class="title d-flex">
                    <div class="dis-row dis-center date">
                        <p>예약날자</p>
                    </div>
                    <div class="dis-row dis-center set">
                        <p>예약자리</p>
                    </div>
                    <div class="dis-row dis-center user">
                        <p>사용자</p>
                    </div>
                    <div class="dis-row dis-center phone">
                        <p>총 가격</p>
                    </div>
                    <div class="dis-row dis-center rstate">
                        <p>주문요청상태</p>
                    </div>
                    <div class="dis-row dis-center rdate">
                        <p>주문시간</p>
                    </div>
                    <div class="dis-row dis-center rstate">
                        <p>버튼</p>
                    </div>
                    <div class="dis-row dis-center rstate">
                        <p>버튼</p>
                    </div>
                </div>
                <ul id="reservation-list">
                    <li class="d-flex align-items-center">
                        <div class="dis-row dis-center date">
                            <p>예약날자</p>
                        </div>
                        <div class="dis-row dis-center set">
                            <p>예약자리</p>
                        </div>
                        <div class="dis-row dis-center user">
                            <p>사용자</p>
                        </div>
                        <div class="dis-row dis-center phone">
                            <p>총 가격</p>
                        </div>
                        <div class="dis-row dis-center rstate">
                            대기중
                        </div>
                        <div class="dis-row dis-center rdate">
                            <p>주문시간</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rstate">
                            <button data-id="" class="accept btn btn-success">주문목록</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rstate">
                            <button data-id="" class="accept btn btn-success mx-2">승인</button>
                            <button data-id="" class="refuse btn btn-danger mx-2">취소</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div id="order-data" class="popup-back popup col-12">
            <div class="order-data col-4 pt-3 pb-3">
                <input type="hidden" value="2023-04-07" id="day">
                <input type="hidden" value="A04" id="seat">
                <div class="col-10 offset-1 d-flex justify-content-center">
                    <p class="font-malgun-bold">주문하기</p>
                </div>
                <ul id="order" class="col-10 offset-1 p-0">
                   
                </ul>
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-danger" id="exit">닫기</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    const startInput = document.querySelector('#start');
        const endInput = document.querySelector('#end');
        const seatInput = document.querySelector('#seat');

    window.onload = function() {
        TableLoad();
    }

    async function TableLoad() {
        let json;

        if(seatInput.value == "none") {
            json = await ajax("GET", `./data_load?start=${startInput.value}&end=${endInput.value}&table=order`);
        } else {
            json = await ajax("GET", `./data_load?start=${startInput.value}&end=${endInput.value}&table=order&seat=${seatInput.value}`);
        }

        try {
            MakeList(json);
        } catch(e) {
            console.log(e);
        }
    }

    document.querySelector("#check").addEventListener('click', e => {
        TableLoad();
    });

    function MakeList(data) {
        $('#reservation-list')[0].innerHTML = '';

        let a = 0;
        let b = 0;
        let c = 0;
        let total = 0;


        data.forEach(value => {

            let button = 
            `
                <button data-id="${value.id}" data-date="${value.date}" class="accept btn btn-success mx-2">완료</button>
                <button data-id="${value.id}" data-date="${value.date}" class="refuse btn btn-danger mx-2">취소</button>
            `;

            if(value.state == '배달완료' || value.state == '주문취소') {
                button = '';
            }

            if(value.state == '접수') {
                a++;
            } else if(value.state == '주문취소') {
                b++;
            } else if(value.state == '배달완료') {
                c++;
                total += value.total * 1;
            }

            $('#reservation-list')[0].innerHTML += 
            `
                <li class="d-flex align-items-center">
                    <div class="dis-row dis-center date">
                        <p class="mb-0">${value.reservation_date}</p>
                    </div>
                    <div class="dis-row dis-center set">
                        <p class="mb-0">${value.seat}</p>
                    </div>
                    <div class="dis-row dis-center user">
                        <p class="mb-0">${value.username}</p>
                    </div>
                    <div class="dis-row dis-center phone">
                        <p class="mb-0">${value.total}원</p>
                    </div>
                    <div class="dis-row dis-center rstate">
                        <p class="mb-0">${value.state}</p>
                    </div>
                    <div class="dis-row dis-center rdate">
                        <p class="mb-0">${value.date}</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center rstate">
                        <button data-id="${value.id}" data-date="${value.date}" class="OpenPopup btn btn-primary">주문목록</button>
                    </div>
                    <div class="d-flex align-items-center justify-content-center rstate">
                        ${button}
                    </div>
                </li>
            `;
        });

        $('#totle')[0].innerText = a;
        $('#delete')[0].innerText = b;
        $('#clear')[0].innerText = c;
        $('#totlebuy')[0].innerText = total;

    }

    $('#exit').on('click', e => {
        $('#order-data')[0].classList.remove("active");
    });

    $('#reservation-list').on('click', async e => {
        if (e.target.classList.contains('OpenPopup')) {
            console.log(e.target);
            let json = await ajax("GET", `./order_load?rid=${e.target.dataset.id}&date=${e.target.dataset.date}`);
            try {
                console.log(json);
                new MenuLoad(json, false);
            } catch(e) {
                console.log(e);
            }
        } else if(e.target.classList.contains('accept')) {
            let formData = new FormData();
            formData.append('id', e.target.dataset.id);
            formData.append('date', e.target.dataset.date);
            formData.append('state', '배달완료');
            formData.append('table', 'order');
            let json = await ajax("POST", "./admin_process", formData);
            try{
                console.log(json);
                if(json) {
                    TableLoad();
                }
            }catch(e) {
                console.log(e);
            }
        } else if(e.target.classList.contains('refuse')) {
            let formData = new FormData();
            formData.append('id', e.target.dataset.id);
            formData.append('date', e.target.dataset.date);
            formData.append('state', '주문취소');
            formData.append('table', 'order');
            let json = await ajax("POST", "./admin_process", formData);
            try{
                console.log(json);
                if(json) {
                    TableLoad();
                }
            }catch(e) {
                console.log(e);
            }
        }
    });
    </script>
</body>

</html>