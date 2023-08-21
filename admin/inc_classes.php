
<?php

spl_autoload_register(function($class){
  include "classes/$class.class.php";
});

//$db = new DBConnect();
$session = new Session();
$date = new Date();
$format = new Format();
$path = new Path();
$doctor = new Doctors();
$major = new Majors();
$city  = new City();
$booking  = new Booking();
$contact = new Messages();
$user = new Users(); 
$file  = new File();
$quote = new Quotes();
$rate = new Rates();

?>