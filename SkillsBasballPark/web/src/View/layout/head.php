<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/common/fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="/common/bootstrap-5.2.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="/common/css/style.css">
    <script src="/common/js/jquery-3.7.1.min.js"></script>
    <script src="/common/bootstrap-5.2.0-dist/js/bootstrap.js"></script>
    <script src="/common/js/lib.js"></script>
    <script src="/common/js/script.js"></script>
</head>
<body class="bg-light">
    <header class="bg-darkblue">
        <div class="container h-100">
            <div class="d-flex justify-content-between align-items-center h-100">
                <a href="/" class="text-white font-bold col-2">
                    <img src="/images/logo.png" alt="" class="fit-cover">
                </a>
                <nav class="item-center d-flex gap-5">
                    <a href="/information" class="text-white font-bold">information</a> 
                    <span class="text-white font-bold border"></span> 
                    <a href="/statistics" class="text-white font-bold">statistics</a> 
                    <span class="text-white font-bold border"></span> 
                    <a href="/reservation" class="text-white font-bold">reservation</a> 
                    <span class="text-white font-bold border"></span> 
                    <a href="/goods" class="text-white font-bold">goods</a>
                </nav>
                <div class="<?= user() ? "d-none" : "d-flex" ?> gap-5" id="login-in">
                    <a href="#" class="text-white font-bold" data-bs-toggle="modal" data-bs-target="#sign-in">로그인</a>
                    <a href="#" class="text-white font-bold" data-bs-toggle="modal" data-bs-target="#sign-up">회원가입</a>
                </div>
                <div class="<?= user() ? "d-flex" : "d-none" ?> gap-5" id="login-out">
                    <a href="/logout" class="text-white font-bold">로그아웃</a>
                    <a href="/mypage" class="text-white font-bold">마이페이지</a>
                </div>
            </div>
        </div>
    </header>
    <div class="modal fade" id="sign-in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-4 pt-4 pb-3">
                    <div class="title text-center">SIGN IN</div>
                    <div class="mt-4">
                        <div class="form-group mb-3">
                            <label class="mb-1" for="sign_id">아이디</label>
                            <input type="text" id="sign_id" class="form-control" name="user_id" placeholder="아이디을(를) 입력하세요" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="sign_pw">비밀번호</label>
                            <input type="password" id="sign_pw" class="form-control" name="password" placeholder="비밀번호을(를) 입력하세요" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="userType">회원구분</label>
                            <select name="userType" id="userType" class="form-select">
                                <option value="3">일반회원</option>    
                                <option value="2">담당자</option>
                                <option value="1">관리자</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button id="login" class="bg-blue text-white w-100 py-3">로그인</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="sign-list">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-4 pt-4 pb-3">
                    <div class="title text-center">SIGN LIST</div>
                    <div class="mt-4">
                        <div class="table-head d-flex align-items-center">
                            <div class="col-4 text-center">순번</div>
                            <div class="col-8 text-center">시간</div>
                        </div>
                    </div>
                    <div class="signList">
                        <div class="w-100 border-bottom py-3 d-flex">
                            <div class="col-4 text-center">1</div>
                            <div class="col-8 text-center">2024-01-01 03:12:32</div>
                        </div>
                        <div class="w-100 border-bottom py-3 d-flex">
                            <div class="col-4 text-center">1</div>
                            <div class="col-8 text-center">2024-01-01 03:12:32</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="modal fade" id="sign-up" action="/sign-up" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-4 pt-4 pb-3">
                    <div class="title text-center">SIGN UP</div>
                    <div class="mt-4">
                        <div class="form-group mb-3">
                            <label class="mb-1" for="join_id">ID</label>
                            <input type="text" id="join_id" class="form-control" name="user_id" placeholder="아이디을(를) 입력하세요" required>
                            <button type="button" class="checkId w-100 py-2 text-white bg-blue mt-3">ID중복확인</button>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="join_pw">PW</label>
                            <input type="password" id="join_pw" class="form-control" name="password" placeholder="비밀번호을(를) 입력하세요" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="join_name">이름</label>
                            <input type="text" id="join_name" class="form-control" name="user_name" placeholder="이름을(를) 입력하세요" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="hidden" id="cap_in" name="cap_in">
                            <label class="mb-1" for="cap_out">자동입력방지 문자</label>
                            <canvas class="w-100 border" id="cap_canvas" width="450" height="100"></canvas>
                            <input type="text" id="cap_out" class="form-control" name="cap_out" placeholder="상단의 문자열을 입력하세요" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="signUp-btn bg-blue text-white w-100 py-3">가입하기</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php if($viewName == "index") : ?>
    <div class="slide-wrap position-relative">
        <img src="./images/25.jpg" alt="">
        <div id="slide" class="bg-darkblue container">
            <div class="slide-img d-flex bg-darkblue">
                <img src="./images/slide.png" alt="" class="fit-cover">
                <div class="text item-center text-center fx-5 text-white col-6">
                    <div>No limits amazing</div>
                    <div>skills baseball park!</div>
                </div>
            </div>
            <div class="slide-img d-flex bg-darkblue">
                <div class="text item-center text-center fx-5 text-white col-6">
                    <div>스킬스 베이스볼 파크에</div>
                    <div>오신것을 환영합니다.</div>
                </div>
            </div>
            <div class="slide-img d-flex bg-darkblue">
                <div class="text item-center text-center fx-5 text-white col-6">
                    <div>New Champion, New Challenge,</div>
                    <div>Skills Baseball Park</div>
                </div>
            </div>
            <div class="slide-img d-flex bg-darkblue">
                <div class="text item-center text-center fx-5 text-white col-6">
                    <div>스킬스베이스볼 파크를 응원해주시는</div>
                    <div>모든 분께 감사드립니다.</div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>