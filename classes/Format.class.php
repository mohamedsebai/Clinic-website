<?php


class Format{


  public function validateInput($data){
    $data = trim(htmlspecialchars(htmlentities($data)));
    return $data;
  }





}
