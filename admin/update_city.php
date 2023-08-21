<?php require_once('templates/header.php'); ?>
<body>
<?php require_once('templates/navbar.php'); ?>

<?php
if(!$session->check('role_admin')){
    $path->redirect('login.php');
}
?>

<?php
  $path->redirectIfThereIsWrongWithGet($_GET['city_id'],"404.php"); 
  $city_id = $_GET['city_id'];
  $town = $city->get(filter: "id = $city_id");

  if($town[0]['id'] != $city_id){
    $path->redirect("city_list.php?page=1");
  }

?>
<!-- Start Main Body -->
  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box">
        <h2 class="text-center">Update City</h2>
        <a class="btn btn-danger mb-5" href="add_city.php">Create New City</a>
        <a class="btn btn-danger mb-5" href="city_list.php?page=1">city list</a>

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

        <form action="validateForms/cities/update_city.php" method="POST">

          <input type="hidden" name="city_id" value="<?php echo $town[0]['id']; ?>">

          <div class="form-group">
            <label>City Name:</label>
            <input class="form-control" type="text" name="city_name" placeholder="City Name" value="<?php echo $town[0]['city_name']; ?>">
          </div>

          <input type="submit" class="btn btn-primary" value="update City" name="update_city">
         </form>
       </div>
      </div>
    </div>
  </div>

  
<!-- End Main Body -->
<?php require_once('templates/footer.php');

