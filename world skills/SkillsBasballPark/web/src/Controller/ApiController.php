<?php
    namespace Controller;

    use App\DB;

    class ApiController {
        function findUserId() {
            extract($_GET);

            if ($user_id) return null;

            $user = DB::fetch("SELECT * FROM users WHERE user_id = ?", [$user_id]);
            json_respons($user);
        }
    }