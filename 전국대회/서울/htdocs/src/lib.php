<?php
    use App\DB;

    if(!DB::fetch("SELECT * FROM festivals")) {
        $filePath = ROOT . "/public/common/js/festivals.json";
        $data = file_get_contents($filePath);
        $companys = ["안동 (Andong)", "구미 (Gumi)", "경주 (Gyeongju)", "경산 (Gyeongsan)", "상주 (Sangju)", "김천 (Gimcheon)", "영주 (Yeongju)", "영천 (Yeongcheon)", "문경 (Mungyeong)", "경북 (Gyeongbuk)", "울진 (Uljin)", "포항 (Pohang)"];
        foreach(json_decode($data)->data as $key => $value) {
            
            $sql = "INSERT INTO festivals (
                `idx`,
                `img`,
                `name`,
                `description`,
                `address`,
                `startDate`,
                `endDate`,
                `company`,
                `city`,
                `phone`,
                `ticketPrice`
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            extract(get_object_vars($value));

            if(!DB::execute($sql, [
                $idx,
                $img,
                $name,
                $description,
                $address,
                date("Y-m-d h:i:s", strtotime("$startDate $startTime")),
                date("Y-m-d h:i:s", strtotime("$endDate $endTime")),
                $companys[$companyIdx - 1],
                $city,
                $phone,
                $ticketPrice
            ]))
                back("에러!");
        }
    }

    function user() {
        return isset($_SESSION['user']) ? $_SESSION['user'] : false;
    }

    function admin() {
        return user() && user()->type == "운영자" ? user() : false;
    }

    function company() {
        return user() && user()->type == "기업" ? user() : false;
    }

    function view($name, $data = []) {
        extract($data);

        $fileName = VIEW . "/$name.php";
        if(!is_file($fileName)) exit;

        require VIEW . "/layer/header.php";
        require $fileName;
        require VIEW . "/layer/footer.php";

        exit;
    }

    function back($msg) {
        echo "<script>";
        echo "alert('{$msg}');";
        echo "history.back();";
        echo "</script>";
        exit;
    }
    
    function go($msg, $url = "/") {
        echo "<script>";
        echo "alert('{$msg}');";
        echo "location.href = '{$url}';";
        echo "</script>";
        exit;
    }

    function json($data) {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    function image_upload($file, $path = "") {
        $fileName = time() . $file['name'];
        $filePath = $path . "/$fileName";
        if(!move_uploaded_file($file['tmp_name'], UPLOADS . "/$filePath")) {
            back("에러가 발생했습니다.");
            exit;
        }
        return $filePath;
    }
