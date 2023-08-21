<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    if(isset($_GET['city_id'])){

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }


        $city_id = $_GET['city_id'];
        $cityData = $city->get(filter: "id = $city_id");


        if($cityData[0]['id'] != $city_id){
            $path->redirect("../../city_list.php?city_id=$city_id&page=".$page);
        }else{

            $city->delete(filter: "id = $city_id");
            $session->set('success', 'One city has been deleted');
            $path->redirect("../../city_list.php?city_id=$city_id&page=".$page);

        }

        
    }// end 
}else{
    $path->redirect('../../index.php');

}