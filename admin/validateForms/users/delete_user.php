<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    if(isset($_GET['user_id'])){

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }


        $user_id = $_GET['user_id'];
        $userData = $user->get(filter: "id = $user_id");


        if($userData[0]['id'] != $user_id){
            $path->redirect("../../users_list.php?user_id=$user_id&page=".$page);
        }else{

            $user->delete(filter: "id = $user_id");
            $session->set('success', 'One user has been deleted');
            $path->redirect("../../users_list.php?user_id=$user_id&page=".$page);

        }

        
    }// end 
}else{
    $path->redirect('../../index.php');

}