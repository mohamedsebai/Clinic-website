<!-- include all classes -->
  <?php

  if (strpos($_SERVER['REQUEST_URI'], "doctors") !== false){
    spl_autoload_register(function($class){
      include "../classes/$class.class.php";
    });
  }elseif( strpos($_SERVER['REQUEST_URI'], "doctor_profile") !== false &&  !strpos($_SERVER['REQUEST_URI'], "validateForms") !== false){
    spl_autoload_register(function($class){
      include "../classes/$class.class.php";
    });
  }elseif(strpos($_SERVER['REQUEST_URI'], "doctor_profile") !== false &&  strpos($_SERVER['REQUEST_URI'], "validateForms") !== false){
    spl_autoload_register(function($class){
      include "../../classes/$class.class.php";
    });
  }elseif( !strpos($_SERVER['REQUEST_URI'], "doctor_profile") !== false &&  strpos($_SERVER['REQUEST_URI'], "validateForms") !== false){
    spl_autoload_register(function($class){
      include "../classes/$class.class.php";
    });
  }else{
    spl_autoload_register(function($class){
      include "classes/$class.class.php";
    });
  }
  
  

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
  $auth = new Users();
  $file = new File();
  $quote = new Quotes();
  $rate = new Rates();



?>