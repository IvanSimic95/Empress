<?php
if(!isset($_SESSION['loggedIn'])){
header("Location: /dashboard");
die();
}
$title = "Dashboard - Profile | Psychic Artist"; 
$insertPage = "profile";
$pageTitle1 = "Edit Profile";
$sdescription = "Manage & Edit your user profile";
$customCSS = '
<!--=====================================CUSTOM CSS================================================-->
<link rel="stylesheet" type="text/css" href="/vendors/animate/animate.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="/vendors/select2/select2.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="/vendors/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="/assets/css/orders.css">
<!--===============================================================================================-->
';
$customJS = <<<EOT
<script src="/vendors/select2/select2.min.js"></script>
EOT;

$DBsaved = "";
$order_email = $_SESSION['email'];
$dashboardRedirect = $errorDisplay = $showError = $showErrorText = "";
if(isset($_POST['form_submit'])){
    isset($_POST['userID']) ? $nuserID = $_POST['userID'] : $errorDisplay .= "<li>Missing User ID </li>";
    isset($_POST['userName'])  ? $newName  = $_POST['userName'] : $errorDisplay .= "<li>Missing User Name </li>";
    isset($_POST['userEmail']) ? $newEmail = $_POST['userEmail'] : $errorDisplay .= "<li>Missing User Email </li>";
    
    isset($_POST['userDob']) OR isset($_POST['userDobUS']) ? $dob = "Yes"   : $errorDisplay .= "<li>Missing User Date of Birth (Both US and EU Fields) </li>";
    if(isset($_POST['userDob']))$new_user_dob = $_POST['userDob'];
    
    if(isset($_POST['userDobUS'])){
    $originalDate = $_POST['userDobUS'];
    $new_user_dob = date("d-m-Y", strtotime($originalDate));
    }
    
    isset($_POST['gender'])  ? $newGender  = $_POST['gender']  : $errorDisplay .= "<li>Missing User Gender </li>";
    isset($_POST['pgender']) ? $newPGender = $_POST['pgender'] : $errorDisplay .= "<li>Missing Partner Gender </li>";
    
    empty($errorDisplay) ?  $testError = FALSE : $testError = TRUE;
    if($testError == TRUE){
    $showError = 1;
    $showErrorText = $errorDisplay;
    }else{
    
    //Change stuff in DB
    //Update order status and other info from BG
    $sql = "UPDATE `users` SET `full_name`='$newName',`email`='$newEmail',`dob`='$new_user_dob',`gender`='$newGender',`partner_gender`='$newPGender' WHERE `id`='$nuserID'" ;
    if ($conn->query($sql) === TRUE) {
      $showError = 0;
    } else {
      $showError = 1;
      $showErrorText = "Error: " . $sql->error . "<br>" . $conn->error;
    }
  
    $today = date("d-m-Y");
    $diff = date_diff(date_create($new_user_dob), date_create($today));
    $new_user_age = $diff->format('%Y');
  
    $sql2 = "UPDATE `orders` SET `user_name`='$newName',`order_email`='$newEmail',`user_age`='$new_user_age',`user_sex`='$newGender',`pick_sex`='$newPGender' WHERE `user_id`='$nuserID'";
    if ($conn->query($sql2) === TRUE) {
      $showError = 0;
    } else {
      $showError = 1;
      $showErrorText = "Error: " . $sql2->error . "<br>" . $conn->error;
    }
  
    if($showError == 0){
    $DBsaved = 1;
  
    $_SESSION['name'] = $newName;
    $_SESSION['email'] = $newEmail;
    $_SESSION['dob'] = $new_user_dob;
    $_SESSION['dobUS'] = date("m/d/Y", strtotime($new_user_dob));
    $_SESSION['gender'] = $newGender;
    $_SESSION['partnerGender'] = $newPGender;
  
    $galert = "Your Changes have been Saved!";
    }
}
    
    }else{
    
    if(isset($_SESSION['loggedIn'])){ 
        $order_email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email = '$order_email'";
        $result = $conn->query($sql);

        $sql2 = "SELECT * FROM orders WHERE order_email = '$order_email'";
        $result2 = $conn->query($sql2);
        
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['full_name'];
        $_SESSION['fname'] = $row['first_name'];
        $_SESSION['lname'] = $row['last_name'];
        $_SESSION['dob'] = $row['dob'];
        $_SESSION['dobUS'] = date("m/d/Y", strtotime($_SESSION['dob']));
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['partnerGender'] = $row['partner_gender'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['orders'] = $result2->num_rows;

        $_SESSION['loggedIn'] = "yes";
        $userID = $_SESSION['id'];
    }
}

include $_SERVER['DOCUMENT_ROOT'].'/templates/dashboard/menu.php'; ?>
<?php if($DBsaved==1){ ?>
<div class="alert alert-success border-2 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span></div>
  <p class="mb-0 flex-1">Your Changes have been Saved!</p>
  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>

<form id="completeOrder" class="form-order needs-validation display-block text-start mt-3" name="completeOrder" action="" method="POST">
<div class="row g-2">




  <div class="col-sm-12 col-md-6">
    <div class="form-floating form-floating-icon mb-1">
    <input class="form-control" id="userName" type="text" name="userName" placeholder="Your Full Name" required="" value="<?php echo $_SESSION['name']; ?>">
    <span class="icon-inside"><i class="fas fa-user"></i> </span>
    <label for="userName">First & Last Name</label>
    </div>
  </div>

  <div class="col-sm-12 col-md-6">
  <div class="form-floating mb-2 form-floating-icon mb-1">

  <?php if($formDate == "US"){ ?>
  <input class="form-control" id="userDobUS" name="userDobUS" placeholder="MM/DD/YYYY" required value="<?php echo $_SESSION['dobUS']; ?>" />
  <span class="icon-inside"><i class="fa fa-clock"></i> </span>
  <label for="userDobUS">Date of Birth</label>

  <?php }else{ ?>

  <input class="form-control " id="userDob" name="userDob" placeholder="DD-MM-YYYY" required value="<?php echo $_SESSION['dob']; ?>" />
  <span class="icon-inside"><i class="fa fa-clock"></i> </span>
  <label for="userDob">Date of Birth</label>

  <?php } ?>
  </div>
  </div>
  <div class="col-sm-12 col-md-12">
  <div class="form-floating form-floating-icon">
<input class="form-control" id="userEmail" type="email" name="userEmail" placeholder="email@gmail.com" required="" value="<?php echo $_SESSION['email']; ?>">
<span class="icon-inside"><i class="fas fa-envelope"></i> </span>
<label for="userEmail">E-mail Address</label>
</div></div>
</div>

<hr class="mb-2">
<div class="row g-2">
  <div class="col-sm-12 col-md-6">
  <div class="form-floating mb-1">
  <select class="form-select" id="SelectGender" aria-label="SelectGender" required="" name="gender">
    <option <?php if($_SESSION['gender']=="male")echo 'selected=""'; ?> value="male"><span class="fa fa-user"></span> Male</option>
    <option <?php if($_SESSION['gender']=="female")echo 'selected=""'; ?>value="female">Female</option>
    <option <?php if($_SESSION['gender']=="nonbinary")echo 'selected=""'; ?>value="nonbinary">Non-Binary</option>
  </select>
  <label for="SelectGender" style="left: 0;">Your Gender</label>
  </div>
  </div>
  <div class="col-sm-12 col-md-6">
  <div class="form-floating form mb-1">
  <select class="form-select" id="SelectPGender" aria-label="SelectPGender" required="" name="pgender">
    <option <?php if($_SESSION['partnerGender']=="male")echo 'selected=""'; ?> value="male"><span class="fa fa-user"></span> Male</option>
    <option <?php if($_SESSION['partnerGender']=="female")echo 'selected=""'; ?>value="female"><span class="fa fa-user"></span> Female</option>
    <option <?php if($_SESSION['partnerGender']=="nonbinary")echo 'selected=""'; ?>value="nonbinary">Non-Binary</option>
    <option <?php if($_SESSION['partnerGender']=="any")echo 'selected=""'; ?>value="any">Any Gender</option>
  </select>
  <label for="SelectPGender" style="left: 0;">Preffered Partner Gender</label>
  </div>
  </div>
</div>
<hr class="mb-3">
<div class="error-container">
<ol class="<?php if($showError == 1)echo "alert-danger rounded-3 px-5 py-3"; ?>">
<?php if($showError == 1)echo "<p class='h4' style='margin-left:-1.5rem'>Errors Detected!</p>"; ?>
<?php if($showError == 1)echo $showErrorText; ?>
</ol>
</div>
<input class="userID" type="hidden" name="userID" value="<?php echo $userID; ?>">
<button id="SaveChanges" type="submit" name="form_submit" class="btn btn-submit-form btn-primary btn-shadow w-100 btn-add-to-cart mb-3 mt-1 fw-bold fs-1" style="display:block;" value="Save Changes!" disabled><i class="fa fa-square-check"></i> Save This!</button>
</form>

            </div>


         
      </div>
  </div>
            
        </div>
    </section>
</div>


<?php
//$customCSSPreload = '<link rel="preload" href="/assets/css/baby.css" as="style">';
//$customCSS = '<link href="/assets/css/baby.css" rel="stylesheet">';
if($formDate == "US"){
  $dobfield = "userDobUS";
  $dobmsg = "Make sure to enter your Date in MM/DD/YYYY Format!";
  $validDob = "validDOBus";
}else{ 
  $dobfield = "userDob";
  $dobmsg = "Make sure to enter your Date in DD-MM-YYYY Format!";
  $validDob = "validDOB";
}
$customJS .= <<<EOT
<script>
$("#userName, #userDobUS, #userDob, #userEmail, #SelectGender, #SelectPGender").on("change keyup paste", function(){
  $('#SaveChanges').prop('disabled', false);
});

$(document).ready(function(){
  $('#userDobUS').mask('00/00/0000');
  $('#userDob').mask('00-00-0000');
});
</script>
EOT;


?>