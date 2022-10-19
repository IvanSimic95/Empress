<?php
$title = "Error 404 - Page Not Found";
$sdescription = "The page you're looking for is not found.";
$errorPage = "404";
 
ob_start();
$customJSPreload = $customCSS = "";
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/templates/header.php'; 


$buffer=ob_get_contents();
ob_end_clean();

$buffer=str_replace("%TITLE%",$title,$buffer);
$buffer=str_replace("%DESCRIPTION%",$sdescription,$buffer);
$buffer=str_replace("%LOGO%",$webLogo,$buffer);
$buffer=str_replace("%PIMAGE%",$pimage,$buffer);
echo $buffer;
http_response_code(404);
?>
<style>.breadcrumbs-nav{display:none!important;}</style>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container" data-layout="container">
        <div class="row flex-center min-vh-80 py-6 text-center">
          <div class="col-sm-12 col-md-12 col-lg-10 col-xxl-8 min-vh-90">
            <div class="card py-6">
            <div class="card-body p-4 p-sm-5">
                <div class="fw-black lh-1 text-300 fs-error">404</div>
                <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold w-md-75 w-xl-100 mx-auto">The page you're looking for is not found.</p>
                <hr>
                <i><?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?></i>
                <hr>
                <p>Make sure the address is correct and that the page hasn't moved. </p>
                <a class="btn btn-primary btn-lg mt-3" href="/"><span class="fas fa-home me-2"></span> Take me home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->