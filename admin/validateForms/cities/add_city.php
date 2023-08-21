<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    if(isset($_POST['add_city'])){


        $city_name = $format->validateInput($_POST['city_name']);

        $formErrors = array();

        if(empty($city_name)){
            $formErrors['city_nameError'] = 'city name can not be empty';
        }
        if(strlen($city_name) > 50){
            $formErrors['city_nameError'] = 'city name can not be more than 50 char';
        }


        if(!empty($formErrors)){
            $session->set('errors', $formErrors);
            $path->redirect("../../add_city.php");
        }

        if(empty($formErrors)){
            if( $city->insert([
                'city_name' =>  $city_name,
            ]) ){
                $session->set('success', 'One city has been added');
                $path->redirect("../../add_city.php");
            }else{
                $session->set('database_error', 'try agian later');
                $path->redirect("../../add_city.php");
            }
        }
        
        
        
              


    }// end 
}else{
    $path->redirect('../../index.php');
}