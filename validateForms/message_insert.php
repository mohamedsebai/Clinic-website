<?php 

include '../incs/inc.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['message'])){

        $name = $format->validateInput($_POST['name']);

        $email = $_POST['email'];

        $subject = $format->validateInput($_POST['subject']);
        $content = $format->validateInput($_POST['content']);

        $phone = intval($_POST['phone']);

        $formErrors = array();

        if(empty($name) || strlen($name) > 50){
            $formErrors['nameError'] = 'Name can not be empty or more than 50 char';
        }

        if(empty($phone) || strlen($phone) > 50){
            $formErrors['phoneError'] = 'Phone can not be empty or more than 50 char';
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false || empty($email) ){
            $formErrors['emailError'] = 'Email can not be empty';
        }

        if(empty($subject) || strlen($subject) > 255){
            $formErrors['subjectError'] = 'Subject can not be empty or more than 255 char';
        }

        if(empty($content) || strlen($content) > 300){
            $formErrors['contentError'] = 'Message Content can not be empty or more than 300 char';
        }

        
        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../contact.php");
        }
        


        if(empty($formErrors)){
            if( $contact->insert([
                'name' =>  $name,
                'email' => $email,
                'phone' => $phone,
                'subject' => $subject,
                'content' => $content,
            ]) ){
                $session->set('success', 'Your message has been sent');
                $path->redirect("../contact.php");
            }else{
                $$session->set('database_error', 'Wrong try to delvier your message try agian later');
                $path->redirect("../contact.php");
            }
        }

    }// end 
}else{
    $path->redirect('../index.php');
}