<?php 
if(isset($_GET['skip'])){ 
    if($_GET['skip']=="yes"){ 
        $_SESSION['funnel_page'] = "future-baby";
        header('Location: /offer/future-baby');
        die();
    }
}
$sPage = $_SESSION['funnel_page'];
//START - Logging Variables //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$logArray = array();
$orderID = $userID = $createUser = $errorDisplay = $cookie = $getcountdown = $getformused = $user_name = $user_email = $user_dob = $user_age = $order_product = $ttt = $user_name = $fName = $lName = "";
$logArray['0'] = "ORDER-CREATION";
$logArray['1'] = date("d-m-Y H:i:s");
$logArray['2'] = $_SERVER['REMOTE_ADDR'];
$logArray['3'] = $_SERVER['REQUEST_URI'];
//END - Logging Variables ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sPage == "personal-reading" ? $ttt = "All Good!" : $errorDisplay .= " Incorrect Session Funnel Page - ".$sPage." /";

//START - Check if all required variables are present ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
isset($_SESSION['userID'])    ? $userID = $_SESSION['userID']        : $errorDisplay .= " Missing Session User ID /";
isset($_SESSION['userEmail']) ? $user_email = $_SESSION['userEmail'] : $errorDisplay .= " Missing Session User Email /";

$user_name = $_SESSION['userName'];
$fName = $_SESSION['userFName'];
$lName = $_SESSION['userLName'];

$user_dob = $_SESSION['userDOB'];
$user_age = $_SESSION['userAge'];

$orderID = $_SESSION['orderID'];

$userGender = $_SESSION['userGender'];
$partnerGender = $_SESSION['userPGender'];

$userGenderAcc = "100";

$countReadings = "0";


// set parameters and execute
if(isset($_GET['general'])) {$general = $_GET['general']; $countReadings=$countReadings + 1;}else{$general = "";}
if(isset($_GET['love'])) {$love = $_GET['love']; $countReadings=$countReadings + 1;}else{$love = "";}
if(isset($_GET['career'])) {$career = $_GET['career']; $countReadings=$countReadings + 1;}else{$career = "";}
if(isset($_GET['health'])) {$health = $_GET['health']; $countReadings=$countReadings + 1;}else{$health = "";}

$order_product = $general . " " .  $love . " " . $career . " " . $health;

$order_product_nice = "Personal Reading(".$countReadings."): ".$order_product;

$product_codename = "personal";

$order_priority = "24";
$order_product_id = "5";

isset($_GET['cookie_id1']) ? $cookie1 = $_GET['cookie_id1'] : $errorDisplay .= " Missing User Cookie ID 1 /";
isset($_GET['cookie_id2']) ? $cookie2 = $_GET['cookie_id2'] : $errorDisplay .= " Missing User Cookie ID 2 /";
isset($_GET['cookie_id3']) ? $cookie3 = $_GET['cookie_id3'] : $errorDisplay .= " Missing User Cookie ID 3 /";
isset($_GET['landingpage']) ? $landing = $_GET['landingpage'] : $errorDisplay .= " Missing Landing Page ID /";
isset($_GET['form_submit']) ? $getButtonText = $_GET['btntext'] : $getButtonText = "Place an order";

$order_date = date('Y-m-d H:i:s');
//END - Check if all required variables are present ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

