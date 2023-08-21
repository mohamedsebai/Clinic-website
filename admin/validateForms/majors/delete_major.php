<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    if(isset($_GET['major_id'])){

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }


        $major_id = $_GET['major_id'];
        $majorData = $major->get(filter: "id = $major_id");


        if($majorData[0]['id'] != $major_id){
            $path->redirect("../../majors_list.php?major_id=$major_id&page=".$page);
        }else{

            $major->delete(filter: "id = $major_id");
            $session->set('success', 'One Major has been deleted');
            $path->redirect("../../majors_list.php?major_id=$major_id&page=".$page);

        }

        
    }// end 
}else{
    $path->redirect('../../index.php');

}