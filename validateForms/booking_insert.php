<?php 

include '../incs/inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['booking'])){
        
        $doctor_id = intval($_POST['doctor_id']);
        $name = $format->validateInput($_POST['name']);
        $email = $_POST['email'];
        $phone = intval($_POST['phone']);

        $formErrors = array();

        if(empty($name)){
            $formErrors['nameError'] = 'Name can not be empty';
        }

        if(empty($phone)){
            $formErrors['phoneError'] = 'Phone can not be empty';
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false || empty($email) ){
            $formErrors['emailError'] = 'Email can not be empty';
        }
        
        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../doctors/doctor.php?doctor_id=$doctor_id");
        }

        if(empty($formErrors)){
            if( $booking->insert([
                'name' =>  $name,
                'email' => $email,
                'phone' => $phone,
                'doctor_id' => $doctor_id
            ]) ){
                $session->set('success', 'Your reservation has been done');
                $path->redirect("../doctors/doctor.php?doctor_id=$doctor_id");
            }else{
                $session->set('database_error', 'Wrong try to make your reservation try agian later');
                $path->redirect("../doctors/doctor.php?doctor_id=$doctor_id");
            }
        }
        
        
        
              


    }// end 
}else{
    $path->redirect('../index.php');
}