empty($errorDisplay) ?  $testError = FALSE : $testError = TRUE;
if($testError == TRUE){ //IF there was error recoreded fetching main variables show error page
    $title = "Error: Can't create your Order";
    $titlePage = "Can't create your Order";
    $sdescription = $errorDisplay;
    $logArray['0'] = "ORDER-ERROR";
    $errorID  = md5($errorDisplay.$order_date);
    $logArray['4'] = $errorID;
    $logArray['5'] = $errorDisplay;
    $logArray['6'] = $user_name." - ".$user_email." - ".$user_dob." - ".$order_product;
    include $_SERVER['DOCUMENT_ROOT'].'/templates/error/error-log.php';
    SuperLog($logArray, "error");
}else{ //IF there was NO error recoreded fetching main variables save to DB and redirect to payment page
    $_SESSION['funnel_page'] = "success";
    $title = "Redirecting you to payment page...";

    $titlePage = "Redirecting you...";
    $sdescription = "You are being redirected to the Payment Processor.";
    $logArray['0'] = "PERSONAL-ORDER-CREATION";
    $logArray['4'] = $cookie2;
    $logArray['4'] = $user_name;
    $logArray['5'] = $user_email;
    $logArray['6'] = $user_dob;
    $logArray['8'] = $order_priority;
    $logArray['7'] = $order_product;

    switch($countReadings){
    case "1":
    $order_price = "19.99";
    break;
    case "2":
    $order_price = "29.99";
    break;
    case "3":
    $order_price = "39.99";
    break;
    case "4":
    $order_price = "49.99";
    break;
    }

    $order_date = date('Y-m-d H:i:s');
    $baseRedirect = base64_encode("https://".$domain."/order/success/personal");
    $signedUpAt = time();

    $sql5 = "SELECT * FROM users WHERE email = '".$user_email."'";
    $result5 = $conn->query($sql5);
    if ($result5){
        $row5 = mysqli_num_rows($result5);
            if ($row5 > 0){
                $createUser = 0;
                $row2 = $result5->fetch_assoc();
                $userID = $row2['id'];
                $logArray['9'] = "Existed: ".$userID;
            }else{
                $createUser = 1;
            }
    } 

    if($createUser == 1){
        $sql65 = "INSERT INTO users (first_name, last_name, full_name, email, age, dob, gender, partner_gender)
        VALUES ('$fName', '$lName', '$user_name', '$user_email', '$user_age', '$user_dob', '$userGender','$partnerGender')";
        if ($conn->query($sql65) === TRUE) {
            $userID = mysqli_insert_id($conn);
            $logArray['9'] = "Created: ".$userID;
        } else {
            $logArray['9'] = "Error: " . $sql65->error . "<br>" . $conn->error;; 
        }
        

    }
    
    
    $sql = "INSERT INTO orders (cookie_id, user_id, user_age, first_name, last_name, user_name, order_status, order_date, order_email, bg_email, order_product, product_codename, product_nice, order_priority, order_price, buygoods_order_id, user_sex, genderAcc, pick_sex, landing_page, form, countdown, button)
            VALUES ('$cookie2', '$userID', '$user_age', '$fName', '$lName', '$user_name', 'pending', '$order_date', '$user_email', '', '$order_product', '$product_codename', '$order_product_nice', '$order_priority', '$order_price', '', '$userGender', '$userGenderAcc', '$partnerGender', '$landing', '$getformused', '$getcountdown', '$getButtonText')";

    if ($conn->query($sql) === TRUE) {
    $logArray['10'] = "Success"; 
    } else {
    $logArray['10'] = "Error: " . $sql . "<br>" . $conn->error;; 
    }

    $lastRowInsert = mysqli_insert_id($conn);

    //Save data to orders log
    $sql2 = "INSERT INTO orders_log (user_id, order_id, time, notice) VALUES ('$userID','$lastRowInsert', '$order_date', 'Order Created!')";
    if ($conn->query($sql2) === TRUE) {
        $logArray['11'] = "Success"; 
    }else {
        $logArray['11'] = "Error: " . $sql2->error . "<br>" . $conn->error;
    }

    $clean_order_product=str_replace(" ","-",$order_product);

    $cookieuser = $cookie1."|".$cookie2."|".$cookie3."|".$userID;
    $cookiec = base64_encode($cookieuser);

    $finalLink = 'https://buygoods.com/secure/upsell?account_id=6490&screen=checkout_clean&product_codename='.$countReadings.'xreadings&subid='.$cookiec.'&subid2='.$lastRowInsert.'&subid3='.$clean_order_product.'&subid4='.$userID.'&external_order_id='.$lastRowInsert.'&redirect='.$baseRedirect;

    $_SESSION['orderID']   = $lastRowInsert;
 
    $sql = "UPDATE `orders` SET `link`='$finalLink' WHERE order_id='$lastRowInsert'" ;
    if ($conn->query($sql) === TRUE) {
        $logArray['12'] = "Success"; 
    } else {
        $logArray['12'] = "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();

    
    SuperLog($logArray, "order");
?>
<!-- ===============================================-->
 <!--    Main Content-->
 <!-- ===============================================-->
 <main class="main" id="top">
   <div class="container" data-layout="container">
     <div class="row flex-center min-vh-80 py-6 text-center">
       <div class="col-sm-12 col-md-12 col-lg-10 col-xxl-8 min-vh-90">
         <div class="card py-6">
         <div class="card-body p-4 p-sm-5">
             <div class="fw-bold display-6"><?php echo $titlePage; ?></div>
             <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold w-md-75 w-xl-100 mx-auto"><?php echo $sdescription; ?></p>

            
             <div class="loadericon"></div>
     
           </div>
         </div>
       </div>
     </div>
   </div>
 </main><!-- ===============================================-->
 <!--    End of Main Content-->
 <!-- ===============================================-->

<script>
document.addEventListener("DOMContentLoaded", function(event) {
 setTimeout(function(){
     window.location.href = "<?php echo $finalLink; ?>";
 }, 1000);
});
</script>


<?php
}
?>