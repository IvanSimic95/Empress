<?php 
$title = "Order Error";
$sdescription = "There was an error while placing your order, please try again!";
ob_start();
include $_SERVER['DOCUMENT_ROOT'].'/templates/header.php'; 

$buffer=ob_get_contents();
ob_end_clean();


$buffer=str_replace("%TITLE%",$title,$buffer);
$buffer=str_replace("%DESCRIPTION%",$sdescription,$buffer);
$buffer=str_replace("%LOGO%",$webLogo,$buffer);
$buffer=str_replace("%PIMAGE%",$pimage,$buffer);
echo $buffer;
?>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container" data-layout="container">
        <div class="row flex-center min-vh-80 py-6 text-center">
          <div class="col-sm-12 col-md-12 col-lg-10 col-xxl-8 min-vh-90">
            <div class="card py-6">
            <div class="card-body p-4 p-sm-5">
                <div class="fw-black display-1"><?php echo $title; ?></div>
                <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold w-md-75 w-xl-100 mx-auto"><?php echo $sdescription; ?></p>
                <hr>
                Error ID: 
                <i><?php echo $errorID ?></i>
                <hr>
                <p><?php echo $errorDisplay ?> </p>
                <a class="btn btn-primary btn-lg mt-3" onclick="history.back()">
                <span class="fas fa-arrow-left me-2"></span> Back to Previous Page!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <?php include $_SERVER['DOCUMENT_ROOT'].'/templates/footer.php';  ?>