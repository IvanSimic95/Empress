<?php
$email = $password = $call_login=$set_email=$emailErr=$passErr='';

if(isset($_POST['email']))$email = $_POST['email'];
if(isset($_POST['password']))$password = $_POST['password'];

if($email=="admin" && $password=="123Dadada123!")
 {
   session_start();
   $_SESSION['adminemail']=$email;
   header("location:index.php");
  }else
  {
   return "Login Failed";
  }

  ?>