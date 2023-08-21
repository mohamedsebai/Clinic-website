<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    if(isset($_GET['booking_id'])){

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }




        $booking_id = $_GET['booking_id'];
        $bookingData = $booking->get(filter: "id = $booking_id");

        if($bookingData[0]['id'] != $booking_id){
            $path->redirect("../../bookings_list.php?booking_id=$booking_id&page=".$page);
        }else{

            $booking->delete(filter: "id = $booking_id");
            $session->set('success', 'One booking has been deleted');
            $path->redirect("../../bookings_list.php?booking_id=$booking_id&page=".$page);
        }

            


        
    }// end 
}else{
    $path->redirect('../../index.php');

}