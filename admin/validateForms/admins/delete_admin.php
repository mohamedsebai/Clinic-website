<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    if(isset($_GET['admin_id'])){

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }


        $admin_id = $_GET['admin_id'];
        $adminData = $user->get(filter: "id = $admin_id");


        if($adminData[0]['id'] != $admin_id){
            $path->redirect("../../admins_list.php?admin_id=$admin_id&page=".$page);
        }else{

            $user->delete(filter: "id = $admin_id");
            $session->set('success', 'One admin has been deleted');
            $path->redirect("../../admins_list.php?admin_id=$admin_id&page=".$page);

        }

        
    }// end 
}else{
    $path->redirect('../../index.php');

}