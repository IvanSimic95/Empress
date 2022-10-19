<?php
$errorDisplay = "";

if(isset($_SESSION['email'])){//if logged in already retrieve the email
$order_email = $_SESSION['email'];
}else{

// set parameters and execute
if(isset($_GET['check_email'])) {
$order_email = $_GET['check_email'];
}
    
if(isset($_POST['email'])) {
$order_email = $_POST['email'];
}
}


if(isset($_POST['remember'])) {
    $cookie = "1";
}else{
    $cookie = "1";
}


$LoginError = "";

if(isset($order_email)){ 
$sql = "SELECT * FROM orders WHERE order_email = '$order_email' ORDER BY order_id DESC";
$result = $conn->query($sql);

$sql0 = "SELECT * FROM orders WHERE order_email = '$order_email' AND order_status = 'pending'";
$result0 = $conn->query($sql0);
$countPending = $result0->num_rows;

$sql1 = "SELECT * FROM orders WHERE order_email = '$order_email' AND order_status = 'processing'";
$result1 = $conn->query($sql1);
$countProcessing = $result1->num_rows;

$sql2 = "SELECT * FROM orders WHERE order_email = '$order_email' AND order_status = 'completed'";
$result2 = $conn->query($sql2);
$countCompleted = $result2->num_rows;

$sql3 = "SELECT SUM(order_price) AS total FROM orders WHERE (`order_email` = '$order_email' AND `order_status`='paid') OR (`order_email` = '$order_email' AND `order_status`='processing')  OR (`order_email` = '$order_email' AND `order_status`='completed');";
$result3 = $conn->query($sql3);
$row = mysqli_fetch_assoc($result3);
$countTotal = $row['total'];




if($result->num_rows == 0) {
if($order_email==""){
$LoginError = "<div class='alert alert-danger  mb-0' role='alert'>Email not provided!</div>";
}else{
$LoginError = "<div class='alert alert-danger  mb-0' role='alert'>Email is not valid, account not found!</div>";
}
$LoginError = "<div class='alert alert-danger  mb-0' role='alert'>Email is not valid, account not found!</div>";

} else {
$row = mysqli_fetch_assoc($result);

$_SESSION['id'] = $row['order_id'];
$_SESSION['userID'] = $row['user_id'];
$_SESSION['name'] = $row['user_name'];
$_SESSION['fname'] = $row['first_name'];
$_SESSION['lname'] = $row['last_name'];
$_SESSION['email'] = $row['order_email'];
$_SESSION['orders'] = $result->num_rows;
$_SESSION['loggedIn'] = "yes";

$_SESSION['peOrders'] =$countPending;
$_SESSION['pOrders'] = $countProcessing;
$_SESSION['cOrders'] = $countCompleted;
$_SESSION['cSpent']  = $countTotal;

$userID = $_SESSION['userID'];

$sql4 = "SELECT * FROM users WHERE id = '$userID'";
$result4 = $conn->query($sql4);
$rowU = mysqli_fetch_assoc($result4);

$_SESSION['dob'] = $rowU['dob'];
$_SESSION['dobUS'] = date("m/d/Y", strtotime($_SESSION['dob']));

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

if(isset($_GET['login'])) {
$redirect = '<script>window.location.replace("/dashboard?loggedin=success");</script>';
echo $redirect;
}
}
}
?>