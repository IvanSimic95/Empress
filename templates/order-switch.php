<?php

$product = strtolower($row["order_product"]);
$productCodename = $product;
$product = ucwords($product);
switch ($product) {
case "Husband":
$product = "Future Husband Drawing";
$productCodename = "futurespouse";
break;

case "Pastlife":
$product = "Past Life Drawing";
$productCodename = "pastlife";
break;

case "Baby":
$product = "Future Baby Drawing";
$productCodename = "futurebaby";
break;

case "Soulmate":
$product = "Soulmate Drawing";
$productCodename = "soulmate";
break;

case "Twinflame":
$product = "Twin Flame Drawing";
$productCodename = "twinflamme";
break;

case "Future-baby":
$product = "Future Baby Drawing";
$productCodename = "futurebaby";
break;

case "General":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "General Love":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "General Love Career":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "General Love Career Health":
$product = "Personal Reading";
$productCodename = "personal";
break;


case "Love":
$product = "Personal Reading";
$productCodename = "personal";
break; 

case "Love Career":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "Love Career Health":
$product = "Personal Reading";
$productCodename = "personal";
break;


case "Career":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "Career Health":
$product = "Personal Reading";
$productCodename = "personal";
break;

case "Health":
$product = "Personal Reading";
$productCodename = "personal";
break;
}


$status = $row["order_status"];
$id = $row["order_id"];
$price = $row["order_price"];
$orderDate = $row["order_date"];
$link = $row["link"];

?>