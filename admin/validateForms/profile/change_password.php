<?php 


include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['change_password'])){

        
        $profile_id = $session->get('role_admin_admin_id');

        $old_password          =  $_POST['old_password'];
        $new_password          =  $format->validateInput($_POST['new_password']);
        $repeat_new_password   =  $format->validateInput($_POST['repeat_new_password']);
        $database_old_password =  $user->get(filter: "id = '$profile_id'")[0]['password'];

        


        $formErrors = array();

        if(empty($old_password)){
            $formErrors['passwordError'] = 'old password can not be empty';
        }

        if(empty($new_password) || strlen($new_password) < 6 || strlen($new_password) > 12):
            $formErrors['passwordError'] = 'password only can contain 6 to 12 char';
        endif;

        if($new_password !== $repeat_new_password):
            $formErrors['passwordError'] =  'new password dose not matched';
        endif;

        if(empty($new_password) || empty($repeat_new_password)):
            $formErrors['passwordError'] =  'your password can not empty';
        endif;

        if(!empty($old_password) && !password_verify($old_password, $database_old_password)){
            $formErrors['passwordError'] = 'old password is wrong';
        }

        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../../change_password.php");
        }

        if(empty($formErrors) && password_verify($old_password, $database_old_password) ){
            if( $user->update([
                'password' => password_hash($new_password, PASSWORD_DEFAULT),
            ],filter: "id = $profile_id" ) ){
                $session->set('success', 'Password has been updated');
                $path->redirect("../../change_password.php");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../change_password.php");
            }
        }
        

    }// end 
}else{
    $path->redirect('../../index.php');
}