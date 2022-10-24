<?php
$orderDate = "2022-10-24 22:04:47";
$date = new DateTime($orderDate);
$orderPriority = 24;
$expectedelivery = date("F d, Y h:i:s", strtotime('+'.$orderPriority.' hours', $date));
echo $expecteddelivery;
?>