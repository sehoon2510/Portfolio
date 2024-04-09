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
                <div class="notice">
                    <div class="title dis-col align-center">
                        <p class="noto-bold">공지사항</p>
                        <p class="tahoma">INTORMATION</p>
                    </div>
                    <div class="content dis-row just-bet">
                        <ul>
                            <li class="dis-row just-bet">
                                <p class="noto-regular">2022년 동대문 축제 대행사업자 모집 공고</p>
                                <p class="noto-regular">2021-05-02</p>
                            </li>
                            <li class="dis-row just-bet">
                                <p class="noto-regular">누죤 ‘2021 봄맞이 경품 대축제’ 룰렛 이벤트(3월5일~3월9일)</p>
                                <p class="noto-regular">2021-02-12</p>
                            </li>
                            <li class="dis-row just-bet">
                                <p class="noto-regular">가방의 성지 동대문 남평화시장</p>
                                <p class="noto-regular">2021-02-03</p>
                            </li>
                            <li class="dis-row just-bet">
                                <p class="noto-regular">동대문패션타운관광특구 국제포럼(10.31)</p>
                                <p class="noto-regular">2020-10-30</p>
                            </li>
                            <li class="dis-row just-bet">
                                <p class="noto-regular">동대문 DDP라이트 축제(12.20~1.3)</p>
                                <p class="noto-regular">2020-10-13</p>
                            </li>
                            <li class="dis-row just-bet">
                                <p class="noto-regular">2020 상가별 여름휴가 일정</p>
                                <p class="noto-regular">2020-06-17</p>
                            </li>
                            <li class="dis-row just-bet">
                                <p class="noto-regular">2월 7일부터 두타몰 영업시간 단축 안내</p>
                                <p class="noto-regular">2020-02-11</p>
                            </li>
                            <li class="dis-row just-bet">
                                <p class="noto-regular">신종 코로나 바이러스 예방수칙</p>
                                <p class="noto-regular">2020-01-30</p>
                            </li>
                        </ul>
                        <div>
                            <p class="noto-bold">고객센터</p>
                            <p class="noto-bold">02-6161-5525</p>
                            <div>
                                <p class="noto-regular">Fax. 02-6161-5520</p>
                                <p class="noto-regular">E-mail : .</p>
                            </div>
                            <div>
                                <p class="noto-regular">상담시간 AM 10:00 ~ PM  17:00</p>
                                <p class="noto-regular">토,일,공휴일 휴뮤</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner">
                    <div class="title dis-col align-center">
                        <p class="noto-bold">배너</p>
                        <p class="tahoma">BANNER</p>
                    </div>
                    <div class="content dis-row just-bet dis-wrap">
                        <div class="list">
                            <div class="text-box dis-col align-center">
                                <div class="text dis-col align-center">
                                    <p class="noto-bold">2022 DDP 오픈큐레이팅 모집 공고</p>
                                    <p class="noto-regular comment">신진 크리에이터의</p>
                                    <p class="noto-regular comment">독창적이고 실험적인 전시기획을 모집합니다.</p>
                                    <p class="noto-regular">기간 : 2022.3.26 - 05.27 17:00까지</p>
                                    <p class="noto-regular">주제 : 경계를 지우는 디자인</p>
                                </div>  
                                <div class="icon dis-row align-center just-bet">
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="./image/banner1.jpg" alt="banner1">
                            </div>
                        </div>
                        <div class="list">
                            <div class="text-box dis-col align-center">
                                <div class="text dis-col align-center">
                                    <p class="noto-bold">2022 서울디자인컨설턴트 「청년디자이너」 모집</p>
                                    <p class="noto-regular comment">서울형 뉴딜일자리 사업과 연계하여</p>
                                    <p class="noto-regular comment">실무 수행이 가능한 열정 있는 청년디자이너를 모집합니다.</p>
                                    <p class="noto-regular">접수기간 : 2022. 4.27(수) - 5.7(토)</p>
                                    <p class="noto-regular">이메일 접수(consultant@dfaa.co.kr)</p>
                                </div>  
                                <div class="icon dis-row align-center just-bet">
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="./image/banner2.jpg" alt="banner2">
                            </div>
                        </div>
                        <div class="list">
                            <div class="text-box dis-col align-center">
                                <div class="text dis-col align-center">
                                    <p class="noto-bold">2022 서울디자인컨설턴트 모집</p>
                                    <p class="noto-regular comment">맞춤형 디자인 컨설팅을 수행할 수 있는</p>
                                    <p class="noto-regular comment">역량 있는 컨설턴트 모집합니다.</p>
                                    <p class="noto-regular">모집인원 : 12명</p>
                                    <p class="noto-regular comment">접수기간 : 2022.4.27.(수) ~ 5.7.(토) 16:00 </p>
                                    <p class="noto-regular comment">접수방법 : 온라인 접수(consultant@dfaa.co.kr)</p>
                                </div>  
                                <div class="icon dis-row align-center just-bet">
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="./image/banner3.jpg" alt="banner3">
                            </div>
                        </div>
                        <div class="list">
                            <div class="text-box dis-col align-center">
                                <div class="text dis-col align-center">
                                    <p class="noto-bold">DDP 온라인클래스</p>
                                    <p class="noto-regular comment">포스트 코로나 시대의 변화하는 ‘라이프스타일’에</p>
                                    <p class="noto-regular comment">시민들이 적응하고 치유될 수 있도록</p>
                                    <p class="noto-regular comment">의식주(衣食住)컨셉에 맞춰</p>
                                    <p class="noto-regular comment">지속가능성, 친환경성을 고려한 DDP 온라인 클래스를 진행합니다.</p>
                                    <p class="noto-regular comment">1. 의衣: 업사이클링 패션</p>
                                    <p class="noto-regular comment">2. 식食: 홈파티 테이블 셋팅</p>
                                    <p class="noto-regular comment">3. 주住: 힐링 홈가든</p>
                                </div>  
                                <div class="icon dis-row align-center just-bet">
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="./image/banner4.jpg" alt="banner4">
                            </div>
                        </div>
                        <div class="list">
                            <div class="text-box dis-col align-center">
                                <div class="text dis-col align-center">
                                    <p class="noto-bold">DDP 영디자이너 잡페어 온라인 전시</p>
                                    <p class="noto-regular comment">포스트코로나 시대를 관통하는 ‘새로운 변화’를 즐기며</p>
                                    <p class="noto-regular comment">디자인 대학 졸업예정자와 취업준비생이 대면할</p>
                                    <p class="noto-regular comment">다양한 ‘미래 담론’에 도전하고 모두에게 열린 기회를 나누고자 합니다.</p>
                                    <p class="noto-regular">일정 : 2021. 12. 10 ~ 2022. 3. 10</p>
                                    <p class="noto-regular">장소 : DDP 영디자이너 잡페어 플랫폼에서 입장가능</p>
                                </div>  
                                <div class="icon dis-row align-center just-bet">
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="./image/banner5.jpg" alt="banner5">
                            </div>
                        </div>
                        <div class="list">
                            <div class="text-box dis-col align-center">
                                <div class="text dis-col align-center">
                                    <p class="noto-bold">팀랩 라이프</p>
                                    <p class="noto-regular comment">DDP의 복합문화공간의 특징을 최대한 활용해 압도적이고 몰입감 넘치는 </p>
                                    <p class="noto-regular comment">예술 작품들로 생명의 아름다움을 구현하고자 합니다.</p>
                                    <p class="noto-regular">일정 : 2022. 02. 25 ~ 2022. 03. 22</p>
                                    <p class="noto-regular">장소 : DDP 지하2층 디자인전시관</p>
                                </div>  
                                <div class="icon dis-row align-center just-bet">
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="img-box">
                                <img src="./image/banner6.jpg" alt="banner6">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gallery">
                    <div class="title dis-col align-center">
                        <p class="noto-bold">갤러리</p>
                        <p class="tahoma">GALLERY</p>
                    </div>
                    <div class="content">
                        <ul class="dis-row">
                            <li><img src="./image/gallary-01.jpg" alt="gallery1"></li>
                            <li><img src="./image/gallary-02.jpg" alt="gallery2"></li>
                            <li><img src="./image/gallary-03.jpg" alt="gallery3"></li>
                            <li><img src="./image/gallary-04.jpg" alt="gallery4"></li>
                            <li><img src="./image/gallary-05.jpg" alt="gallery5"></li>
                            <li><img src="./image/gallary-06.jpg" alt="gallery6"></li>
                            <li><img src="./image/gallary-01.jpg" alt="gallery7"></li>
                        </ul>
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
</body>
</html>