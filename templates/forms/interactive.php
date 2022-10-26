<div id="form-progressbar" class="mb-2"></div>
<form class="form-order row g-0 flex-grow-2" name="order_form" action="/order/order" method="get" novalidate>
<div id="form-type-wrapper" class="alert alert-info mb-0" role="alert" style="min-height:100px;">
<span class="type-it-zero" style="min-height:200px;"></span>

<div id="welcome-form-msg">
<span class="type-it"></span>
</div>

<div id="dob-form-msg">
<span class="type-it-two"></span>
</div>

<div id="delivery-form-msg">
<span class="type-it-three"></span>
</div>

</div>
<button type="button" id="start-form-btn" class="btn btn-primary btn-shadow w-100 btn-add-to-cart mb-2 mt-2 fw-bold fs-1"> <?php echo $button; ?> </button>


<div id="final-form-msg">
<span class="type-it-four"></span>
</div>











    <div class="mb-2 mt-2 userNameWrapper">
       
        <div class="form-floating form-floating-icon mb-2">
        <input class="form-control" id="userName" type="text" name="userName" placeholder="Your Full Name" required value="<?php if(isset($_SESSION['name']))echo $_SESSION['name']; ?>"/>
        <span class="icon-inside"><i class="fas fa-user"></i></span>
        <label for="userName">Your Full Name</label>
        </div>
        <div class="form-floating form-floating-icon mb-2">
        <input class="form-control" id="userEmail" type="email" name="userEmail" placeholder="email@gmail.com" required value="<?php if(isset($_SESSION['email']))echo $_SESSION['email']; ?>"/>
        <span class="icon-inside"><i class="fas fa-envelope"></i></span>
        <label for="userEmail">Your E-mail</label>
        </div>
        <div id="error" class="mb-2"></div>
        <div id="errorEmail" class="mb-2"></div>
    </div>
    <button type="button" id="name-confirm-btn" class="btn btn-primary btn-shadow w-100 btn-add-to-cart mb-2 mt-2 fw-bold fs-1" <?php if(!isset($_SESSION['email'])){ ?>disabled<?php } ?>> Confirm!</button>

    <div class="mb-2 mt-2 userDobWrapper">
        <?php if($formDate == "US"){ ?>
        <input class="form-control" id="userDobUS" name="userDobUS" placeholder="MM/DD/YYYY" inputmode="numeric" pattern="[0-9]*" type="text" required value="<?php if(isset($_SESSION['dobUS']))echo $_SESSION['dobUS']; ?>"/>
        <div id="errorDobUS" class="mb-2"></div>
        <?php }else{ ?>
        <input class="form-control " id="userDob" name="userDob" placeholder="DD-MM-YYYY" inputmode="numeric" pattern="[0-9]*" type="text" required value="<?php if(isset($_SESSION['dob']))echo $_SESSION['dob']; ?>"/>
        <div id="errorDob" class="mb-2"></div>
        <?php } ?>
        

    </div>
    <button type="button" id="dob-confirm-btn" class="btn btn-primary btn-shadow w-100 btn-add-to-cart mb-2 mt-2 fw-bold fs-1" <?php if(!isset($_SESSION['dob'])){ ?>disabled<?php } ?>> Confirm!</button>


    <div class="mb-2 mt-2 userDeliveryWrapper">
   


<div id="delivery-speed" class="delivery-speed-clicked">
   
    
    <div class="option">
    <input type="radio" name="priority" id="prio12" value="12">
    <label for="prio12" aria-label="12 Hour Delivery" class="d-flex justify-content-start align-items-center">
    <span></span>
    <div class="p-0 delivery-icon"><i class="fas fa-bolt"></i></div>
    <div class="flex-grow-1">
    <div class="fw-bold text-dark">Express <span class="delivery">Delivery</span></div>
    <div class="fs-sm text-muted">8 - 12 <span class="hours">Hours</span><span class="h">H</span></div>
    
    </div>
    <div class="fw-bold badge bg-dark">+ $14.99</div>
    </label>
    </div>
  
    <div class="option">
    <input type="radio" name="priority" id="prio24" value="24">
    <label for="prio24" aria-label="24 Hour Delivery" class="d-flex justify-content-start align-items-center">
    <span></span>
    <div class="p-0 delivery-icon"><i class="fas fa-stopwatch"></i></div>
    <div class="flex-grow-1">
    <div class="fw-bold text-dark">Fast <span class="delivery">Delivery</span></div>
    <div class="fs-sm text-muted">18 - 24 <span class="hours">Hours</span><span class="h">H</span></div>
   
    </div>
    <div class="fw-bold badge bg-dark">+ $9.99</div>
    </label>
    </div>

    <div class="option">
    <input type="radio" name="priority" id="prio48" value="48">
    <label for="prio48" aria-label="48 Hour Delivery" class="d-flex justify-content-start align-items-center">
    <span></span>
    <div class="p-0 delivery-icon"><i class="fas fa-clock"></i></div>
    <div class="flex-grow-1">
    <div class="fw-bold text-dark">Standard <span class="delivery">Delivery</span></div>
    <div class="fs-sm text-muted">36 - 48 <span class="hours">Hours</span><span class="h">H</span></div>
    </div>
    <div class="fw-bold badge bg-dark">+ $0.00</div>
    
    </label>
    </div>

  
