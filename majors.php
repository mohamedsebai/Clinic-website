
<?php require_once('templates/header.php'); ?>
<body>
    <div class="page-wrapper">
    <?php require_once('templates/nav.php'); ?>

    <?php 

        //$path->redirectIfThereIsWrongWithGet($_GET['page'],'404.php');
        if(isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }
        if ( isset ($_GET['page']) && empty($_GET['page']) ) {
            $path->redirect("404.php");
        }elseif ( isset ($_GET['page']) && !empty($_GET['page']) && !is_numeric($_GET['page'])) {
            $path->redirect("404.php");
        }
    
        $results_per_page = 1;
        $start_from = ( $page - 1 ) * $results_per_page;
        $number_of_result = $major->count(filter: true);
        $number_of_page = ceil($number_of_result / $results_per_page);
    ?>
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">majors</li>
                </ol>
            </nav>
            <div class="majors-grid">

            <?php
            $majors = $major->getPaginateJoin(start_from: $start_from, results_per_page: $results_per_page);
            if(!empty($majors)){
                foreach($majors as $major){
                ?>
                    <div class="card p-2" style="width: 18rem; background: #00c2ff">
                        <img src="<?php echo 'admin/assets/images/majors/' . $major['img']; ?>" class="card-img-top rounded-circle card-image-circle"
                            alt="major">
                        <div class="card-body d-flex flex-column gap-1 justify-content-center">
                            <h4 class="card-title fw-bold text-center"><?php echo $major['title']; ?></h4>
                            <a href="doctors/doctor.php?doctor_id=<?php echo $major['doctor_id']; ?>" class="btn btn-outline-primary card-button">Browse Doctors</a>
                        </div>
                    </div>
                    <?php
                        }
                }else{ ?>
                <div class="alert alert-danger">
                    There is no doctor for this page
                    <?php echo isset($page) ? $page : '' ?>
                </div>
            <?php } ?>
                
                
            </div>

            <nav class="mt-5" aria-label="navigation">
                <ul class="pagination justify-content-center">
                <?php
                    for($page = 1; $page <= $number_of_page; $page++) { ?>

                        <li class="page-item"> <a class="page-link" 
                        <?php if(isset($_GET['page']) && $_GET['page'] == $page): ?>
                            style="background-color: red;"
                        <?php endif; ?>
                        href="majors.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>';

                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    <?php require_once('templates/footer.php'); ?>
</body>

</html>
