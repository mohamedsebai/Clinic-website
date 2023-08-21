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
        <h2 class="text-center">Add New admin</h2>

        <a class="btn btn-danger mb-5" href="admins_list.php?page=1">admins list</a>

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

        <form action="validateForms/admins/add_admin.php" method="POST" enctype="multipart/form-data">

          <div class="form-group">
            <label>Name:</label>
            <input class="form-control" type="text" name="username" placeholder="admin name">
          </div>

          <div class="form-group">
            <label>Phone:</label>
            <input class="form-control" type="text" name="phone" placeholder="admin phone">
          </div>


          <div class="form-group">
            <label>Email:</label>
            <input class="form-control" type="email" name="email" placeholder="admin email">
          </div>


          <div class="form-group">
            <label>Password:</label>
            <input class="form-control" type="password" name="password" placeholder="admin password">
          </div>

          <div class="form-group">
            <label>Role: is admin</label>
            <input class="form-control" type="hidden" name="role" placeholder="Role" value="admin">
          </div>


        <div class="form-group">
        <label>Image:</label>
        <input class="form-control" type="file" name="image" >
        </div>

          <input type="submit" class="btn btn-primary" value="add admin" name="add_admin">
         </form>
       </div>
      </div>
    </div>
  </div>

  
<!-- End Main Body -->
<?php require_once('templates/footer.php');
