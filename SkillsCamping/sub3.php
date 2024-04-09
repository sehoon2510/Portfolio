<?php
require_once "./autoload.php";

use Lib\Helper;
use Lib\DB;

if(!isset($_SESSION['user'])){
    Helper::MsgAndGo('로그인 후 이용할 수 있습니다.', './login.php');
}

// $sql = "SELECT r.* FROM reservation AS r, users AS u WHERE u.userid = ? AND u.userid = r.phone AND r.reservation_date BETWEEN ? AND ? ORDER BY r.reservation_date DESC";
$sql = "SELECT r.*, IFNULL(total, 0) AS total
        FROM reservation AS r
        LEFT JOIN (SELECT rid, COUNT(*) AS total
                    FROM (SELECT DISTINCT rid, date FROM orders GROUP BY date, rid) AS cnt
                    GROUP BY rid) AS o
        ON o.rid = r.id
        WHERE phone = ?
        AND r.admintype  <> 'W'
        ORDER BY r.reservation_date DESC;";

// $sql = "SELECT r.* FROM reservation AS r, users AS u WHERE u.userid = ? AND u.userid = r.phone ORDER BY r.reservation_date DESC";

$data = DB::fetchAll($sql, [$_SESSION['user']->userid]);

$sql = "SELECT IFNULL(COUNT(*), 0) AS cnt FROM `order` AS o WHERE o.order_date = ? AND o.seat = ? AND o.type = '접수' OR o.type = '배달완료' AND o.order_date = ? AND o.seat = ? GROUP BY o.order_date";

