<?php 


class File {

    public function file_extension($img_name){
        $file_extension = explode('.', $img_name);
        $file_extension = strtolower(end($file_extension));
        return $file_extension;
    } 
    
    public function uploade_file($file_path_to_uploade, $img_tmp_name, $new_img_name){
        if(!file_exists($file_path_to_uploade)){ 
            mkdir($file_path_to_uploade);
        }
        return move_uploaded_file( $img_tmp_name,  $file_path_to_uploade . $new_img_name );
    }


    public function righte_file_logic($img_error, $file_extension, $allowed_extension, $img_tmp_name, $allowed_mime_type){
        if($img_error == 0
                            && in_array($file_extension, $allowed_extension)  
                            && in_array(mime_content_type($img_tmp_name), $allowed_mime_type)){
                return true;
        }
    }

    public function new_img_name($file_extension){
        $new_img_name = "IMG-" . rand(0, getrandmax()) . "." . $file_extension;
        return $new_img_name;
    }
    

    public function is_valid_file($img_error, $file_extension, $allowed_extension ){
        if($img_error == 0 && !in_array($file_extension, $allowed_extension)){
            return false;
        }
        return true;
    }

    public function check_content_file($img_error, $file_extension, $allowed_extension, $img_tmp_name, $allowed_mime_type){
        if($img_error == 0 && in_array($file_extension, $allowed_extension) 
            && !in_array(mime_content_type($img_tmp_name), $allowed_mime_type)){
                return false;
        }
        return true;
    }

    public function check_size($img_error, $file_extension, $allowed_extension, $img_tmp_name, $allowed_mime_type, $img_size, $size){
        if( $img_error == 0
                            &&  in_array($file_extension, $allowed_extension)
                            &&  in_array(mime_content_type($img_tmp_name), $allowed_mime_type)
                            &&  $img_size > $size ){
                return false;
        }
        return true;
    }

    public function check_there_is_file($img_error){
        if( $img_error == 4){
            return false;
        }
        return true;
    }


}