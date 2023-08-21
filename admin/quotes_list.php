<?php include_once('templates/header.php'); ?>
<body>
<?php include_once('templates/navbar.php'); ?>

<?php
if(!$session->check('role_admin')){
    $path->redirect('login.php');
}
?>
<!-- Start Main Body -->
<div class="main-body">
 <div class="container">
  <div class="row">
    <div class="responsive-table m-auto">
      <h2 class="text-center">quotes List</h2>
      <a class="btn btn-danger mb-5" href="add_quote.php">Create New quote</a>

      
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
          <th>Title</th>
          <th>Content</th>
          <th>created at</th>
          <th>option</th>
        </tr>
       </thead>
        <tbody class="text-center">
        <?php
            $quotes = $quote->get();
            if(!empty($quotes)){
                foreach($quotes as $quote){
                ?>
                <tr>
                    <td><?php echo $quote['id']; ?></td>
                    <td><?php echo $quote['title']; ?></td>
                    <td><?php echo $quote['content']; ?></td>
                    <td><?php echo $date->date_differance($quote['created_at']); ?></td>
                    <td>
                      <a href="update_quote.php?quote_id=<?php echo $quote['id']; ?>" class="btn btn-success custom-btn"><i class="fa fa-edit"></i>Edit</a>
                      <a href="validateForms/quotes/delete_quote.php?quote_id=<?php echo $quote['id']; ?>" class="btn btn-danger custom-btn"><i class="fa fa-close"></i>Delete</a>
                    </td>
                </tr>
                    <?php
                      }
                }else{ ?>
                <div class="alert alert-danger">There is no quotes yet</div>
            <?php } ?>

        </tbody>
      </table>

      </div>
    
    </div>
   </div>
   
 </div>
</div>
<!-- End Main Body -->
<?php require_once('templates/footer.php');
