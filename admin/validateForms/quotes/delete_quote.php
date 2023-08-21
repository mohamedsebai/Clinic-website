<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    if(isset($_GET['quote_id'])){

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }


        $quote_id = $_GET['quote_id'];
        $quoteData = $quote->get(filter: "id = $quote_id");


        if($quoteData[0]['id'] != $quote_id){
            $path->redirect("../../quotes_list.php?quote_id=$quote_id");
        }else{

            $quote->delete(filter: "id = $quote_id");
            $session->set('success', 'One quote has been deleted');
            $path->redirect("../../quotes_list.php?quote_id=$quote_id");

        }

    }// end 
}else{
    $path->redirect('../../index.php');
}