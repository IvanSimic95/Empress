<?php
#include $_SERVER['DOCUMENT_ROOT'].'/templates/noskip.php';
isset($_SESSION['userFName']) ? $fName = $_SESSION['userFName'] : $fName = "there";

$title = "Special Offer! Personal Psychic Reading! "; 
$title2 = "YOU UNLOCKED A SPECIAL SERVICE!";
$sdescription = "Customize your order";
$description = "Hey ".$fName."!<br> Here's an exclusive offer to complement your order!";

$productID = "5";

include $_SERVER['DOCUMENT_ROOT'] . '/templates/rating/rating-total.php';


$reviews = $count;
$avgrating = $avg;
?>
<div class="container-fluid" data-layout="container" style="padding:0!important;padding-top:20px!important;">
    <section class="py-0 light" id="banner">
        <div class="container p-0 p-xl-4">


<div class="card mb-3 col-12 offset-0 col-xl-8 offset-xl-2">
            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(/assets/img/icons/spot-illustrations/corner-4.png);"></div>
            <!--/.bg-holder-->
            <div class="card-header bg-light rounded-3" style="text-align:center;">
            <h3 class="gradient mb-0"><?php echo $title2; ?></h3>
                </div>
            <div class="card-body position-relative p-2 p-xl-3" style="text-align:center;">
              <div class="row">
                <div class="col-lg-12">
                <div class="progress mt-2 col-12 offset-0 mb-2" style="height: 40px; max-width:100%;margin:0 auto;">
                <div class="progress-bar progress-bar-striped fw-bold fs-1 progress-bar-animated" role="progressbar" style="background-color: #cf2bbd !important;width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" title="Step 2">Step 2 of 3</div>
                </div>     
                </div>
              </div>
            </div>
          </div>
          <div class="row g-0">
       
            <div class="col-12 offset-0 col-xl-8 offset-xl-2">
                 <div class="alert alert-info border-2 d-flex align-items-center col-12 offset-0" role="alert">
                    <div class="bg-info me-3 icon-item"><span class="fas fa-info-circle text-white fs-3"></span></div>
                    <p class="mb-0 flex-1" style="font-weight:600;"><?php echo $description; ?></p>
                    
                  </div>
              <div class="card mb-3">
                <div class="card-header bg-light" style="text-align:center;">
                <h3 class="gradient  mb-0">PERSONAL PSYCHIC READING </h3>

                </div>
                  <div class="card-body col-12 offset-0" style="text-align:center;">
                  <div class="gradient mt-3 mb-3 text-start fs-1">
                  Unlock the mysteries of your soul with a personalized psychic reading from the Psychic Empress!
