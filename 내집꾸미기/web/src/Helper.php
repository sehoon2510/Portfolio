<?php

    function user(){
        return isset($_SESSION['user']) ? $_SESSION['user'] : false;
    }

    function go($message, $url){
        echo "<script>";
        echo "alert('$message');";
        echo "location.href='$url';";
        echo "</script>";
        exit;
    }

    function back($message){
        echo "<script>";
        echo "alert('$message');";
        echo "history.back();";
        echo "</script>";
        exit;
    }

    function Image_uploads($file, $text = "") {
        $filePath = $text . time() . $file['name'];

        if(!move_uploaded_file($file['tmp_name'], UPLOADS . "/$filePath")) {
            exit;
        }

        return $filePath;
    }

    function view($name, $data = []) {
        extract($data); // 컨트롤러에서 파일로 데이터 보내기
        
        $filePath = VIEW . "/$name.php"; // 가져올 html파일
        if(is_file($filePath)) {
            require VIEW . "/layouts/head.php";
            require $filePath;
            require VIEW . "/layouts/footer.php";
        }
    }