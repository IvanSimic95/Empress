$(document).ready(function(){
  
  
    window.setTimeout(function() {
    $(".product-badge-bestselling").toggleClass("product-badge-hover");
    }, 1500);

    window.setTimeout(function() {
    $(".product-badge-bestselling").toggleClass("product-badge-hover");
    $(".product-badge-toprated").toggleClass("product-badge-hover");
    }, 2500);

    window.setTimeout(function() {
    $(".product-badge-trending").toggleClass("product-badge-hover");
    $(".product-badge-toprated").toggleClass("product-badge-hover");
    }, 3500);

    window.setTimeout(function() {
    $(".product-badge-trending").toggleClass("product-badge-hover");
    $(".product-badge-new").toggleClass("product-badge-hover");
    }, 4250);

    window.setTimeout(function() {
    $(".product-badge-new").toggleClass("product-badge-hover");
    }, 5000);

    let ias = new InfiniteAjaxScroll('.contents', {
        item: '.item',
        next: '.next',
        pagination: '.pagination',
        trigger: '.load-more',
        logger: false
          });
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
      target: '#product-nav'
    })
  
    $("#start-form-btn").click(function(){
      $('.type-it-zero').fadeToggle();//Hide Start Message
      $('.pr-avail-wrap').fadeToggle();//Hide Side badge
      $("#start-form-btn").fadeToggle(); //Hide Start Button
      $("#welcome-form-msg").slideToggle();//Show Welcome message after starting Form
      instance.go(); //Start next part of text
      bar.animate(0.25); 
  
  
    });
  

    var regexname=/^([A-Za-z\s]{3,24})$/;
    $('#userName').on('keypress keydown keyup',function(){
            if (!$(this).val().match(regexname)) {
              // If username is too long
            $("#error").html("<div class='alert alert-danger border-2 d-flex align-items-center' role='alert'><p class='mb-0 flex-1'>Your name is invalid, make sure to use only letters and spaces!</p></div>");
            $("#userName").addClass("is-invalid");
            $("#userName").removeClass("is-valid");
            }else{
            $("#error").html("");
            $("#userName").addClass("is-valid");
            $("#userName").removeClass("is-invalid");
          }
    });

    $('#userEmail').on('keypress keydown keyup',function(){

        
        $("#userEmail").removeClass("is-valid");
        $("#userEmail").addClass("is-invalid");
     
        

    });
  
  
  
  $('#userDobUS').mask('00/00/0000', {onComplete: function(cepUS) {
    
    var dateFrom = "01/01/1930";
    var dateTo = "12/31/2008";
    var dateCheck = cepUS;
    
    var d1 = dateFrom.split("/");
    var d2 = dateTo.split("/");
    var c = dateCheck.split("/");
    
    var from = new Date(d1[2], parseInt(d1[1])-1, d1[0]);  // -1 because months are from 0 to 11
    var to   = new Date(d2[2], parseInt(d2[1])-1, d2[0]);
    var check = new Date(c[2], parseInt(c[1])-1, c[0]);
    
    var final = check > from && check < to;
    if (final){
        $("#errorDob").html("");
        $("#userDobUS").addClass("is-valid");
        $("#userDobUS").removeClass("is-invalid");
    
        var userval = $("#userName").hasClass("is-valid");
        var dateval = $("#userDobUS").hasClass("is-valid");

        if(userval && dateval){
        $(".form-order").addClass("is-validated");
        $(".form-order").removeClass("needs-validation");
        }

        $("#dob-confirm-btn").prop("disabled", false);
    }else{
        $("#errorDobUS").html("<div class='alert alert-danger border-2 d-flex align-items-center' role='alert'><p class='mb-0 flex-1'><b>Invalid Date:</b> Make sure to enter your Date in MM/DD/YYYY Format!</p></div>");  
        $("#userDobUS").addClass("is-invalid");
        $("#userDobUS").removeClass("is-valid");
        $("#dob-confirm-btn").prop("disabled", true);
    }
              },
               onKeyPress: function(cepUS, event, currentField, options){
                
              },
              onInvalid: function(val, e, field, invalid, options){
                $("#errorDob").html("You can only enter numbers for your Date of Birth");  
              }
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
 

    var bar = new ProgressBar.Line("#form-progressbar", {
            strokeWidth: 4,
            easing: 'easeInOut',
            duration: 1400,
            color: 'rgba(255, 105, 180, 1)',
            trailColor: 'none',
            trailWidth: 10,
            svgStyle: {width: '100%', height: '6px', position:'absolute', top:'0', left: '0'}
    });

    $("#helper-delivery-express").click(function(){
          $("#prio12").prop("checked", true);
          jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$44.99').animate({'opacity': 1}, 200);});
          jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$449.99').animate({'opacity': 1}, 300);});
          jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$400').animate({'opacity': 1}, 400);});	
  });
  
  $("#helper-delivery-fast").click(function(){
          $("#prio24").prop("checked", true);
          jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$39.99').animate({'opacity': 1}, 200);});
          jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$399.99').animate({'opacity': 1}, 300);});
          jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$360').animate({'opacity': 1}, 400);});
  });
  
  $("#helper-delivery-standard").click(function(){
          $("#prio48").prop("checked", true);
          jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$29.99').animate({'opacity': 1}, 200);});
          jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$299.99').animate({'opacity': 1}, 300);});
          jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$270').animate({'opacity': 1}, 400);});
  });
  
  
   
  $("#close-deliveryCollapse").click(function(){
    $('#deliveryCollapse').collapse('hide');
  });
  

    $('#delivery-speed').one('click', function(e){
      $('#deliveryCollapse').collapse('hide');
    });

    $('#deliveryCollapse').one('click', function(e){
      $('#deliveryCollapse').collapse('hide');
    });

    


  jQuery('input[name="priority"]').change(function(){
    if (this.value == '12') {
        jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$44.99').animate({'opacity': 1}, 200);});
        jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$449.99').animate({'opacity': 1}, 300);});
        jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$400').animate({'opacity': 1}, 400);});	
    }
    if (this.value == '24') {
        jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$39.99').animate({'opacity': 1}, 200);});
        jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$399.99').animate({'opacity': 1}, 300);});
        jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$360').animate({'opacity': 1}, 400);});
    }
    if (this.value == '48') {
        jQuery('.new_prce').animate({'opacity' : 0}, 200, function(){jQuery('.new_prce').html('$29.99').animate({'opacity': 1}, 200);});
        jQuery('.old_price del').animate({'opacity' : 0}, 300, function(){jQuery('.old_price del').html('$299.99').animate({'opacity': 1}, 300);});
        jQuery('.saveda').animate({'opacity' : 0}, 400, function(){jQuery('.saveda').html('$270').animate({'opacity': 1}, 400);});
    }
})
  

});