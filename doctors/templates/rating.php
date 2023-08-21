
<?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
                    if(isset($_POST['star_rate'])){
                        if(isset($_POST['star_rating_value'])){
                            $rate->insert(['rate' => $_POST['star_rating_value'], 'doctor_id' => $doctor[0]['id']]);
                            $success_rating = 'you rate has been sent';
                            $path->redirect("doctor.php?doctor_id=".$doctor[0]['id']); 
                            // there is cache when we try to insert in database if we make
                            // reloade for page an this is the righte way i found to redirect to same page then we have to make ob_statr() and ob_end_flush
                        }
                    }
                }
                ?>

                <!-- if there is form_toggle by java script remove to show this form  -->
                        <form action="" method="POST" class="form_toggle" id="form_toggle">
                            <input type="hidden" name="star_rating_value" id="star_rating_value" >
                            <input type="submit" value="submiteRate" class="btn btn-warning p-0" name="star_rate">
                        </form>
                        <?php if(isset($success_rating)): ?>
                            <span style="color: red"><?php echo $success_rating; ?></span>
                        <?php endif; ?>
                        <form class="rating" method="post">
                            <input type="radio" id="star5" name="rating" value="5" onclick="postToController(); myFunction();" /><label for="star5" title="Super !!">5</label><span class="fa fa-star" style="color: orange"></span> 
                            <input type="radio" id="star4" name="rating" value="4" onclick="postToController(); myFunction();" /><label for="star4" title="Geil">4</label><span class="fa fa-star" style="color: red"></span>
                            <input type="radio" id="star3" name="rating" value="3" onclick="postToController(); myFunction();" /><label for="star3" title="Gut">3 </label><span class="fa fa-star" style="color: yellow"></span>
                            <input type="radio" id="star2" name="rating" value="2" onclick="postToController(); myFunction();" /><label for="star2" title="So gut wie">2</label><span class="fa fa-star" style="color: green"></span>
                            <input type="radio" id="star1" name="rating" value="1" onclick="postToController(); myFunction();" /><label for="star1" title="Schlecht">1</label><span class="fa fa-star" style="color: white"></span>
                        </form>
                        <script>
                            function myFunction() {
                                var element = document.getElementById("form_toggle");
                                element.classList.remove("form_toggle");
                            }
                            function postToController() {
                                for (i = 0; i < document.getElementsByName('rating').length; i++) {
                                        if(document.getElementsByName('rating')[i].checked == true) {
                                            var ratingValue = document.getElementsByName('rating')[i].value;
                                            break;
                                        }
                                }
                                document.getElementById("star_rating_value").value  = ratingValue;
                            }
                        </script> 
                        <h6 class="card-title fw-bold"><?php echo $doctor[0]['summary']; ?></h6>
                    </div>
                </div>

                <hr />