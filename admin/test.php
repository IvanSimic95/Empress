<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';
$sql = "SELECT * FROM orders WHERE order_status = 'completed'";
$result = $conn->query($sql);

$ordersc = $result->num_rows;

$sql2 = "SELECT * FROM orders WHERE order_status = 'completed' AND form = 'normal'";
$result2 = $conn->query($sql2);

$normal = $result2->num_rows;


$sql3 = "SELECT * FROM orders WHERE order_status = 'completed' AND form = 'progressive'";
$result3 = $conn->query($sql3);

$progressive = $result3->num_rows;


$sql4 = "SELECT * FROM orders WHERE order_status = 'completed' AND form = 'interactive'";
$result4 = $conn->query($sql4);

$interactive = $result4->num_rows;

echo "Orders: ".$ordersc."<hr>";

echo "Normal Form: ".$normal."<hr>";

echo "Interactive Form: ".$interactive."<hr>";

echo "Progressive Form: ".$progressive."<hr>";

?>