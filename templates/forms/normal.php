<form id="normalproduct" class="form-order needs-validation display-block" name="order_form" action="/order/order" method="get">


        <div class="form-floating form-floating-icon mb-2">
        <input class="form-control" id="userName" type="text" name="userName" placeholder="Your Full Name" required="" value="<?php if(isset($_SESSION['name']))echo $_SESSION['name']; ?>">
        <span class="icon-inside"><i class="fas fa-user"></i> </span>
        <label for="userName">First & Last Name</label>
        </div>
        
        
       
        

        <div class="form-floating mb-2 form-floating-icon mb-3">
        <?php if($formDate == "US"){ ?>
        <input class="form-control" id="userDobUS" name="userDobUS" placeholder="MM/DD/YYYY" inputmode="numeric" pattern="[0-9]*" type="text" required value="<?php if(isset($_SESSION['dobUS']))echo $_SESSION['dobUS']; ?>"/>
        <span class="icon-inside"><i class="fa fa-clock"></i> </span>
        <label for="userDobUS">Date of Birth (MM/DD/YYYY)</label>
        <?php }else{ ?>
        <input class="form-control " id="userDob" name="userDob" placeholder="DD-MM-YYYY" inputmode="numeric" pattern="[0-9]*" type="text" required value="<?php if(isset($_SESSION['dob']))echo $_SESSION['dob']; ?>"/>
        <span class="icon-inside"><i class="fa fa-clock"></i> </span>
        <label for="userDob">Date of Birth (DD-MM-YYYY)</label>
        <?php } ?>
        </div>


  <hr class="mb-3">

        <div class="form-floating form-floating-icon">
        <input class="form-control" id="userEmail" type="email" name="userEmail" placeholder="email@gmail.com" required="" value="<?php if(isset($_SESSION['email']))echo $_SESSION['email']; ?>">
        <span class="icon-inside"><i class="fas fa-envelope"></i> </span>
        <label for="userEmail">E-mail Address</label>
        </div>


        <hr class="mb-3">
   
<div class="error-container mb-3">
<ol>
</ol>
</div>

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
    <input type="radio" name="priority" id="prio48" value="48" checked="checked">
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
      
      
            <hr class="mb-3">





    <input class="product" type="hidden" name="product" value="<?php echo $productID; ?>">
    <input class="cookie" type="hidden" name="cookie_id" value="<?php echo $_SESSION['cookie']; ?>">
    <input class="formused" type="hidden" name="formused" value="normal">
    <input class="btncolor" type="hidden" name="btncolor" value="<?php echo $btncolor; ?>">
    <input class="countdown" type="hidden" name="countdown" value="<?php echo $countdownRandom; ?>">
    <input class="landingpage" type="hidden" name="landingpage" value="LP1">

    <input class="fbp" type="hidden" name="fbp" value="<?php echo $UserFBP; ?>">
    <input class="fbc" type="hidden" name="fbc" value="<?php echo $UserFBC; ?>">

    <input class="affid" type="hidden" name="affid" value="<?php echo $affid; ?>">
    <input class="cid" type="hidden" name="cid" value="<?php echo $cid; ?>">
    <input class="subid1" type="hidden" name="subid1" value="<?php echo $subid1; ?>">
    <input class="subid2" type="hidden" name="subid2" value="<?php echo $subid2; ?>">
    

    <input class="btntext" type="hidden" name="btntext" value="Place an Order!">
    <div class="mb-2 mt-3"> 
    <button id="PlaceOrder" type="submit" name="form_submit" class="btn btn-submit-form btn-primary btn-shadow w-100 btn-add-to-cart mb-1 mt-1 fw-bold fs-2">Place an Order!</button></div>

       

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
if($formDate == "US"){
  $dobfield = "userDobUS";
  $dobmsg = "Make sure to enter your Date in MM/DD/YYYY Format!";
  $validDob = "validDOBus";
}else{ 
  $dobfield = "userDob";
  $dobmsg = "Make sure to enter your Date in DD-MM-YYYY Format!";
  $validDob = "validDOB";
} 
$customJSPreload .= '
<link rel="preload" href="/min/g=normal?v=1204" as="script">
';
$customCSS .= '<link href="/assets/css/form-normal.css" rel="stylesheet">
<link href="/assets/css/lightslider.css" rel="stylesheet">';
$customJS .= <<<EOT
<script src="/min/g=normal?v=1204"></script>

<script>
var econtainer = $(".error-container");

