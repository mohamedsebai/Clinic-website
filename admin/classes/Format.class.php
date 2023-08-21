<?php


class Format{

  public $page_title = 'home';

  public function get_title(){
    return  $this->page_title;
  }


  public function validateInput($data){
    $data = trim(htmlspecialchars(htmlentities($data)));
    return $data;
  }

  // public function handlePaginate($method, $value_defautl){
  //     if ( isset ($method) && empty($method) ) {
  //       return $value_defautl;
  //     }
  //     if(isset($method) && is_numeric($method)){
  //       return $method;
  //     }
  //     if (!isset($method)) {
  //       return $value_defautl;
  //     }
  //     if(isset($method) && !is_numeric($method)){
  //       return $value_defautl;
  //     }
  // }
  




  }




