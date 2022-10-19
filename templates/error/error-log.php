

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container" data-layout="container">
        <div class="row flex-center min-vh-80 py-6 text-center">
          <div class="col-sm-12 col-md-12 col-lg-10 col-xxl-8 min-vh-90">
            <div class="card py-6">
            <div class="card-body p-4 p-sm-5">
                <div class="fw-bold display-4"><?php echo $titlePage; ?></div>
                <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold w-md-75 w-xl-100 mx-auto"><?php echo $sdescription; ?></p>
                <hr>
                Error ID: 
                <i><?php echo $errorID ?></i>
                <hr>
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