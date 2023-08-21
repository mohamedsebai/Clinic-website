<?php

session_start();

if(isset($_SESSION['role_doctor'])){
    unset($_SESSION['role_doctor']);
    unset($_SESSION['role_doctor_email']);
    unset($_SESSION['role_doctor_name']);
    unset($_SESSION['role_doctor_phone']);
    unset($_SESSION['role_doctor_doctor_id']);
    header("Location: login.php");
    exit();
}

header("Location: index.php");
exit();

