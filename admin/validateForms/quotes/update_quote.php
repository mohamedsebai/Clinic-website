<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['update_quote'])){


        $title   = $format->validateInput($_POST['title']);
        $content = $format->validateInput($_POST['content']);
        $quote_id = $_POST['quote_id'];

        echo $quote_id;

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
            $path->redirect("../../update_quote.php?quote_id=$quote_id");
        }

        if(empty($formErrors)){
            if( $quote->update([
                'title' =>  $title,
                'content' =>  $content
            ], filter: "id = $quote_id") ){
                $session->set('success', 'One quote has been updateed');
                $path->redirect("../../update_quote.php?quote_id=$quote_id");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../update_quote.php?quote_id=$quote_id");
            }
        }




    }// end 
}else{
    $path->redirect('../../index.php');
}