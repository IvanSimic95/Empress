<?php

//define variables as empty to prevent errors
$today = $createEntry = $userIP = "";

//define required variables
$today = date('Y-m-d');
$userIP = $_SERVER['REMOTE_ADDR'];

isset($url) ? $page = $url : $page = parse_url( $_SERVER[ 'REQUEST_URI' ], PHP_URL_PATH );
isset($affid) ? $vaffid = $affid : $vaffid = 0;

$form = "normal";
$button = "button";
$button_color = "standard";


 //Check if visit already exists
 $sql = "SELECT * FROM visits WHERE ip = '$userIP' AND DATE(time) = '$today'";
 $result = $conn->query($sql);
 if ($result){
     $row = mysqli_num_rows($result);
         if ($row > 0){
             $createEntry = 0;
         }else{
             $createEntry = 1;
         }
 }

//If visit doesn't exist record it to DB
if($createEntry == 1){

    $sql65 = "INSERT INTO visits (ip, page, form, button, button_color, affid)
    VALUES ('$userIP', '$page', '$form', '$button', '$button_color', '$vaffid')";

    
    if ($conn->query($sql65) === TRUE) {
        $visitID = mysqli_insert_id($conn);
    } else {

    }
}




?>