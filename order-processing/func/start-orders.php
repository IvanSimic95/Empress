<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';

echo "Starting start-orders.php...<br><br>";
    





// 1. Check and select paid orders.

	$sqlpending = "SELECT * FROM `orders` WHERE `order_status` = 'paid'";
	$resultpending = $conn->query($sqlpending);
	if($resultpending->num_rows == 0) {
	   echo "No Orders with STATUS = PAID found in database.";
	}else{
		echo "Paid Orders: ".$resultpending->num_rows."<br><br>";
			$logArray['4'] = "Paid Orders: ".$resultpending->num_rows;
		while($row = $resultpending->fetch_assoc()) {
$logArray = array();
$logArray['1'] = date("d-m-Y H:i:s");

			$orderDate = $row["order_date"];
			$orderName = $row["user_name"];
		    $fName = $row["first_name"];
			$lName = $row["last_name"];
			$orderID = $row["order_id"];
			$userID = $row["user_id"];
			$orderProduct = $row["order_product"];
			$orderPriority = $row["order_priority"];
			$orderPrio = $orderPriority;
			$orderSex = $row["pick_sex"];
			$userSex = $row["user_sex"];
			$orderEmail = $row["order_email"];
			$emailLink = $base_url ."/dashboard.php?check_email=" .$orderEmail;
			$message = $processingWelcome;

			$dbaffID = $row["affid"];
			$dbclickID = $row["clickid"];
			$subid1 = $row["subid1"];
			$subid2 = $row["subid2"];

			$price = $row["order_price"];
			$bg_email = $row["bg_email"];
			$product_nice = $row["product_nice"];

			$cart = $row["abandoned_cart"];

			$message = str_replace("%ORDERID%",   $orderID, $message);
			$message = str_replace("%PRIORITY%",  $orderPriority, $message);
			$message = str_replace("%EMAILLINK%", $emailLink , $message);


			$sql2 = "SELECT * FROM users WHERE id = '$userID'";
			$result2 = $conn->query($sql2);
			$row2 = mysqli_fetch_assoc($result2);

			$fbCampaign = $row["fbCampaign"];
			$fbAdset 	= $row["fbAdset"];
			$fbAd 		= $row["fbAd"];

		

			$logArray[] = $orderID;
			$logArray[] = $orderEmail;
			$logArray[] = $orderProduct."-".$orderPriority;
			$CreatedAt = time();
			
			//CODE TO SEND EMMAIL NOTIFYING ABOUT SWITCHING ORDER STATUS TO PROCESSING

			if($cart=="active"){
			//CODE TO STOP ABANDONED CART PROCESS
			$ch = curl_init();
			$data = [
			"action" => "Cart Recovered",
			"email" => $orderEmail,
			"created_at" => $CreatedAt
			];
			$jData = json_encode($data);
			curl_setopt($ch, CURLOPT_URL, 'https://beacon.crowdpower.io/events');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jData);
			$headers = array();
			$headers[] = 'Content-Type: application/json';
			$headers[] = 'Authorization: Bearer sk_7b8f2be0b4bc56ddf0a3b7a1eed2699d19e3990ebd3aa9e9e5c93815cdcfdc64';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			$logArray[] =  "Stop Event Sent";


			}
            

		 	//	Update Order Status Processing
			$sqlupdate = "UPDATE `orders` SET `order_status`='processing' WHERE order_id='$orderID'";
			if ($conn->query($sqlupdate) === TRUE) {
      			echo "Status changed to: Processing! ";
				$logArray[] = "Update Status Success";
			} else {
				$logArray[] = "Updated Status Failed";
			}

			//Save data to orders log
			$TimeNow = date('y-m-d H:i:s', time());
    		$sql2 = "INSERT INTO orders_log (user_id, order_id, type, time, notice) VALUES ('$userID', '$orderID', 'status', '$TimeNow', 'Order Status updated to Processing!')";
   			if ($conn->query($sql2) === TRUE) {
				echo "Log Success ";
				$logArray[] = "Insert Log Success";
   			} else {
				echo "Insert Log Failed ";
				$logArray[] = "Insert Log Failed";
			}

			$sql3 = "INSERT INTO notifications (user_id, order_id, unread, title, description, custom, time) VALUES ('$userID', '$orderID', '1', 'Status Updated' , 'Order Status updated to Processing!', 'test', '$TimeNow')";
   			if ($conn->query($sql3) === TRUE) {
				echo "Notification Success ";
				$logArray[] = "Insert Notification Success";
   			} else {
				echo "Notification Failed ";
				$logArray[] = "Insert Notification Failed";
			}

			//Insert into ads log
			if($fbCampaign !="" && $fbAdset !="" && $fbAd !=""){
				$sql4 = "INSERT INTO ads_log (campaign, adset, ad, time, order_id, price) VALUES ('$fbCampaign', '$fbAdset', '$fbAd', '$orderDate' , '$orderID', '$price')";
   			if ($conn->query($sql4) === TRUE) {
				echo "Ads Log Success ";
				$logArray[] = "Ads Log Success";
   			} else {
				echo "Ads Log Failed ";
				$logArray[] = "Ads Log Failed";
			}

			}


			if($orderProduct == "soulmate" OR $orderProduct == "twinflame" OR $orderProduct == "futurespouse"){
				if($affID!=0){
				//Code to send to aff network
				}
			}




			//Send data to zapier so it can submit FB conversion and send an email to user
			$ch = curl_init();
			$data = [
			"fname" => $fName,
			"lname" => $lName,
			"orderID" => $orderID,
			"userID" => $userID,
			"email" => $orderEmail,
			"priority" => $orderPrio,
			"product" => $orderProduct,
			"product_nice" => $product_nice,
			"gender" => $userSex,
			"Pgender" => $orderSex,
			"price" => $price
			];

			$jData = json_encode($data);
			curl_setopt($ch, CURLOPT_URL, 'https://hooks.zapier.com/hooks/catch/4722157/bih1wv9/');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jData);
			$headers = array();
			$headers[] = 'Content-Type: application/json';
			$headers[] = 'Authorization: Bearer sk_7b8f2be0b4bc56ddf0a3b7a1eed2699d19e3990ebd3aa9e9e5c93815cdcfdc64';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			$logArray[] =  "Data sent to zapier";
			echo "Data sent to zapier";

			SuperLog($logArray, "start-orders");
			unset($logArray);
            echo " <br>"; 

			if($dbaffID > 0){

			//Send data to zapier so it can submit FB conversion and send an email to user
			$ch = curl_init();
			$data = [
			"affid" => $dbaffID,
			"subid1" => $subid1,
			"subid2" => $subid2
			];

			$requestURL = "https://www.brcvhf7tf.com/?nid=1488&transaction_id=".$dbclickID;
			echo $requestURL;
			
			$jData = json_encode($data);
			curl_setopt($ch, CURLOPT_URL, $requestURL);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jData);
			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			echo "Data sent to affiliate postback";
            echo " <br>"; 
			}
		}
	}
	echo "<br><hr>";
 ?>
