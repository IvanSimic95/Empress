<?php
//include $_SERVER['DOCUMENT_ROOT'].'/templates/noskip.php';
$dashboardRedirect = $errorDisplay = $showError = $showErrorText = "";
$DBsaved = 0;
$title = "Order complete! | Psychic Empress"; 
$sdescription = "You can now proceed to your user dashboard by clicking the button below!";
$galert = "Your Orders have been Created!";
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

  $sql2 = "UPDATE `orders` SET `user_name`='$newName',`order_email`='$newEmail',`user_age`='$new_user_age',`user_sex`='$newGender',`pick_sex`='$newPGender' WHERE (`user_id`='$nuserID' AND `order_status`='paid') OR (`user_id`='$nuserID' AND `order_status`='processing') OR (`user_id`='$nuserID' AND `order_status`='pending')" ;
  if ($conn->query($sql2) === TRUE) {
    $showError = 0;
  } else {
    $showError = 1;
    $showErrorText = "Error: " . $sql2->error . "<br>" . $conn->error;
  }

  if($showError == 0){
  //$dashboardRedirect = 1;
  $dashboardLink = "/dashboard?login=yes&check_email=".$newEmail;

  $DBsaved = 1;

$_SESSION['name'] = $newName;
$_SESSION['email'] = $newEmail;
$_SESSION['dob'] = $new_user_dob;
$_SESSION['dobUS'] = date("m/d/Y", strtotime($new_user_dob));
$_SESSION['gender'] = $newGender;
$_SESSION['partnerGender'] = $newPGender;


$_SESSION['FBdob'] = date("Ymd", strtotime($_SESSION['dob']));

$_SESSION['gender'] = $rowU['gender'];
$_SESSION['partnerGender'] = $rowU['partner_gender'];

$gender = $_SESSION['gender'];
switch ($gender) {

    case "male":
    $_SESSION['FBgender'] = "m";
    break;

    case "female":
    $_SESSION['FBgender'] = "f";
    break;

    default:
    $_SESSION['FBgender'] = "f";
    break;
}


$galert = "Your Changes have been Saved!";
  }else{
  $dashboardRedirect = 0;
  }
  $userID = $nuserID;

  }
}else{

if(isset($_SESSION['orderID'])){
  $orderID = $_SESSION['orderID'];

  if(isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
    }else{ 
    $sqlU = "SELECT * FROM `orders` WHERE `order_id` = $orderID";
    $resultU = $conn->query($sqlU);
      if($resultU->num_rows == 0) {
          $errorDisplay .= " User ID Not Found /";
          $logArray[] = "User ID Not Found";
       }else{
          $row = $resultU->fetch_assoc();
          $userID = $row["user_id"];
          $logArray[] = "User ID found using Order ID";
      }
    }
}

if(isset($userID)){
$dashboardRedirect = 0;
$dashboardLink = "/dashboard";

$cookie_name = "userID";
$cookie_value = $userID;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

$sql = "SELECT * FROM users WHERE id = '$userID'";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM orders WHERE user_id = '$userID'";
$result2 = $conn->query($sql2);

$row = mysqli_fetch_assoc($result);


$_SESSION['id'] = $row['id'];
$_SESSION['name'] = $row['full_name'];
$_SESSION['fname'] = $row['first_name'];
$_SESSION['lname'] = $row['last_name'];
$_SESSION['email'] = $row['email'];
$_SESSION['dob'] = $row['dob'];
$_SESSION['dobUS'] = date("m/d/Y", strtotime($_SESSION['dob']));
$_SESSION['gender'] = $row['gender'];
$_SESSION['partnerGender'] = $row['partner_gender'];
$_SESSION['orders'] = $result2->num_rows;
$_SESSION['loggedIn'] = "yes";

$order_email = $_SESSION['email'];

$sql0 = "SELECT * FROM orders WHERE order_email = '$order_email' AND order_status = 'pending'";
$result0 = $conn->query($sql0);
$countPending = $result0->num_rows;

$sql1 = "SELECT * FROM orders WHERE order_email = '$order_email' AND order_status = 'processing'";
$result1 = $conn->query($sql1);
$countProcessing = $result1->num_rows;

$sql2 = "SELECT * FROM orders WHERE order_email = '$order_email' AND order_status = 'completed'";
$result2 = $conn->query($sql2);
$countCompleted = $result2->num_rows;

$_SESSION['peOrders'] =$countPending;
$_SESSION['pOrders'] = $countProcessing;
$_SESSION['cOrders'] = $countCompleted;

}elseif(isset($_SESSION['userEmail'])){
$dashboardRedirect = 1;
$dashboardLink = "/dashboard?login=yes&check_email=".$_SESSION['userEmail'];
}else{
$dashboardRedirect = 1;
$dashboardLink = "/dashboard";
}

}
if($dashboardRedirect == 1){
?>

<script>
document.addEventListener("DOMContentLoaded", function(event) {
    setTimeout(function(){
        window.location.href = "<?php echo $dashboardLink; ?>";
    }, 500);
});
</script>

<?php } ?>

