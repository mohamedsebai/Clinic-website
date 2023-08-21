<?php ob_start(); ?>
<?php require_once('templates/header.php'); ?>
<body>
    <div class="page-wrapper">
    <?php require_once('templates/nav.php'); ?>
    <?php 
    
    $path->redirectIfThereIsWrongWithGet($_GET['doctor_id'], '../404.php');
    $doctor_id = $_GET['doctor_id'];

    $doctor = $doctor->get(filter: "id = $doctor_id");
    if($doctor[0]['id'] != $doctor_id){
        $path->redirect('../404.php');
    }
    
    ?>
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="../index.php">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="./index.php?page=1">doctors</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $doctor[0]['name']; ?></li>
                </ol>
            </nav>
            
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

            <div class="d-flex flex-column gap-3 details-card doctor-details">

                <?php
                    
                ?>
                <div class="details d-flex gap-2 align-items-center">
                    <img src="<?php echo '../admin/assets/images/doctors/' . $doctor[0]['doctor_img']; ?>" alt="doctor" class="img-fluid rounded-circle" height="150"
                        width="150">
                    <div class="details-info d-flex flex-column gap-3 ">
                        <h4 class="card-title fw-bold"><?php echo $doctor[0]['name']; ?></h4>
                 <!-- include ratign page here for doctor -->
                <?php include 'templates/rating.php'; ?>

                <form class="form" action="../validateForms/booking_insert.php" method="POST">
                    <input type="hidden" name="doctor_id" value="<?php echo $doctor[0]['id']; ?>">
                    <div class="form-items">
                        <div class="mb-3">
                            <label class="form-label required-label" for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                            value="<?php echo  $session->check('role_user_username')  ? $session->get('role_user_username') : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-label" for="phone">Phone</label>
                            <input type="tel" name="phone" class="form-control" id="phone"
                            value="<?php echo  $session->check('role_user_phone')  ? $session->get('role_user_phone') : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required-label" for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" 
                            value="<?php echo  $session->check('role_user_email')  ? $session->get('role_user_email') : '' ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="booking">Confirm Booking</button>
                </form>

            </div>
        </div>
    </div>
    <?php require_once('templates/footer_content.php'); ?>
    <?php require_once('templates/footer.php'); ?>
</body>

</php>
<?php ob_end_flush(); ?>