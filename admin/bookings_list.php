<?php include_once('templates/header.php'); ?>
<body>
<?php include_once('templates/navbar.php'); ?>

<?php
if(!$session->check('role_admin')){
    $path->redirect('login.php');
}
?>

<?php


if ( isset ($_GET['page']) && empty($_GET['page']) ) {
    $page = 1;
}
if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $page = $_GET['page'];  
}
if (!isset($_GET['page'])) {
    $page = 1;
}
if(isset($_GET['page']) && !is_numeric($_GET['page'])){
    $page = 1;
}



$results_per_page = 3;
$start_from = ( $page - 1 ) * $results_per_page;

if(isset($_GET['doctor_id'])){
    $doctor_id = $_GET['doctor_id'];
    $number_of_result = $booking->count("doctor_id = $doctor_id");
}else{
  $number_of_result = $booking->count(filter: true);
}
$number_of_page = ceil($number_of_result / $results_per_page);

// if($page > $number_of_page){
//     $page = 1;
// }
?>
<!-- Start Main Body -->
<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="responsive-table m-auto">
      <h2 class="text-center">bookings List</h2>

        <div class="dropdown mb-5">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Doctors
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php
                $doctors = $doctor->getJoin();
                    if(!empty($doctors)){
                    foreach($doctors as $doctor){
                        ?>
                    <a class="dropdown-item" href="bookings_list.php?doctor_id=<?php echo $doctor['id']; ?>&page=1">
                    <?php echo $doctor['name']; ?> ( <?php echo $doctor['title']; ?> )
                    </a>
                    <?php 
                    }
                }else{ ?>
                <li>Nothing</li>
            <?php } ?>
        </div>
      </div>


      <a class="btn btn-danger mb-5" href="add_booking.php">Add new booking</a>

        <?php if($session->check('success')): ?>
                <div class="alert alert-success"><?php echo $session->get('success'); $session->unset('success') ?></div>
        <?php endif; ?>

        <?php if($session->check('database_error')): ?>
            <div class="alert alert-danger"><?php echo $session->get('database_error'); $session->unset('database_error') ?></div>
        <?php endif; ?>

        <?php if( $session->check('errors')  ): ?>
            <?php foreach($session->get('errors') as $sessionData): ?>
            <div class="alert alert-danger"><?php echo $sessionData; unset($_SESSION['errors']) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>


      <table class="table-bordered">
       <thead class="text-center">
         <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Email</th>
          <td>doctor</td>
          <td>major</td>
          <th>created at</th>
          <th>Status</th>
          <th>option</th>
        </tr>
       </thead>
        <tbody class="text-center">
        <?php
        if(isset($_GET['doctor_id']) && is_numeric($_GET['doctor_id']) && !empty($_GET['doctor_id'])){
          $doctor_id = $_GET['doctor_id'];
          $bookings = $booking->getPaginateJoin(filter: "doctor_id = $doctor_id",start_from: $start_from, results_per_page: $results_per_page);
        }else{
          $bookings = $booking->getPaginateJoin(filter: true ,start_from: $start_from, results_per_page: $results_per_page);
        }
        if(!empty($bookings)){
            foreach($bookings as $booking){
            ?>
            <tr>
                <td><?php echo $booking['id']; ?></td>
                <td><?php echo $booking['name']; ?></td>
                <td><?php echo $booking['phone']; ?></td>
                <td><?php echo $booking['email']; ?></td>
                <td><?php echo $booking['doctor_name']; ?></td>
                <td><?php echo $booking['major_title']; ?></td>
                <td><?php echo $date->date_differance($booking['created_at']); ?></td>

                <td>
                    <?php if($booking['status'] == 0): ?>
                    <a href="validateForms/bookings/change_status.php?booking_id=<?php echo $booking['id']; ?>&status=<?php echo 1; ?>&page=<?php echo $page; ?>" class="btn btn-danger custom-btn">Not complated</a>
                    <?php elseif($booking['status'] == 1): ?>
                        <a href="validateForms/bookings/change_status.php?booking_id=<?php echo $booking['id']; ?>&status=<?php echo 0; ?>&page=<?php echo $page; ?>" class="btn btn-success custom-btn">complated</a>
                    <?php endif; ?>
                </td>

                <td>
                <a href="update_booking.php?booking_id=<?php echo $booking['id']; ?>" class="btn btn-success custom-btn"><i class="fa fa-edit"></i>Edit</a>
                <a href="validateForms/bookings/delete_booking.php?booking_id=<?php echo $booking['id']; ?>&page=<?php echo $page; ?>" class="btn btn-danger custom-btn"><i class="fa fa-close"></i>Delete</a>
                </td>
            </tr>
                <?php
                }
            }else{ ?>
            <div class="alert alert-danger">There is no bookings yet</div>
        <?php } ?>

        </tbody>
      </table>

      </div>
    
    </div>
   </div>

    <?php if($number_of_result > 0): ?>
        <nav class="mt-5" aria-label="navigation">
            <ul class="pagination justify-content-center">
            <?php
                for($page = 1; $page <= $number_of_page; $page++) {
                if(isset($_GET['doctor_id']) ){ 
                    ?>

                    <li class="page-item"> <a class="page-link" 
                    <?php if(isset($_GET['page']) && $_GET['page'] == $page): ?>
                        style="background-color: red;"
                    <?php endif; ?>
                    href="bookings_list.php?doctor_id=<?php echo $_GET['doctor_id']; ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a></li>

                <?php }else{ ?>
                    <li class="page-item"> <a class="page-link" 
                    <?php if(isset($_GET['page']) && $_GET['page'] == $page): ?>
                        style="background-color: red;"
                    <?php endif; ?>
                    href="bookings_list.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                <?php } ?>
                    
                <?php }?>
            </ul>
        </nav>
    <?php endif; ?>



 </div>
</div>
<!-- End Main Body -->
<?php require_once('templates/footer.php');
