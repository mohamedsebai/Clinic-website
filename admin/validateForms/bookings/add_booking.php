<?php 


include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['add_booking'])){


        $name = $format->validateInput($_POST['name']);

        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $doctor_id =  $_POST['doctor_id'];

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



        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../../add_booking.php");
        }

        if(empty($formErrors)){
            if( $booking->insert([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'doctor_id' => $doctor_id,
            ]) ){
                $session->set('success', 'One booking has been added');
                $path->redirect("../../add_booking.php");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../add_booking.php");
            }
        }
        
        
        
              


    }// end 
}else{
    $path->redirect('../../index.php');
}