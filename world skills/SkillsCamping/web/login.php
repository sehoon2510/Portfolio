<?php session_start(); ?>

<!DOCTYPE html>
<html lang="kr">
<?php require_once "./layout/head.php"; ?>
<body>
    <div class="wrap">
        <?php require_once "./layout/header.php"; ?>
        <div class="contents sub col-12 pb-5">
            <?php require_once "./layout/slide.php"; ?>
            <div class="content-title dis-col dis-center mt-5">
                <p class="font-malgun">로그인</p>
            </div>
            <form action="./login_process.php" method="post" enctype="multipart/form-data" class="col-8 offset-2 mt-3 mb-5 pb-5">
                <!-- <input type="hidden" name="path" id="path" value="<?= $_GET['path'] ?>"> -->
                <div class="mb-3">
                    <label for="userid" class="font-malgun form-label">Phone</label>
                    <input type="text" class="font-malgun form-control" placeholder="Phone" id="userid" name="userid" aria-describedby="emailHelp">
                    <div id="emailHelp" class="font-malgun form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="pass" class="font-malgun form-label">Name</label>
                    <input type="text" class="font-malgun form-control" placeholder="Name" id="pass" name="pass">
                </div>
                <!-- <div class="mb-3 form-check">
                    <input type="checkbox" class="font-malgun form-check-input" id="exampleCheck1">
                    <label class="form-check-label font-malgun" for="exampleCheck1">Check me out</label>
                </div> -->
                <button type="submit" class="btn btn-primary font-malgun">로그인</button>
            </form>
        </div>
        <?php require_once "./layout/footer.php" ?>
    </div>
    <script>
        let PhoneHistory = '';

        $('#userid').on('input', e => {
            if(e.target.value.length >= 14){

                e.target.value = PhoneHistory;

            } else {
                // 전화번호에서 숫자만 추출
                const phoneNumberOnlyDigits = e.target.value.replace(/\D/g, '');

                // 숫자를 하이픈으로 구분하여 문자열 생성
                const phoneNumberFormatted = phoneNumberOnlyDigits.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
                
                e.target.value = phoneNumberFormatted;

                PhoneHistory = e.target.value;
            }

        });
    </script>
</body>
</html>