<header>
    <div class="col-10 offset-2 row d-flex justify-content-between">
        <div class="logo dis-row dis-center">
            <a href="./"><img src="./image/logo.png" alt=""></a>
        </div>
        <nav class="d-flex align-tiems-center justify-content-center">
            <ul class="dis-row aling-center just-bet">
                <li><a href="./sub1">캠핑장소개</a></li>
                <li><a href="./sub2">예약하기</a></li>
                <li><a href="./sub3">마이페이지</a></li>
            </ul>
        </nav>
        <div class="sub">
            <ul class="d-flex align-items-center justify-content-between">
                <li class="dis-row dis-center">
                    <?php if(!isset($_SESSION['user'])) : ?>
                        <a href="./login?path=/">로그인</a>
                    <?php else : ?>
                        <a href="./logout">로그아웃</a>
                    <?php endif; ?>
                </li>
                <li class="d-flex align-items-center justify-content-center">
                    <a href="./admin1.php">운영관리</a>
                    <div>
                        <div></div>
                        <ul>
                            <li class="dis-row dis-center"><a href="./admin1">예약관리</a></li>
                            <li class="dis-row dis-center"><a href="./admin2">주문관리</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="back"></div>
</header>