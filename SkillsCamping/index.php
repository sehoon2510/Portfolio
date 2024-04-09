<?php
require_once "./autoload.php";

    
?>
<!DOCTYPE html>
<html lang="kr">
<?php require_once "./layout/head.php" ?>
<body>
    <div class="wrap">
        <?php require_once "./layout/header.php"; ?>
        <div class="contents">
            <?php require_once "./layout/slide.php" ?>
            <div class="show col-12">
                <div class="col-12 row d-flex flex-column align-items-center">
                    <div class="dis-col dis-center content-title mt-4 mb-5">
                        <p>캠핑장소개</p>
                        <p class="font-tahoma-bold">INTRODUCTION</p>
                    </div>
                    <div class="d-flex justify-content-around align-items-center item-card mt-5">
                        <div class="col-5 d-flex flex-column align-items-center item">
                            <div class="dis-row dis-center title">
                                <p class="font-malgun">캠핑장 구성</p>
                            </div>
                            <div class="dis-col dis-center span-box">
                                <span class="dis-row just-bet">
                                    <p class="font-malgun">텐트데크 (3m x 5m) </p>
                                    <p class="font-malgun-bold">10 개소</p>
                                </span>
                                <span class="dis-row just-bet">
                                    <p class="font-malgun">오토캠핑 (5m x 8m)</p>
                                    <p class="font-malgun-bold">7 개소</p>
                                </span>
                            </div>
                            <div class="imgs">
                                <img src="./image/image_01 (1).jpg" alt="">
                            </div>
                        </div>
                        <div class="col-5 d-flex flex-column align-items-center item">
                            <div class="dis-row dis-center title">
                                <p class="font-malgun">부대시설 안내</p>
                            </div>
                            <div class="span-box d-flex justify-content-center align-items-center">
                                <div class="d-flex flex-wrap align-items-center">
                                    <span class="dis-row dis-center span-item"><p class="font-malgun">관리소</p></span>
                                    <span class="dis-row dis-center span-item"><p class="font-malgun">취사장</p></span>
                                    <span class="dis-row dis-center span-item"><p class="font-malgun">세면장</p></span>
                                    <span class="dis-row dis-center span-item"><p class="font-malgun">화장실</p></span>
                                    <span class="dis-row dis-center span-item"><p class="font-malgun">포토존</p></span>
                                    <span class="dis-row dis-center span-item"><p class="font-malgun">잔디밭</p></span>
                                    <span class="dis-row dis-center span-item"><p class="font-malgun">전망대</p></span>
                                    <span class="dis-row dis-center span-item mt-2"><p class="font-malgun">어린이놀이터</p></span>
                                </div>
                            </div>
                            <div class="imgs">
                                <img src="./image/image_01 (30).jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 reservation mb-5">
                <div class="row dis-col just-ard aling-center">
                    <div class="dis-col dis-center content-title">
                        <p>예약안내</p>
                        <p class="font-tahoma-bold">RESERVATION INFOMATION</p>
                    </div>
                    <div class="d-flex justify-content-around align-items-center item-card">
                        <div class="col-5 d-flex flex-column align-items-center item">
                            <div class="dis-row dis-center title">
                                <p>예약문의</p>
                            </div>
                            <div class="dis-col dis-center span-box">
                                <span class="dis-row just-bet aling-center only-item">
                                    <i class="fa-solid fa-phone"></i>
                                    <p class="font-malgun-bold">전화번호 <span class="font-malgun">:</span> 041-987-1234</p>
                                </span>
                            </div>
                        </div>
                        <div class="col-5 d-flex flex-column align-items-center item">
                            <div class="dis-row dis-center title">
                                <p>운영시간</p>
                            </div>
                            <div class="span-box dis-row dis-center">
                                <span class="dis-row just-bet aling-center only-item">
                                    <i class="fa-regular fa-clock"></i>
                                    <ul>
                                        <li class="font-malgun-bold">평일 09:00 ~ 18:00</li>
                                        <li class="font-malgun-bold">주말 10:00 ~ 15:00</li>
                                        <li class="font-malgun-bold">점심시간 12:30~13:30</li>
                                    </ul>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text d-flex align-items-center">
                        <img src="./image/icon.png" alt="">
                        <ul>
                            <li>- 캠핑장 예약은 당일부터 2주간 가능합니다.</li>
                            <li>- 캠핑장 입영은 예약한 날의 14시부터 가능 합니다.</li>
                            <li>- 당일 예약의 경우 17시부터 입영할 수 있습니다.</li>
                        </ul>
                    </div>
                </div>
                <div class="img">
                    <img src="./image/image_01 (6)-편집.jpg" alt="">
                </div>
            </div>
            <div class="going mt-5">
                <div class="row col-12 mt-5 pb-5">
                    <div class="dis-col dis-center content-title mt-5">
                        <p></p>
                        <p class="font-malgun-bold">오시는길</p>
                    </div>
                    <div class="col-10 offset-1 pb-5">
                        <img src="./image/location.png" class="col-12" alt="location">
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "./layout/footer.php"; ?>
    </div>
    <script>
        var app = new Slide("#slide-ul");
    </script>
</body>
</html>