</div>

</div>

    </div>
    <input class="product" type="hidden" name="product" value="<?php echo $productID; ?>">
    <input class="cookie" type="hidden" name="cookie_id" value="<?php echo $_SESSION['cookie']; ?>">
    <input class="formused" type="hidden" name="formused" value="interactive">
    <input class="btncolor" type="hidden" name="btncolor" value="<?php echo $btncolor; ?>">
    <input class="countdown" type="hidden" name="countdown" value="<?php echo $countdownRandom; ?>">
    <input class="landingpage" type="hidden" name="landingpage" value="LP1">
    <input class="fbp" type="hidden" name="fbp" value="<?php echo $UserFBP; ?>">
    <input class="fbc" type="hidden" name="fbc" value="<?php echo $UserFBC; ?>">
    <input class="btntext" type="hidden" name="btntext" value="Place an Order">
    <div class="mb-1 mt-1"> <input type="submit" name="form_submit" class="btn btn-submit-form btn-primary btn-shadow w-100 btn-add-to-cart mb-1 mt-1 fw-bold fs-1" value="Place an Order"></div>



</form>

<?php if($btncolor == "green") { ?>
<style>
.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:focus, .btn-primary.active, .btn-primary.show {
  color: #fff!important;
  background-color: #00d27a!important;
  border-color: #00d27a!important;
  background-image: none!important;
  box-shadow: 0 0.5rem 1.125rem -0.5rem #00d27a!important;
}
</style>

<?php } ?>

<?php
$customJSPreload .= '
<link rel="preload" href="/min/g=interactive?v=1204" as="script">
';
$customCSS .= '
<link href="/assets/css/form-interactive.css" rel="stylesheet">
<link href="/assets/css/lightslider.css" rel="stylesheet">';
$customJS .= <<<EOT
<script src="/min/g=interactive?v=1204"></script>
<script>

$(document).ready(function(){
    fbq('track', 'ViewContent', {
        content_name: '$shorttitle Drawing', 
        content_ids: ['$retailer'],
        content_type: 'product',
        value: $price,
        currency: 'USD' 
     });       
    
    var button = document.getElementById('start-form-btn');
    button.addEventListener(
      'click', 
      function() {
         fbq('track', 'AddToCart', {
           content_name: '$shorttitle Drawing', 
           content_ids: ['$retailer'],
           content_type: 'product',
           value: $price,
           currency: 'USD' 
        });          
      },
    false
    );

var width = $(window).width();

if(width < 750) {
    $(document).scroll(function() {
        var y = $(this).scrollTop();
        if (y > 500) {
            $('#phone-navbar').slideDown();
            $('.eapps-form-floating-button').slideUp();
        
        } else {
            $('#phone-navbar').slideUp();
            $('.eapps-form-floating-button').slideDown();
    
        }
      });
  }
$('#phone-navbar > .nav-link').click(function(){    
    var divId = $(this).attr('href');
     $('html, body').animate({
      scrollTop: 0 + 150
    }, 100);
  });

  


const instance0 =  new TypeIt(".type-it-zero", {
strings: ["<span class='fw-bold'>$subtitle<\/span><br>", "Psychic Empress (通灵艺术家) is a master of astrology famous in China for being able to draw anyone's soulmate. Thousands of people have found love thanks to Artist's gift.<br>", "Answer just a few simple questions and Psychic Empress will draw you a picture of your $shorttitle"],
waitUntilVisible: true,
lifeLike: true,
loop: false,
html: true,
breakLines: true,
speed: 5, 
afterComplete: function (instance) {
instance.destroy();
$("#start-form-btn").slideToggle();
}
})

instance0.go();
});


$(window).on("load", function() {
    $('#lightSlider').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        slideMargin: 0,
        thumbItem: 6,
      controls:true,
     
    });
  })
</script>
EOT;
?>