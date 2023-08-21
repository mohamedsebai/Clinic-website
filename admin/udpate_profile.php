<?php require_once('templates/header.php'); ?>
<body>
<?php require_once('templates/navbar.php'); ?>

<?php
if(!$session->check('role_admin')){
    $path->redirect('login.php');
}
?>

<?php
 $profile_id = $session->get('role_admin_admin_id');
 $auth = $user->get(filter: "id = '$profile_id'");

?>
<!-- Start Main Body -->
  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box">
        <h2 class="text-center">Update Admin profile</h2>

        <a class="btn btn-danger mb-5" href="change_password.php">Change Password</a>

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

        <form action="validateForms/profile/update_profile.php" method="POST" enctype="multipart/form-data">

          <div class="form-group">
            <label>Name:</label>
            <input class="form-control" type="text" name="username" placeholder="admin name" value="<?php echo $auth[0]['username']; ?>">
          </div>

          <div class="form-group">
            <label>Phone:</label>
            <input class="form-control" type="text" name="phone" placeholder="admin phone" value="<?php echo $auth[0]['phone']; ?>">
          </div>


          <div class="form-group">
            <label>Email:</label>
            <input class="form-control" type="text" name="email" placeholder="admin email" value="<?php echo $auth[0]['email']; ?>">
          </div>

        <div class="form-group">
        <label>Image:</label>
        <input class="form-control" type="file" name="image" >
        </div>

          <input type="submit" class="btn btn-primary" value="update profile" name="update_profile">
         </form>
       </div>
      </div>
    </div>
  </div>

  
<!-- End Main Body -->
<?php require_once('templates/footer.php');
