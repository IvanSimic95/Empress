<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';

if(isset($_GET['id'])){
    $userID = str_replace("PA","",$_GET['id']);
}else{
    $userID = "19481";
}

if($domain == "empress.test"){
  $userID = "19481";
}


$sql = "SELECT * FROM users WHERE id = '$userID'";
$result = $conn->query($sql);

$row = mysqli_fetch_assoc($result);
        $fullname = $row['full_name'];
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $dob = $row['dob'];
        $dobUS = date("m/d/Y", strtotime($dob));
        $gender = $row['gender'];
        $pgender = $row['partner_gender'];
        $email = $row['email'];

        $sql2 = "SELECT * FROM orders WHERE order_email = '$email'";
        $result2 = $conn->query($sql2);

        $orders = $result2->num_rows;
?>


<!--
<div class="d-none d-lg-block mt-4">
    <div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-sales clearfix">
		<div class="h4 mb-0">11 993</div>
    </div>
    <div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-sales clearfix">
      <div class="h4 mb-0">11 993</div>
    </div>
    <div class="bg-secondary rounded p-3 mt-2 mb-2 product-stats product-stats-reviews clearfix">
		<div class="h4 mb-0">11 993</div>
	</div>
</div>
-->
<script>
$("#userName, #userDobUS, #userDob, #userEmail, #SelectGender, #SelectPGender").on("change keyup paste", function(){
  $('#SaveChanges').prop('disabled', false);
});
</script>
<form id="updateUser" class="form-order display-block text-start mt-0" name="updateUser">
<div class="row g-2">




  <div class="col-sm-12 ">
    <div class="form-floating form-floating-icon mb-1">
    <input class="form-control" id="userName" type="text" name="userName" placeholder="Your Full Name" required="" value="<?php echo $fullname; ?>">
    <span class="icon-inside"><i class="fas fa-user"></i> </span>
    <label for="userName">First & Last Name</label>
    </div>
  </div>

  <div class="col-sm-12 ">
  <div class="form-floating mb-2 form-floating-icon mb-1">

  <?php if($formDate == "US"){ ?>
  <input class="form-control" id="userDobUS" name="userDobUS" placeholder="MM/DD/YYYY" required value="<?php echo $dobUS; ?>" />
  <span class="icon-inside"><i class="fa fa-clock"></i> </span>
  <label for="userDobUS">Date of Birth</label>

  <?php }else{ ?>

  <input class="form-control " id="userDob" name="userDob" placeholder="DD-MM-YYYY" required value="<?php echo $dob; ?>" />
  <span class="icon-inside"><i class="fa fa-clock"></i> </span>
  <label for="userDob">Date of Birth</label>

  <?php } ?>
  </div>
  </div>
  <div class="col-sm-12 col-md-12">
  <div class="form-floating form-floating-icon">
<input class="form-control" id="userEmail" type="email" name="userEmail" placeholder="email@gmail.com" required="" value="<?php echo $email; ?>">
<span class="icon-inside"><i class="fas fa-envelope"></i> </span>
<label for="userEmail">E-mail Address</label>
</div></div>
</div>

<hr class="mb-2">
<div class="row g-2">
  <div class="col-sm-12 ">
  <div class="form-floating mb-1">
  <select class="form-select" id="SelectGender" aria-label="SelectGender" required="" name="gender">
    <option <?php if($gender=="male")echo 'selected=""'; ?> value="male"><span class="fa fa-user"></span> Male</option>
    <option <?php if($gender=="female")echo 'selected=""'; ?>value="female">Female</option>
    <option <?php if($gender=="nonbinary")echo 'selected=""'; ?>value="nonbinary">Non-Binary</option>
  </select>
  <label for="SelectGender" style="left: 0;">Your Gender</label>
  </div>
  </div>
  <div class="col-sm-12 ">
  <div class="form-floating form mb-1">
  <select class="form-select" id="SelectPGender" aria-label="SelectPGender" required="" name="pgender">
    <option <?php if($pgender=="male")echo 'selected=""'; ?> value="male"><span class="fa fa-user"></span> Male</option>
    <option <?php if($pgender=="female")echo 'selected=""'; ?>value="female"><span class="fa fa-user"></span> Female</option>
    <option <?php if($pgender=="nonbinary")echo 'selected=""'; ?>value="nonbinary">Non-Binary</option>
    <option <?php if($pgender=="any")echo 'selected=""'; ?>value="any">Any Gender</option>
  </select>
  <label for="SelectPGender" style="left: 0;">Preffered Partner Gender</label>
  </div>
  </div>
</div>
<hr class="mb-3">

<input id="userID" class="userID" type="hidden" name="userID" value="<?php echo $userID; ?>">
<button id="SaveChanges" type="submit" name="form_submit" class="btn btn-submit-form btn-primary btn-shadow w-100 btn-add-to-cart mb-3 mt-1 fw-bold fs-1" style="display:block;" value="Save Changes!" disabled><i class="fa fa-square-check"></i> Save This!</button>
</form>