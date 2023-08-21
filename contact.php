
<?php require_once('templates/header.php'); ?>
<body>
    <div class="page-wrapper">
        <?php require_once('templates/nav.php'); ?>
        
            <div class="container">
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

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-decoration-none" href="./index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">contact</li>
                    </ol>
                </nav>
                <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
                    <form class="form" action="validateForms/message_insert.php" method="POST">
                        <div class="form-items">
                            <div class="mb-3">
                                <label class="form-label required-label" for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                value="<?php echo  $session->check('role_user_username')  ? $session->get('role_user_username') : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required-label" for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                value="<?php echo  $session->check('role_user_phone')  ? $session->get('role_user_phone') : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo  $session->check('role_user_email')  ? $session->get('role_user_email') : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required-label" for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required-label" for="content">Message</label>
                               <textarea class="form-control" id="content"  name="content"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="message">Send Message</button>
                    </form>
                </div>

            </div>
    </div>
    <?php require_once('templates/footer.php'); ?>
</body>

</html>