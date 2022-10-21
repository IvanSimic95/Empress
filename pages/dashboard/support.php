<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

if(!isset($_SESSION['loggedIn'])){
header("Location: /dashboard");
die();
}
$title = "Dashboard - Support | Psychic Empress"; 
$insertPage = "support";
$pageTitle1 = "Support Chat";
$sdescription = "Need help? This is the best place for you!";
$firstTime = "";




?>

<div class="container-fluid py-0 px-0 px-md-3 py-md-3" data-layout="container">
    <section class="py-0 overflow-hidden light" id="banner">
        <div class="container p-0 pt-2 p-md-3 pt-md-3">

            <div class="row gx-0 gy-2 g-xl-2 h-100">
            <div class="col-12 col-sm-12 col-xl-4 text-center py-2 order-2 order-md-1">
                

            <div class="py-2 px-0 light topbar-gradient rounded-3"> 
            <div class="elfsight-app-f9baa5f9-4e55-4c19-bae9-2445b696abcf"></div>
<div id="sidebar-menu" class="text-white">
    
<ul>

                    <li> <a href="/dashboard" class="text-decoration-none d-flex align-items-start">
                            <div class="fas fa-box pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Account</div>
                                <div class="link-desc">Your Account Overview</div>
                            </div>
                        </a> </li>
                        <li> <a href="/dashboard/orders" class="text-decoration-none d-flex align-items-start">
                            <div class="fas fa-box-open pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Orders 
                            <?php 
                                if(isset($_SESSION['loggedIn'])){ 
                                    if($_SESSION['loggedIn']=="yes"){
                                        echo "(".$_SESSION['orders'].")"; 
                                    }
                                }
                            ?> </div>
                                <div class="link-desc">View & Manage Orders</div>
                            </div>
                        </a> </li>
                        <li> <a href="/dashboard/profile" class="text-decoration-none d-flex align-items-start">
                            <div class="fa fa-user-pen pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Profile</div>
                                <div class="link-desc">Change your profile details</div>
                            </div>
                        </a> </li>
                        <li class="active"> <a href="/dashboard/support" class="text-decoration-none d-flex align-items-start">
                            <div class="fa fa-comment-question pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link position-relative">
                                Support   
                                <span id="notifier-badge" class="position-absolute badge rounded-pill bg-danger">0</span>
                                </div>
                                <div class="link-desc">Need help with something?</div>
                            </div>
                        </a> </li>
                    <li> <a href="/dashboard?logout=yes" class="text-decoration-none d-flex align-items-start">
                            <div class="fa fa-right-from-bracket pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">Logout</div>
                                <div class="link-desc">All done? Click here to sign out!</div>
                            </div>
                        </a> </li>
</ul>

                            </div>
      
                            </div>

</div>
              <div class="col-12 col-sm-12 col-xl-8 py-2 order-1 order-md-2">
                  <div class="p-0 flex-grow-1 d-flex flex-column">

                  <div class="card mb-3 p-0">
                        <div class="card-header bg-light p-4 py-3 topbar-gradient">
                            <div class="d-flex flex-between-center">
                                <h3 class="mb-0 fw-semibold fs-1" style="color:#fff;">Support - Contact Form</h3>
                            </div>
                        </div>
                        <div class="card-body px-1 px-md-2 px-lg-3 py-2">
                       
                        <div class="alert alert-info border-2 d-flex align-items-center mt-1" role="alert">
                        <div class="bg-info me-3 icon-item d-none d-sm-flex"><span class="fas fa-info-circle text-white fs-3"></span></div>
                        <p class="mb-0 flex-1">If you need help fill out this form and we will reply ASAP</p>
                        </div>
                        <form id="ajax-form" class="form-support" name="support_form" action="javascript:void(0)" method="post">

                        <div class="form-floating mb-3">
                        <select class="form-select" name="category" id="floatingSelect" aria-label="Floating label select example">
                            <option value="" disabled="" selected="" hidden="">Please choose one option</option>
                            <option value="1">General Question</option>
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
                        <textarea class="form-control" id="floatingTextarea2" placeholder="Description here" style="height: 100px" name="message"></textarea>
                        <label for="floatingTextarea2"  style="left:0px;">Description of the issue</label>
                        </div>

                        <button id="PlaceOrder" type="submit" name="form_submit" style="display:block;" class="btn btn-submit-form btn-primary btn-shadow w-100 btn-add-to-cart mb-1 mt-1 fw-bold fs-2">Submit support request!</button></div>

                            </form>
                                <div id="success-msg" style="display:none;">
                        <div class="alert alert-success border-2 d-flex align-items-center mt-1" role="alert">
                        <div class="bg-success me-3 icon-item d-none d-sm-flex"><span class="fas fa-info-circle text-white fs-3"></span></div>
                        <p class="mb-0 flex-1">Support Request Sent!</p>
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


//$customCSSPreload = '<link rel="preload" href="/assets/css/baby.css" as="style">';
//$customCSS = '<link href="/assets/css/baby.css" rel="stylesheet">';



?>