<?php require_once('templates/header.php'); ?>
<body>
    <div class="page-wrapper">
    <?php require_once('templates/nav.php'); ?>

    <?php

        if(isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page']) ){
            $page = $_GET['page'];
        }
        
        if(!isset($_GET['page'])){
            $page = 1;
        }
        if ( isset ($_GET['page']) && empty($_GET['page']) ) {
            $path->redirect("../404.php");
        }elseif ( isset ($_GET['page']) && !empty($_GET['page']) && !is_numeric($_GET['page'])) {
            $path->redirect("../404.php");
        }
        //$page = $_GET['page'];
        $results_per_page = 4;
        $start_from = ( $page - 1 ) * $results_per_page;

        if(isset($_GET['city_id'])){
            $city_id = $_GET['city_id'];
            $number_of_result = $doctor->count("city_id = $city_id");
        }elseif(isset($_GET['major_id'])){
            $major_id = $_GET['major_id'];
            $number_of_result = $doctor->count("major_id = $major_id");
        }else{
            $number_of_result = $doctor->count(filter: true);
        }
        $number_of_page = ceil($number_of_result / $results_per_page);


        
    ?>
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="../index.php"
                            index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">doctors</li>
                </ol>
            </nav>
            <div class="filteration d-flex gap-3 mb-3 flex-wrap justify-content-center justify-content-lg-start justify-content-md-start">

            <a href="index.php?page=1" class="btn btn-danger">All</a>

                <div class="dropdown">
                    <button class="btn bg-blue btn-primary align-items-center d-flex gap-2 dropdown-toggle"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        city
                    </button>
                    <ul class="dropdown-menu">
                        <?php
                        $cities = $city->get();
                            if(!empty($cities)){
                                foreach($cities as $city){
                                    ?>
                                <li><a class="dropdown-item" href="index.php?city_id=<?php echo $city['id']; ?>&page=1"><?php echo $city['city_name']; ?></a></li>
                                <?php 
                                }
                            }else{ ?>
                            <li>Nothing</li>
                    <?php } ?>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn bg-blue btn-primary align-items-center d-flex gap-2 dropdown-toggle"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        major
                    </button>
                    <ul class="dropdown-menu">
                    <?php
                        $majors = $major->get();
                            if(!empty($majors)){
                                foreach($majors as $major){
                                    ?>
                                <li><a class="dropdown-item" href="index.php?major_id=<?php echo $major['id']; ?>&page=1"><?php echo $major['title']; ?></a></li>
                                <?php 
                                }
                            }else{ ?>
                            <li>Nothing</li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="doctors-grid">


                <?php
                if(isset($_GET['major_id']) && is_numeric($_GET['major_id']) && !empty($_GET['major_id'])){
                    $major_id = $_GET['major_id'];
                    $doctors = $doctor->getPaginateJoin(filter: "major_id = $major_id",start_from: $start_from, results_per_page: $results_per_page);

                }elseif(isset($_GET['city_id']) && is_numeric($_GET['city_id']) && !empty($_GET['city_id'])){
                    $city_id = $_GET['city_id'];
                    $doctors = $doctor->getPaginateJoin(filter: "city_id = $city_id",start_from: $start_from, results_per_page: $results_per_page);
                }else{
                    $doctors = $doctor->getPaginateJoin(filter: true, start_from: $start_from, results_per_page: $results_per_page);
                }
                    if(!empty($doctors)){
                        foreach($doctors as $doctor){
                            ?>
                            <div class="card p-2" style="width: 18rem; background: #222dbb73"">
                                <img src="<?php echo '../admin/assets/images/doctors/' . $doctor['doctor_img']; ?>" class="card-img-top rounded-circle card-image-circle"
                                                    alt="major">
                                <div class="card-body d-flex flex-column gap-1 justify-content-center">
                                    <h4 class="card-title fw-bold text-center"><?php echo $doctor['name']; ?></h4>
                                    <h6 class="card-title fw-bold text-center"><?php echo $doctor['title']; ?></h6>
                                    <a href="doctor.php?doctor_id=<?php echo $doctor['id']; ?>" class="btn btn-outline-primary card-button">Book an appointment</a>
                                </div>
                            </div>
                        <?php 
                        }
                    }else{ ?>
                    <div class="alert alert-danger">There is no doctor yet for this page <?php echo isset($page) ? $page : '' ?></div>
                <?php } ?>

            </div>

            
            <?php if($number_of_result > 0): 

                ?>
            <nav class="mt-5" aria-label="navigation">
                <ul class="pagination justify-content-center">
                <?php
                    for($page = 1; $page <= $number_of_page; $page++) {
                    if(isset($_GET['city_id']) ){ ?>

                        <li class="page-item"> <a class="page-link" 
                        <?php if(isset($_GET['page']) && $_GET['page'] == $page): ?>
                            style="background-color: red;"
                        <?php endif; ?>
                        href="index.php?city_id=<?php echo $_GET['city_id']; ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a></li>

                    <?php }elseif(isset($_GET['major_id'])){ ?>

                        <li class="page-item"> <a class="page-link" 
                        <?php if(isset($_GET['page']) && $_GET['page'] == $page): ?>
                            style="background-color: red;"
                        <?php endif; ?>
                        href="index.php?major_id=<?php echo $_GET['major_id']; ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a></li>

                    <?php }else{ ?>
                        <li class="page-item"> <a class="page-link" 
                        <?php if(isset($_GET['page']) && $_GET['page'] == $page): ?>
                            style="background-color: red;"
                        <?php endif; ?>
                        href="index.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                    <?php } ?>
                        
                    <?php }?>
                </ul>
            </nav>
            <?php endif; ?>




        </div>
    </div>
    <?php require_once('templates/footer_content.php'); ?>
    <?php require_once('templates/footer.php'); ?>
</body>

</html>

