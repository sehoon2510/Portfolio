<?php

session_start();

if(isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    echo '<script>location.href = "./";</script>';
} else {
    echo '<script>alert("error"); history.back();</script>';
}