<?php   
    use App\DB;

    function dd(...$args) {
        foreach($args as $arg) {
            echo "<pre>";
            var_dump($arg);
            echo "</pre>";
        }

        exit;
    }

    function user() {
        return $_SESSION['user']?? false;
        
    }

    function manager() {
        $user = user();
        return $user && $user->type == "manager" ? $user : false;
    }
    
    function admin() {
        $user = user();
        return $user && $user->type == "admin" ? $user : false;
    }

    function go($msg, $url) {
        echo "<script>";
        echo "alert('$msg');";
        echo "location.href = '$url';";
        echo "</script>";
        exit;
    }
    
    function back($msg) {
        echo "<script>";
        echo "alert('$msg');";
        echo "history.back();";
        echo "</script>";
        exit;
    }

    function view($viewName, $data = []) {
        extract($data);

        require VIEW . "/header.php";
        require VIEW . "/$viewName.php";
        require VIEW . "/footer.php";
        exit;
    }

    function json_respons($data) {
        header("Content-Type: application/json", 200);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    function checkEmpty() {
        foreach($_POST as $input) {
            if(trim($input) == "") {
                back("모든 정보를 입력해 주세요");
            }
        }
    }

    function extname($fileName) {
        return strtolower(substr($fileName, strrpos($fileName, ".")));
    }

    function isImage($fileName) {
        return array_search($fileName, [".jpg", ".png", ".gif"]) !== false;
    }