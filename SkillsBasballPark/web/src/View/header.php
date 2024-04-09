<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/common/bootstrap-5.2.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="/common/fontawesome-free-6.4.0-web/css/all.css">
    <script src="/common/js/jquery-3.7.1.min.js"></script>
    <script src="/common/bootstrap-5.2.0-dist/js/bootstrap.js"></script>

    <?php if(isset($_SESSION['open_last_login'])) : ?>

        <script>
                window.open(
                    "/users/last-login",
                    null,
                    "width=300, hegiht=200"
                );
        </script>

        <?php unset($_SESSION['open_last_login']); ?>
    <?php endif; ?>

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/info">ITEM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/stat">ITEM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/reservation">ITEM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/goods">ITEM</a>
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if(user()) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/users/logout">로그아웃</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">마이페이지</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item <?= user() ? "d-none" : "" ?>">
                            <a class="nav-link" aria-current="page" data-bs-toggle="modal" data-bs-target="#login-modal">로그인</a>
                        </li>
                        <li class="nav-item <?= user() ? "d-none" : "" ?>">
                            <a class="nav-link" aria-current="page" data-bs-toggle="modal" data-bs-target="#join-modal">회원가입</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <form action="/users/login" method="post" class="modal fade" id="login-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                        <h4 class="modal-title">회원가입</h4>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div> -->
                    <div class="modal-body pt-1 px-4 pb-3">
                        <div class="title text-center" style="font-size: 1.4rem;">회원가입</div>
                        <div class="mt-4">
                            <div class="form-group mb-3">
                                <label for="login_id" class="form-label">아이디</label>
                                <input type="text" id="login_id" name="login_id" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="login_password" class="form-label">비밀번호</label>
                                <input type="text" id="login_password" name="login_password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="user_name" class="form-label">이름</label>
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <input type="radio" class="btn-check" name="type" value="3" id="type1" checked>
                                        <label for="type1" class="btn btn-outline-secondary w-100">일반회원</label>
                                    </div>
                                    <div class="col-4 text-center">
                                        <input type="radio" class="btn-check" name="type" value="2" id="type2">
                                        <label for="type2" class="btn btn-outline-secondary w-100">담당자</label>
                                    </div>
                                    <div class="col-4 text-center">
                                        <input type="radio" class="btn-check" name="type" value="1" id="type3">
                                        <label for="type3" class="btn btn-outline-secondary w-100">관리자</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary w-100" style="padding: 0.5rem auto;">로그인</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form action="/users/join" method="post" class="modal fade" id="join-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                        <h4 class="modal-title">회원가입</h4>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div> -->
                    <div class="modal-body pt-1 px-4 pb-3">
                        <div class="title text-center" style="font-size: 1.4rem;">회원가입</div>
                        <div class="mt-4">
                            <div class="form-group mb-3">
                                <label for="user_id" class="form-label">아이디</label>
                                <div class="d-flex">
                                    <input type="text" id="user_id" name="user_id" class="form-control">
                                    <button type="button" id="btn-check" class="btn btn-primary ms-2" style="width: 100%; padding: 0.5rem auto;">ID중복확인</button>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">비밀번호</label>
                                <input type="text" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="user_name" class="form-label">이름</label>
                                <input type="text" id="user_name" name="user_name" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <div>
                                    <canvas id="captcha-canvas" width="450" height="100" class="form-control"></canvas>
                                    <input type="hidden" id="captcha_result" name="captcha_result">
                                </div>
                                <label for="chatcha" class="form-label">캡챠</label>
                                <input type="text" id="captcha" name="captcha" class="form-control">
                            </div>
                        </div>
                        <div class="mt-3">
                            <button id="btn-check" class="btn btn-primary ms-2" style="width: 100%; padding: 0.5rem auto;">회원가입</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </header>

    <script>
        window.onload = () => {

            const captcha = [1, 2, 3, 4, 5].map((v) => (Math.random() * v * 36 / 5 + v * 1).toString(36)[0]).sort((a, b) => ((Math.random() * 10) - 5)).join('');

            const canvas = document.querySelector("canvas");
            const ctx = canvas.getContext("2d");
            const W = canvas.width;
            const H = canvas.height;

            ctx.font = "bold 32px serif";
            let { width: textW, actualBoundingBoxAscent: h1, actualBoundingBoxDescent: h2 } = ctx.measureText(captcha);
            textW += 50;

            ctx.save();

            captcha.split('').forEach((t, i) => {
                const X = (W / 2 - textW / 2) + (textW / 5 * i);
                const Y = H / 2 + 10;
                const [skewX, skewY] = [1, 2].map(() => Math.floor(Math.random() * 6 - 3) / 10);

                ctx.translate(X, Y);
                ctx.transform(1, skewY, skewX, 1, 0, 0);
                ctx.translate(-X, -Y);

                ctx.fillText(t, X, Y);

                ctx.restore();
            })
            
            // ctx.fillText(captcha, (W / 2) - (width / 2), (H / 2) + ((h1 + h2) / 2));
            
            document.querySelector("#captcha_result").value = captcha;

            document.querySelector("#btn-check").addEventListener("click", e => {
                e.preventDefault();
                const user_id = document.querySelector("#user_id")?.value;
                const result = fetch("/users/find-id?user_id=" + user_id).then((res) => res.json());

                if(result) {
                    alert("사용 중인 ID입니다.");
                }
            })

        }

        
    </script>