<?php

class Session {


  public function __construct(){
     SELF::init();
  }

   public static function init(){
    session_start();
    session_regenerate_id();
  }

  public static function get($key){
    return $_SESSION[$key];
  }

  public static function set($key, $value){
    return $_SESSION[$key] = $value;
  }

  public static function check($key){
   if(isset($_SESSION[$key]) && !empty($_SESSION[$key])){
     return true;
   }else{
     return false;
   }
  }


  public function unset($key){
    unset($_SESSION[$key]);
  }


  // public function SessionArray(){
  //   $_SESSION[$array_name] = $valu
  // }



}
