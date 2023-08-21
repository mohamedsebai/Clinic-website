<?php 


include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['update_profile'])){


        $name = $format->validateInput($_POST['username']);

        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $profile_id = $session->get('role_admin_admin_id');


        $formErrors = array();
        
        if(empty($name)){
            $formErrors['nameError'] = 'name can not be empty';
        }
        if(strlen($name) > 255){
            $formErrors['nameError'] = 'name can not be more than 255 char';
        }
        
        if(empty($phone) || strlen($phone) > 50){
            $formErrors['phoneError'] = 'Phone can not be empty or more than 50 char';
        }


        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false || empty($email) ){
            $formErrors['emailError'] = 'Email can not be empty';
        }


        $count = $user->getRowCount(filter: "email = '$email' AND role = 'admin'");
        if( $count == 1 ){
            $profileData = $user->get(filter: "id = $profile_id");
            if($profileData[0]['email'] !== $email){
                $formErrors['emailError'] = 'Email is aleardy exists';
            }
        }


        $admins_image   = $_FILES['image'];
        $img_name        = $admins_image['name'];
        $img_tmp_name    = $admins_image['tmp_name'];
        $img_type        = $admins_image['type'];
        $img_error       = $admins_image['error'];
        $img_size        = $admins_image['size'];

        
        // file extension
        $allowed_extension = ['png', 'jpg', 'jpeg'];

        $file_extension = $file->file_extension($img_name);

        // file mime type
        $allowed_mime_type = ['image/png', 'image/jpg', 'image/jpeg'];


        if(!$file->check_there_is_file($img_error) ){
            $new_img_name = $user->get(filter: "id = $profile_id")[0]['profile_img'];
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
                $file->uploade_file("../../assets/images/admins/", $img_tmp_name, $new_img_name);
            }

        }

        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../../udpate_profile.php");
        }

        if(empty($formErrors)){
            if( $user->update([
                'username' => $name,
                'phone' => $phone,
                'email' => $email,
                'profile_img' => $new_img_name
            ],filter: "id = $profile_id" ) ){
                $session->set('success', 'Profile has been updated');
                $path->redirect("../../udpate_profile.php");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../udpate_profile.php");
            }
        }
        

    }// end 
}else{
    $path->redirect('../../index.php');
}