$(document).ready(function(){
 
  
  fbq('track', 'ViewContent', {
    content_name: '$shorttitle Drawing', 
    content_ids: ['$retailer'],
    content_type: 'product',
    value: $price,
    currency: 'USD' 
 });       

var button = document.getElementById('PlaceOrder');
button.addEventListener(
  'click', 
  function() {
     fbq('track', 'InitiateCheckout', {
       content_name: '$shorttitle Drawing', 
       content_ids: ['$retailer'],
       content_type: 'product',
       value: $price,
       currency: 'USD' 
    });          
  },
false
);
$('#userDobUS').mask('00/00/0000');
$('#userDob').mask('00-00-0000');

jQuery.validator.addMethod("validDOBus", function(value) {
    var parts = value.split(/[\/\-\.]/);

    var pmonth = parts[0];
    var pday   = parts[1];
    var pyear  = parts[2];
    
    if (parts.length < 3) {
      return false;
      console.log("invalid format");
    }


  if (pmonth < 1 || pmonth > 12){
    console.log("invalid format");
    return false;
    

  }else if (pday < 1 || pday > 31){
    console.log("day lower than 1 or higher than 31");
    return false;
    
    
  }else if ((pmonth == 4 || pmonth == 6 || pmonth == 9 || pmonth == 11) && pday == 31){
    console.log("there aren't 31 days in selected month");
    return false;
    
  }else if (pmonth == 2) {
    var isleap = (pyear % 4 == 0 && (pyear % 100 != 0 || pyear % 400 == 0));

    if (pday > 29 || (pday == 29 && !isleap)){
    console.log("leap year, that day doesn't exist in february");
    return false;
    }


  }else if (pyear < 1900 || pyear > 2010){
    console.log("too old or too young");
    return false;

  }else{
    console.log("all good");
    return true;
  }


}, "$dobmsg");


jQuery.validator.addMethod("validDOB", function(value) {
  var parts = value.split(/[\/\-\.]/);

 
  var pday   = parts[0];
  var pmonth = parts[1];
  var pyear  = parts[2];
  
  if (parts.length < 3) {
    return false;
    console.log("invalid format");
  }


if (pmonth < 1 || pmonth > 12){
  console.log("invalid format");
  return false;
  

}else if (pday < 1 || pday > 31){
  console.log("day lower than 1 or higher than 31");
  return false;
  
  
}else if ((pmonth == 4 || pmonth == 6 || pmonth == 9 || pmonth == 11) && pday == 31){
  console.log("there aren't 31 days in selected month");
  return false;
  
}else if (pmonth == 2) {
  var isleap = (pyear % 4 == 0 && (pyear % 100 != 0 || pyear % 400 == 0));

  if (pday > 29 || (pday == 29 && !isleap)){
  console.log("leap year, that day doesn't exist in february");
  return false;
  }


}else if (pyear < 1900 || pyear > 2010){
  console.log("too old or too young");
  return false;

}else{
  console.log("all good");
  return true;
}

   
}, "$dobmsg");

var formcounter = 0;

   $("#normalproduct").validate({
     success: function() {
     formcounter = formcounter +1;
    if(formcounter < 1){
      $("#email-f-input").addClass('d-none');
      $("#delivery-speed").addClass('d-none');
      console.log("count less than 1");
    }else if(formcounter == 1){
      $("#email-f-input").removeClass('d-none');
      console.log("count is 1");
    }else if(formcounter == 2){
      $("#delivery-speed").removeClass('d-none');
      console.log("count is 2");
    }else if(formcounter == 3){
      $("#submitbtnwrap").removeClass('d-none');
      console.log("count is 3");
    }
    },
    submitHandler: function(form){
    $("#PlaceOrder").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...')
    form.submit();
    },

    rules: {
      userName: "required",

      userEmail: {
      required: true,
      email: true
      },

      $dobfield: {
        $validDob: "$dobmsg",
        }

    },
    messages: {
      userName: "Please enter your First & Last name!",

      userEmail: {
        required: "Please enter your email address!",
      },

      $dobfield: {
        required: "Please enter your Date of Birth!",
        $validDob: "$dobmsg",
      }
    },
  
    errorContainer: $(".error-container"),
		errorLabelContainer: $("ol", econtainer),
		wrapper: 'li'
  } );

var width = $(window).width();

if(width < 750) {
    $(document).scroll(function() {
        var y = $(this).scrollTop();
        if (y > 500) {
            $('#phone-navbar').slideDown();
        
        } else {
            $('#phone-navbar').slideUp();
    
        }
      });
  }
$('#phone-navbar > .nav-link').click(function(){    
    var divId = $(this).attr('href');
     $('html, body').animate({
      scrollTop: 0 + 150
    }, 100);
  });

  
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