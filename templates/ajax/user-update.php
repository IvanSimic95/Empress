<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';

  $userID = $_POST['userID'];

  $name = $_POST['name'];
  $dob  = $_POST['dob'];

  $email = $_POST['email'];

  $gender = $_POST['gender'];
  $pgender  = $_POST['pgender'];

  $originalDate = $_POST['userDobUS'];
  $new_user_dob = date("d-m-Y", strtotime($originalDate));

  $sql2 = "UPDATE `users` SET `full_name`='$name',`dob`='$new_user_dob',`email`='$mail',`user_sex`='$gender',`pick_sex`='$pgender' WHERE `id`='$userID'";
  $insert = "insert into TABLE_NAME values('$name','$last_name')";// Do Your Insert Query
  if(mysql_query($insert)) {
   echo "Success";
  } else {
   echo "Cannot Insert";
  }
?>