<?php
$orderDate = "2022-10-24 22:04:47";
$orderPriority = 24;
$priorityRandom = 3;

$finalPriority = $orderPriority - $priorityRandom;

$orderTime = (strtotime($orderDate));
$newDateDay = date('F d,', strtotime('+'.$orderPriority.' hours', $orderTime));

$newDateHourMin = date('h A', strtotime('+'.$finalPriority.' hours', $orderTime));
$newDateHourMax = date('h A', strtotime('+'.$orderPriority.' hours', $orderTime));

echo "Delivery Time: ".$newDateDay." ".$newDateHourMin." - ".$newDateHourMax;
?>