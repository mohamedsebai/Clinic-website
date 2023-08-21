<?php 




include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['update_doctor'])){


        $name = $format->validateInput($_POST['name']);
        $summary = $format->validateInput($_POST['summary']);

        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $major_id =  $_POST['major_id'];
        $city_id =  $_POST['city_id'];
        $doctor_id  = $_POST['doctor_id'];

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

        if(empty($summary) || strlen($summary) > 255){
            $formErrors['summaryError'] = 'summary can not be empty or more than 255 char';
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false || empty($email) ){
            $formErrors['emailError'] = 'Email can not be empty';
        }

        $count = $doctor->getRowCount(filter: "email = '$email'");
        if( $count == 1 ){
            $doctors = $doctor->get(filter: "id = $doctor_id");
            if($doctors[0]['email'] !== $email){
                $formErrors['emailError'] = 'Email is eleardy exits';
            }
        }


        $doctors_image   = $_FILES['image'];
        $img_name        = $doctors_image['name'];
        $img_tmp_name    = $doctors_image['tmp_name'];
        $img_type        = $doctors_image['type'];
        $img_error       = $doctors_image['error'];
        $img_size        = $doctors_image['size'];

        
        // file extension
        $allowed_extension = ['png', 'jpg', 'jpeg'];

        $file_extension = $file->file_extension($img_name);

        // file mime type
        $allowed_mime_type = ['image/png', 'image/jpg', 'image/jpeg'];


        if( !$file->check_there_is_file($img_error) ){
            $new_img_name = $doctor->get(filter: "id = $doctor_id")[0]['doctor_img'];
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
                $file->uploade_file("../../assets/images/doctors/", $img_tmp_name, $new_img_name);
            }

        }

        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../../update_doctor.php?doctor_id=$doctor_id");
        }

        if(empty($formErrors)){
            if( $doctor->update([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'summary' => $summary,
                'major_id' => $major_id,
                'city_id' => $city_id,
                'doctor_img' => $new_img_name
            ], filter: "id = $doctor_id") ){
                $session->set('success', 'One doctors has been updated');
                $path->redirect("../../update_doctor.php?doctor_id=$doctor_id");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../update_doctor.php?doctor_id=$doctor_id");
            }
        }
        
        
        
              


    }// end 
}else{
    $path->redirect('../../index.php');
}