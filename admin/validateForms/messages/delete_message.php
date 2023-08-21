<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['message_id'])){

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }

        $message_id = $_GET['message_id'];
        $messageData = $contact->get(filter: "id = $message_id");


        if($messageData[0]['id'] != $message_id){
            $path->redirect("../../messages_list.php?message_id=$message_id&page=".$page);
        }else{

            $contact->delete(filter: "id = $message_id");
            $session->set('success', 'One messge has been deleted');
            $path->redirect("../../messages_list.php?message_id=$message_id&page=".$page);

        }

        
    }// end 
}else{
    $path->redirect('../../index.php');

}