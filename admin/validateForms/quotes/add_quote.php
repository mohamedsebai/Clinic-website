<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['add_quote'])){


        $title   = $format->validateInput($_POST['title']);
        $content = $format->validateInput($_POST['content']);

        $formErrors = array();

        if(empty($title)){
            $formErrors['titleError'] = 'quote name can not be empty';
        }
        if(strlen($title) > 38){
            $formErrors['titleError'] = 'quote name can not be more than 38 char';
        }


        if(empty($content)){
            $formErrors['contentError'] = 'content name can not be empty';
        }
        if(strlen($content) > 142){
            $formErrors['contentError'] = 'content name can not be more than 142 char';
        }


        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../../add_quote.php");
        }

        if(empty($formErrors)){
            if( $quote->insert([
                'title' =>  $title,
                'content' =>  $content
            ]) ){
                $session->set('success', 'One quote has been added');
                $path->redirect("../../add_quote.php");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../add_quote.php");
            }
        }
        
        
        
              


    }// end 
}else{
    $path->redirect('../../index.php');
}