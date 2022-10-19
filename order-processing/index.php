<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include $_SERVER['DOCUMENT_ROOT'].'/order-processing/func/start-orders.php';
include $_SERVER['DOCUMENT_ROOT'].'/order-processing/func/complete-orders.php';
include $_SERVER['DOCUMENT_ROOT'].'/order-processing/func/abbandoned-carts.php';

/*
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.melissa-psychic.com/assets/order/func/start-orders.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPGET, 1);

$result = curl_exec($ch);
if (curl_errno($ch)) { echo 'Error:' . curl_error($ch);}
curl_close ($ch);
echo $result ;

$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, 'https://www.melissa-psychic.com/assets/order/func/complete-orders.php');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_HTTPGET, 1);

$result2 = curl_exec($ch2);
if (curl_errno($ch2)) { echo 'Error:' . curl_error($ch2);}
curl_close ($ch2);
echo $result2;
*/
?>