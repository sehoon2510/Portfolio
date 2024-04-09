<?php require_once "./autoload.php";

?>

<!DOCTYPE html>
<html lang="kr">
<?php require_once "./layout/head.php"; ?>
<body>
    <div class="col-12 wrap">
        <?php require_once "./layout/header.php"; ?>
        <div class="contents sub">
            <?php require_once "./layout/slide.php"; ?>
            <div class="air"></div>
            <div class="content-title dis-col dis-center mt-5">
                <p class="font-malgun">캠핑장 예약하기</p>
                <p class="font-tahoma-bold">RESERVATION</p>
            </div>
            <div class="col-10 offset-1 table-div pb-5">
                <div class="legend col-12 d-flex justify-content-end">
                    <ul class="dis-row just-ard aling-center">
                        <li class="dis-row aling-center just-bet">
                            <img src="./image/tent-line.svg" style="width: 22px; height: 22px; margin-right: 8.5px;" class="tent-line" alt="">
                            <p>: 예약 가능</p>
                        </li>
                        <li class="dis-row aling-center just-bet">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <p>: 예약중</p>
                        </li>
                        <li class="dis-row aling-center just-bet">
                            <i class="fa-solid fa-tent"></i>
                            <p>: 예약완료</p>
                        </li>
                    </ul>
                </div>
                <div class="table-back data-list col-12 d-flex flex-wrap">
                    <div class="title dis-row dis-center">
                        <p class="font-malgun-bold">예약하기</p>
                    </div>
                    <div id="table-header">
                    </div>
                    <div id="table" class="dis-row">
                        <div class="col-11 d-flex justify-content-center mt-5">
                            <p class="mt-5 mx-4">데이터가 없습니다.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input popup-back col-12 popup">
                <div class="col-3 pb-4">
                    <div class="col-10 offset-1 d-flex justify-content-center mt-3">
                        <p class="font-malgun-bold">예약하기</p>
                        <!-- <i class="fa-solid fa-square-xmark" id="back"></i> -->
                    </div>
                    <div class="col-10 offset-1 mt-4">
                        <p class="mb-1 font-malgun">예약 정보</p>
                        <p class="mx-2 font-malgun" id="date">2023-03-27 [A06]</p>
                        <p class="mb-1 font-malgun">결재 금액</p>
                        <p class="mx-2 font-malgun"><span id="mapbuy">30,000</span>원</p>
                    </div>
                    <form class="col-10 offset-1 mt-5" id="reservationForm">
                        <input type="hidden" name="date" id="day" value="2023-03-27">
                        <input type="hidden" name="seat" id="seat" value="A06">
                        <input type="hidden" name="buy" id="buy" value="15000">
                        <p class="mb-1 font-malgun">전화번호</p>
                        <div class="input-group flex-nowrap mb-3" id="phoneForm">
                            <span class="input-group-text font-malgun" id="addon-wrapping">@</span>
                            <input type="text" id="phone" name="userid" placeholder="예) 010-1234-5678" class="font-malgun form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                        <p class="mb-1 font-malgun">이름</p>
                        <div class="input-group flex-nowrap mb-3" id="nameForm">
                            <span class="input-group-text font-malgun" id="addon-wrapping">@</span>
                            <input type="text" name="password" id="name" placeholder="예) 홍길동" class="form-control font-malgun" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                        <div class="input-group mb-3 mt-4" id="certificat">
                            <input type="password" id="certification-check" class="form-control font-malgun" placeholder="인증번호" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-success font-malgun" type="button" id="certification">인증번호 요청</button>
                        </div>
                        <div class="col-12 d-flex justify-content-around mt-5">
                            <button id="reservation" class="btn btn-primary font-malgun">예약진행</button>
                            <button id="back" type="button" class="btn btn-danger font-malgun px-4">닫기</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="Msg">
            <ul id="msg-Ul">
            
            </ul>
        </div>
        <?php require_once "./layout/footer.php"; ?>
    </div>
    <script>
        var app = new Sub();
        const table = document.querySelector("#table");
        const tableHeader = document.querySelector("#table-header");
        const reservationBtn = document.querySelector("#reservation");
        const popup = document.querySelector(".input");


        function load() {
            setInterval(async () => {
                let json = await ajax("GET", "./Json.php");
                console.log(json);
                try {
                    let drow = new TalbeDrow(json);
                    console.log(json);
                } catch(e) {
                    console.log(e);
                }
            }, 5000);
        }

        reservationBtn.addEventListener('click', async e => {
            e.preventDefault();

            let test = new Reservation();
            console.log(test.test);
            if(test.test) {
                let form = document.querySelector("#reservationForm");
                let formData = new FormData(form);

                console.log(formData);

                let json = await ajax("POST", "./reservation_process", formData);
                try {
                    console.log(json);
                    new Msg(json.msg, json.type, json.class);
                    if(json.type == "msg") {
                        
                    }
                    
                } catch(e) {
                    console.log(e);
                }
                popup.classList.remove("active");   
                let reload = await ajax("GET", "./Json.php");
                try {
                    let dorw = new TalbeDrow(reload);
                } catch(e) {
                    console.log(e);
                }
            }
        });

        table.addEventListener('click', e => {
            console.log("test");
            if(e.target.classList.contains("icon")){
                if(!e.target.classList.contains("fa-tent") && !e.target.classList.contains("fa-clock-rotate-left")){
                    let dayName;
                    if(e.target.dataset.day == 0 || e.target.dataset.day == 6){
                        if(e.target.dataset.seat[0] == "A"){
                            dayName = 30000;
                        } else if(e.target.dataset.seat[0] == "T"){
                            dayName = 20000;
                        }
                    } else {
                        if(e.target.dataset.seat[0] == "A"){
                            dayName = 25000;
                        } else if(e.target.dataset.seat[0] == "T"){
                            dayName = 15000;
                        }
                    }

                    $('#date')[0].innerText = `${e.target.dataset.now} [${e.target.dataset.seat}]`;
                    $('#day')[0].value = e.target.dataset.now;
                    $('#seat')[0].value = e.target.dataset.seat;
                    $('#buy')[0].value = dayName;
                    $('#mapbuy')[0].innerHTML = `${NumberFormet(dayName)}`;
                    popup.classList.add("active");                    

                } else {
                    new Msg(
                        '<p>예약할수 없습니다.</p>',
                        'err', 'fa-triangle-exclamation'
                    );
                }
            }

        });
        

        function NumberFormet(num){
            return (num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        window.onload = async () => {
            

            let json = await ajax("GET", "./Json.php");
            console.log(json);
            try {
                let drow = new TalbeDrow(json);
            } catch(e) {
                console.log(e);
            }

            // 요청 무한요청 (5초)
            load();
            setInterval(load(), 5000);
        }
    </script>
</body>
</html>