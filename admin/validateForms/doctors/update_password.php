<?php 


include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['change_password'])){

        
        $doctor_id = $_POST['doctor_id'];

        $new_password          =  $format->validateInput($_POST['new_password']);
        $repeat_new_password   =  $format->validateInput($_POST['repeat_new_password']);


        $formErrors = array();


        if(empty($new_password) || strlen($new_password) < 6 || strlen($new_password) > 12):
            $formErrors['passwordError'] = 'password only can contain 6 to 12 char';
        endif;

        if($new_password !== $repeat_new_password):
            $formErrors['passwordError'] =  'new password dose not matched';
        endif;

        if(empty($new_password) || empty($repeat_new_password)):
            $formErrors['passwordError'] =  'your password can not empty';
        endif;


        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../../update_doctor_password.php?doctor_id=$doctor_id");
        }

        if(empty($formErrors) ){
            if( $doctor->update([
                'password' => password_hash($new_password, PASSWORD_DEFAULT),
            ],filter: "id = $doctor_id" ) ){
                $session->set('success', 'Password has been updated');
                $path->redirect("../../update_doctor_password.php?doctor_id=$doctor_id");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../update_doctor_password.php?doctor_id=$doctor_id");
            }
        }
        

    }// end 
}else{
    $path->redirect('../../index.php');
}