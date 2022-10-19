<?php
$email_address= !empty($_SESSION['adminemail'])?$_SESSION['adminemail']:'';
if(empty($email_address)){
header("location:/admin/login.php");
}
?>