<?php include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/login-function.php'; ?>

<div class="container-fluid py-0 px-0 px-md-3 py-md-3" data-layout="container">
    <section class="py-0 overflow-hidden light" id="banner">
        <div class="container p-0 pt-2 p-md-3 pt-md-3">

<?php if(isset($_GET['loggedOut'])){ ?>
      <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
      <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span></div>
      <p class="mb-0 flex-1">You have logged out of your account!</p>
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
        <?php } ?>

<div class="card mb-3">
            <div class="card-body p-0">
                <div class="row g-0 h-100">
                  <div class="col-md-5 text-center topbar-gradient p-0 rounded-3">
                    <div class="position-relative p-4 pt-md-5 pb-md-7 light">
                      <div class="bg-holder bg-auth-card-shape" style="background-image:url(../../../assets/img/icons/spot-illustrations/half-circle.png);">
                      </div>
                      <!--/.bg-holder-->

                      <div class="z-index-1 position-relative"><a class="link-light mb-4 font-sans-serif fs-4 d-inline-block fw-bolder" href="#!">Dashboard</a>
                        <p class="opacity-75 text-white">Login to edit your account and see your orders!</p>
                      </div>
                    </div>
                    <div class="mt-3 mb-4 mt-md-4 mb-md-5 light">

                    <div class="avatar avatar-4xl">
                    <img class="" src="/assets/img/team/avatar.png" alt="Default Avatar" style="background: white;border-radius: 500px!important;border: 4px solid white;">
                    </div>

                      <p class="text-white">Don't have an account?<br><a class="text-decoration-underline link-light" href="/shop">Get started!</a></p>
                    </div>
                  </div>
                  <div class="col-md-7 d-flex align-items-stretch">
                    <div class="py-md-4 p-4 p-md-5 flex-grow-1 d-flex align-items-stretch flex-column">
                    
                        <div class="col-auto">
                          <h3>Account Login</h3>
                          <p class="login-error mt-3 mb-0"><?php echo $LoginError; ?></p>
                     
                      </div>
                      <form class="mt-3 mb-3 mt-md-3"  action="/dashboard?login=yes" method="POST">
                        <div class="mb-3 position-relative p-0 pt-md-3 pb-md-3">
                          <label class="form-label" for="card-email">Email address</label>
                          <input class="form-control" id="card-email" name="email" type="email">
                        </div>
                     
                        <div class="row flex-between-center">
                          <div class="col-auto">
                            <div class="form-check mb-0">
                              <input class="form-check-input" type="checkbox" id="card-checkbox" checked="checked" name="remember">
                              <label class="form-check-label mb-0" for="card-checkbox">Remember me</label>
                            </div>
                          </div>
                          <div class="col-auto d-none"><a class="fs--1" href="#forgot">Forgot Password?</a></div>
                        </div>
                        <div class="mb-3">
                          <button class="btn btn-primary btn-shadow w-100 btn-add-to-cart mb-4 mt-4 fw-bold fs-1" style="display:block!important;" type="submit" name="submit">Log in</button>
                        </div>
                      </form>
                      <!--<div class="position-relative mt-4">
                        <hr class="bg-300">
                        <div class="divider-content-center">or log in with</div>
                      </div>
                      <div class="row g-2 mt-2">
                        <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</a></div>
                        <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100" href="#"><span class="fab fa-facebook-square me-2" data-fa-transform="grow-8"></span> facebook</a></div>
                      </div>-->
                    </div>
                  </div>
                </div>
              </div>
         
          </div>

          </div>
</section>
         </div>