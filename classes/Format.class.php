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





}
