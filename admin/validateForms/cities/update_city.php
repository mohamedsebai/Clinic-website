<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['update_city'])){


        $city_name = $format->validateInput($_POST['city_name']);
        $city_id = $_POST['city_id'];

        $formErrors = array();

        if(empty($city_name)){
            $formErrors['city_nameError'] = 'city name can not be empty';
        }
        if(strlen($city_name) > 50){
            $formErrors['city_nameError'] = 'city name can not be more than 50 char';
        }


        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../../update_city.php?city_id=$city_id");
        }

        if(empty($formErrors)){
            if( $city->update([
                'city_name' =>  $city_name,
            ], filter: "id = $city_id") ){
                $session->set('success', 'One city has been updated');
                $path->redirect("../../update_city.php?city_id=$city_id");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../update_city.php?city_id=$city_id");
            }
        }
        
        
        
              


    }// end 
}else{
    $path->redirect('../../index.php');
}