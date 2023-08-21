<?php 

include '../inc_classes.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    if(isset($_GET['booking_id']) && isset($_GET['status'])){

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }

        $status = intval($_GET['status']);
        $booking_id = $_GET['booking_id'];

      //  echo $status . '<br>' . $booking_id;


        $bookingData = $booking->get(filter: "id = $booking_id");


        if($bookingData[0]['id'] != $booking_id){
            $path->redirect("../../bookings_list.php?page=".$page);
        }else{

            $booking->update(['status' => $status],filter: "id = $booking_id");
            $session->set('success', 'One booking has been changed');
            $path->redirect("../../bookings_list.php?&page=".$page);

        }

        
    }// end 
}else{
    $path->redirect('../../index.php');

}