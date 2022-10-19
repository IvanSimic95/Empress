<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';
echo "Starting abbandoned-carts.php...<br><br>";


// 1. Check and select paid orders.

	$sqlpending = "SELECT * FROM `orders` WHERE `order_status` = 'pending' AND `order_product` = 'soulmate'";
	$resultpending = $conn->query($sqlpending);
	if($resultpending->num_rows == 0) {
	   echo "No Orders with STATUS = PENDING found in database.";
	}else{
        echo "Pending Orders: ".$resultpending->num_rows."<br><br>";
		$logArray[] = "Pending: ".$resultpending->num_rows;
		while($row = $resultpending->fetch_assoc()) {
            
$logArray = array();
$logArray['1'] = date("d-m-Y H:i:s");
			
			$orderDate = $row["order_date"];
			$orderName = $row["user_name"];
		    $ex = explode(" ",$orderName);
			$customerName =  $ex["0"];
			$orderID = $row["order_id"];
			$userID = $row["user_id"];
			$cart = $row["abandoned_cart"];
			$orderProduct = $row["order_product"];
			$orderPriority = $row["order_priority"];
			$orderEmail = $row["order_email"];
			$emailLink = $base_url ."/dashboard.php?check_email=" .$orderEmail;

            $date1 = $orderDate;
			$date2 =  date("Y-m-d H:i:s");
			$start = new \DateTime($date1);
			$end = new \DateTime($date2);
			$interval = new \DateInterval('PT1H');
			$periods = new \DatePeriod($start, $interval, $end);
			$hours = iterator_count($periods);

			$logArray[] =  $orderID;
			$logArray[] =  $orderEmail;
			$logArray[] =  $orderProduct."-".$orderPriority;
            $logArray[] =  $hours." Hours ago";

			$CreatedAt = time();
       		
			if($hours > 1 && $hours < 2){
			if($cart == "active"){
				
			}else{
				
			// Set order to canceled
			$sqlupdate2 = "UPDATE `orders` SET `abandoned_cart`='active' WHERE order_id='$orderID'";
			if ($conn->query($sqlupdate2) === TRUE) {
			$logArray[] =  "Order Abandon Started";
			}

			//Save data to orders log
			$TimeNow = date('y-m-d H:i:s', time());
			$sql2 = "INSERT INTO orders_log (user_id, order_id, type, time, notice) VALUES ('$userID', '$orderID', 'status', '$TimeNow', 'Cart Recovery Emails Started')";
			if ($conn->query($sql2) === TRUE) {
			$logArray[] =  "Log Emails Started";
			}
  
			//CODE TO START ABANDONED CART PROCESS
			$ch = curl_init();
			$data = [
			"action" => "Cart Abandoned",
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
			$logArray[] =  "Start Event Sent";

			SuperLog($logArray, "abandoned");
			unset($logArray);
            echo " <br>"; 
			}
			}elseif($hours > 2){
            // Set order to canceled
			$sqlupdate = "UPDATE `orders` SET `order_status`='canceled' WHERE order_id='$orderID'";
            if ($conn->query($sqlupdate) === TRUE) {
			echo "Order Canceled ";
			$logArray[] =  "Order Canceled";
            }

			//Save data to orders log
			$TimeNow = date('y-m-d H:i:s', time());
			$sql2 = "INSERT INTO orders_log (user_id, order_id, type, time, notice) VALUES ('$userID', '$orderID', 'status', '$TimeNow', 'Order Status changed to Canceled!')";
			if ($conn->query($sql2) === TRUE) {
			$logArray[] =  "Log Updated";
			}

			$sql3 = "INSERT INTO notifications (user_id, order_id, unread, title, description, custom, time) VALUES ('$userID', '$orderID', '1', 'Order Canceled' , 'Order Status updated to Canceled due to lack of payment!', 'test', '$TimeNow')";
			if ($conn->query($sql3) === TRUE) {
			 	echo "Notification Success ";
			 	$logArray[] = "Notification Success";
			} else {
			 	echo "Notification Failed ";
			 	$logArray[] = "Notification Failed";
			 }

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

			SuperLog($logArray, "abandoned");
			unset($logArray);
            echo " <br>"; 
			}

            
        }

           
        }


    echo "<br><hr>"
 ?>
