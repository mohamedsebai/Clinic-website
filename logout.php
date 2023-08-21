<?php
session_start();

if(isset($_SESSION['role_user'])){
    unset($_SESSION['role_user']);
    unset($_SESSION['role_user_email']);
    unset($_SESSION['role_user_username']);
    unset($_SESSION['role_user_phone']);
    unset($_SESSION['role_user_user_id']);
    header("Location: login.php");
    exit();
}

header("Location: index.php");
exit();

