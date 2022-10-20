<?php debug_backtrace() || include $_SERVER['DOCUMENT_ROOT'].'/templates/error/403.php'; ?>

<?php // include $_SERVER['DOCUMENT_ROOT'].'/templates/chat.php'; ?>
<?php // include $_SERVER['DOCUMENT_ROOT'].'/templates/bublbes.php'; ?>
</main>

<footer class="footer bg-dark pt-4">
      <section class="p-3 p-md-4 p-lg-5">
        <div class="container">
        
          <div class="row">
            <div class="col-lg-4">
              <div data-v-5c7d699b="" class="logo-footer"><?php include $_SERVER['DOCUMENT_ROOT'].'/templates/logo.php'; ?></div>
              <p class="text-white">Born psychic with an extrasensory perception capable of uniting with your energy and reading the hidden meanings and upcoming events predestined by the Universe. In the process, I will find out a lot about your soulmate, good and bad, his nature, his inner willingness to finally meet you.</p>
              
            </div>
            <div class="col ps-lg-6 ps-xl-8">
              <div class="row mt-5 mt-lg-0">
                <div class="col-6 col-md-4">
                  <p class="h5 text-uppercase text-white opacity-85 mb-3">Quick Links</p>
                  <ul class="list-unstyled">
                    <li class="mb-1"><a class="link-white" href="/"><i class="fas fa-home"></i> Home</a></li>
                    <li class="mb-1"><a class="link-white" href="/shop"><i class="fas fa-shopping-basket"></i> Shop</a></li>
                    <li class="mb-1"><a class="link-white" href="/support/faq"><i class="fas fa-question-circle"></i> FAQ</a></li>
                    <li class="mb-1"><a class="link-white" href="/support/contact"><i class="fas fa-life-ring"></i> Contact Us</a></li>
                    <li class="mb-1"><a class="link-white" href="/dashboard"><i class="fas fa-shipping-fast"></i> Order Status</a></li>
                    
                    
                  </ul>
                </div>
                <div class="col-6 col-md-4">
                  <p class="h5 text-uppercase text-white opacity-85 mb-3">Legal</p>
                  <ul class="list-unstyled">
                  <li class="mb-1"><a class="link-white" href="/legal/terms-of-service"><i class="fa fa-gavel"></i> Terms of Service</a>
                  <li class="mb-1"><a class="link-white" href="/legal/privacy-policy"><i class="fa fa-gavel"></i> Privacy Policy</a>
                  <li class="mb-1"><a class="link-white" href="/legal/dmca"><i class="fa fa-gavel"></i> DMCA</a>
                  <li class="mb-1"><a class="link-white" href="/legal/refund-policy"><i class="fa fa-gavel"></i> Refund Policy</a>
                  <li class="mb-1"><a class="link-white" href="/legal/facebook-policy"><i class="fa fa-gavel"></i> Facebook Policy</a>
                  </ul>
                </div>
                
              </div>
            </div>
          </div>
        </div><!-- end of .container-->
      </section>

      <section class="bg-dark-two py-0 light">
        <div>
          <hr class="my-0 text-white opacity-25">
          <div class="container py-3">
            <div class="row justify-content-between fs--1">
              <div class="col-12 col-md-6 text-center text-md-start">
                <p class="mb-0 text-white opacity-85">© 2022 Psychic Empress All Rights Reserved</p>
              </div>
              <div class="col-12 col-md-6 text-end d-none	d-sm-none d-md-block">
                <p class="mb-0 text-white opacity-85">v<?php echo $webVersion; ?></p>
              </div>
            </div>
          </div>
        </div><!-- end of .container-->
      </section>
  </footer>     

<!--CHATPOPUP-->
<div class="offcanvas offcanvas-end" id="contact-popup" tabindex="-1" aria-labelledby="offcanvasExampleLabel" style="z-index: 99999 !important;">
  <div class="offcanvas-header topbar-gradient">
    <h5 class="offcanvas-title text-white" id="contact-popupLabel">Contact Us</h5>
    <button class="btn-close btn-close-white" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body px-4 py-0" id="offcanvas-bddy-h">
    
  <?php if(isset($_SESSION['loggedIn'])){ ?>
  <!-- container element in which TalkJS will display a chat UI -->
  <div id="result"></div>

  <?php }else{ ?>
  <div class="elfsight-app-c96edf1d-ddee-4ee6-8816-19f06ec91f55"></div>
  <?php }?>
  </div>
</div>




    <?php include $_SERVER['DOCUMENT_ROOT'].'/templates/fb.php'; ?>
    <!-- ===============================================-->
    <!--   Footer JavaScripts-->
    <!-- ===============================================-->
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script defer="defer" src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="/assets/js/comb1.js"></script>
    <script defer="defer" src="/assets/js/comb2.js"></script>
    <script defer="defer" src="/assets/js/fa.js"></script>
    <script defer="defer" src="/assets/js/menuv3.js?v=1204"></script>



    <!-- ===============================================-->
    <!--   Elfsight jQuery Plugins -->
    <!-- ===============================================-->
    <script src="https://apps.elfsight.com/p/platform.js" defer></script>

    <!--  Visitor Stats Widget -->
    <!--<div class="elfsight-app-e5581c30-8361-43d6-9323-37dd59142295"></div>-->

    <!-- ===============================================-->
    <!--   CrowdPower Script
   
    <cp-root></cp-root>
    <script src="https://tag.crowdpower.io/js/app.js"></script>
    
     ===============================================-->


    <!-- ===============================================-->
    <!--    TalkJS Start When Logged in   -->
    <!-- ===============================================-->
   
    <!--TALKJSSTART-->
    <?php echo $TalkJS; ?>

    <!-- ===============================================-->
    <!--   Custom Page JavaScripts & CSS -->
    <!-- ===============================================-->
    <?php echo $customJS; ?>
    



    <!-- ===============================================-->
    <!--   General Custom JS Scripts & Functions -->
    <!-- ===============================================-->

  

<script>
   var width = $(window).width();
      if(width < 750) {
  $(document).scroll(function() {
      var y = $(this).scrollTop();
      if (y > 500) {
          $('#phone-main-navbar').slideDown();
      } else {
          $('#phone-main-navbar').slideUp();
      }
    });
}


$(document).ready(function($) {
     
$("#eapps-form-2").hide();
$("#offcanvas-bddy-h").hide();



$("#contact-popup").on("hide.bs.offcanvas", function () { 
  $("#eapps-form-2").hide();
  $("#offcanvas-bddy-h").hide();
});

$("#contact-popup").on("show.bs.offcanvas", function () { 
  $("#eapps-form-2").show();
  $("#offcanvas-bddy-h").show();
});

var preloader = $('.preloader');
preloader.addClass('loader-activate') 
});

 // no need to specify document ready
      $(window).on('load', function(){
      $('.preloader').fadeOut();
      $('.preloader').removeClass('loader-activate');
      $('.preloader').addClass('loader-deactivate');
      $(".eapps-form-floating-button-visible").removeClass("eapps-form-floating-button-visible");
      $("#contactpopup").click(function(){

      $( "#phoneRootLink" ).toggleClass("globalPopupActive");
      <?php echo $loadAjaxChat; ?>
      });

      $("#contactpopuptopbar").click(function(){
      $( "#phoneRootLink" ).removeClass("globalPopupActive");
      <?php echo $loadAjaxChat; ?>
      });
      
    });
</script>

<?php echo $CrowdPowerLogin; ?>


    

</body>
</html>