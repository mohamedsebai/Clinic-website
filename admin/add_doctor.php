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
        <h2 class="text-center">Add New doctor</h2>

        <a class="btn btn-danger mb-5" href="doctors_list.php?page=1">doctors list</a>

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

        <form action="validateForms/doctors/add_doctor.php" method="POST" enctype="multipart/form-data">

          <div class="form-group">
            <label>Name:</label>
            <input class="form-control" type="text" name="name" placeholder="doctor name">
          </div>

          <div class="form-group">
            <label>Phone:</label>
            <input class="form-control" type="text" name="phone" placeholder="doctor phone">
          </div>


          <div class="form-group">
            <label>Email:</label>
            <input class="form-control" type="email" name="email" placeholder="doctor email">
          </div>


          <div class="form-group">
            <label>Password:</label>
            <input class="form-control" type="password" name="password" placeholder="doctor password">
          </div>

          <div class="form-group">
            <label>Summary:</label>
            <input class="form-control" type="text" name="summary" placeholder="doctor summary">
          </div>

        <div class="form-group">
            <select name="major_id" class="form-group">
            <?php
                $majors = $major->get();
                if(!empty($majors)){
                    foreach($majors as $major){
                    ?>
                    <option value="<?php echo $major['id']; ?>"><?php echo $major['title']; ?></option>
                        <?php
                        }
                    }?>
            </select>
        </div>

        <div class="form-group">
            <select name="city_id" class="form-group">
            <?php
                $cities = $city->get();
                if(!empty($cities)){
                    foreach($cities as $town){
                    ?>
                    <option value="<?php echo $town['id']; ?>"><?php echo $town['city_name']; ?></option>
                        <?php
                        }
                    }?>
            </select>
        </div>

        <div class="form-group">
        <label>Image:</label>
        <input class="form-control" type="file" name="image" >
        </div>

          <input type="submit" class="btn btn-primary" value="add doctor" name="add_doctor">
         </form>
       </div>
      </div>
    </div>
  </div>

  
<!-- End Main Body -->
<?php require_once('templates/footer.php');
