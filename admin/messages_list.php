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
$number_of_result = $contact->count(filter: true);
$number_of_page = ceil($number_of_result / $results_per_page);

?>
<!-- Start Main Body -->
<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="responsive-table m-auto">
      <h2 class="text-center">Messages List</h2>

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
          <th>Email</th>
          <th>Phone</th>
          <th>Subject</th>
          <th>Messge Content</th>
          <th>created at</th>
          <th>option</th>
        </tr>
       </thead>
        <tbody class="text-center">
        <?php
            $messages = $contact->paginate(cols: "*", filter: true ,start_from: $start_from, results_per_page: $results_per_page);
            if(!empty($messages)){
                foreach($messages as $message){
                ?>
                <tr>
                    <td><?php echo $message['id']; ?></td>
                    <td><?php echo $message['name']; ?></td>
                    <td><?php echo $message['email']; ?></td>
                    <td><?php echo $message['phone']; ?></td>
                    <td><?php echo $message['subject']; ?></td>
                    <td><?php echo $message['content']; ?></td>
                    <td><?php echo $date->date_differance($message['created_at']); ?></td>
                    <td>
                      <a href="validateForms/messages/delete_message.php?message_id=<?php echo $message['id']; ?>&page=<?php echo $page; ?>" class="btn btn-danger custom-btn"><i class="fa fa-close"></i>Delete</a>
                    </td>
                </tr>
                    <?php
                      }
                }else{ ?>
                <div class="alert alert-danger">There is no majors yet</div>
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
                <a href="messages_list.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
              <?php } ?>
          </ul>
    </div>
 </div>
</div>
<!-- End Main Body -->
<?php require_once('templates/footer.php');
