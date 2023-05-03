<?php
$sPage = $_SESSION['funnel_page'];
$pixelActive = 0;

//START - Logging Variables //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$logArray = array();
$createUser = $errorDisplay = $cookie = $getcountdown = $getformused = $user_name = $user_email = $user_dob = $order_product = $ttt = "";
$logArray['0'] = "ORDER-CREATION";
$logArray['1'] = date("d-m-Y H:i:s");
$logArray['2'] = $_SERVER['REMOTE_ADDR'];
$logArray['3'] = $_SERVER['REQUEST_URI'];
//END - Logging Variables ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//START - Check if all required variables are present ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
isset($_GET['userName'])    ? $user_name=$_GET['userName']     : $errorDisplay .= " Missing User Name /";
isset($_GET['userEmail'])   ? $user_email=$_GET['userEmail']    : $errorDisplay .= " Missing User Email /";

isset($_GET['userDob']) OR isset($_GET['userDobUS']) OR isset($_GET['dob_day']) ? $dob = "Yes"   : $errorDisplay .= " Missing User Date of Birth (Both US and EU Fields) /";
if(isset($_GET['userDob']))$user_dob = $_GET['userDob'];

if(isset($_GET['userDobUS'])){
$originalDate = $_GET['userDobUS'];
$user_dob = date("d-m-Y", strtotime($originalDate));
}

if(isset($_GET['dob_day'])){
$user_dob = $_GET['dob_day']."-".$_GET['dob_month']."-".$_GET['dob_year'];
}

isset($_GET['product'])  ? $order_product = $_GET['product']   : $errorDisplay .= " Missing Product ID /";
isset($_GET['priority']) ? $order_priority = $_GET['priority'] : $order_priority = "48";

isset($_GET['cookie_id1']) ? $cookie1 = $_GET['cookie_id1'] : $errorDisplay .= " Missing User Cookie ID 1 /";
isset($_GET['cookie_id2']) ? $cookie2 = $_GET['cookie_id2'] : $errorDisplay .= " Missing User Cookie ID 2 /";
isset($_GET['cookie_id3']) ? $cookie3 = $_GET['cookie_id3'] : $errorDisplay .= " Missing User Cookie ID 3 /";
isset($_GET['landingpage']) ? $landing = $_GET['landingpage'] : $errorDisplay .= " Missing Landing Page ID /";

isset($_GET['countdown']) ? $getcountdown = $_GET['countdown'] : $errorDisplay .= " Missing Countdown Variable /";
isset($_GET['formused']) ? $getformused = $_GET['formused'] : $errorDisplay .= " Missing FormUsed ID /";
isset($_GET['btncolor']) ? $fbtncolor = $_GET['btncolor'] : $errorDisplay .= " Missing Button Color /";

isset($_GET['form_submit']) ? $getButtonText = $_GET['btntext'] : $getButtonText = "Place an order";

isset($_GET['fbp']) ? $uFBP = $_GET['fbp'] : $uFBP = "";
isset($_GET['fbc']) ? $uFBC = $_GET['fbc'] : $uFBC = "";

isset($_GET['premium']) ? $premium = $_GET['premium'] : $premium = "no";

isset($_GET['ip'])    ? $addip = $_GET['ip'] : $addip = "";
isset($_GET['agent']) ? $addagent = $_GET['agent'] : $addagent = "";

isset($_GET['affid']) ? $affid = $_GET['affid'] : $affid = "";
isset($_GET['cid'])   ? $cid = $_GET['cid']     : $cid = "0";
isset($_GET['pid'])   ? $pid = $_GET['pid']     : $pid = "0";
isset($_GET['pubid']) ? $pubid = $_GET['pubid'] : $pubid = "0";

isset($_GET['subid1']) ? $subid1 = $_GET['subid1'] : $subid1 = "";
isset($_GET['subid2']) ? $subid2 = $_GET['subid2'] : $subid2 = "";

$order_date = date('Y-m-d H:i:s');
$partnerGender = "male";