?>
<!DOCTYPE html>
<html lang="kr">
<?php require_once "./layout/head.php"; ?>
<body>
    <div class="wrap sub3">
        <?php require_once "./layout/header.php" ?>
        <div class="col-12 contents sub sub3">
            <?php require_once "./layout/slide.php" ?>
            <div class="col-10 offset-1 area row data-list d-flex flex-column">
                <div class="content-title dis-col dis-center mt-5">
                    <p class="font-malgun">마이페이지</p>
                    <p class="font-tahoma-bold">MYPAGE</p>
                </div>
                <div class="title d-flex">
                    <div class="dis-row dis-center date">
                        <p>날자</p>
                    </div>
                    <div class="dis-row dis-center set">
                        <p>자리</p>
                    </div>
                    <div class="dis-row dis-center user">
                        <p>주문건수</p>
                    </div>
                    <div class="dis-row dis-center rstate">
                        <p>요청상태</p>
                    </div>
                    <div class="dis-row dis-center rstate">
                        <p>예약상태</p>
                    </div>
                    <div class="dis-row dis-center Bbutton">
                        <p>주문관리</p>
                    </div>
                    <div class="dis-row dis-center rdate">
                        <p>예약관리</p>
                    </div>
                </div>
                <ul id="reservation-list">
                    <?php foreach($data as $list) : ?>
                    <li id="<?= $list->reservation_date ?>S<?= $list->seat ?>" class="d-flex align-items-center">
                        <div class="dis-row dis-center date">
                            <p class="mb-0"><?= $list->reservation_date ?></p>
                        </div>
                        <div class="dis-row dis-center set">
                            <p class="mb-0"><?= $list->seat ?></p>
                        </div>
                        <div class="dis-row dis-center user">
                            <p class="mb-0">
                                주문건수 <span
                                data-day="<?= $list->reservation_date ?>"
                                data-seat="<?= $list->seat ?>" class="cnt">
                                <?= $list->total ?> 
                                </span>건
                            </p>
                        </div>
                        <div class="dis-row dis-center rstate">
                            <?php if($list->admintype == "R") : ?>
                            <p class="mb-0">신청</p>
                            <?php elseif($list->admintype == "C") : ?>
                            <p class="mb-0">승인</p>
                            <?php elseif($list->admintype == "W") : ?>
                            <p class="mb-0">취소</p>
                            <?php endif; ?>
                        </div>
                        <div class="dis-row dis-center rstate">
                            <?php if($list->admintype == "R") : ?>
                                <p class="mb-0">예약중</p>
                            <?php elseif($list->admintype == "C") : ?>
                                <p class="mb-0">예약완료</p>
                            <?php elseif($list->admintype == "W") : ?>
                                <p class="mb-0">예약취소</p>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-around Bbutton"> 
                            <button class="menu btn btn-success" data-day="<?= $list->reservation_date ?>" data-seat="<?= $list->seat ?>">바비큐 주문하기</button>
                            <button class="view-btn btn btn-primary" data-rid="<?= $list->id ?>" data-day="<?= $list->reservation_date ?>" data-seat="<?= $list->seat ?>">주문내역보기</button>
                        </div>
                        <div class="dis-row dis-center rdate"> 
                            <button data-id="<?= $list->id ?>" class="refuse btn btn-danger">예약취소</button>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="popup-back col-12 popup" id="barbecue-popup">
            <div class="barbecue-popup col-4 pb-4">
                <input type="hidden" value="" id="day">
                <input type="hidden" value="" id="seat">
                <div class="col-10 offset-1 d-flex justify-content-center mt-3">
                    <p class="font-malgun-bold">주문하기</p>
                </div>
                <!-- 상품 리스트 -->
                <div class="col-12">
                    <ul class="list col-10 offset-1 p-0" id="menu-list">
                        
                    </ul>
                </div>
                <div class="d-flex justify-content-center">
                    <p class="font-malgun fs-5 mt-4">선택된 상품</p>
                </div>
                <div class="col-12">
                    <ul class="col-10 offset-1 dis-col aling-center p-0" id="order-list">
                        <li id="AddMenuId0" class="d-flex align-items-center justify-content-between col-12 px-3 pb-2 pt-2 mb-2">
                            <div>
                                <p class="mb-1 font-malgun">바비큐 그릴 대여</p>
                                <span class="icon-black d-flex align-items-center mt-2">
                                    ( <i class="fa-solid fa-circle-info"></i><p class="mb-0 mx-2 font-malgun">도구 및 숯 등 포함</p> )
                                </span>
                            </div>
                            <div class="AddMenuId0">
                                
                            </div>    
                            <div class="d-flex flex-column align-items-end">
                                <p class="mb-1 font-malgun">10,000원</p>
                                <button class="Delete btn btn-danger font-malgun" data-name="바비큐 그릴 대여" data-id="0">삭제</button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-10 offset-1 d-flex align-items-center justify-content-end mt-3" id="totlebuy">
                    <p></p>
                </div>
                <div class="col-12 d-flex justify-content-center mt-3">
                    <button id="order-complete" class="btn btn-primary mx-4">주문완료</button>
                    <button id="back" class="btn btn-danger mx-4 px-4">닫기</button>
                </div>
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
                    <li class="px-3 pt-2 pb-2 mb-3">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <div class="col-8">
                                <p class="mb-0 font-malgun fs-5">2023-09-15 [A01] <span>배달완료</span></p>
                                <p class="mb-0 font-malgun">주문시간 : 2023-09-16 18:15:39</p>
                            </div>
                            <div class="col-4 d-flex justify-content-end">
                                
                                <a href="./order_delete?id=undefined&type=delete" class="btn btn-danger pt-1 pb-1 font-malgun">주문취소</a>
                
                            </div>
                        </div>
                        <div class="title d-flex mt-3">
                            <div class="col-3 d-flex justify-content-center">
                                <p class="font-malgun">상품명</p>    
                            </div>
                            <div class="col-3 offset-2 d-flex justify-content-center">
                                <p class="font-malgun">수량</p>
                            </div>
                            <div class="col-1 offset-3 d-flex justify-content-center">
                                <p class="font-malgun">가격</p>
                            </div>
                        </div>
                        <ul class="p-0 col-12">
                            
                        <li class="col-12 d-flex mb-3">
                            <span class="col-5 d-flex justify-content-start"><p class="mb-0 font-malgun">바비큐 그릴 대여</p></span>
                               
                            <span class="col-3 d-flex justify-content-center"><p class="mb-0 font-malgun">대여</p></span>
                            <span class="col-4 d-flex justify-content-end"><p class="mb-0 font-malgun"><span>10000</span>원</p></span>
                        
                        </li>
                    
                        <li class="col-12 d-flex mb-3">
                            <span class="col-5 d-flex justify-content-start"><p class="mb-0 font-malgun">돼지고기 바비큐 세트</p></span>
                            
                            <span class="col-3 d-flex justify-content-center"><p class="mb-0 font-malgun">2인분</p></span>
                            <span class="col-4 d-flex justify-content-end"><p class="mb-0 font-malgun"><span>24000</span>원</p></span>
                    
                        </li>
                    
                        <li class="col-12 d-flex mb-3">
                            <span class="col-5 d-flex justify-content-start"><p class="mb-0 font-malgun">해산물 바비큐 세트</p></span>
                            
                            <span class="col-3 d-flex justify-content-center"><p class="mb-0 font-malgun">6인분</p></span>
                            <span class="col-4 d-flex justify-content-end"><p class="mb-0 font-malgun"><span>90000</span>원</p></span>
                    
                        </li>
                    
                        </ul>
                        <div class="col-12 d-flex justify-content-end">
                            <p class="mb-0 font-malgun"><span>124,000</span>원</p>
                        </div>
                    </li>
                </ul>
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-danger font-malgun" id="exit">닫기</button>
                </div>
            </div>
        </div>
        <div class="Msg">
            <ul id="msg-Ul">

            </ul>
        </div>
        <?php require_once "./layout/footer.php" ?>
    </div>
    <script>
        let menus;
        const orderPopup = document.querySelector('#barbecue-popup');
        const menuPopup = document.querySelector('#order-data');

        async function menuLoad() {
            let json = await ajax("GET", "./menu_add");
            try{    
                console.log(json);
                menus = new MyPage(json);
            } catch(e) {
                new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
            }
        }

        async function listLoad() {
            let json = await ajax("GET", "./reservation_load");
            try {
                console.log(json);
                const listUl = document.querySelector('#reservation-list');
                listUl.innerHTML = '';
                json.forEach(list => {
                    listUl.innerHTML += 
                    `
                        <li id="${list.reservation_date}S${list.seat}" class="d-flex align-items-center">
                            <div class="dis-row dis-center date">
                                <p class="mb-0">${list.reservation_date}</p>
                            </div>
                            <div class="dis-row dis-center set">
                                <p class="mb-0">${list.seat}</p>
                            </div>
                            <div class="dis-row dis-center user">
                                <p class="mb-0">
                                    주문건수 <span
                                    data-day="${list.reservation_date}"
                                    data-seat="${list.seat}" class="cnt">
                                    ${list.total} 
                                    </span>건
                                </p>
                            </div>
                            <div class="dis-row dis-center rstate">
                                ${list.type == "R" ? '<p class="mb-0">신청</p>' : '<p class="mb-0">승인</p>'}
                            </div>
                            <div class="dis-row dis-center rstate">
                                ${list.admintype == "R" ? '<p class="mb-0">예약중</p>' : '<p class="mb-0">예약완료</p>'}
                            </div>
                            <div class="d-flex justify-content-around Bbutton"> 
                                <button class="menu btn btn-success" data-day="${list.reservation_date}" data-seat="${list.seat}">바비큐 주문하기</button>
                                <button class="view-btn btn btn-primary" data-rid="${list.id}" data-day="${list.reservation_date}" data-seat="<?= $list->seat ?>">주문내역보기</button>
                            </div>
                            <div class="dis-row dis-center rdate"> 
                                <button data-id="${list.id}" class="refuse btn btn-danger">예약취소</button>
                            </div>
                        </li>
                    `;
                });
            }catch(e) {
                new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
            }
        }

        document.querySelector("#order-complete").addEventListener('click', async e => {
            let date = getFormattedDate();
            console.log(menus.dayInput.value, menus.seatInput.value, menus.checkmenu, date);
            try {
                for(let i = 0; i < menus.checkmenu.length; i++) {
                    let formData = new FormData();
                    formData.append("day", menus.dayInput.value);
                    formData.append("seat", menus.seatInput.value);
                    formData.append("id", menus.checkmenu[i].id);
                    formData.append("cnt", menus.checkmenu[i].cnt);
                    formData.append("date", date);

                    console.log(formData);

                    let json = await ajax("POST", "./order_process", formData);
                    try{
                        console.log(json);
                    } catch(e) {
                        new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
                    }   
                }

                new Msg("성공적으로 접수처리 되었습니다.", "msg", "fa-envelope");
                listLoad();
            }catch(e) {
                new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
            }     
            document.querySelector("#barbecue-popup").classList.remove("active");
            const Count = document.querySelector(`#${menus.dayInput.value}S${menus.seatInput.value}`);
            Count.querySelector('.cnt').innerHTML = parseInt(Count.querySelector('.cnt').innerText) + 1;
        });

        document.querySelector('#reservation-list').addEventListener('click', async e => {
            if(e.target.classList.contains("menu")){
                document.querySelector('#day').value = e.target.dataset.day;
                document.querySelector('#seat').value = e.target.dataset.seat;

                orderPopup.classList.add("active");
                menuPopup.classList.remove("active");
            } else if(e.target.classList.contains("view-btn")) {
                let json = await ajax("GET", `./Getorder?rid=${e.target.dataset.rid}`);
                try {
                    console.log(json);
                    new MenuLoad(json);
                } catch(e) {
                    new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
                }
            } else if(e.target.classList.contains('refuse')){
                let formData = new FormData();
                formData.append('id', e.target.dataset.id);
                formData.append('type', 'W');
                formData.append('table', 'reservation');
                let json = await ajax("POST", "./admin_process", formData);
                try{
                    console.log(json);
                    if(json) {
                        new Msg("성공적으로 취소되었습니다.", "msg", "fa-envelope");
                        listLoad();
                    } else {
                        new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
                    }
                }catch(e) {
                    new Msg("에러가 발생하였습니다.", "err", "fa-triangle-exclamation");
                }
            }
        });

        document.querySelector("#order").addEventListener('click', async e => {
            if(e.target.classList.contains('refuse')) {
                let formData = new FormData();
                formData.append('id', e.target.dataset.id);
                formData.append('date', e.target.dataset.date);
                formData.append('state', '주문취소');
                formData.append('table', 'order');
                let json = await ajax("POST", "./admin_process", formData);
                try{
                    console.log(json);
                    if(json) {
                        new Msg("성공적으로 취소되었습니다.", "msg", "fa-envelope");
                        listLoad();
                    }
                }catch(e) {
                    console.log(e);
                }
            }
        });

        function getFormattedDate() {
            const now = new Date();
            
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); // 월은 0부터 시작하므로 +1 필요
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            
            return formattedDate;
        }

        function find() {
            console.log(menus.checkmenu);
        }

        document.querySelector('#reservation-list').addEventListener("click", async e => {
            
        }); 

        menuLoad();
    </script>
</body>
</html>