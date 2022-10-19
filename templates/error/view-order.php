<?php 

$title = "Error 404 - Order Not Found";
$sdescription = "The Order you're looking for is not found.";
$errorPage = "404";
?>

<div class="container-fluid py-0 px-0 px-md-3 py-md-3" data-layout="container">
    <section class="py-0 overflow-hidden light" id="banner">
        <div class="container p-0">
        <div class="row flex-center min-vh-80 py-6 text-center">
          <div class="col-sm-12 col-md-12 col-lg-10 col-xxl-8 min-vh-90">
    
            <div class="card py-6">
            <div class="card-body p-4 p-sm-5">
                <div class="fw-black lh-1 text-300 fs-error">404</div>
                <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold w-md-75 w-xl-100 mx-auto">The Order you're looking for is not found!</p>
                <hr>
                <p>You can't access <b>Order #<?php echo $viewOrder; ?></b></p> <p>if you belive this is an error please contact us!</p>
                <hr>
                
                <a class="btn btn-primary btn-lg mt-3 w-100" href="/dashboard/"><span class="fas fa-home me-2"></span> Take me to dashboard</a>
              </div>
            </div>
            </div>

</div> </div>

</div>
    </section>
</div>