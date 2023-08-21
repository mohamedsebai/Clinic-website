<?php require_once('../doctors/templates/header.php'); ?>

<?php 
if(!$session->check('role_doctor')){
    $path->redirect('login.php');
}
?>
<body>

    <div class="page-wrapper">
    <nav class="navbar navbar-expand-lg navbar-expand-md bg-blue sticky-top">
    <div class="container">
        <div class="navbar-brand">
            <a class="fw-bold text-white m-0 text-decoration-none h3" href="../index.php">VCare</a>
    </div>
    <button class="navbar-toggler btn-outline-light border-0 shadow-none" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <div class="d-flex gap-3 flex-wrap justify-content-center" role="group">
            <a type="button" class="btn btn-outline-light navigation--button" href="../index.php">Home</a>
            <a type="button" class="btn btn-outline-light navigation--button"
                href="../majors.php?page=1">majors</a>
            <a type="button" class="btn btn-outline-light navigation--button"
                href="../doctors/index.php?page=1">Doctors</a>

                    <?php if($session->check('role_doctor')): ?>
                        <a type="button" class="btn btn-outline-light navigation--button" href="./logout.php">logout</a>
                    <?php else: ?>
                        <a type="button" class="btn btn-outline-light navigation--button" href="./login.php">login</a>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
        </nav>


        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
            <h2 class="fw-200">Welcome back Doctor <?php echo $session->get('role_doctor_name'); ?></h2>
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item active" aria-current="page">Your Booking history</li>
                </ol>
            </nav>
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">major</th>
                        <th scope="col">location</th>
                        <th scope="col">completed</th>
                    </tr>
                </thead>
                <tbody>
    <?php $bookings = $booking->getJoin(); ?>

    <?php 

    $doctor_id = $session->get('role_doctor_doctor_id');

    $bookings = $booking->getJoin(filter: "doctor_id = '$doctor_id'");
            if(!empty($bookings)){
                foreach($bookings as $booking){ 
                ?>
                    <tr>
                        <th scope="row"><?php echo $booking['id']; ?></th>
                        <td><?php echo $booking['created_at']; ?></td>
                        <td class="d-flex align-items-center gap-2"><img src="../admin/assets/images/doctors/<?php echo $booking['doctor_img'] ?>" alt="" width="25"
                                height="25" class="rounded-circle">
                            <a href="../doctors/doctor.php?doctor_id=<?php echo $booking['doctor_id']; ?>"><?php echo $booking['name']; ?></a>
                        </td>
                        <td><?php echo $booking['title']?></td>
                        <td><a href="https://www.eraasoft.com" target="_blank">eraasoft</a></td>
                        <td>
                            <?php echo $booking['status'] == 0 ? 'Not complated' : 'Complated' ?>
                        </td>
                    </tr>
                    <?php
                        }
                }else{ ?>
                <div class="alert alert-danger">There is no booking yet</div>
            <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require_once('../doctors/templates/footer.php'); ?>
</body>

</php>