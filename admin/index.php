<?php require_once('templates/header.php'); ?>
<body>
<?php require_once('templates/navbar.php'); ?>

<?php
if(!$session->check('role_admin')){
    $path->redirect('login.php');
}
?>

<!-- Start Main Body -->
<div class="main-body">
 <div class="container">
  <div class="row">
   <div class="col-md-6 col-lg-3">
    <div class="stat user">
     <div class="d-inline-block text-center">
       <h5>Admin</h5>
       <i class="fa fa-users"></i>
       <a href="admins_list.php?page=1" class="btn btn-danger">Go list</a>
     </div>
     <div class="float-right d-inline-block text-center">
       <h5>Count</h5>
       <span><?php echo $user->count(filter: "role = 'admin'");?></span>
     </div>
    </div>
   </div>
   <div class="col-md-6 col-lg-3">
    <div class="stat user">
     <div class="d-inline-block text-center">
       <h5>Users</h5>
       <i class="fa fa-users"></i>
       <a href="users_list.php?page=1" class="btn btn-danger">Go list</a>
     </div>
     <div class="float-right d-inline-block text-center">
       <h5>Count</h5>
       <span><?php echo $user->count(filter: "role = 'user'");?></span>
     </div>
    </div>
   </div>
   <div class="col-md-6 col-lg-3">
     <div class="stat post">
       <div class="d-inline-block text-center">
         <h5>Doctors</h5>
         <i class="fa fa-paste"></i>
         <a href="doctors_list.php?page=1" class="btn btn-danger">Go list</a>
       </div>
       <div class="float-right d-inline-block text-center">
         <h5>Count</h5>
         <span><?php echo $doctor->count(filter: true); ?></span>
       </div>
     </div>
   </div>
    <div class="col-md-6 col-lg-3">
      <div class="stat category">
        <div class="d-inline-block text-center">
          <h5>majors</h5>
          <i class="fa fa-tags"></i>
          <a href="majors_list.php?page=1" class="btn btn-primary">Go list</a>
        </div>
        <div class="float-right d-inline-block text-center">
          <h5>Count</h5>
          <span><?php echo $major->count(filter: true);?></span>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="stat category">
        <div class="d-inline-block text-center">
          <h5>Bookings</h5>
          <i class="fa fa-tags"></i>
          <a href="bookings_list.php?page=1" class="btn btn-primary">Go list</a>
        </div>
        <div class="float-right d-inline-block text-center">
          <h5>Count</h5>
          <span><?php echo $booking->count(filter: true);?></span>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="stat category">
        <div class="d-inline-block text-center">
          <h5>Messages</h5>
          <i class="fa fa-tags"></i>
          <a href="messages_list.php?page=1" class="btn btn-primary">Go list</a>
        </div>
        <div class="float-right d-inline-block text-center">
          <h5>Count</h5>
          <span><?php echo $contact->count(filter: true);?></span>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="stat category">
        <div class="d-inline-block text-center">
          <h5>cities</h5>
          <i class="fa fa-tags"></i>
          <a href="city_list.php?page=1" class="btn btn-primary">Go list</a>
        </div>
        <div class="float-right d-inline-block text-center">
          <h5>Count</h5>
          <span><?php echo $city->count(filter: true);?></span>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="stat category">
        <div class="d-inline-block text-center">
          <h5>Quotes</h5>
          <i class="fa fa-tags"></i>
          <a href="quotes_list.php?page=1" class="btn btn-primary">Go list</a>
        </div>
        <div class="float-right d-inline-block text-center">
          <h5>Count</h5>
          <span><?php echo $quote->count(filter: true);?></span>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="stat category">
        <div class="d-inline-block text-center">
          <h5>Rates</h5>
          <i class="fa fa-tags"></i>
          <a href="ratings_list.php?page=1" class="btn btn-primary">Go list</a>
        </div>
        <div class="float-right d-inline-block text-center">
          <h5>Count</h5>
          <span><?php echo $rate->count(filter: true);?></span>
        </div>
      </div>
    </div>


  </div>

 <div class="latest-items">
  <div class="row">

    <div class="col-md-12">
      <div class="latest latest-users">
        <h4>Latest Bookings</h4>

        <a href="bookings_list.php?page=1" class="btn btn-primary mb-3">Bookings List</a>

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
        </tr>
       </thead>
        <tbody class="text-center">
        <?php
          $bookings = $booking->getPaginateJoin(filter: true ,start_from: 0, results_per_page: 10);

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

    <a href="change_password.php" class="btn btn-warning mb-3 ml-3">Change Your Password</a>
    <a href="udpate_profile.php" class="btn btn-warning mb-3 ml-3">Udpate Profile</a>

  </div>
 </div>

</div>
</div>
<!-- End Main Body -->
<?php require_once('templates/footer.php'); ?>

