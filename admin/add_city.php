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
      <div class="form-box">
        <h2 class="text-center">Add New City</h2>

        <a class="btn btn-danger mb-5" href="city_list.php?page=1">City list</a>

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

        <form action="validateForms/cities/add_city.php" method="POST">

          <div class="form-group">
            <label>City Name:</label>
            <input class="form-control" type="text" name="city_name" placeholder="city name">

          </div>
          <input type="submit" class="btn btn-primary" value="add City" name="add_city">
         </form>
       </div>
      </div>
    </div>
  </div>

  
<!-- End Main Body -->
<?php require_once('templates/footer.php');
