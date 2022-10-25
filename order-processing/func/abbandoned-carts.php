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
$cart = $row["abandoned_cart"];
$orderProduct = $row["order_product"];
$orderPriority = $row["order_priority"];
$orderEmail = $row["order_email"];
$orderStatus = $row["order_status"];
$emailLink = $base_url ."/dashboard.php?check_email=" .$orderEmail;
$restoreLink = $row["cart_recover"];
$partner = $row['pick_sex'];
$birthday = $row['birthday'];
$orderPrice = $row['order_price'];
$cartRecover = $row['cart_recover'];
$newPrice = $orderPrice / 2;

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

				
			//Check if any previous orders
			$sql = "SELECT * FROM `orders` WHERE (`order_email` = '$orderEmail' AND `order_product` = '$orderProduct' AND `order_status` = 'processing') OR (`order_email` = '$orderEmail' AND `order_product` = '$orderProduct' AND `order_status` = 'shipped') ORDER BY `order_id` DESC";
			$result = $conn->query($sql);
			$count = $result->num_rows;

			$AbandonSubject = "You forgot about your order!";
				if($count <= 1) {
					$email = NULL;
					$sendgrid = NULL;
					$response = NULL;
					$email = new Mail();
					$email->setFrom("contact@psychic-empress.com", "Psychic Empress");
					$email->setSubject($AbandonSubject);
					$email->addTo(
						$orderEmail,
						$orderName,
						[
							"name" => $orderName,
							"email" => $orderEmail,
							"status" => $orderStatus,
							"product" => $order_product_nice,
							"orderid" => $orderID,
							"partner" => $partner,
							"birthday" => $birthday,
							"price" => $orderPrice,
							"newprice" => $newPrice,
							"restorelink" => $cartRecover,
							"msg" => $AbandonMessage
						]
					);
					$email->setTemplateId("d-7ef6c271357e4b6092f423cc1a96ab5e");
					$sendgrid = new \SendGrid($sendg3);
					try {
						$response = $sendgrid->send($email);
						print_r($response);
						error_log($orderEmail);

						//Mark the cart abandon email as sent in DB
						$sqlupdate = "UPDATE `orders` SET `abandoned_cart`='sent' WHERE order_id='$orderID'";
						if ($conn->query($sqlupdate) === TRUE) {
						}
					} catch (Exception $e) { 
						echo 'Caught exception: '.  $e->getMessage(). "\n";
						error_log('$e->getMessage()');
					}


				}

			
			
		
		
				
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
	
			$logArray[] =  "Start Event Sent";

			SuperLog($logArray, "abandoned");
			unset($logArray);
            echo " <br>"; 
			}
			}elseif($hours > 48){
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
			
			}

            
        }

           
        }


    echo "<br><hr>"
 ?>
