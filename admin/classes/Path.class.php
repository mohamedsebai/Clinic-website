<?php

final class Path{

  public function redirect($path){
    header("Location: {$path}");
    exit();
  }

  public function redirectIfThereIsWrongWithGet($get_value,$path){

    if ( isset ($get_value) && empty($get_value) ) {
      return $this->redirect("$path");
    }elseif ( isset ($get_value) && !is_numeric($get_value)) {
      return $this->redirect("$path");
    }

  }

}
