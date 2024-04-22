<?php
    function go($msg, $url) {
        echo "<script>";
        echo "alert('{$msg}');";
        echo "location.href = '$url';";
        echo "</script>";
        exit;
    }
    
    function back($msg) {
        echo "<script>";
        echo "alert('{$msg}');";
        echo "history.back();";
        echo "</script>";
        exit;
    }

    function view($viewName, $data = []) {
        extract($data);
        $fileName = VIEW . "/$viewName.php";

        if(is_file($fileName)) {
            require VIEW . "/layout/head.php";
            require $fileName;
            require VIEW . "/layout/footer.php";
        }
    }

    function  dd(...$args) {
        foreach($args as $arg) {
            echo "<pre>";
            var_dump($arg);
            echo "</pre>";
        }
        exit;
    }

    function imageUpload($file) {
        $fileName = time() . $file["name"];
        if(move_uploaded_file($file["tmp_name"], "images/goods/" . $fileName)) {
            return "goods/" . $fileName;
        } else {
            return null;
        }
    }

    function json($value, $code = 200) {
        header("Content-Type: application/json", $code);
        echo json_encode($value, JSON_UNESCAPED_UNICODE);
        exit;
    }

    function user() {
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    function manager() {
        $user = user();
        return $user && $user->grant == "2" ? $user : false;
    }
    
    function admin() {
        $user = user();
        return $user && $user->grant == "1" ? $user : false;
    }