<div class="container-fluid" data-layout="container" style="padding:0!important;padding-top:20px!important;">
    <section class="py-0 light" id="banner">
        <div class="container p-0 p-xl-4">

          <div class="row g-0">
       
            <div class="col-12 offset-0 col-xl-8 offset-xl-2">
      <?php if($showError == 0){ ?>
      <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
      <div class="bg-success me-3 icon-item d-none d-sm-flex"><span class="fas fa-check-circle text-white fs-3"></span> </div>
      <p class="mb-0 flex-1"><?php echo $galert; ?></p>
      <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php } ?>
              <div class="card mb-3">
                <div class="card-header bg-light topbar-gradient <?php if($DBsaved == 0){ ?>p-4<?php }else{ ?>p-3<?php }?>" style="text-align:center;">
                <h3 class="mb-0 fw-semibold fs-3" style="color:#fff;">Order Complete!</h3>
                <?php if($DBsaved == 0){ ?>
                <h5 class="mt-2 fs-1" style="color:#fff;">We need to make sure your info is correct!</h5>
                <?php }?>
                </div>
                  <div class="card-body col-12 offset-0 col-xl-10 offset-xl-1 mt-0" style="text-align:center; min-height:25vh;">
     
      <?php if(!isset($_POST['form_submit'])){ ?>
      <div class="alert alert-warning border-2 d-flex align-items-center mt-2" role="alert">
      <p class="mb-0 flex-1">Please check your account information!</p>
      </div>
      <?php } if($DBsaved == 1){ ?>
      <div class="alert alert-info border-2 d-flex align-items-center mt-2" role="alert">
      <p class="mb-0 flex-1">It's time to head over to your <b>User Dashboard!</b> <br> Please click the button below!</p>
      </div>

      <a href="<?php echo "/dashboard?login=yes&check_email=".$_SESSION['userEmail']; ?>" id="DashboardLogin" class="btn btn-shadow btn-dark text-capitalize w-100 mt-2 mb-3 fs-1 fw-bold fs-1"><i class="fa fa-user"></i> User Dashboard!</a>
      <?php } ?>

               


<?php if($DBsaved == 0){ ?>
<form id="completeOrder" class="form-order needs-validation display-block text-start" name="completeOrder" action="?updateInfo=Yes" method="post">
<div class="row g-2">
  <div class="col-sm-12 col-md-6">
    <div class="form-floating form-floating-icon mb-2">
    <input class="form-control" id="userName" type="text" name="userName" placeholder="Your Full Name" required="" value="<?php echo $_SESSION['name']; ?>">
    <span class="icon-inside"><i class="fas fa-user"></i> </span>
    <label for="userName">First & Last Name</label>
    </div>
  </div>

  <div class="col-sm-12 col-md-6">
  <div class="form-floating mb-2 form-floating-icon mb-3">

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

<hr class="mb-3">
<div class="row g-2">
  <div class="col-sm-12 col-md-6">
  <div class="form-floating mb-3">
  <select class="form-select" id="SelectGender" aria-label="SelectGender" required="" name="gender">
    <option <?php if($_SESSION['gender']=="male")echo 'selected=""'; ?> value="male"><span class="fa fa-user"></span> Male</option>
    <option <?php if($_SESSION['gender']=="female")echo 'selected=""'; ?>value="female">Female</option>
    <option <?php if($_SESSION['gender']=="nonbinary")echo 'selected=""'; ?>value="nonbinary">Non-Binary</option>
  </select>
  <label for="SelectGender" style="left: 0;">Your Gender</label>
  </div>
  </div>
  <div class="col-sm-12 col-md-6">
  <div class="form-floating form mb-3">
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
<button id="SaveChanges" type="submit" name="form_submit" class="btn btn-submit-form btn-primary btn-shadow w-100 btn-add-to-cart mb-1 mt-1 fw-bold fs-1" value="Save Changes!" disabled><i class="fa fa-square-check"></i> Save This!</button>
<a href="<?php echo "/dashboard?login=yes&check_email=".$_SESSION['userEmail']; ?>" id="SkipChanges" class="btn btn-shadow btn-dark text-capitalize w-100 fs-1 fw-bold fs-1 mb-1 mt-1"> Skip This! <i class="fa fa-forward"></i></a>
</form>
<?php }?>

     </div>
              </div>
            </div>
        
      
          </div>
          
          </div>
    </section>
</div>
<style>
ol {
    list-style: disc!important;
    padding-left: 1.5rem!important;
}
  </style>
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
$customJS = <<<EOT

<script>
$(window).on('load', function(){
    window.cp('push');
});

$("#userName, #userDobUS, #userDob, #userEmail, #SelectGender, #SelectPGender").on("change keyup paste", function(){
  $('#SaveChanges').prop('disabled', false);
  $('#SaveChanges').slideDown("slow");

  $('#SkipChanges').html('<i class="fa fa-ban"></i> Don\'t Save!');


});

$(document).ready(function(){
  $('#userDobUS').mask('00/00/0000');
  $('#userDob').mask('00-00-0000');
});
</script>
EOT;


?>