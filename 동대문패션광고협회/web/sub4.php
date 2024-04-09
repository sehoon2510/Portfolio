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
                <div class="list-box">
                    <div class="title dis-col align-center">
                        <p class="noto-bold">맛집정보</p>
                        <p class="tahoma">INTORMATION</p>
                    </div>
                    <ul>
                        <li>
                            <p class="noto-bold">쉐이크쉑 (ShakeShack)</p>
                            <div class="text">
                                <p class="noto-regular">전화번호 : 02-3398-4003</p>
                                <p class="noto-regular">품목 : 수제버거</p>
                                <p class="noto-regular">휴무일 : 연중무휴</p>
                                <p class="noto-regular">주소 : 서울 중구 장충단로 275, 두산타워 1층</p>
                            </div>
                            <div class="img-box">
                                <img src="./image/1.ShakeShack/3537770944_1Yef6u3N_a1fd275d08524b4d6d4bddf68de8ad5d2cc60f89.jpg" alt="backimg1">
                            </div>
                            <div class="comment">
                                <p class="noto-regular">뉴욕에서 시작한 올바른 가치를 추구하는 파인 캐주얼 레스토랑
                                    쉐이크쉑은 프리미엄 식재료로 사용한 클래식 아메리칸 스타일의 맛있고 건강한 수제버거입니다. 프리미엄 버거, 플랫-탑도그, 크링클컷 프라이에 신선한 커스터드, 에일 맥주, 와인 등을 함께 즐길 수 있습니다. </p>
                            </div>
                        </li>
                        <li>
                            <p class="noto-bold">신룽푸마라탕 (XIN LONG FU MA LA TANG)</p>
                            <div class="text">
                                <p class="noto-regular">전화번호 : 02-3398-4106</p>
                                <p class="noto-regular">품목 : 마라탕</p>
                                <p class="noto-regular">휴무일 : 연중무휴</p>
                                <p class="noto-regular">주소 : 서울 중구 장충단로 275, 두산타워 지하1층</p>
                            </div>
                            <div class="img-box">
                                <img src="./image/2.신룽푸마라탕/3537770944_6cFmk45L_7984a67b85db510c29458b1b6af22f585c7a883b.jpg" alt="backimg2">
                            </div>
                            <div class="comment">
                                <p class="noto-regular">신룽푸마라탕은 시원한 사골육수에 각종 신선한 채소와 재료들을 취향대로 골라 넣어드실 수 있는 고객 맞춤형 건강식입니다.</p>
                            </div>
                        </li>
                        <li>
                            <p class="noto-bold">크래프트한스 (CRAFTHANS)</p>
                            <div class="text">
                                <p class="noto-regular">전화번호 : 02-3398-4242</p>
                                <p class="noto-regular">품목 : 수제 맥주, 치킨, 소시지, 피자</p>
                                <p class="noto-regular">휴무일 : 연중무휴</p>
                                <p class="noto-regular">주소 : 서울 중구 장충단로 275, 두타 지하 1층</p>
                            </div>
                            <div class="img-box">
                                <img src="./image/3.크래프트한스/3537770944_4iey3T7m_33162a46c3e10cceef440021ae6aaa88196af88b.jpg" alt="backimg3">
                            </div>
                            <div class="comment">
                                <p class="noto-regular">크래프트한스는 맛있는 수제 맥주를 부담 없는 가격에 즐길 수 있는 문화를 전파하고자 하는 신념으로 이태원 해밀턴호텔 뒷골목에서 시작된 수제 맥주 전문점입니다. </p>
                            </div>
                        </li>
                        <li>
                            <p class="noto-bold">해초섬</p>
                            <div class="text">
                                <p class="noto-regular">전화번호 : 02-2283-2901</p>
                                <p class="noto-regular">품목 : 해초섬 밥상, 바다쌈</p>
                                <p class="noto-regular">영업시간 : 11:00 ~ 23:00</p>
                                <p class="noto-regular">휴무일 : 연중무휴</p>
                                <p class="noto-regular">주소 : 서울시 중구 장충단로 13길, 20 현대시티아울렛 동대문점 9층</p>
                            </div>
                            <div class="img-box">
                                <img src="./image/4.해초섬/3537770944_BJZKX17c_bef35b21fc23d00ef664fc01f6e182b3f90fd798.jpg" alt="backimg4">
                            </div>
                            <div class="comment">
                                <p class="noto-regular">바다보쌈, 바다밥상 '해초섬'은 모던하고 심플한 인테리어의 Korean Casual Dining을 지향합니다. 자연으로부터 온 로컬푸드와 제철을 맞은 싱싱한 해산물로 건강한 바다요리를 선사하는 해초섬은 남녀노소 누구나 부담없이 즐기실 수 있고, 국내 최초로 개발된 생선회 세꼬시와 해초, 돼지고기가 결합된 어육 바다보쌈은 해초섬이 가장 자랑하는 시그니쳐 메뉴입니다. </p>
                            </div>
                        </li>
                        <li>
                            <p class="noto-bold">풀잎채</p>
                            <div class="text">
                                <p class="noto-regular">전화번호 : 02-2283-2900</p>
                                <p class="noto-regular">품목 : 한식뷔페</p>
                                <p class="noto-regular">영업시간 : 11:00 ~ 23:00</p>
                                <p class="noto-regular">휴무일 : 연중무휴</p>
                                <p class="noto-regular">주소 : 서울시 중구 장충단로 13길, 20 현대시티아울렛 동대문점 9층</p>
                            </div>
                            <div class="img-box">
                                <img src="./image/5.풀잎채/3537770944_1LfEXWKs_b8ea02ae65c5d84470966f11970ada5bc443061b.jpg" alt="backimg5">
                            </div>
                            <div class="comment">
                                <p class="noto-regular">풀잎채는 힐링이 되는 건강한 프리미엄 한식 브랜드입니다. 풀잎채는 스트레스와 피로를 안고 살아가는 현대인에게 한국의 맛을 담은 자연 친화적이고 건강한 한식을 제공하는데 매진하고 있습니다. 지난 20여년간 두부마을, 풀잎채 한상, 두란 등 한식업의 경영 노하우로 가장 한식다운 한식, 전통의 맛을 간직한 한식으로 건강한 맛의 즐거움을 선사해 드립니다.</p>
                            </div>
                        </li>
                        <li>
                            <p class="noto-bold">미즈컨테이너</p>
                            <div class="text">
                                <p class="noto-regular">전화번호 : 02-2283-2146</p>
                                <p class="noto-regular">품목 : 특제 브라운 소스 도리아, 베이컨포테이토 팬치즈</p>
                                <p class="noto-regular">영업시간 : 11:00 ~ 23:00</p>
                                <p class="noto-regular">휴무일 : 연중무휴</p>
                                <p class="noto-regular">주소 : 서울시 중구 장충단로 13길, 20 현대시티아울렛 동대문점 B1층</p>
                            </div>
                            <div class="img-box">
                                <img src="./image/6.미즈컨테이너/3537770944_6gEQ4kNG_daa61dd35e6c69e4c4313ab599250842946cc2fa.jpg" alt="backimg6">
                            </div>
                            <div class="comment">
                                <p class="noto-regular">미즈컨테이너는 퓨전 아메리카 스타일의 레스토랑으로 :맛있게, 양많이"를 컨셉으로 추구하는 브랜드입니다. 대구의 1호점을 시작으로 전국의 6개의 점포를 운영하고 있으며, 맛있는 료리 뿐만 아니라 인더스트리얼 소품을 이용한 재미있는 인테리어로 남녀노소 가리지 않고 많은 사람들의 사랑을 받고 있습니다. 이제 동대문에서 만나보세요.</p>
                            </div>
                        </li>
                        <li>
                            <p class="noto-bold">도레도레</p>
                            <div class="text">
                                <p class="noto-regular">전화번호 : 02-2283-2145</p>
                                <p class="noto-regular">품목 : 케이크, 커피</p>
                                <p class="noto-regular">영업시간 : 11:00 ~ 23:00</p>
                                <p class="noto-regular">휴무일 : 연중무휴</p>
                                <p class="noto-regular">주소 : 서울 중구 장충단로 13길, 20 현대시티아울렛 동대문점 B1층</p>
                            </div>
                            <div class="img-box">
                                <img src="./image/7.도레도레/3537770944_bqXvUcS7_17c567f36c02a0e0c7cc0ced395d46c969569727.jpg" alt="backimg7">
                            </div>
                            <div class="comment">
                                <p class="noto-regular">도레도레는 자체 로스팅한 원두로 만든 커피, 갓 구운 신선한 베이커리로 모든 메뉴를 좋은 재료와 정성을 다하여 만듭니다. 특히 '고마워', '행복해', '사랑해'라는 이름의 케이크 메뉴가 인기에 있습니다. 고마운 사람에게, 사랑하는 사람에게 도레도레 케이크를 선물해보세요. </p>
                            </div>
                        </li>
                        <li>
                            <p class="noto-bold">명동가츠라</p>
                            <div class="text">
                                <p class="noto-regular">전화번호 : 02-6262-4825</p>
                                <p class="noto-regular">품목 : 돈까스</p>
                                <p class="noto-regular">영업시간 : 11:00 ~ 22:00</p>
                                <p class="noto-regular">휴무일 : 연중무휴(추석, 설 당일 휴무)</p>
                                <p class="noto-regular">주소 : 서울 중구 을지로 264, 롯데피트인 8층</p>
                            </div>
                            <div class="img-box">
                                <img src="./image/8.명동가츠라/3537770944_0ePDwEay_81d184a8c2d97e67d46123ff57aba3033f222454.jpg" alt="backimg8">
                            </div>
                            <div class="comment">
                                <p class="noto-regular">국내에서 일본의 맛을 선사하는 일본 요리 전문 외식 브랜드 </p>
                            </div>
                        </li>
                        <li>
                            <p class="noto-bold">황금닭한마리</p>
                            <div class="text">
                                <p class="noto-regular">전화번호 : 02-2285-1900</p>
                                <p class="noto-regular">품목 : 닭한마리, 닭볶음탕, 닭칼국수</p>
                                <p class="noto-regular">영업시간 : 11AM ~ 10PM(월~토)</p>
                                <p class="noto-regular">휴무일 : 일요일(선 예약시 일요일 오픈)</p>
                                <p class="noto-regular">주소 : 서울 중구 퇴계로 58길 33</p>
                            </div>
                            <div class="img-box">
                                <img src="./image/8.명동가츠라/3537770944_0ePDwEay_81d184a8c2d97e67d46123ff57aba3033f222454.jpg" alt="backimg8">
                            </div>
                            <div class="comment">
                                <p class="noto-regular">'황금닭한마리'는 싱싱한 하림 생닭만을 사용해 누린내가 나지 않고 건강에 좋은 닭요리만을 선보입니다.
                                    국내산 김치와 원료로 건강한 맛을 보장할 뿐만 아니라 소스를 직접 제조하여 찍어먹는 재미까지 있습니다.
                                    내부는 1층과 2층으로 이루어져 있으며 2층에서는 단독 24석 회식이 가능하고 깔끔한 분위기를 즐길 수 있으니, 단체로 오게 된다면 2층을 강력하게 추천합니다. 
                                    </p>
                            </div>
                        </li>
                    </ul>
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