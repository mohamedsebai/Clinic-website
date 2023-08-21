<?php

session_start();

if(isset($_SESSION['role_admin'])){
    unset($_SESSION['role_admin']);
    unset($_SESSION['role_admin_email']);
    unset($_SESSION['role_admin_username']);
    unset($_SESSION['role_admin_phone']);
    unset($_SESSION['role_admin_admin_id']);
    header("Location: login.php");
    exit();
}

header("Location: index.php");
exit();