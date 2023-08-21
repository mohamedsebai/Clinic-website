<?php 

include '../../incs/inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['login'])){


        $email = $_POST['email'];

        $password = $format->validateInput($_POST['password']);

        $formErrors = array();

        if(empty($password) || strlen($password) < 6 || strlen($password) > 12){
            $formErrors['passwordError'] = 'password only can contain 6 to 12 char';
        }


        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false || empty($email) ){
            $formErrors['emailError'] = 'Email can not be empty';
        }



        
        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../login.php");
        }

        if(empty($form_error)){

            if(isset($_POST['remember_me'])){
                setcookie('email', $email, time() + (60 * 60), "/");
            }else{
                setcookie('email', $email, time() - 1, "/");
            }
          
            if($doctor->login($email,$password)){
                $path->redirect('../index.php');
            }else{
                $session->set('database_error', 'this email dosenot match this password');
                $path->redirect("../login.php");
            }

            
        }
        

    }// end 
}else{
    $path->redirect('../index.php');
}