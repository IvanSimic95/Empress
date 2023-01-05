<!DOCTYPE html>
<html>
    
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PA Profit</title>
</head>

<body>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';
$dateToday = date("d-m-Y");
echo "<div>Date: <p style='display:inline-block;'>".$dateToday."</p></div>";

echo "<hr>";



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v15.0/act_798761478055222/insights?__activeScenarioIDs=%5B%5D&__activeScenarios=%5B%5D&date_preset=today&fields=spend&level=account&transport=cors&access_token='.$FBToken);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
if (curl_errno($ch)) {echo 'Error:' . curl_error($ch);}
curl_close($ch);
$y = json_decode($result);
print_r($y);
$spentTotal = $y->data[0]->spend;


echo "<div>Spent: <p style='display:inline-block;'>".$spentTotal."</p></div>";


echo "<hr>";


$earnedSumSQL = "SELECT DATE(order_date),SUM(order_price) FROM orders WHERE order_status='completed' OR order_status='processing' GROUP BY DATE(order_date) ORDER BY DATE(order_date) desc LIMIT 1";
$earnedSumResult = $conn->query($earnedSumSQL);
while($rESum = $earnedSumResult->fetch_assoc()) {$earnedTotal = $rESum['SUM(order_price)'];}

echo "<div>Earned: <p style='display:inline-block;'>".$earnedTotal."</p></div>";

echo "<hr>";


$difference = $earnedTotal - $spentTotal;

$differenceKeyword = "";

if($difference <= 0){
    $differenceKeyword = "Lost";
    $differenceColor = "red";
}else{
    $differenceKeyword = "Profit";
    $differenceColor = "green";
}

$difference = str_replace('-', '', $difference);

echo "<div>".$differenceKeyword.": <p style='display:inline-block;color:".$differenceColor."'>$".$difference."</p></div>";









echo "<hr>";





$sqlOCount="SELECT COUNT(*) as total FROM orders WHERE (DATE_FORMAT(order_date, '%Y-%m-%d') = CURDATE() AND order_status='processing') OR (DATE_FORMAT(order_date, '%Y-%m-%d') = CURDATE() AND order_status='completed') OR (DATE_FORMAT(order_date, '%Y-%m-%d') = CURDATE() AND order_status='paid')";
$resultCount=mysqli_query($conn,$sqlOCount);
$dataCount=mysqli_fetch_assoc($resultCount);
$orderCountTotal = $dataCount['total'];
echo "<div>Orders: <p style='display:inline-block;'>".$orderCountTotal."</p></div>";








?>
<style>
div {
height:20px;
}
p{
    margin:0;
}
    </style>

</body>
    </html>