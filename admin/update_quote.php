<?php require_once('templates/header.php'); ?>
<body>
<?php require_once('templates/navbar.php'); ?>

<?php
if(!$session->check('role_admin')){
    $path->redirect('login.php');
}
?>
<?php 
$path->redirectIfThereIsWrongWithGet($_GET['quote_id'],"404.php");
$quote_id = $_GET['quote_id'];
$quotes = $quote->get(filter: "id = '$quote_id'");
if($quotes[0]['id'] != $quote_id){
    $path->redirect("quotes.php?page=1");
}

?>
<!-- Start Main Body -->
  <div class="main-body">
   <div class="container">
    <div class="row">
      <div class="form-box">
        <h2 class="text-center">update New quote</h2>

        <a class="btn btn-danger mb-5" href="quotes_list.php?page=1">quote list</a>

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

        <form action="validateForms/quotes/update_quote.php" method="POST">

        <input type="hidden" name="quote_id" value="<?Php echo $quotes[0]['id']; ?>">

          <div class="form-group">
            <label>Title:</label>
            <input class="form-control" type="text" name="title" placeholder="quote title" value="<?Php echo $quotes[0]['title']; ?>">
          </div>

          <div class="form-group">
          <label>Content:</label>
            <textarea name="content" class="form-control" cols="30" rows="10" placeholder="quote content"><?Php echo $quotes[0]['content']; ?></textarea>
          </div>



          <input type="submit" class="btn btn-primary" value="update quote" name="update_quote">
         </form>
       </div>
      </div>
    </div>
  </div>

  
<!-- End Main Body -->
<?php require_once('templates/footer.php');
