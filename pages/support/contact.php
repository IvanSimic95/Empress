<?php
$title = "Contact - Support | Psychic Empress";
$sdescription = "Contact Us so we can help you!";



//SQL Query for fetching FAQ from Database
$sql = "SELECT * FROM faq ORDER BY id DESC";
$result = $conn->query($sql);
$count = $result->num_rows;


?>


<div class="container-fluid" data-layout="container" style="padding:0!important;padding-top:20px!important;">
    <section class="py-0 overflow-hidden light" id="banner">
        <div class="container p-0">



        <div class="card theme-wizard mb-5 col-12 offset-0 col-md-10 offset-md-1" id="wizard">
              <div class="card-header bg-light px-3 pt-3 pb-3 px-md-5">
              <h3>Contact Us!</h3>
                  <p class="mb-0">Ran into some issues with website or perhaps you need more info about your order?</p>
              </div>
              <div class="card-body py-4 px-3">
                <div class="tab-content">
                  <div class="tab-pane active px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-tab1" id="bootstrap-wizard-tab1">
                  

                  <form id="ajax-form" class="form-support" name="support_form" action="javascript:void(0)" method="post">

<div class="form-floating mb-3">
<select class="form-select" name="category" id="floatingSelect" aria-label="Floating label select example">
    <option value="1"  selected="">General Question</option>
    <option value="2">Payment</option>
    <option value="3">Order</option>
    <option value="4">User Profile</option>
    <option value="4">Feedback</option>
</select>
<label for="floatingSelect"  style="left:0px;">What can we help you with? *</label>
</div>

<div class="form-floating mb-3">
<input class="form-control" id="emailInput" type="email" placeholder="name@example.com" name="email" value="<?php if(isset($_SESSION['email']))echo $_SESSION['email']; ?>" />
<label for="floatingInputValid" style="left:0px;">Your Email Address</label>
</div>

<div class="form-floating mb-3">
<input class="form-control" id="orderid" type="number" placeholder="738125" name="orderid" value="" />
<label for="floatingInputValid" style="left:0px;">Your Order Number (You can find it in purchase email)</label>
</div>


<div class="form-floating mb-3">
<textarea class="form-control" id="floatingTextarea2" placeholder="Description here" style="height: 100px" name="message"></textarea>
<label for="floatingTextarea2"  style="left:0px;">Description of the issue</label>
</div>

<button id="submitbtn" type="submit" name="form_submit" style="display:block;" class="btn btn-submit-form btn-primary btn-shadow w-100 btn-add-to-cart mb-1 mt-1 fw-bold fs-2">Submit support request!</button></div>

    </form>
    <div id="success-msg" style="display:none;" class="">
                        <div class="alert alert-success border-2 d-flex align-items-center mt-1" role="alert">
                        <div class="bg-success me-3 icon-item d-none d-sm-flex"><span class="fas fa-info-circle text-white fs-3"></span></div>
                        <p class="mb-0 flex-1">Support Request Sent!</p>
                        </div>

                  <!--
                  <form name="contact_form" action="" method="post">

            <div class="form-group mb-3"><input class="form-control" type="text" name="name" placeholder="Name"></div>
            <div class="form-group mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group mb-3"><textarea class="form-control" style="height: 250px;" rows="24" name="message" placeholder="Message"></textarea></div>
            <div class="form-group mb-3"><button class="btn btn-primary w-100" type="submit">send </button></div>
                    </form>
        -->

                  </div>
                </div>
              </div>
             
            </div>

            <div class="card theme-wizard mb-5 col-12 offset-0 col-md-10 offset-md-1" id="wizard">
              <div class="card-header bg-light px-3 pt-3 pb-3 px-md-5">
              <h3>Frequently Asked Questions</h3>
                  <p class="mb-0">Make sure to go through these because in most cases they help you instantly!</p>
              </div>
              <div class="card-body py-4 px-0">
                <div class="tab-content">
                  <div class="tab-pane active px-3 px-md-2" role="tabpanel" aria-labelledby="bootstrap-wizard-tab1" id="bootstrap-wizard-tab1">
                  <?php
            
            if($result->num_rows != 0) {

            $FAQschema = "";
            $countFAQ = $result->num_rows;
            $countLoop = "1";

                while($row = $result->fetch_assoc()) {
                echo '<h6 style="font-weight:bold;color: #2c7be5;"> <i class="fas fa-question-circle"></i> '.$row["question"].'</h6><p class="fs--1 mb-0"><i class="fas fa-info-circle"></i> '.$row["answer"].'</p><hr class="my-3">';
                
                if($countLoop == $countFAQ){//Last loop
                  $FAQschema .= '
                  {
                  "@type": "Question",
                  "name": "'.$row["question"].'",
                  "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "'.$row["answer"].'"
                  }
                  }';
                }else{
                $FAQschema .= '
                  {
                  "@type": "Question",
                  "name": "'.$row["question"].'",
                  "acceptedAnswer": {
                  "@type": "Answer",
                  "text": "'.$row["answer"].'"
                  }
                  }, ';
                }
                  $countLoop++;
                }
                } else {
                    echo "No FAQ";
                }
                  $conn->close();
                ?>

                  </div>
                </div>
              </div>
             
            </div>
        </div>


     
        </div>
    </section>
</div>

<?php
$customJS = <<<EOT
<script src="/vendors/lottie/lottie.min.js"></script>
<script>
var selectElement = $("#floatingSelect");
var order = $("#orderid");
order.hide();

$("#floatingSelect").on("change", function(){
    var selectedClass = this.value;

    if(selectedClass == "order"){
      order.show();

    };
});
</script>
<script>


        $(document).ready(function($){



     
        // hide messages 
        $("#error").hide();
        $("#success-msg").hide();
        $("#show_message").hide();
     
        // on submit...
        $('#ajax-form').submit(function(e){
     
            e.preventDefault();
     
            $("#error").hide();
            $("#submitbtn").html('<i class="fas fa-spinner fa-pulse"></i> Loading...');
            $("#submitbtn").prop('disabled', true);

            // ajax
            $.ajax({
                type:"POST",
                url: "/ajax/contact.php",
                dataType: 'json',
                data: $(this).serialize(),
                success: function(data){
                  var SubmitStatus = data[0];
                  var DataMSG = data[1];
     
                  if (SubmitStatus == "Success"){
                  var Redirect = data[2];
                  $("#show_message").html(DataMSG);
                  $("#show_message").fadeIn();
                  $("#submitbtn").html('<i class="fas fa-spinner fa-pulse"></i> Loading...');
                  
                  setTimeout(function(){
                    $('#ajax-form').hide();
                    $('#success-msg').show();
                    $("#submitbtn").hide();
                    $("#welcome-msg").hide();
                    
                  }, 2000);

                  }else{
                  $("#error").html(DataMSG);
                  $("#error").fadeIn();
                  $("#submitbtn").html("Error Occured!");
                  }

                }
            });
        });  
     
        return false;
    });


</script>

EOT;
?>