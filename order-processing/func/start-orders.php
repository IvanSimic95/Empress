<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use Mailgun\Mailgun;

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
			$orderProductCode = $row["product_codename"];
			$productNice = $row["product_nice"];
			$orderPriority = $row["order_priority"];
			$priorityRandom = 3;
			$orderDate = $row["order_date"];
			$orderPrio = $orderPriority;
			$orderSex = $row["pick_sex"];
			$userSex = $row["user_sex"];
			$orderEmail = $row["order_email"];
			$emailLink = $base_url ."/dashboard.php?check_email=" .$orderEmail;
			$message = $processingWelcome;
			$birthday = $row["birthday"];
			$niceBirthday = date('F d, Y', strtotime($birthday));

			$orderPrice = $row["order_price"];

			$finalPriority = $orderPriority - $priorityRandom;
			$orderTime = (strtotime($orderDate));
			$newDateDay = date('F d,', strtotime('+'.$orderPriority.' hours', $orderTime));

			$newDateHourMin = date('h A', strtotime('+'.$finalPriority.' hours', $orderTime));
			$newDateHourMax = date('h A', strtotime('+'.$orderPriority.' hours', $orderTime));

			$DeliveryTime = $newDateDay." ".$newDateHourMin." - ".$newDateHourMax;

			$fbp = $row["fbp"];
			$fbc = $row["fbc"];

			$ip = $row["ip"];
			$agent = $row["agent"];

			$dbaffID = $row["affid"];
			$dbclickID = $row["clickid"];


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


			//Facebook API conversion
if($orderProduct == "soulmate" OR $orderProduct == "futurespouse"){
	if($sendFBAPI == 1){
	 $fixedBirthday = date("Ymd", strtotime($birthday));
	 if($userSex == "male"){
		$usersex1 = "m";
	}else{
		$usersex1 = "f";
	}



 
	 if (!empty($fbc) AND empty($fbp)) {
		 $data = array( // main object
			 "data" => array( // data array
				 array(
					 
					 "event_name" => "Purchase",
					 "event_time" => time(),
					 "event_id" => $orderID,
					 "user_data" => array(
						 "fn" => hash('sha256', $fName),
						 "ln" => hash('sha256', $lName),
						 "em" => hash('sha256', $orderEmail),
						 "db" => hash('sha256', $fixedBirthday),
						 "ge" => hash('sha256', $usersex1),
						 "external_id" => hash('sha256', $orderID),
						 "fbc" => $fbc,
						 "client_ip_address" => $ip,
						 "client_user_agent" => $agent,
	
					 ),
					 "contents" => array(
						 array(
						 "id" => $orderProduct,
						 "quantity" => 1
						 ),
					 ),
					 "custom_data" => array(
						 "currency" => "USD",
						 "value"    => $orderPrice,
					 ),
					 "action_source" => "website",
					 "event_source_url"  => "https://".$domain."/readings.php",
				),
			 ),
				"access_token" => $fbAccessToken,
				
			 ); 
	 }elseif(empty($fbp) AND !empty($fbc)){
		 $data = array( // main object
			 "data" => array( // data array
				 array(
					 
					 "event_name" => "Purchase",
					 "event_time" => time(),
					 "event_id" => $orderID,
					 "user_data" => array(
						"fn" => hash('sha256', $fName),
						"ln" => hash('sha256', $lName),
						"em" => hash('sha256', $orderEmail),
						"db" => hash('sha256', $fixedBirthday),
						"ge" => hash('sha256', $usersex1),
						"external_id" => hash('sha256', $orderID),
						 "fbp" => $fbp,
						 "client_ip_address" => $ip,
						 "client_user_agent" => $agent,
		
					 ),
					 "contents" => array(
						 array(
						 "id" => $orderProduct,
						 "quantity" => 1
						 ),
					 ),
					 "custom_data" => array(
						 "currency" => "USD",
						 "value"    => $orderPrice,
					 ),
					 "action_source" => "website",
					 "event_source_url"  => "https://".$domain."/readings.php",
				),
			 ),
				"access_token" => $fbAccessToken,
				
			 ); 
 
	 }elseif(!empty($fbp) AND !empty($fbc)){
		 $data = array( // main object
			 "data" => array( // data array
				 array(
					 
					 "event_name" => "Purchase",
					 "event_time" => time(),
					 "event_id" => $orderID,
					 "user_data" => array(
						"fn" => hash('sha256', $fName),
						"ln" => hash('sha256', $lName),
						"em" => hash('sha256', $orderEmail),
						"db" => hash('sha256', $fixedBirthday),
						"ge" => hash('sha256', $usersex1),
						"external_id" => hash('sha256', $orderID),
						 "fbc" => $fbc,
						 "fbp" => $fbp,
						 "client_ip_address" => $ip,
						 "client_user_agent" => $agent,
		
					 ),
					 "contents" => array(
						 array(
						 "id" => $orderProduct,
						 "quantity" => 1
						 ),
					 ),
					 "custom_data" => array(
						 "currency" => "USD",
						 "value"    => $orderPrice,
					 ),
					 "action_source" => "website",
					 "event_source_url"  => "https://".$domain."/readings.php",
				),
			 ),
				"access_token" => $fbAccessToken,
				
			 ); 
	 }else{
	 $data = array( // main object
		 "data" => array( // data array
			 array(
				 
				 "event_name" => "Purchase",
				 "event_time" => time(),
				 "event_id" => $orderID,
				 "user_data" => array(
					"fn" => hash('sha256', $fName),
					"ln" => hash('sha256', $lName),
					"em" => hash('sha256', $orderEmail),
					"db" => hash('sha256', $fixedBirthday),
					"ge" => hash('sha256', $usersex1),
					"external_id" => hash('sha256', $orderID),
					 "client_ip_address" => $ip,
					 "client_user_agent" => $agent,

				 ),
				 "contents" => array(
					 array(
					 "id" => $orderProduct,
					 "quantity" => 1
					 ),
				 ),
				 "custom_data" => array(
					 "currency" => "USD",
					 "value"    => $orderPrice,
				 ),
				 "action_source" => "website",
				 "event_source_url"  => "https://".$domain."/readings.php",
			),
		 ),
			"access_token" => $fbAccessToken,
			
		 );  
		 
	 }
		 $dataString = json_encode($data);                                                                                                              
		 $ch = curl_init('https://graph.facebook.com/v11.0/'.$FBPixel.'/events');                                                                      
		 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		 curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);                                                                  
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		 curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			 'Content-Type: application/json',                                                                                
			 'Content-Length: ' . strlen($dataString))                                                                       
		 );                                                                                                                                                                       
		 $response = curl_exec($ch);
		 error_log($response);
		 echo $response;
	 }
 }

