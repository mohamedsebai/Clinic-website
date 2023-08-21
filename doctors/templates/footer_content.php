<footer class="container-fluid bg-blue text-white py-3">
        <div class="row gap-2">

            <div class="col-sm order-sm-1">
                <h1 class="h1">About Us</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa nesciunt repellendus itaque,
                    laborum
                    saepe
                    enim maxime, delectus, dicta cumque error cupiditate nobis officia quam perferendis consequatur
                    cum
                    iure
                    quod facere.</p>
            </div>
            <div class="col-sm order-sm-2">
                <h1 class="h1">Links</h1>
                <div class="links d-flex gap-2 flex-wrap">
                    <a href="../index.php" class="link text-white">Home</a>
                    <a href="../majors.php?page=1" class="link text-white">Majors</a>
                    <a href="./index.php?page=1" class="link text-white">Doctors</a>
                    <a href="../contact.php" class="link text-white">Contact</a>
                    <?php if($session->check('role_user')): ?>
                        <a href="../logout.php" class="link text-white">logout</a>
                    <?php else: ?>
                        <a href="../login.php" class="link text-white">Login</a>
                        <a href="../register.php" class="link text-white">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </footer>