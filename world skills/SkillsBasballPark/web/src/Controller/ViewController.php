<?php
    namespace Controller;

    use App\DB;

    class ViewController {
        function main() {
            view("main");
        }

        function lastlogin() {
            require VIEW . "/last-login.php";
        }

        function reservation() {
            view("reservation");
        }
    }