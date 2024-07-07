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
<body>
    <!-- index -->
    <div class="bg-light">
        <header class="bg-darkblue">
            <div class="container px-0 h-100">
                <div class="d-flex align-items-center justify-content-between h-100">
                    <a href="/" class="logo col-2">
                        <img src="/images/logo.png" alt="LogoImage1" class="fit-cover">
                    </a>
                    <nav class="item-center d-flex justify-content-between gap-5">
                        <a href="/information" class="text-white font-bold">소개</a>
                        <a href="/festivalList" class="text-white font-bold">축제 프로그램</a>
                        <a href="/reservation" class="text-white font-bold">인사이트</a>
                        <a href="/goods" class="text-white font-bold">위크스페이스</a>
                        <a href="/mypage" class="text-white font-bold">마이페이지</a>
                    </nav>
                    <div class="d-flex gap-5">
                        <?php if(!user()) : ?>
                            <a href="/login" class="text-white font-bold">로그인</a>
                            <a href="/signup" class="text-white font-bold">회원가입</a>
                        <?php endif; ?>
                        <?php if(user()) : ?>
                            <a href="/logout" class="text-white font-bold">로그아웃</a>
                            <a href="/message" class="text-white font-bold">알림</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
        <div style="margin-top: 80px;"></div>