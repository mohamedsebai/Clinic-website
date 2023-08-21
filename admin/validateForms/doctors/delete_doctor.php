<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    if(isset($_GET['doctor_id'])){

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }


        $doctor_id = $_GET['doctor_id'];
        $doctorData = $doctor->get(filter: "id = $doctor_id");


        if($doctorData[0]['id'] != $doctor_id){
            $path->redirect("../../doctors_list.php?doctor_id=$doctor_id&page=".$page);
        }else{

            $doctor->delete(filter: "id = $doctor_id");
            $session->set('success', 'One doctor has been deleted');
            $path->redirect("../../doctors_list.php?doctor_id=$doctor_id&page=".$page);

        }

        
    }// end 
}else{
    $path->redirect('../../index.php');

}