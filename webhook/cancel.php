<?php
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

if($order_email) {
include $_SERVER['DOCUMENT_ROOT'].'/config/vars.php';

    $sql = "UPDATE `orders` SET `order_status`='canceled',`order_email`='$order_email',`order_price`='$order_price',`buygoods_order_id`='$order_buygoods' WHERE order_id='$mOrderID'" ;

    if ($conn->query($sql) === TRUE) {
      echo "Order Status updated to Canceled succesfully!";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>