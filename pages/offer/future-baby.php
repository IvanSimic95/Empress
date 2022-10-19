<?php
#include $_SERVER['DOCUMENT_ROOT'].'/templates/noskip.php';
isset($_SESSION['userFName']) ? $fName = $_SESSION['userFName'] : $fName = "there";

$title = "Future Baby Portrait | Last Chance!"; 
$title2 = "LAST CHANCE TO GRAB IT!";
$sdescription = "Customize your order";
$description = "<b>Hey ".$fName."!</b><br><span class='text-center'> Here's a last chance to grab your future baby portrait with huge discount & express delivery!</span>";

$productID = "6";

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
                
                  
               

                  <div class="progress mt-3 col-12 offset-0 col-xl-10 offset-xl-1 mb-3" style="height: 40px; max-width:100%;margin:0 auto;">
                            <div class="progress-bar bg-warning progress-bar-striped fw-bold fs-1 progress-bar-animated" role="progressbar" style="background-color: #cf2bbd !important;width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" title="Step 2">Step 3 of 3</div>
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
                <h3 class="gradient  mb-0">Future Baby Portrait </h3>
                </div>
                  <div class="card-body col-12 offset-0" style="text-align:center;">
                  <img class="img-fluid rounded img-thumbnail" src="/assets/img/psychic.jpg" alt="upsell" style="border: none!important;padding: 0!important;">

                  <form class="readings" action="/order/order-baby" method="get" style="text-align:left;">
 
 
        <input class="cookie" type="hidden" name="cookie_id" value="<?php echo $_SESSION['cookie']; ?>">
        <input class="cookie" type="hidden" name="landingpage" value="Baby1">
        <input class="btntext" type="hidden" name="btntext" value="Place an Order">

      <div class="meta_part">

       
       
          <div class="gradient mt-3 mb-3">BONUS: You will receive this order as 12 hour priority (Express) for free!</div>
          <button class="btn btn-primary btn-shadow w-100 btn-add-to-cart mb-2 mt-2 fw-bold fs-1" style="display:block;" type="submit" name="form_submit">
          <i class="fa fa-basket-shopping"></i> Purchase - <span class="updated-price">$19.99</span>
          </button>

      
      </div>
     
      <a href="/order/order-baby?skip=yes">
      <div class="nothanks w-100 rounded-3 mb-4">No, Thanks!</div>
      </a>

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
$customCSSPreload = '<link rel="preload" href="/assets/css/baby.css" as="style">';
$customCSS = '<link href="/assets/css/baby.css" rel="stylesheet">';
$customJS = <<<EOT
<script src="/assets/js/infinite-ajax-scroll.min.js"></script>
<script>
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