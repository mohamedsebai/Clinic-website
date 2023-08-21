<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['add_major'])){


        $title = $format->validateInput($_POST['title']);

        $major_image     = $_FILES['image'];
        $img_name        = $major_image['name'];
        $img_tmp_name    = $major_image['tmp_name'];
        $img_type        = $major_image['type'];
        $img_error       = $major_image['error'];
        $img_size        = $major_image['size'];

        $formErrors = array();

        if(empty($title)){
            $formErrors['titleError'] = 'title can not be empty';
        }
        if(strlen($title) > 255){
            $formErrors['titleError'] = 'title can not be more than 255 char';
        }


        
        // file extension
        $allowed_extension = ['png', 'jpg', 'jpeg'];

        $file_extension = $file->file_extension($img_name);

        // file mime type
        $allowed_mime_type = ['image/png', 'image/jpg', 'image/jpeg'];


        if(!$file->check_there_is_file($img_error) ){
            $formErrors['imageError'] = 'choose an image for your profile';
        }

        if($file->check_there_is_file($img_error)){


            if(!$file->check_size($img_error, $file_extension, $allowed_extension, $img_tmp_name, $allowed_mime_type, $img_size, 2342834238947236487)){
                $formErrors['imageError']  = 'profile image it\'s large';
            }

            if(!$file->check_content_file($img_error, $file_extension, $allowed_extension, $img_tmp_name, $allowed_mime_type)){
                $formErrors['imageError'] = 'content of file is not image';
            }

            if(!$file->is_valid_file($img_error, $file_extension, $allowed_extension )){
                $formErrors['imageError'] = 'not valid file please chosse image';
            }

            if($file->righte_file_logic($img_error, $file_extension, $allowed_extension, $img_tmp_name, $allowed_mime_type)){
                $new_img_name = $file->new_img_name($file_extension);
                $file->uploade_file("../../assets/images/majors/", $img_tmp_name, $new_img_name);
            }

        }

        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../../add_major.php");
        }

        if(empty($formErrors)){
            if( $major->insert([
                'title' =>  $title,
                'img' => $new_img_name
            ]) ){
                $session->set('success', 'One Major has been added');
                $path->redirect("../../add_major.php");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../add_major.php");
            }
        }
        
        
        
              


    }// end 
}else{
    $path->redirect('../../index.php');
}