$emailText = "Hello ".$fName.", We have received your payment for order #".$orderID." and have confirmed your order. You will receive an email shortly with your reading. Thank you for your business! Psychic Empress";

 $mgClient = new Mailgun($mg);
 $domain = "notification.psychic-empress.com";
 # Make the call to the client.
 $result = $mgClient->sendMessage($domain, array(
	 'from'	=> 'Psychic Empress <noreply@notification.psychic-empress.com>',
	 'to'	=> $orderEmail,
	 'subject' => 'Payment Confirmed!',
	 'text'	=> $emailText
 ));


/*
			$email = new Mail();
			$email->setFrom("contact@psychic-empress.com", "Psychic Empress");
			$email->setSubject("Payment Confirmed!");
			$email->addTo(
				$orderEmail,
				$orderName,
				[
					"fullname" => $orderName,
					"fname" => $fName,
					"email" => $orderEmail,
					"status" => "processing",
					"product" => $orderProductCode,
					"productNice" => $productNice,
					"orderid" => $orderID,
					"gender" => $userSex,
					"partner" => $orderSex,
					"dob" => $niceBirthday,
					"price" => $price,
					"emaillink" => $emailLink,
					"msg" => $message,
					"delivery" => $DeliveryTime
				]
			);
			$email->setTemplateId("d-94ff935883c14a6186def78f3bef0d84");
			$sendgrid = new \SendGrid($sendg3);
			try {
				$response = $sendgrid->send($email);
				print_r($response);
				error_log($orderEmail);

				
			$logArray[] =  "New order email sent";
			echo "New order email sent";

			SuperLog($logArray, "start-orders");
			unset($logArray);
            echo " <br>"; 
		} catch (Exception $e) { 
			echo 'Caught exception: '.  $e->getMessage(). "\n";
			error_log('$e->getMessage()');

		}
*/
	
	}
}
	echo "<br><hr>";
 ?>