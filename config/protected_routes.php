<?php

session_start();

$username = $_SESSION["user"] ?? "@email.com";
$isLogin = $_SESSION["isLogin"] ?? false;


if (!$isLogin && $username ==  "@email.com") {
    header("Location:./index.php");
}
