<?php require_once('templates/header.php'); ?>
<body>
<?php require_once('templates/navbar.php'); ?>


<?php
if(!$session->check('role_admin')){
    $path->redirect('login.php');
}
?>

<?php
  $path->redirectIfThereIsWrongWithGet($_GET['major_id'],"404.php"); 
  $major_id = $_GET['major_id'];
  $major = $major->get(filter: "id = $major_id");

  if($major[0]['id'] != $major_id){
    $path->redirect("majors_list.php?page=1");
  }

?>
<!-- Start Main Body -->
  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box">
        <h2 class="text-center">Update Major</h2>
        <a class="btn btn-danger mb-5" href="add_major.php">Create New Major</a>
        <a class="btn btn-danger mb-5" href="majors_list.php?page=1">Major list</a>

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

        <form action="validateForms/majors/update_major.php" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="major_id" value="<?php echo $major[0]['id']; ?>">

          <div class="form-group">
            <label>Name:</label>
            <input class="form-control" type="text" name="title" placeholder="major title" value="<?php echo $major[0]['title']; ?>">
          </div>

          <div class="form-group">
            <label>Image:</label>
            <input class="form-control" type="file" name="image" >
          </div>

          <input type="submit" class="btn btn-primary" value="update Major" name="update_major">
         </form>
       </div>
      </div>
    </div>
  </div>

  
<!-- End Main Body -->
<?php require_once('templates/footer.php');

