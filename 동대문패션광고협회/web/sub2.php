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
    <script src="https://kit.fontawesome.com/f8a46e4a2c.js" crossorigin="anonymous"></script>
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
                <div class="textweb type-text">
                    <div class="title dis-col align-center">
                        <p class="noto-bold">DFAA소개</p>
                        <p class="tahoma">INTRODUCTION</p>
                    </div>
                    <div class="video">
                        <video width="1280" id="video">
                            <source src="./image/DDP.mp4" type="video/mp4">
                        </video>
                        <div id="controll" class="controll dis-row align-center just-ard">
                            <button id="play"><i class="fa-solid fa-play"></i></button>
                            <button id="pause"><i class="fa-solid fa-pause"></i></button>
                            <button id="stop"><i class="fa-solid fa-stop"></i></button>
                            <button id="rewind"><i class="fa-solid fa-backward"></i></button>
                            <button id="fast-forward"><i class="fa-solid fa-forward"></i></button>
                            <button id="speedDown"><i class="fa-solid fa-backward-fast"></i></button>
                            <button id="speedUp"><i class="fa-solid fa-forward-fast"></i></button>
                            <button id="resetSpeed" class="noto-bold">1.00X</button>
                            <button id="hide"><i class="fa-solid fa-eye-slash"></i></button>
                            <button id="toggleLoopButton"><i class="fa-sharp fa-solid fa-infinity"></i></button>
                            <button id="toggleAutoplayButton"><i class="fa-solid fa-bolt"></i></button>
                        </div>
                    </div>
                    <div class="dis-row just-bet">
                        <div class="textarr">
                            <div class="title dis-col just-center">
                                <p class="noto-bold">동대문 상권을 찾는 여러 고객을 비롯하여 상인 모두의 안녕을 기원합니다.</p>
                            </div>
                            <div class="comment">
                                <p class="noto-regular">동대문패션 상권은 전통시장과 현대식 쇼핑몰이 혼재된 31개 대형상가의 3만여 점포와 15만명에 이르는 패션인들이 종사하고 있는 단일 지역, 세계 최대 패션산업단지입니다.</p>
                                <p class="noto-regular">또한, 중국, 일본, 대만, 동남아시아를 비롯한 세계각지의 수출전진기지로서 연간 800만 명이 넘는 관광객과 소매상, 바이어들이 즐겨 찾는 세계적인 패션상권이자 관광 명소입니다.</p>
                                <p class="noto-regular">특히, 중구 신당동과 종로구 창신동을 중심으로 봉제, 패턴, 완성 등 생산에 종사하는 장인들의 기술과 경험을 비롯하여 동대문종합시장 상인들의 원단개발 노력과 디자이너들의 탁월한 감각이 동대문상인들과 하나가 되어 패션타운의 명성을 유지 발전시켰습니다.</p>
                                <p class="noto-regular">아울러, 최신 트렌드를 반영한 제품을 소비자가 원하는 조건에 신속히 공급하는 것과 야간패션시장이라는 특성이 동대문패션상권 발전의 원동력이었으며 현재는 온라인시장의</p>
                                <p class="noto-regular">중요한 공급자이자 주체로서 유통환경의 급격한 변화 속에서 스마트시대에 맞는 다양한 역할에 대비하여, 다가오는 유커머스(U-Commerce)의 중심이 되고자 준비하고 있습니다.</p>
                            </div>
                            <div class="comment">
                                <p class="noto-regular">"흥인지문(보물 1호)과 동대문시장의 발전"</p>
                                <p class="noto-regular">1934년 일제가 ‘흥인지문(興仁之門)’을 ‘동대문’이란 이름으로 문화재 지정을 하여 안타깝게도 ‘동대문’으로 불리게 되었으며, 근처에 시장이 형성되면서 자연스럽게 ‘동대문시장’으로 불리게 되었다. 1963년 보물 제 1호로 지정되었으며, 1996년 역사 바로 세우기 사업으로 ‘흥인지문(興仁之門)’으로 명칭이 환원되었고, 현재는 차로 일부를 축소하여 시민들이 가깝게 접근할 수 있도록 녹지공간이 조성되어 있다.</p>
                                <p class="noto-regular">1962년 평화시장의 개설을 기점으로 현대식 패션상권이 형성되기 시작하여, 1990년대에 들어서 아트프라자, 누죤, APM 등 현대식 도매상가들이 연속해서 세계유일의 야간 패션시장을 오픈하고, 경쟁적으로 디자인을 강조한 패스트패션(fast fashion)을 국내외에 공급하여 동대문패션의 전성기를 열었다.</p>
                                <p class="noto-regular">1990년대 후반기부터는 상권 서쪽에 프레야타운(현 현대시티아울렛), 밀리오레, 두타, 헬로APM과 같은 패션전문 복합쇼핑몰들이 속속 문을 열면서, 다양한 이벤트와 젊음이 넘치는 문화, 관광 해방구의 역할을 추가하여, ‘동대문시장’의 역할과 범위가 확대 되었다.</p>
                            </div>
                            <div class="comment">
                                <p class="noto-regular">"DFAA와 동대문패션상권"</p>
                                <p class="noto-regular">2021년 개관한 DFAA는 동대문디자인프라자(DDP) 내에 위치한 복합 문화 공간으로, 각종 전시, 패션쇼, 신제품발표회, 포럼, 컨퍼런스 등 다양한 문화 행사를 진행하고 있습니다.</p>
                                <p class="noto-regular">동대문패션타운은 디자인 트렌드가 시작되고 문화가 교류하는 장소입니다. 세계 최초 신제품과 패션 트렌드를 알리고, 새로운 전시를 통해 지식을 공유하며, 다양한 디자인 체험이 가능한 콘텐츠로 운영됩니다. 이러한 활동을 통해 DFAA는 아시아로, 세계로 향하는 ‘디자인·패션산업의 발원지’의 역할을 할 것입니다.</p>
                                <p class="noto-regular">그동안 DFAA는 동대문디자인프라자(DDP)와 협력하여 수주박람회 등의 행사만을 주관해오다가, 2021년부터 동대문패션 상권의 활성화를 위한 본격적인 걸음을 서울시와 함께 내딛고자 합니다.</p>
                            </div>
                            <div class="comment">
                                <p class="noto-regular">위치 : 서울중구 소재 동대문운동장 주변 신흥 및 재래시장 일대</p>
                                <p class="noto-regular">면적 : 약 586,000㎡ (약 17만 평)</p>
                                <p class="noto-regular">상가수 31개 : 야간 도매상가 (pm9~am7)：22개 / 24시간 영업상가：6개</p>
                                <p class="noto-regular">점포수 : 3만 여 개</p>
                                <p class="noto-regular">주요품목 : 의류, 잡화, 장신구, 생필품 등</p>
                                <p class="noto-regular">시장종사자 : 상인포함 약 15만 명 / 1일 유동인구：100만 명</p>
                                <p class="noto-regular">연간 외국인 관광객 수 : 800만 명 / 1일 총매출액：약 500억원</p>
                                <p class="noto-regular">주차장 : 약 1만5천 여 대 주차가능</p>
                                <p class="noto-regular">대중교통 이용편리 : 지하철 - 1, 2, 4, 5, 6호선 / 시내버스 - 18개 노선 운행</p>
                            </div>
                        </div>
                    </div>
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
    <script src="./js/sub2.js"></script>
</body>
</html>