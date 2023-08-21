<?php include_once('templates/header.php'); ?>
<body>
<?php include_once('templates/navbar.php'); ?>

<?php
  if(!$session->check('role_admin')){
      $path->redirect('login.php');
  }
?>

<!-- Start Main Body -->
<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="responsive-table m-auto">
      <h2 class="text-center">rates List</h2>

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
          <th>Doctor Name</th>
          <th>Major Title</th>
          <th>Rate(Count of Voting)</th>
          <th>Latest Rate At</th>
        </tr>
       </thead>
        <tbody class="text-center">
        <?php
            $rates = $rate->getJoin();
            if(!empty($rates)){
                foreach($rates as $rate){
                ?>
                <tr>
                    <td><?php echo $rate['id']; ?></td>
                    <td><?php echo $rate['doctor_name']; ?></td>
                    <td><?php echo $rate['major_name']; ?></td>
                    <td><?php echo $rate['sum_of_rate']; ?><span class="fa fa-star" style="color: orange"></span></td>
                    <td><?php echo $date->date_differance($rate['created_at']); ?></td>
                </tr>
                <?php
                      }
                }else{ ?>
                <div class="alert alert-danger">There is no rating for any doctor yet</div>
            <?php } ?>

        </tbody>
      </table>

      </div>
    
    </div>
   </div>

 </div>
</div>
<!-- End Main Body -->
<?php require_once('templates/footer.php');
