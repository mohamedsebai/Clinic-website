<?php include_once('templates/header.php'); ?>
<body>
<?php include_once('templates/navbar.php'); ?>

<?php
if(!$session->check('role_admin')){
    $path->redirect('login.php');
}
?>

<?php



if ( isset ($_GET['page']) && empty($_GET['page']) ) {
  $page = 1;
}
if(isset($_GET['page']) && is_numeric($_GET['page'])){
  $page = $_GET['page'];  
}
if (!isset($_GET['page'])) {
  $page = 1;
}
if(isset($_GET['page']) && !is_numeric($_GET['page'])){
  $page = 1;
}

$results_per_page = 5;
$start_from = ( $page - 1 ) * $results_per_page;
$number_of_result = $user->count(filter: "role = 'admin'");
$number_of_page = ceil($number_of_result / $results_per_page);

?>
<!-- Start Main Body -->
<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="responsive-table m-auto">
      <h2 class="text-center">admins List</h2>
      <a class="btn btn-danger mb-5" href="add_admin.php">Add new Admin</a>

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
          <th>Name</th>
          <th>Image</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Role</th>
          <th>created at</th>
          <th>option</th>
        </tr>
       </thead>
        <tbody class="text-center">
        <?php
            $admins = $user->paginate(cols: "*",filter: "role = 'admin'" ,start_from: $start_from, results_per_page: $results_per_page);
            if(!empty($admins)){
                foreach($admins as $admin){
                ?>
                <tr>
                    <td><?php echo $admin['id']; ?></td>
                    <td><?php echo $admin['username']; ?></td>
                    <td>
                      <img src="<?php echo 'assets\images\admins\\' . $admin['profile_img']; ?>" alt="" width="100" height="100">
                    </td>
                    <td><?php echo $admin['phone']; ?></td>
                    <td><?php echo $admin['email']; ?></td>
                    <td><?php echo $admin['role']; ?></td>
                    <td><?php echo $date->date_differance($admin['created_at']); ?></td>
                    <td>
                      <a href="validateForms/admins/delete_admin.php?admin_id=<?php echo $admin['id']; ?>&page=<?php echo $page; ?>" class="btn btn-danger custom-btn"><i class="fa fa-close"></i>Delete</a>
                    </td>
                </tr>
                    <?php
                    }
                }else{ ?>
                <div class="alert alert-danger">There is no admins yet</div>
            <?php } ?>

        </tbody>
      </table>

      </div>
    
    </div>
   </div>

   <div class="order-list">
          <ul class="list-unstyled">
            <?php for($page = 1; $page <= $number_of_page; $page++) { ?>

                <li
                <?php if (isset($_GET['page']) && $_GET['page'] == $page): ?>
                            style="background-color: red;"
                <?php endif; ?>>
                <a href="admins_list.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
              <?php } ?>
          </ul>
    </div>
 </div>
</div>
<!-- End Main Body -->
<?php require_once('templates/footer.php');
