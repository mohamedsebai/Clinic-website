<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['update_major'])){


        $title = $format->validateInput($_POST['title']);
        $major_id = $_POST['major_id'];

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
            $new_img_name = $major->get(filter: "id = $major_id")[0]['img'];
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
            $path->redirect("../../update_major.php?major_id=$major_id");
        }

        if(empty($formErrors)){
            if( $major->update([
                'title' =>  $title,
                'img' => $new_img_name
            ], filter: "id = $major_id") ){
                $session->set('success', 'One Major has been updated');
                $path->redirect("../../update_major.php?major_id=$major_id");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../update_major.php?major_id=$major_id");
            }
        }
        
    }// end 
}else{
    $path->redirect('../../index.php');

}