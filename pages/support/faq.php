<?php
$title = "FAQ - Support | Psychic Artist";
$sdescription = "FAQ Description";

//SQL Query for fetching FAQ from Database
$sql = "SELECT * FROM faq ORDER BY id DESC";
$result = $conn->query($sql);
$count = $result->num_rows;



?>


<div class="container-fluid" data-layout="container" style="padding:0!important;padding-top:50px!important;">
    <section class="py-0 overflow-hidden light" id="banner">
        <div class="container">

            <div class="card mb-3">
            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(/assets/img/icons/spot-illustrations/corner-4.png);"></div>
            <!--/.bg-holder-->
            <div class="card-body position-relative">
              <div class="row">
                <div class="col-lg-8">
                  <h3>Frequently Asked Questions</h3>
                  <p class="mb-0">Below you'll find answers to the questions we get asked the most about our services & website</p>
                </div>
              </div>
            </div>
            </div>


            <div class="card mb-3">
            <div class="card-body">

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

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
  <?php echo $FAQschema; ?>
  ]
}
</script>
              
              </div>
            <div class="card-footer d-flex align-items-center bg-light">
              <h5 class="d-inline-block me-3 mb-0 fs--1 help-info">Was this information helpful?</h5><button id="yes" class="btn btn-falcon-default btn-sm">Yes</button><button id="no" class="btn btn-falcon-default btn-sm ms-2">No</button>
            </div>
          </div>
        </div>
    </section>
</div>
<?php
$customJS = <<<EOT
<script>
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