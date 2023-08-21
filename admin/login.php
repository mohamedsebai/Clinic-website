<?php include_once('templates/header.php'); ?>
<?php
if($session->check('role_admin')){
    $path->redirect('index.php');
}
?>
<body class="member-page-body">
<div class="overlay"></div>
<div class="member-page">
  <div class="container">
   <div class="row">
     <div class="form-box m-auto">

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

    <?php
        if(isset($_COOKIE['email'])){
          $email_by_cookie = $_COOKIE['email'];
          $checked = 'checked';
        }else{
          $checked = '';
        }
        ?>
        
      <h2 class="text-center">Welcome back!</h2>

      <form action="validateForms/login/validate_login.php" method="POST" id="form">
        <div class="form-group">
          <input class="form-control" type="email" name="email" placeholder="Email"
          value="<?php if(isset($email_by_cookie)){ echo $email_by_cookie;}?>">
        </div>
        <div class="form-group">
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>

        <div class="form-group">
          <input type="checkbox" name="remember_me" id="remember_me" <?php echo $checked; ?>>
          <label for="remember_me">remember me</label>
        </div>

        <input class="btn btn-primary d-block m-auto" type="submit" name="login" value="Send" style="margin-top: 10px !important">
       </form>
    </div>
   </div>
  </div>
</div>
<!-- End Main Body -->
<?php require_once('templates/footer.php');