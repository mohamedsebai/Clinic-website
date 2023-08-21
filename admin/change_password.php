
<?php include_once('templates/header.php'); ?>
<body>
<?php include_once('templates/navbar.php'); ?>

<?php
  if(!$session->check('role_admin')){
      $path->redirect('login.php');
  }
?>

<div class="change-pass">
   <div class="container">
    <div class="row">
      <div class="form-box m-auto">
        <h2 class="text-center" style="margin: 30px 0;">Change Password</h2>

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

       <form action="validateForms/profile/change_password.php" method="POST">
         <div class="form-group">
           <input class="form-control" type="password" name="old_password" placeholder="Old Password">
         </div>
         <div class="form-group">
           <input class="form-control" type="password" name="new_password" placeholder="New Password">
         </div>
         <div class="form-group">
           <input class="form-control" type="password" name="repeat_new_password" placeholder="Repeat New Password">
         </div>
         <input class="btn btn-primary"type="submit" value="change password" name="change_password">
        </form>
       </div>
      </div>
    </div>
</div>

  <!-- End Main Body -->
<?php require_once('templates/footer.php');