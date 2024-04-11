<?php
    function dd(...$args) {
        foreach($args as $arg) {
            echo "<pre>";
            var_dump($arg);
            echo "</pre>";
        }
        exit;
    }

    function go($msg, $url) {
        echo "<script>";
        echo "alert('$msg');";
        echo "location.href = '$url';";
        echo "</script>";
    }
    
    function back($msg) {
        echo "<script>";
        echo "alert('$msg');";
        echo "history.back();";
        echo "</script>";
    }

    function user() {
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    function json($value, $code = 200) {
        header("Content-Type: application/json", true, $code);
        echo json_encode($value, JSON_UNESCAPED_UNICODE);
        exit;
    }

    function add_watermark_text($file) {

        $text = "경상남도 특산품"; // 워터마크 텍스트
        $font = ROOT . "/common/font/malgunbd.ttf"; // 폰트 파일도 절대경로로 지정해야함 (url이 아닌 path)
        
        $image_path = $file["tmp_name"];
        $image_name = time() . $file["name"];
        
        
        $array_img_chk = array("jpg");
        $img_ext = pathinfo($image_name)['extension'];
        if (!file_exists($image_path)) {
            return json(["message"=>"오류가 발생했습니다. 다시 시도해 주세요."], 401);
        }
        
        if (in_array($img_ext, $array_img_chk)) {
            if(!move_uploaded_file($image_path, ROOT . "/image/" . $image_name)) {
                return json(["message"=>"오류가 발생했습니다. 다시 시도해 주세요."], 401);
            }
        
            $image_path = ROOT . "/image/" . $image_name;
        
            $create_img = imagecreatefromjpeg($image_path);
        
            if ($create_img) {
        
                imagealphablending($create_img, true);
                $color = imagecolorallocatealpha($create_img, 255, 255, 255, 60);
                $create_img = crop_image($create_img);
        
                imagedestroy($create_img);
                imagedestroy($create_img);
        
                for($i = 0; $i < 10; $i++) {
                    imagettftext($create_img, 30, 0, 10, 45 + ($i * (45 * 3)), $color, $font, $text);
                    imagettftext($create_img, 30, 0, 200, 110 + ($i * 135) + ($i * 3), $color, $font, $text); 
                }
        
                header("Content-type: image/jpeg");
                imagejpeg($create_img, ROOT . "/image/" . $image_name);
        
                imagedestroy($create_img);
        
                return $image_name;
            } else {
                return json(["message"=>"오류가 발생했습니다. 다시 시도해 주세요."], 401);
            }
        } else {
            return json(["message"=>"오류가 발생했습니다. 다시 시도해 주세요."], 401);
        }
    }
        
    function crop_image($image) {
        $original_width = imagesx($image);
        $original_height = imagesy($image);
        $crop_x = ($original_width - 500) / 2;
        $crop_y = ($original_height - 500) / 2;
    
        $cropped_img = imagecrop($image, ['x' => $crop_x, 'y' => $crop_y, 'width' => 500, 'height' => 500]);
        
        return $cropped_img;
    }