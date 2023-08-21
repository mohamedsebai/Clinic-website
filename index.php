
<?php require_once('templates/header.php'); ?>
<body>
    <div class="page-wrapper">
    <?php require_once('templates/nav.php'); ?>
        <div class="container-fluid bg-blue text-white pt-3">
            <div class="container pb-5">
                <div class="row gap-2">
                    <div class="col-sm order-sm-2">
                        <img src="assets/images/banner.jpg" class="img-fluid banner-img banner-img" alt="banner-image"
                            height="200">
                    </div>
                    <div class="col-sm order-sm-1">

                    <?php echo  $session->check('role_user_email')  ? '<h2 class="h2" style="color: black;">Welcome ' . $session->get('role_user_username') . '</h2>': '' ?>
                        <h1 class="h1">Have a Medical Question?</h1>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa nesciunt repellendus itaque,
                            laborum
                            saepe
                            enim maxime, delectus, dicta cumque error cupiditate nobis officia quam perferendis
                            consequatur
                            cum
                            iure
                            quod facere.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 class="h1 fw-bold text-center my-4">majors</h2>

            <div class="d-flex flex-wrap gap-4 justify-content-center">

            
            <?php
            $majors = $major->get();
            if(!empty($majors)){
                foreach($majors as $major){ 
                ?>
                    <div class="card p-2" style="width: 18rem; background: #00c2ff">
                        <img src="<?php echo 'admin/assets/images/majors/' . $major['img']; ?>" class="card-img-top rounded-circle card-image-circle"
                            alt="major">
                        <div class="card-body d-flex flex-column gap-1 justify-content-center">
                            <h4 class="card-title fw-bold text-center"><?php echo $major['title']; ?></h4>
                            <a href="doctors/index.php?major_id=<?php echo $major['id']; ?>&page=1" class="btn btn-outline-primary card-button">Browse Doctors</a>
                        </div>
                    </div>
                    <?php
                        }
                }else{ ?>
                <div class="alert alert-danger">There is no doctor yet</div>
            <?php } ?>
                
            </div>

            <h2 class="h1 fw-bold text-center my-4">doctors</h2>

            <div class="d-flex flex-wrap gap-4 justify-content-center">
                <?php
                $doctors = $doctor->getJoin();
                    if(!empty($doctors)){
                        foreach($doctors as $doctor){
                            ?>
                            <div class="card p-2" style="width: 18rem; background: #222dbb73">
                                <img src="<?php echo 'admin/assets/images/doctors/' . $doctor['doctor_img']; ?>" class="card-img-top rounded-circle card-image-circle"
                                                    alt="major">
                                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                                    <h4 class="card-title fw-bold text-center"><?php echo $doctor['name']; ?></h4>
                                    <h6 class="card-title fw-bold text-center"><?php echo $doctor['title']; ?></h6>
                                    <a href="doctors/doctor.php?doctor_id=<?php echo $doctor['id']; ?>" class="btn btn-outline-primary card-button">Book an appointment</a>
                                </div>
                            </div>
                        <?php 
                        }
                }else{ ?>
                <div class="alert alert-danger">There is no doctor yet</div>
                <?php } ?>
            </div>
        </div>
        <div class="banner container d-block d-lg-grid d-md-block d-sm-block">

            <?php require_once('templates/qoutes.php'); ?>

    </div>

    <?php require_once('templates/footer.php'); ?>
</body>

</html>