</div>
                  <img class="img-fluid rounded img-thumbnail" src="/assets/img/psychic.jpg" alt="upsell">

    <form class="readings position-relative" action="/order/order-reading" method="get" style="text-align:left;">
 
      <ul class="list-group list-group-flush">
          <li class="list-group-control">
					<label class="custom-control fill-checkbox">
			    <input type="checkbox" class="fill-control-input" id="general" name="general" value="general" checked="">
			    <span class="fill-control-indicator"></span>
			    <span class="fill-control-description">General Reading</span>
		      </label>
					</li>
          <li class="list-group-control">
					<label class="custom-control fill-checkbox">
			    <input type="checkbox" class="fill-control-input" id="love" name="love" value="love">
			    <span class="fill-control-indicator"></span>
			    <span class="fill-control-description">Love Reading</span>
		      </label>
					</li>
          <li class="list-group-control">
					<label class="custom-control fill-checkbox">
			    <input type="checkbox" class="fill-control-input" id="career" name="career" value="career">
			    <span class="fill-control-indicator"></span>
			    <span class="fill-control-description">Career Reading</span>
		      </label>
					</li>
          <li class="list-group-control">
					<label class="custom-control fill-checkbox">
			    <input type="checkbox" class="fill-control-input" id="health" name="health" value="health">
			    <span class="fill-control-indicator"></span>
			    <span class="fill-control-description">Health Reading</span>
		      </label>
					</li>
          
				</ul>

 



    <input class="cookie" type="hidden" name="cookie_id1" value="<?php echo $_SESSION['cookie']; ?>">
    <input class="cookie" type="hidden" name="cookie_id2" value="<?php echo $_SESSION['cookie2']; ?>">
    <input class="cookie" type="hidden" name="cookie_id3" value="<?php echo $_SESSION['cookie3']; ?>">
      
    <input class="landingpage" type="hidden" name="landingpage" value="Personal1">
    <input class="btntext" type="hidden" name="btntext" value="Place an Order">
      
    <input class="fbp" type="hidden" name="fbp" value="<?php echo $UserFBP; ?>">
    <input class="fbc" type="hidden" name="fbc" value="<?php echo $UserFBC; ?>">

    <input class="fbp" type="hidden" name="ip" value="<?php echo $userip; ?>">
    <input class="fbc" type="hidden" name="agent" value="<?php echo $userAgent; ?>">
       
          <div class="gradient mt-3 mb-3 text-start fs-1">
            Psychics use natural intuition to conduct detailed psychic readings. This “sixth sense” provides us with a deeper view into the emotional, physical, and spiritual essence of those seeking readings.<br>
            <br>
            The essence of a psychic reading is your personal development. A psychic reading doesn't provide directions, but insight.<br>
            <br>
            Do not expect a psychic to have all of the answers (but do expect a psychic to be honest when this is the case).<br>
                    When you are struggling in a particular area in life, a psychic reading can help you gain clarity.<br>
                    <br>
                    Likewise, a psychic senses unseen obstacles along your path to happiness. Most important, if you're not ready to hear the truth, then don't ask.<br>
                    A psychic is ultimately doing you a disservice if only feeding you a verbal diet of feel-goodisms.<br>
                    <br>
                    Instead, be prepared for adversity, which by conquering or overcoming it, can help you rise up to becoming a better person.<br>
          </div>

          <div class="fixed-bottom mx-auto" style="max-width:800px;">
          <button class="btn btn-primary w-100 btn-add-to-cart fw-bold fs-1" style="display:block;" type="submit" name="form_submit" value="Place an order">
          <i class="fa fa-basket-shopping"></i> Purchase - <span class="updated-price">$19.99</span>
          </button>

      

     
      <a href="/order/order-reading?skip=yes">
      <div class="nothanks w-100 rounded-3 bg-white mt-1">No, Thanks!</div>
      </a>
</div>

      </form>
                 
      <?php include $_SERVER['DOCUMENT_ROOT'].'/templates/rating/rating-upsell.php'; ?>
                  </div>
              </div>
            </div>
        
      
          </div>
          
          </div>
    </section>
</div>

<?php
$customCSSPreload = '<link rel="preload" href="/assets/css/readings.css" as="style">';
$customCSS = '<link href="/assets/css/readings.css" rel="stylesheet">';
$customJS = <<<EOT
<script src="/assets/js/infinite-ajax-scroll.min.js"></script>
<script>
      var checkboxes = $('.list-group-control input[type="checkbox"]');

      checkboxes.change(function() {
        var boxes = $('input:checked');
        var countCheckedCheckboxes = boxes.length;
        if (countCheckedCheckboxes == 1) {
          $('.updated-price').text('$19.99');
          $('.btn-add-to-cart').prop("disabled", false);
        }
        if (countCheckedCheckboxes == 2) {
          $('.updated-price').text('$29.99');
          $('.btn-add-to-cart').prop("disabled", false);
        }
        if (countCheckedCheckboxes == 3) {
          $('.updated-price').text('$39.99');
          $('.btn-add-to-cart').prop("disabled", false);
        }
        if (countCheckedCheckboxes == 4) {
          $('.updated-price').text('$49.99');
          $('.btn-add-to-cart').prop("disabled", false);
        }
        if (countCheckedCheckboxes == 0) {
            $('.updated-price').text('$0.00');
          $('.btn-add-to-cart').prop("disabled", true);
        }
      });


      $(document).ready(function(){
        let ias = new InfiniteAjaxScroll('.contents', {
            item: '.item',
            next: '.next',
            pagination: '.pagination',
            trigger: '.load-more',
            logger: false
              });

            });
    </script>
EOT;
?>