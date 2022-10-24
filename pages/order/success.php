<?php
$pixelActive = 0;
//START - Logging Variables //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$logArray = array();
$errorDisplay = $cookie = $getcountdown = $getformused = $user_name = $user_email = $user_dob = $order_product = $ttt = "";
$logArray['0'] = "MAIN-ORDER-PAID";
$logArray['1'] = date("d-m-Y H:i:s");
$logArray['2'] = $_SERVER['REMOTE_ADDR'];
$logArray['3'] = $_SERVER['REQUEST_URI'];
//END - Logging Variables ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$sPage = $_SESSION['funnel_page'];
if($path=="/order/success"){
    if(!isset($SuccessProduct)){
        $SuccessProduct = "main";
    }
}



//START - Success Page after purchasing MAIN Product (Soulmate, Twin Flame or Future Spouse)//////////////////////////////////////////////////////////////////////////////////////////////////////
if($SuccessProduct  == "main") {
    isset($_GET['emailaddress'])    ? $order_email=$_GET['emailaddress'] : $errorDisplay .= " Missing User Email /";
    isset($_GET['total'])           ? $order_total=$_GET['total']        : $errorDisplay .= " Missing Order Total /";
    isset($_GET['order_id'])        ? $order_BGID=$_GET['order_id']      : $errorDisplay .= " Missing BG Order ID /";

    if(isset($_SESSION['orderID'])){
        $orderID = $_SESSION['orderID'];
    }
    
    if(isset($_GET['external_order_id'])){
        $orderID = $_GET['external_order_id'];
    }


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
    

    $order_date = date('Y-m-d H:i:s');

    empty($errorDisplay) ?  $testError = FALSE : $testError = TRUE;
    if($testError == TRUE){
    $title = "Error: Can't Process your Order!";
    $titlePage = "Can't Process your Order!";
    $sdescription = $errorDisplay;
    $logArray['0'] = "ORDER-SUCCESS-ERROR";
    $errorID  = md5($errorDisplay.$order_date);
    $logArray['4'] = $errorID;
    $logArray['5'] = $errorDisplay;
    include $_SERVER['DOCUMENT_ROOT'].'/templates/error/error-log.php';
    SuperLog($logArray, "error");
    }else{
    $_SESSION['funnel_page'] = "personal-reading";
    $title = "Processing Your Order...";

    $titlePage = "Processing Your Order...";
    $sdescription = "Almost Done!";
    
    $logArray['4'] = $order_email;
    $logArray['4'] = $order_total;
    $logArray['5'] = $order_BGID;

    //Update order status and other info from BG
    $sql = "UPDATE `orders` SET `order_status`='paid',`bg_email`='$order_email',`order_price`='$order_total',`buygoods_order_id`='$order_BGID' WHERE `order_id`='$orderID'" ;
    if ($conn->query($sql) === TRUE) {
        $logArray['7'] = "Success";
    } else {
        $logArray['7'] = "Error: " . $sql->error . "<br>" . $conn->error;
    }

    //Save data to orders log
	$TimeNow = date('y-m-d H:i:s', time());
    $sql2 = "INSERT INTO orders_log (user_id, order_id, type, time, notice) VALUES ('$userID', '$orderID', 'status', '$TimeNow', 'Order Status updated to Paid!')";
    if ($conn->query($sql2) === TRUE) {
        $logArray['8'] = "Success";
    } else {
        $logArray['8'] = "Error: " . $sql2->error . "<br>" . $conn->error;
    }
}
//END - Success Page after purchasing MAIN Product (Soulmate, Twin Flame or Future Spouse)/////////////////////////////////////////////////////////////////////////////////////////////////////////
}elseif($SuccessProduct  == "personal") {
    isset($_GET['emailaddress'])    ? $order_email=$_GET['emailaddress'] : $errorDisplay .= " Missing User Email /";
    isset($_GET['total'])           ? $order_total=$_GET['total']        : $errorDisplay .= " Missing Order Total /";
    isset($_GET['order_id'])        ? $order_BGID=$_GET['order_id']      : $errorDisplay .= " Missing BG Order ID /";

    if(isset($_SESSION['orderID'])){
        $orderID = $_SESSION['orderID'];
    }
    
    if(isset($_GET['external_order_id'])){
        $orderID = $_GET['external_order_id'];
    }


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

    $logArray['0'] = "PERSONAL-ORDER-PAID";

    $order_date = date('Y-m-d H:i:s');

    empty($errorDisplay) ?  $testError = FALSE : $testError = TRUE;
    if($testError == TRUE){
    $title = "Error: Can't Process your Order!";
    $titlePage = "Can't Process your Order!";
    $sdescription = $errorDisplay;
    $logArray['0'] = "PERSONAL-SUCCESS-ERROR";
    $errorID  = md5($errorDisplay.$order_date);
    $logArray['4'] = $errorID;
    $logArray['5'] = $errorDisplay;
    include $_SERVER['DOCUMENT_ROOT'].'/templates/error/error-log.php';
    SuperLog($logArray, "error");
    }else{
    $_SESSION['funnel_page'] = "future-baby";
    $title = "Processing Your Order...";

    $titlePage = "Processing Your Order...";
    $sdescription = "Almost Done!";
    
    $logArray['4'] = $order_email;
    $logArray['4'] = $order_total;
    $logArray['5'] = $order_BGID;

    //Update order status and other info from BG
    $sql = "UPDATE `orders` SET `order_status`='paid',`bg_email`='$order_email',`order_price`='$order_total',`buygoods_order_id`='$order_BGID' WHERE `order_id`='$orderID'" ;
    if ($conn->query($sql) === TRUE) {
        $logArray['7'] = "Success";
    } else {
        $logArray['7'] = "Error: " . $sql->error . "<br>" . $conn->error;
    }

    //Save data to orders log
	$TimeNow = date('y-m-d H:i:s', time());
    $sql2 = "INSERT INTO orders_log (user_id, order_id, type, time, notice) VALUES ('$userID', '$orderID', 'status', '$TimeNow', 'Order Status updated to Paid!')";
    if ($conn->query($sql2) === TRUE) {
        $logArray['8'] = "Success";
    } else {
        $logArray['8'] = "Error: " . $sql2->error . "<br>" . $conn->error;
    }

    $conn->close();
    SuperLog($logArray, "order");

    $finalLink = "/offer/future-baby";
}
}elseif($SuccessProduct  == "baby") { 
    isset($_GET['emailaddress'])    ? $order_email=$_GET['emailaddress'] : $errorDisplay .= " Missing User Email /";
    isset($_GET['total'])           ? $order_total=$_GET['total']        : $errorDisplay .= " Missing Order Total /";
    isset($_GET['order_id'])        ? $order_BGID=$_GET['order_id']      : $errorDisplay .= " Missing BG Order ID /";

    if(isset($_SESSION['orderID'])){
        $orderID = $_SESSION['orderID'];
    }
    
    if(isset($_GET['external_order_id'])){
        $orderID = $_GET['external_order_id'];
    }


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

    $logArray['0'] = "BABY-ORDER-PAID";

    $order_date = date('Y-m-d H:i:s');

    empty($errorDisplay) ?  $testError = FALSE : $testError = TRUE;
    if($testError == TRUE){
    $title = "Error: Can't Process your Order!";
    $titlePage = "Can't Process your Order!";
    $sdescription = $errorDisplay;
    $logArray['0'] = "BABY-SUCCESS-ERROR";
    $errorID  = md5($errorDisplay.$order_date);
    $logArray['4'] = $errorID;
    $logArray['5'] = $errorDisplay;
    include $_SERVER['DOCUMENT_ROOT'].'/templates/error/error-log.php';
    SuperLog($logArray, "error");
    }else{
    $_SESSION['funnel_page'] = "funnel-complete";
    $title = "Processing Your Order...";

    $titlePage = "Processing Your Order...";
    $sdescription = "Almost Done!";
    
    $logArray['4'] = $order_email;
    $logArray['4'] = $order_total;
    $logArray['5'] = $order_BGID;

    //Update order status and other info from BG
    $sql = "UPDATE `orders` SET `order_status`='paid',`bg_email`='$order_email',`order_price`='$order_total',`buygoods_order_id`='$order_BGID' WHERE `order_id`='$orderID'";
    if ($conn->query($sql) === TRUE) {
        $logArray['7'] = "Success";
    } else {
        $logArray['7'] = "Error: " . $sql->error . "<br>" . $conn->error;
    }

    //Save data to orders log
	$TimeNow = date('y-m-d H:i:s', time());
    $sql2 = "INSERT INTO orders_log (user_id, order_id, type, time, notice) VALUES ('$userID', '$orderID', 'status', '$TimeNow', 'Order Status updated to Paid!')";
    if ($conn->query($sql2) === TRUE) {
        $logArray['8'] = "Success";
    } else {
        $logArray['8'] = "Error: " . $sql2->error . "<br>" . $conn->error;
    }

    $conn->close();
    SuperLog($logArray, "order");

    $finalLink = "/order/complete";
}
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