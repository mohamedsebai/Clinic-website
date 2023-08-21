<?php require_once('templates/header.php'); ?>
<body>
<?php require_once('templates/navbar.php'); ?>

<?php
if(!$session->check('role_admin')){
    $path->redirect('login.php');
}
?>

<?php 
$path->redirectIfThereIsWrongWithGet($_GET['doctor_id'],"404.php");
$doctor_id = $_GET['doctor_id'];
$doctors = $doctor->get(filter: "id = $doctor_id");
if($doctors[0]['id'] != $doctor_id){
    $path->redirect("doctors.php?page=1");
}

?>
<!-- Start Main Body -->
  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box">
        <h2 class="text-center">Update doctor</h2>

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

        <form action="validateForms/doctors/update_doctor.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="doctor_id" value="<?php echo $doctors[0]['id']; ?>">

          <div class="form-group">
            <label>Name:</label>
            <input class="form-control" type="text" name="name" placeholder="doctor name" value="<?php echo $doctors[0]['name']; ?>">
          </div>

          <div class="form-group">
            <label>Phone:</label>
            <input class="form-control" type="text" name="phone" placeholder="doctor phone" value="<?php echo $doctors[0]['phone']; ?>">
          </div>


          <div class="form-group">
            <label>Email:</label>
            <input class="form-control" type="text" name="email" placeholder="doctor email" value="<?php echo $doctors[0]['email']; ?>">
          </div>


          <div class="form-group">
            <label>Summary:</label>
            <input class="form-control" type="text" name="summary" placeholder="doctor summary" value="<?php echo $doctors[0]['summary']; ?>">
          </div>

        <div class="form-group">
            <select name="major_id" class="form-group">
            <?php
                $majors = $major->get();
                if(!empty($majors)){
                    foreach($majors as $major){
                    ?>
                    <option value="<?php echo $major['id']; ?>"
                    <?php echo ($major['id'] == $doctors[0]['major_id']) ? 'selected' : '';?>>
                    <?php echo $major['title']; ?></option>
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
                    <option value="<?php echo $town['id']; ?>"
                    <?php echo ($town['id'] == $doctors[0]['city_id']) ? 'selected' : '';?>>
                    <?php echo $town['city_name']; ?></option>
                        <?php
                        }
                    }?>
            </select>
        </div>

        <div class="form-group">
        <label>Image:</label>
        <input class="form-control" type="file" name="image" >
        </div>

          <input type="submit" class="btn btn-primary" value="update doctor" name="update_doctor">
         </form>
       </div>
      </div>
    </div>
  </div>

  
<!-- End Main Body -->
<?php require_once('templates/footer.php');
