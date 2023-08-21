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


$results_per_page = 1;
$start_from = ( $page - 1 ) * $results_per_page;
$number_of_result = $doctor->count(filter: true);
$number_of_page = ceil($number_of_result / $results_per_page);

?>
<!-- Start Main Body -->
<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="responsive-table m-auto">
      <h2 class="text-center">doctors List</h2>

      <a class="btn btn-danger mb-5" href="add_doctor.php">Create New Doctor</a>

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
          <th>Image</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Summary</th>
          <th>City Name</th>
          <th>Major Name</th>
          <th>created at</th>
          <th>option</th>
        </tr>
       </thead>
        <tbody class="text-center">
        <?php
            $doctors = $doctor->getPaginateJoin(filter: true ,start_from: $start_from, results_per_page: $results_per_page);
            if(!empty($doctors)){
                foreach($doctors as $doctor){
                ?>
                <tr>
                    <td><?php echo $doctor['id']; ?></td>
                    <td><?php echo $doctor['name']; ?></td>
                    <td>
                      <img src="<?php echo 'assets\images\doctors\\' . $doctor['doctor_img']; ?>" alt="" width="100" height="100">
                    </td>
                    <td><?php echo $doctor['phone']; ?></td>
                    <td><?php echo $doctor['email']; ?></td>
                    <td><?php echo $doctor['summary']; ?></td>
                    <td><?php echo $doctor['city_name']; ?></td>
                    <td><?php echo $doctor['major_name']; ?></td>
                    <td><?php echo $date->date_differance($doctor['created_at']); ?></td>
                    <td>
                      <a href="update_doctor_password.php?doctor_id=<?php echo $doctor['id']; ?>" class="btn btn-success custom-btn"><i class="fa fa-edit"></i>Edit password</a>
                      
                       <a href="update_doctor.php?doctor_id=<?php echo $doctor['id']; ?>" class="btn btn-success custom-btn"><i class="fa fa-edit"></i>Edit</a>
                      <a href="validateForms/doctors/delete_doctor.php?doctor_id=<?php echo $doctor['id']; ?>&page=<?php echo $page; ?>" class="btn btn-danger custom-btn"><i class="fa fa-close"></i>Delete</a>
                    </td>
                </tr>
                    <?php
                      }
                }else{ ?>
                <div class="alert alert-danger">There is no doctors yet</div>
            <?php } ?>

        </tbody>
      </table>

      </div>
    
    </div>
   </div>

   <div class="order-list">
          <ul class="list-unstyled">
            <?php for($page = 1; $page <= $number_of_page; $page++) { ?>

                <li
                <?php if (isset($_GET['page']) && $_GET['page'] == $page): ?>
                            style="background-color: red;"
                <?php endif; ?>>
                <a href="doctors_list.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
              <?php } ?>
          </ul>
    </div>
 </div>
</div>
<!-- End Main Body -->
<?php require_once('templates/footer.php');
