<?php 
require_once('templates/header.php'); 
if($session->check('role_user')){
    $path->redirect('index.php');
}
?>
<body>
    <div class="page-wrapper">
        
        <?php require_once('templates/nav.php'); ?>
        <div class="container">


            <?php if($session->check('database_error')): ?>
                <div class="alert alert-danger"><?php echo $session->get('database_error'); $session->unset('database_error') ?></div>
            <?php endif; ?>


            <?php if( $session->check('errors')  ): ?>
                <?php foreach($session->get('errors') as $sessionData): ?>
                <div class="alert alert-danger"><?php echo $sessionData; unset($_SESSION['errors']) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>


            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">login</li>
                </ol>
            </nav>
            <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
                <form class="form" action="validateForms/create_account.php" method="POST" enctype="multipart/form-data">
                    <div class="form-items">
                        <div class="mb-3">
                            <label class="form-label required-label" for="name">Username</label>
                            <input type="text" class="form-control" id="name" name="username">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-label" for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-label" for="password">password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label required-label" for="Image">Image</label>
                            <input type="file" class="form-control" id="Image" name="image">
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary" name="create_account">Create account</button>
                </form>
                <div class="d-flex justify-content-center gap-2">
                    <span>already have an account?</span><a class="link" href="./login.php"> login</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('templates/footer.php'); ?>
</body>

</html>