$today = date("d-m-Y");
$diff = date_diff(date_create($user_dob), date_create($today));
$user_age = $diff->format('%Y');
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
    $logArray['0'] = "ORDER-CREATION";
    $logArray['4'] = $cookie1;
    $logArray['4'] = $user_name;
    $logArray['5'] = $user_email;
    $logArray['6'] = $user_dob;
    $logArray['8'] = $order_priority;

    $order_product_id = $order_product;
    $product_codename = $order_product;
    switch ($order_product_id) {
    case "1":
    $order_product = "soulmate";
    $order_product_nice = "Soulmate Drawing & Reading";
    break;
    
    case "2":
    $product = "twinflame";
    $order_product_nice = "Twin Flame Drawing & Reading";
    break;
    
    case "3":
    $product = "futurespouse";
    $order_product_nice = "Future Spouse Drawing & Reading";
    break;
    
    case "4":
    $product = "past";
    $order_product_nice = "Past Life Drawing & Reading";
    break;
    }
    $logArray['7'] = $order_product;

    //Full name -> First and Last Name
    $parser = new TheIconic\NameParser\Parser();
    $name = $parser->parse($user_name);

    $fName = $name->getFirstname();
    $lName = $name->getLastname();

    switch($order_priority){
    case "12":
    $order_price = "44.99";
    break;
    
    case "24":
    $order_price = "39.99";
    break;
    
    case "48":
    $order_price = "29.99";
    break;
    }

    if($premium == "yes"){
        $prelink = "p";
    }else{
        $prelink = "";
    }

    //Find User Gender
    function findGender($name) {
    $apiKey = 'Whc29bSnvP3zrQG3hYCwXKMoYu5h4ZQukS6n'; //Your API Key
    $getGender = json_decode(file_get_contents('https://gender-api.com/get?key=' . $apiKey . '&name=' . urlencode($name)));
    $data = [[
        "gender" => $getGender->gender,
        "accuracy"  => $getGender->accuracy
        ]];
    return $data;
    }

    
    $findGenderFunc = findGender($fName);
    $userGender = $findGenderFunc['0']['gender'];
    $userGenderAcc = $findGenderFunc['0']['accuracy'];

    if($userGender=="male"){$partnerGender = "female";}
    if($userGender=="female"){$partnerGender = "male";}

    $order_date = date('Y-m-d H:i:s');

    //$baseRedirect = base64_encode("https://".$domain."/offer/personal-reading");
    $baseRedirect = base64_encode("https://".$domain."/order/success/main");

    $fbCampaign = $_SESSION['fbCampaign'];
    $fbAdset = $_SESSION['fbAdset'];
    $fbAd = $_SESSION['fbAd'];

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
        $sql65 = "INSERT INTO users (first_name, last_name, full_name, email, age, dob, gender, partner_gender, affid, clickid)
        VALUES ('$fName', '$lName', '$user_name', '$user_email', '$user_age', '$user_dob', '$userGender','$partnerGender', '$affID', '$clickID')";

        
        if ($conn->query($sql65) === TRUE) {
            $userID = mysqli_insert_id($conn);
            $logArray['9'] = "Created: ".$userID;
        } else {
            $logArray['9'] = "Error: " . $sql65->error . "<br>" . $conn->error;; 
        }
        

    }
    
    $sql = "INSERT INTO orders (cookie_id, user_id, user_age, birthday, first_name, last_name, user_name, order_status, order_date, order_email, bg_email, order_product, premium, product_codename, product_nice, order_priority, order_price, buygoods_order_id, user_sex, genderAcc, pick_sex, landing_page, form, countdown, button, btncolor, fbp, fbc, ip, agent, affid, clickid, pid, pubid, fbCampaign, fbAdset, fbAd)
            VALUES ('$cookie1', '$userID', '$user_age', '$user_dob', '$fName', '$lName', '$user_name', 'pending', '$order_date', '$user_email', '', '$order_product', '$premium', '$order_product', '$order_product_nice', '$order_priority', '$order_price', '', '$userGender', '$userGenderAcc', '$partnerGender', '$landing', '$getformused', '$getcountdown', '$getButtonText', '$fbtncolor', '$uFBP', '$uFBC', '$addip', '$addagent', '$affid', '$cid', '$pid', '$pubid',  '$fbCampaign', '$fbAdset', '$fbAd')";

    if ($conn->query($sql) === TRUE) {
    $logArray['10'] = "Success"; 
    } else {
    $logArray['10'] = "Error: " . $sql . "<br>" . $conn->error;; 
    }

    $lastRowInsert = mysqli_insert_id($conn);

    //Save data to orders log
    $sql2 = "INSERT INTO orders_log (user_id, order_id, time, notice) VALUES ('$userID', '$lastRowInsert', '$order_date', 'Order Created!')";
    if ($conn->query($sql2) === TRUE) {
        $logArray['11'] = "Success"; 
    }else {
        $logArray['11'] = "Error: " . $sql2->error . "<br>" . $conn->error;
    }

    $cookieuser = $cookie1."|".$cookie2."|".$cookie3."|".$userID;
    $cookiec = base64_encode($cookieuser);

    $finalLink = 'https://www.buygoods.com/secure/checkout.html?account_id=6490&screen=checkout_clean&product_codename='.$order_product_id.$order_priority.$prelink.'&subid='.$cookiec.'&subid2='.$lastRowInsert.'&subid3='.$order_product.'&subid4='.$uFBP.'&subid5='.$uFBC.'&external_order_id='.$lastRowInsert.'&redirect='.$baseRedirect;
    
    $_SESSION['userID']    = $userID;
    $_SESSION['userEmail'] = $user_email;

    $_SESSION['userName']  = $user_name;
    $_SESSION['userFName'] = $fName;
    $_SESSION['userLName'] = $lName;

    $_SESSION['userDOB']   = $user_dob;
    $_SESSION['userAge']   = $user_age;

    $_SESSION['orderID']   = $lastRowInsert;

    $_SESSION['userGender']= $userGender;
    $_SESSION['userPGender']=$partnerGender;



    $sql = "UPDATE `orders` SET `link`='$finalLink' WHERE order_id='$lastRowInsert'" ;
    if ($conn->query($sql) === TRUE) {
        $logArray['12'] = "Success"; 
    } else {
        $logArray['12'] = "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();

    


    SuperLog($logArray, "order");

}
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