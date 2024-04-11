<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./common/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="./common/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./common/css/style.css">
    <script src="./common/js/jquery-3.4.1.min.js"></script>
    <script src="./common/bootstrap/js/bootstrap.js"></script>
    <script src="./common/js/lib.js"></script>
    <script src="./common/js/script.js"></script>
</head>
<body>
    <!-- 로그인 -->
    <form action="/sign-in" method="post" id="sign-in" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-4 pt-4 pb-3">
                    <div class="title text-center">
                        SIGN IN
                    </div>
                    <div class="mt-4">
                        <div class="form-group">
                            <label for="login_id">아이디</label>
                            <input type="text" id="login_id" class="form-control" name="user_id" placeholder="아이디을(를) 입력하세요" required>
                        </div>
                        <div class="form-group">
                            <label for="login_pw">비밀번호</label>
                            <input type="password" id="login_pw" class="form-control" name="password" placeholder="비밀번호을(를) 입력하세요" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="w-100 py-3 bg-blue text-white">로그인</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /로그인 -->
    <!-- 회원가입 -->
    <form action="/sign-up" method="post" id="sign-up" class="modal fade" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-4 pt-4 pb-3">
                    <div class="title text-center">
                        SIGN UP
                    </div>
                    <div class="mt-4">
                        <div class="form-group">
                            <label for="join_id">아이디</label>
                            <input type="text" id="join_id" class="form-control" name="user_id" placeholder="아이디을(를) 입력하세요" required>
                        </div>
                        <div class="form-group">
                            <label for="join_pw">비밀번호</label>
                            <input type="password" id="join_pw" class="form-control" name="password" placeholder="비밀번호을(를) 입력하세요" required>
                        </div>
                        <div class="form-group">
                            <label for="join_name">이름</label>
                            <input type="text" id="join_name" class="form-control" name="user_name" placeholder="이름을(를) 입력하세요" required>
                        </div>
                        <div class="form-group">
                            <label for="join_photo">사진</label>
                            <div class="custom-file">
                                <input type="file" id="join_photo" class="custom-file-input" name="photo" required>
                                <label for="join_photo" class="custom-file-label">파일을 업로드 하세요</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="cap_answer" name="cap_answer">
                            <label for="cap_input">자동입력방지 문자</label>
                            <canvas class="w-100 border" id="cap_canvas" width="450" height="100"></canvas>
                            <input type="text" id="cap_input" class="form-control" name="cap_input" placeholder="상단의 문자열을 입력하세요" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="w-100 py-3 bg-blue text-white">가입 완료</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- /회원가입 -->
    <div class="col-12 p-0">
        <header class="col-12 p-0">
            <div class="container container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <a href="/" class="logo text-white">
                            <i class="fa fa-home fx-3"></i>
                            <span>내집 꾸미기</span>
                        </a>
                        <nav class="nav ml-5 d-none d-lg-flex gap-3">
                            <a href="/" class="nav__item text-gray">홈</a>
                            <a href="/knowhows" class="nav__item text-gray">온라인 집들이</a>
                            <a href="/store" class="nav__item text-gray">스토어</a>
                            <a href="/specialist" class="nav__item text-gray">전문가</a>
                            <a href="/estimates" class="nav__item text-gray">시공 견적</a>
                        </nav>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="auth d-none d-lg-flex gap-3">
                            <?php if(!user()) : ?>
                                <a href="#" class="text-gray" data-toggle="modal" data-target="#sign-in">로그인</a>
                                <a href="#" class="text-gray" data-toggle="modal" data-target="#sign-up">회원가입</a>
                            <?php else : ?>
                                <span class="fx-n2 text-gold">&lt;<?=user()->name?>&gt;(&lt;<?=user()->user_id?>&gt;)</span>
                                <a href="/logout" class="text-gray" data-target="#sign-up">로그아웃</a>
                            <?php endif; ?>
                        </div>
                        <div class="menu-icon d-lg-none">
                            <span class="border-gray"></span>
                            <span class="border-gray"></span>
                            <span class="border-gray"></span>
                        </div>
                        <div class="menu d-lg-none d-flex flex-column align-items-center">
                            <nav class="col-10 p-0 d-flex flex-column gap-2 mt-5 pt-5">
                                <a href="#" class="nav__item text-gray">홈</a>
                                <a href="#" class="nav__item text-gray">온라인 집들이</a>
                                <a href="/store" class="nav__item text-gray">스토어</a>
                                <a href="/specialist" class="nav__item text-gray">전문가</a>
                                <a href="/estimates" class="nav__item text-gray">시공 견적</a>
                            </nav>
                            <div class="col-10 p-0 mt-3 d-flex gap-3">
                                <?php if(!user()) : ?>
                                    <a href="#" class="text-gray" data-toggle="modal" data-target="#sign-in">로그인</a>
                                    <a href="#" class="text-gray" data-toggle="modal" data-target="#sign-up">회원가입</a>
                                <?php else : ?>
                                    <span class="fx-n2 text-gold">&lt;<?=user()->name?>&gt;(&lt;<?=user()->user_id?>&gt;)</span>
                                    <a href="/logout" class="text-gray">로그아웃</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <script>
            document.querySelector("[data-target='#sign-up']").addEventListener("click", e => {
                let canvas = $("#cap_canvas")[0];
                let ctx = canvas.getContext("2d");
                
                ctx.clearRect(0, 0, 450, 100);
                ctx.font = "50px 나눔스퀘어, sans-serif";
                
                let text = Math.random().toString(36).substr(2, 5).split("").map(str => parseInt(Math.random() * 10) % 2 === 0 ? str.toUpperCase() : str).join("");
                // 렌덤한 수를 36진주로 생성, 이후 50%로 대소문자 여부 설정후 배열은 텍스트형으로 변경
                let width = ctx.measureText(text).width;
                
                ctx.fillText(text, ( canvas.width / 2 ) - ( width / 2 ), ( canvas.height / 2 ) + 25);
                $("#cap_answer").val(text);
            });
        </script>
        <section>
            <?php if($name == "index") : ?>
            <input hidden type="radio" name="slide" id="slide-1" checked>
            <input hidden type="radio" name="slide" id="slide-2">
            <input hidden type="radio" name="slide" id="slide-3">
            <input hidden type="radio" name="slide" id="slide-4">
            <input hidden type="radio" name="slide" id="slide-5">
            <input hidden type="radio" name="slide" id="slide-6">
            <input hidden type="radio" name="slide" id="slide-1-copy">
            <input hidden type="radio" name="slide" id="slide-2-copy">
            <input hidden type="radio" name="slide" id="slide-3-copy">
            <input hidden type="radio" name="slide" id="slide-4-copy">
            <input hidden type="radio" name="slide" id="slide-5-copy">
            <input hidden type="radio" name="slide" id="slide-6-copy">
            <?php endif; ?>
            <div id="visual" <?= $name != "index" ? 'class="sub"' : '' ?>>
                <div class="col-12 design-line bg-white"></div>
                <div class="col-12 design-line bg-white"></div>
                <div class="images">
                    <img src="./image/apartment-2094700_1920.jpg" alt="슬라이드 이미지" title="슬라이드 이미지">
                    <img src="./image/interior-4158033.jpg" alt="슬라이드 이미지" title="슬라이드 이미지">
                    <img src="./image/window-3042834_1920.jpg" alt="슬라이드 이미지" title="슬라이드 이미지">
                </div>
                <div class="item-center">
                    <div class="fx-5 text-gold text-right fx-sm-4">for Customer</div>
                    <div class="fx-8 text-white font-bold mt-n4 fx-sm-7">INTERIOR</div>
                    <div class="d-flex align-items-center justify-content-between flex-column flex-lg-row">
                        <div class="fx-n2 text-gray mb-4 mb-lg-0">나만의 인테리어로 새로운 공간을 만드세요</div>
                        <?php if($name == "index") : ?>
                        <div class="buttons d-flex">
                            <div class="left-btn d-flex justify-content-center align-items-center text-gold border border-gold mr-2">
                                <i class="fa fa-angle-left"></i>
                                <label for="slide-5" class="label-1"></label>
                                <label for="slide-1" class="label-2"></label>
                                <label for="slide-6" class="label-3"></label>
                                <label for="slide-3" class="label-4"></label>
                                <label for="slide-5-copy" class="label-1-copy"></label>
                                <label for="slide-1-copy" class="label-2-copy"></label>
                                <label for="slide-6-copy" class="label-3-copy"></label>
                                <label for="slide-3-copy" class="label-4-copy"></label>
                            </div>
                            <div class="right-btn d-flex justify-content-center align-items-center text-gold border border-gold">
                                <i class="fa fa-angle-right"></i>
                                <label for="slide-2" class="label-1"></label>
                                <label for="slide-3" class="label-2"></label>
                                <label for="slide-4" class="label-3"></label>
                                <label for="slide-1" class="label-4"></label>
                                <label for="slide-2-copy" class="label-1-copy"></label>
                                <label for="slide-3-copy" class="label-2-copy"></label>
                                <label for="slide-4-copy" class="label-3-copy"></label>
                                <label for="slide-1-copy" class="label-4-copy"></label>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>