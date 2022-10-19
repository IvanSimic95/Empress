$(document).ready(function(){

  $("input#userEmail").verimail({
    messageElement: "#errorEmail"
});

  const instance0 =  new TypeIt(".type-it-zero", {
    strings: ["<span class='fw-bold'>Ready to meet your soulmate?</span><br>", "Psychic Artist (通灵艺术家) is a master of astrology famous in China for being able to draw anyone's soulmate. Thousands of people have found love thanks to Artist's gift.<br>", "Answer just a few simple questions and Psychic Artist will draw you a picture of your soulmate."],
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

  const instance =  new TypeIt(".type-it", {
    strings: ["<strong>Great!</strong> All you need to do now is answer 3 easy questions", "<hr>#1 - <b>What is your Name & Email?</b>"],
    waitUntilVisible: true,
    lifeLike: true,
    loop: false,
    html: true,
    breakLines: true,
    speed: 5,
    afterComplete: function (instance) {
      instance.destroy();
      $(".userNameWrapper").slideToggle();
      $("#name-confirm-btn").slideToggle();

    }
  })


  








  const instance3 =  new TypeIt(".type-it-three", {
    strings: ["<strong>Almost There</strong>, only 1 more step to go!", "<hr>#3 - <b>What Order Delivery Priority do you wish?</b>"],
    waitUntilVisible: true,
    lifeLike: true,
    loop: false,
    html: true,
    breakLines: true,
    speed: 5,
    afterComplete: function (instance) {
      instance.destroy();
      $(".userDeliveryWrapper").slideToggle();
      $('#deliveryCollapse').collapse('show');
 
    }
  })

  const instance4 =  new TypeIt(".type-it-four", {
    strings: ["<div class=\"alert alert-success mb-0\" role=\"alert\"><strong>Well Done!</strong> We saved your data & prepared an order for you.<br> You can continue to payment page by clicking button below.</div>"],
    waitUntilVisible: true,
    lifeLike: true,
    loop: false,
    html: true,
    breakLines: true,
    speed: 5,
    afterComplete: function (instance) {
      instance.destroy();

    }
  })

  instance0.go();

var scrollSpy = new bootstrap.ScrollSpy(document.body, {
    target: '#product-nav'
  })

  $("#start-form-btn").click(function(){
    $('.type-it-zero').fadeToggle();//Hide Start Message
    $('.pr-avail-wrap').fadeToggle();//Hide Side badge
    $("#start-form-btn").fadeToggle(); //Hide Start Button
    $("#welcome-form-msg").slideToggle();//Show Welcome message after starting Form
    instance.go(); //Start next part of text


  });

  $(document).ready(function(){
    var $regexname=/^([A-Za-z\s]{3,24})$/;
    $('#userName').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
          // If username is too long
          $("#error").html("<div class='alert alert-danger border-2 d-flex align-items-center' role='alert'><p class='mb-0 flex-1'>Your name is invalid, make sure to use only letters and spaces!</p></div>");
          $("#userName").addClass("is-invalid");
          $("#userName").removeClass("is-valid");
          $("#name-confirm-btn").prop("disabled", true);
             }
           else{

            if($("#userEmail").getVerimailStatus() < 0){
              $("#name-confirm-btn").prop("disabled", true);
              $("#userEmail").removeClass("is-valid");
              $("#userEmail").addClass("is-invalid");
          }else{
            $("#name-confirm-btn").prop("disabled", false);
            $("#userEmail").addClass("is-valid");
            $("#userEmail").removeClass("is-invalid");
            
            
          }

          if($("#userEmail").val().length == 0)
          {
            $("#name-confirm-btn").prop("disabled", true);
            $("#userEmail").removeClass("is-valid");
            $("#userEmail").addClass("is-invalid");
          }else   {


          $("#name-confirm-btn").prop("disabled", false);
          $("#userEmail").removeClass("is-invalid");
          $("#userEmail").addClass("is-valid");
        }

        $("#name-confirm-btn").prop("disabled", false);
        $("#error").html("");
        $("#userName").addClass("is-valid");
        $("#userName").removeClass("is-invalid");

               }
         });
});

$(document).ready(function(){
  $('#userEmail').on('keypress keydown keyup',function(){

    if($("#userEmail").getVerimailStatus() < 0){
      $("#name-confirm-btn").prop("disabled", true);
      $("#userEmail").removeClass("is-valid");
      $("#userEmail").addClass("is-invalid");
  }else{
    $("#name-confirm-btn").prop("disabled", false);
    $("#userEmail").removeClass("is-invalid");
    $("#userEmail").addClass("is-valid");
}
});

});

$("#name-confirm-btn").click(function(){
  
  
          const userName = $("#userName").val();
           const instance2 =  new TypeIt(".type-it-two", {
             strings: ["Nice to meet you <span style='text-transform:capitalize';>"+ userName + "</span>!", "<hr>#2 - <b>What is your Date of Birth?</b>"],
             waitUntilVisible: true,
             lifeLike: true,
             loop: false,
             html: true,
             breakLines: true,
             speed: 35,
             afterComplete: function (instance) {
               instance.destroy();
               $(".userDobWrapper").slideToggle();
               $("#dob-confirm-btn").slideToggle();
               
             }
           })
          
 $("#welcome-form-msg").fadeToggle();//Show Welcome message after starting Form
 $(".userNameWrapper").fadeToggle();//Show Welcome message after starting Form
 $("#name-confirm-btn").fadeToggle();//Show Welcome message after starting Form

  $("#dob-form-msg").slideToggle(); //Hide Start Button
  
  instance2.go(); //Start next part of text

});
  
  $('.show-offer').on('click', function(e) {
    $(".offer-sider").slideToggle();
    $(".more-offer").fadeToggle();
    $(".less-offer").fadeToggle();   
  });

jQuery('input[name="priority"]').change(function(){
    if (this.value == '12') {
    jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$49.99').animate({'opacity': 1}, 200);});
		jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$499.99').animate({'opacity': 1}, 300);});
		jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$450 (90%)').animate({'opacity': 1}, 400);});	
    }
    if (this.value == '24') {
		jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$39.99').animate({'opacity': 1}, 200);});
		jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$399.99').animate({'opacity': 1}, 300);});
		jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$360 (90%)').animate({'opacity': 1}, 400);});
    }
    if (this.value == '48') {
		jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$29.99').animate({'opacity': 1}, 200);});
		jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$299.99').animate({'opacity': 1}, 300);});
		jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$270 (90%)').animate({'opacity': 1}, 400);});
    }
})

$("#dob-confirm-btn").click(function(){
  
  $("#dob-form-msg").fadeToggle(); //Hide Start Button
  $("#dob-confirm-btn").fadeToggle(); //Hide Start Button
  $(".userDobWrapper").fadeToggle();
   $("#delivery-form-msg").slideToggle(); //Hide Start Button
   instance3.go(); //Start next part of text
});

$("#helper-delivery-express").click(function(){
    $("#prio12").prop("checked", true);
    jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$49.99').animate({'opacity': 1}, 200);});
		jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$499.99').animate({'opacity': 1}, 300);});
		jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$450 (90%)').animate({'opacity': 1}, 400);});	
});

$("#helper-delivery-fast").click(function(){
    $("#prio24").prop("checked", true);
    jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$39.99').animate({'opacity': 1}, 200);});
		jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$399.99').animate({'opacity': 1}, 300);});
		jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$360 (90%)').animate({'opacity': 1}, 400);});
});

$("#helper-delivery-standard").click(function(){
    $("#prio48").prop("checked", true);
    jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$29.99').animate({'opacity': 1}, 200);});
		jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$299.99').animate({'opacity': 1}, 300);});
		jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$270 (90%)').animate({'opacity': 1}, 400);});
});


$("#close-deliveryCollapse").click(function(){
  $('#deliveryCollapse').collapse('hide');
});


$(document).ready(function() {
  $('#delivery-speed').one('click', function(e){
    $('#deliveryCollapse').collapse('hide');
    $("#delivery-form-msg").fadeToggle();
    $("#form-type-wrapper").fadeToggle();
    $("#final-form-msg").slideToggle();
    $(".btn-submit-form").slideToggle();
    $(".btn-submit-form").addClass("add-to-cart-flash");
    instance4.go();

  });
});




 
$('#userDob').mask('00-00-0000', {onComplete: function(cep) {
  
  var dateFrom = "01-01-1930";
  var dateTo = "31-12-2008";
  var dateCheck = cep;
  
  var d1 = dateFrom.split("-");
  var d2 = dateTo.split("-");
  var c = dateCheck.split("-");
  
  var from = new Date(d1[2], parseInt(d1[1])-1, d1[0]);  // -1 because months are from 0 to 11
  var to   = new Date(d2[2], parseInt(d2[1])-1, d2[0]);
  var check = new Date(c[2], parseInt(c[1])-1, c[0]);
  
  var final = check > from && check < to;
  if (final)
  {
      $("#errorDob").html("");
      $("#userDob").addClass("is-valid");
      $("#userDob").removeClass("is-invalid");
  
      var userval = $("#userName").hasClass("is-valid");
      var dateval = $("#userDob").hasClass("is-valid");
      if(userval && dateval){
          $(".form-order").addClass("is-validated");
          $(".form-order").removeClass("needs-validation");
      }

      $("#dob-confirm-btn").prop("disabled", false);

     
  }else{
      $("#errorDob").html("<div class='alert alert-danger border-2 d-flex align-items-center' role='alert'><p class='mb-0 flex-1'><b>Invalid Date:</b> Make sure to enter your Date in DD-MM-YYYY Format!</p></div>");  
      $("#userDob").addClass("is-invalid");
      $("#userDob").removeClass("is-valid");
      $("#dob-confirm-btn").prop("disabled", true);
  }
            },
             onKeyPress: function(cep, event, currentField, options){
              
            },
            onInvalid: function(val, e, field, invalid, options){
              $("#errorDob").html("You can only enter numbers for your Date of Birth");  
            }
          });

  


});