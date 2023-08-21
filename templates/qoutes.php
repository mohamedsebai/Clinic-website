


<?php
$quotes = $quote->get();
foreach($quotes as $quote){ 
?>
<div class="card mb-5" style="width: 18rem; background: #c8bdff" >
  <img class="card-img-top mt-3"
   src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/medical-care-icon.svg" 
   alt="Card image cap" width="100" height="100">
  <div class="card-body">
    <h5 class="card-title"><?php echo $quote['title']; ?></h5>
    <p class="card-text"><?php echo $quote['content']; ?></p>
  </div>
</div>
<?php } ?>

          


<div class="bottom--left bottom--content bg-blue text-white">
        <h4 class="title">download the application now</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facere eveniet in id, quod
            explicabo minus ut, sint possimus, fuga voluptas. Eius molestias eveniet labore ullam magnam sequi
            possimus quaerat!</p>
        <div class="app-group">
            <div class="app"><img
                    src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/google-play-logo.svg"
                    alt="">Google Play</div>
            <div class="app"><img
                    src="https://d1aovdz1i2nnak.cloudfront.net/vezeeta-web-reactjs/55619/_next/static/images/apple-logo.svg"
                    alt="">App Store</div>
        </div>
    </div>
    <div class="bottom--right bg-blue text-white">
        <img src="assets/images/banner.jpg" class="img-fluid banner-img">
    </div>
</div>