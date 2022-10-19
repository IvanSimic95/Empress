<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';

$data = file_get_contents('php://input');
$json_data = json_decode($data);


$order_email = $json_data->email;
$order_price = $json_data->price;
$order_buygoods = $json_data->bgorderid;
$cookie = $json_data->cookie;
$mOrderID = $json_data->morderid;
$cName = $json_data->cName;
$cPhone = $json_data->cPhone;
$productImage = $json_data->productImage;
$productFullTitle = $json_data->productFullTitle;
$signedUpAt = time();

if($order_email) {

    $sql = "UPDATE `orders` SET `order_status`='paid',`bg_email`='$order_email',`order_price`='$order_price',`buygoods_order_id`='$order_buygoods' WHERE order_id='$mOrderID'" ;

    if ($conn->query($sql) === TRUE) {
      echo "Order Status updated to Paid succesfully!";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    	//Save data to orders log
			$TimeNow = date('y-m-d H:i:s', time());
      $sql2 = "INSERT INTO orders_log (order_id, type, time, notice) VALUES ('$mOrderID', 'status', '$TimeNow', 'Order Status updated to Paid!')";
       if ($conn->query($sql2) === TRUE) {
       }

    $clean_order_price = str_replace(".","",$order_price);
    $ch = curl_init();
    $data = [
    "user_id" => $mOrderID,
    "amount" => $clean_order_price,
    "email" => $order_email,
    "created_at" => $signedUpAt
    ];
    $jData = json_encode($data);
    print_r($jData);
    curl_setopt($ch, CURLOPT_URL, 'https://beacon.crowdpower.io/charges');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jData);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer sk_7b8f2be0b4bc56ddf0a3b7a1eed2699d19e3990ebd3aa9e9e5c93815cdcfdc64';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);

    $sql = "SELECT * FROM orders WHERE order_id = '".$mOrderID."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $test_email = $row['order_email'];
    if($test_email="" OR $test_email=NULL){


    $sql = "UPDATE `orders` SET `order_email`='$order_email' WHERE order_id='$mOrderID'" ;
    if ($conn->query($sql) === TRUE) {
       // echo "Order Status updated to Paid succesfully!";
      } else {
      //  echo "Error: " . $sql . "<br>" . $conn->error;
      }


      $conn->close();


    }

  }
?>