<?php
$title = "Contact - Support | Psychic Artist";
$sdescription = "Contact Us so we can help you!";



//SQL Query for fetching FAQ from Database
$sql = "SELECT * FROM faq ORDER BY id DESC";
$result = $conn->query($sql);
$count = $result->num_rows;


?>


<div class="container-fluid" data-layout="container" style="padding:0!important;padding-top:20px!important;">
    <section class="py-0 overflow-hidden light" id="banner">
        <div class="container p-0">

        <?php if(isset($_SESSION['loggedIn'])){ ?>
         
          
                        <div class="alert alert-info border-2 d-flex align-items-center mt-1 col-12 offset-0 col-md-10 offset-md-1 mb-0" role="alert">
                        <span class="bg-info me-3 icon-item"><span class="fas fa-info-circle text-white fs-3"></span></span>
                        <p class="mb-0 d-block">I see that you are one of our customers, I highly recommend contacting us via live chat!<br> Wanna do that now?</p><br>
                       
                        </div>
                        <a href="/dashboard/support" class="btn btn-primary d-block mb-3 mt-2 rounded-3 col-12 offset-0 col-md-10 offset-md-1" type="submit">Go to Live Chat! </a>
            <?php } ?>

        <div class="card theme-wizard mb-5 col-12 offset-0 col-md-10 offset-md-1" id="wizard">
              <div class="card-header bg-light px-3 pt-3 pb-3 px-md-5">
              <h3>Contact Us!</h3>
                  <p class="mb-0">Ran into some issues with website or perhaps you need more info about your order?</p>
              </div>
              <div class="card-body py-4 px-3">
                <div class="tab-content">
                  <div class="tab-pane active px-sm-3 px-md-5" role="tabpanel" aria-labelledby="bootstrap-wizard-tab1" id="bootstrap-wizard-tab1">
                  

                      <div class="elfsight-app-c96edf1d-ddee-4ee6-8816-19f06ec91f55"></div>


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

function fff(){
  alert(1);
  return false;
}   

$(document).ready(function(){

$("#yes" ).click(function(){
$("#yes").hide();
$("#no").hide();
$(".help-info").text("Thank you for your opinion!");
});

$("#no" ).click(function(){
$("#yes").hide();
$("#no").hide();
$(".help-info").text("Thank you for your opinion!");
});

});
</script>

EOT;
?>