<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="row">
            <div class="row">
                <nav>
                    <ul class="dis-row">
                        <li><a href="./sub1.php" class="noto-bold dis-center">DFAA</a>
                            <div></div>
                            <ul class="dis-col align-center">
                                <li><a href="./sub1.php" class="noto-medium">인사말</a></li>
                                <li><a href="./sub2.php" class="noto-medium">DFAA 소개</a></li>
                                <li><a href="./sub3.php" class="noto-medium">상가안내</a></li>
                            </ul>
                        </li>
                        <li><a href="./sub4.php" class="noto-bold dis-center">고객정보서비스</a>
                            <div></div>
                            <ul class="dis-col align-center">
                                <li><a href="./sub4.php" class="noto-medium">맛집정보</a></li>
                                <li><a href="./sub5.php" class="noto-medium">숙박정보</a></li>
                            </ul>
                        </li>
                        <li><a href="./sub6.php" class="noto-bold dis-center">광고대행서비스</a>
                            <div></div>
                            <ul class="dis-col align-center">
                                <li><a href="./sub6.php" class="noto-medium">광고쇼핑</a></li>
                            </ul>
                        </li>
                        <li><a <?php if(!isset($_SESSION['user'])) : ?>href="./logoin.php"<?php else : ?>href="./logout.php"<?php endif; ?> class="noto-bold dis-center">계정</a>
                            <div></div>
                            <ul class="dis-col align-center">
                                <?php if(!isset($_SESSION['user'])) : ?>
                                    <li><a href="./logoin.php" class="noto-medium">로그인</a></li>
                                <?php else : ?>
                                    <li><a href="./logout.php" class="noto-medium">로그아웃</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php if(isset($_SESSION['user'])) : ?>
                            <?php if($_SESSION['user']['userid'] == 'admin') : ?>
                                <li><a href="./menuSet.php" class="noto-bold dis-center">관리자</a>
                                    <div></div>
                                    <ul class="dis-col align-center">
                                        <li><a href="./menuSet.php" class="noto-medium">메뉴관리</a></li>
                                        <li><a href="./logout.php" class="noto-medium">숙박업소 관리</a></li>
                                        <li><a href="./logout.php" class="noto-medium">광고카드 관리</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </nav>
                <div class="depth2"></div>
                <div class="logo dis-center">
                    <a href="./index.html"></a>
                </div>
            </div>
        </header>
        <section>
            <div class="slide dis-row">
                <div class="img-box">
                    <img src="./image/visual-img-01.jpg" alt="vis">
                </div>
                <div class="text">
                    <p class="noto-bold">동대문패션광고협회</p>
                    <p class="times">SEOUL<br>TRENDSCAPE</p>
                </div>
                <div class="background1">
                    <img src="./image/visual-img-11.jpg" alt="vis-back1">
                </div>
                <div class="background2"></div>
            </div>
            <div class="row">
                <div class="textweb type-img">
                    <div class="title dis-col align-center">
                        <p class="noto-bold">인사말</p>
                        <p class="tahoma">GREETINGS</p>
                    </div>
                    <div id="ad-card-container">
                        <div class="ad-card"><img src="./image/01.png" alt=""><p></p></div>
                        <div class="ad-card"><img src="./image/02.png" alt=""><p></p></div>
                        <div class="ad-card"><img src="./image/03.png" alt=""><p></p></div>
                        <div class="ad-card"><img src="./image/04.png" alt=""><p></p></div>
                        <div class="ad-card"><img src="./image/05.png" alt=""><p></p></div>
                        <div class="ad-card"><img src="./image/06.png" alt=""><p></p></div>
                        <div class="ad-card"><img src="./image/07.png" alt=""><p></p></div>
                        <div class="ad-card"><img src="./image/08.png" alt=""><p></p></div>
                    </div>
                    
                      <button id="reorder-button">Reorder Cards</button>
                      <button id="undo-button">Undo</button>
                      <button id="redo-button">Redo</button>
                    
                    <div id="toast-message"></div>
                </div>
            </div>
        </section>
        <footer>
            <div>
                <div class="row dis-row align-center">
                    <p class="noto-medium">이메일집단수집거부</p>
                    <p class="noto-medium">|</p>
                    <p class="noto-medium">관광특구소개</p>
                    <p class="noto-medium">|</p>
                    <p class="noto-medium">개인정보처리정책</p>
                    <p class="noto-medium">|</p>
                    <p class="noto-medium">관리자로그인</p>
                </div>
            </div>
            <div>
                <div class="row">
                    <p class="noto-regular">TEL : <span class="noto-bold">02-6161-5525,5526</span> FAX : <span class="noto-bold">02-6161-5520</span></p>
                    <p class="noto-regular">주소 : 서울 중구 을지로264, 롯데피트인 10층2220호 (사)동대문패션광고협회</p>
                    <p class="noto-regular">COPYRIGHT(C) SINCE 2017 DFAA.CO.KR ALL RIGHT RESERVED</p>
                </div>
            </div>
        </footer>
    </div>
    <script src="./js/sub6.js"></script>
</body>
</html>