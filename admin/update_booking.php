<?php require_once('templates/header.php'); ?>
<body>
<?php require_once('templates/navbar.php'); ?>
<?php
if(!$session->check('role_admin')){
    $path->redirect('login.php');
}
?>
<?php

 $path->redirectIfThereIsWrongWithGet($_GET['booking_id'],"404.php"); 
  $booking_id = $_GET['booking_id'];
  $booking = $booking->get(filter: "id = '$booking_id'");

  if($booking[0]['id'] != $booking_id){
    $path->redirect("bookings_list.php?page=1");
  }

?>

<!-- Start Main Body -->
  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box">
        <h2 class="text-center">update New booking</h2>

        <a class="btn btn-danger mb-5" href="bookings_list.php?page=1">bookings list</a>

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

        <form action="validateForms/bookings/update_booking.php" method="POST">

          <input type="hidden" name="booking_id" value="<?php echo $booking[0]['id']?>">

          <div class="form-group">
            <label>Name:</label>
            <input class="form-control" type="text" name="name" placeholder="booking username" value="<?php echo $booking[0]['name']; ?>">
          </div>

          <div class="form-group">
            <label>Phone:</label>
            <input class="form-control" type="text" name="phone" placeholder="booking phone" value="<?php echo $booking[0]['phone']; ?>">
          </div>


          <div class="form-group">
            <label>Email:</label>
            <input class="form-control" type="text" name="email" placeholder="booking email" value="<?php echo $booking[0]['email']; ?>">
          </div>


            <div class="form-group">
                <select name="doctor_id" class="form-group">
                <?php
                    $doctors = $doctor->get();
                    if(!empty($doctors)){
                        foreach($doctors as $doctor){
                        ?>
                        <option value="<?php echo $doctor['id']; ?>"
                        <?php echo $doctor['id'] == $booking[0]['doctor_id'] ? 'selected' : ''?>
                        ><?php echo $doctor['name']; ?></option>
                            <?php
                            }
                        }?>
                </select>
            </div>


          <input type="submit" class="btn btn-primary" value="update booking" name="update_booking">
         </form>
       </div>
      </div>
    </div>
  </div>

  
<!-- End Main Body -->
<?php require_once('templates/footer.php');
