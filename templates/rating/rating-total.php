<?php

$sql = "SELECT * FROM reviews WHERE review_moderated = 'approved' AND product_id = '".$productID."' ORDER BY review_date DESC";
$result = $conn->query($sql);
$count = $result->num_rows;

if($count > 1){

$sql5 = "SELECT * FROM reviews WHERE review_moderated = 'approved' AND product_id = '".$productID."' AND review_rating = '5.0' ORDER BY review_date DESC";
$fiveresult = $conn->query($sql5);
$countfive = $fiveresult->num_rows;


$sql4 = "SELECT * FROM reviews WHERE review_moderated = 'approved' AND product_id = '".$productID."' AND review_rating = '4.0' ORDER BY review_date DESC";
$fourresult = $conn->query($sql4);
$countfour = $fourresult->num_rows;


$sql3 = "SELECT * FROM reviews WHERE review_moderated = 'approved' AND product_id = '".$productID."' AND review_rating = '3.0' ORDER BY review_date DESC";
$threeresult = $conn->query($sql3);
$countthree = $threeresult->num_rows;


$sql2 = "SELECT * FROM reviews WHERE review_moderated = 'approved' AND product_id = '".$productID."' AND review_rating = '2.0' ORDER BY review_date DESC";
$tworesult = $conn->query($sql2);
$counttwo = $tworesult->num_rows;


$sql1 = "SELECT * FROM reviews WHERE review_moderated = 'approved' AND product_id = '".$productID."' AND review_rating = '1.0' ORDER BY review_date DESC";
$oneresult = $conn->query($sql1);
$countone = $oneresult->num_rows;


$avgrate = $countfive*"5" + $countfour*"4" + $countthree*"3" + $counttwo*"2" + $countone*"1";
$avgratet = $countfive + $countfour + $countthree + $counttwo + $countone;
$avgratefinal = $avgrate / $avgratet;
$avg = round($avgratefinal, "2");



$avgsplit = explode(".", $avg);//Try splitting average rating number from its decimals
$countsplit = count($avgsplit);//Check how many array elements after split

//If array only 1 element that means its round number
if($countsplit == 1){
$deci = "no";
$avgprimary = $avgsplit[0];
$avgsecondary = "0"; 
$avg = $avg . ".00";
}else{//If more than one then it had decimals
$deci = "yes";
$avgprimary = $avgsplit[0];
$avgsecondary = $avgsplit[1]; 
}

if($avgsecondary < 10){
$avgsecondary = $avgsecondary ."0";
}

//If avg rating is lower than 5 calculate empty stars number, if its 5 there are none empty
if($avgprimary < "5"){
$emptycalc = "4" - $avgprimary;
}else{
$emptycalc = "0";
}

$starhtml = '<span class="sprw-star-icon full"><i class="fa fa-star"></i></span>';
$emptystarhtml = '<span class="sprw-star-icon"><i class="fa fa-star"></i></span>';

if($avgsecondary < 30){
$avgsecondary = $avgsecondary + 20;
}

function get_percentage($total, $number)
{
if ( $total > 0 ) {
return round(($number * 100) / $total, 2);
} else {
return 0;
}
}

$bar5 = get_percentage($avgratet,$countfive);
$bar5 = round($bar5, "0");

$bar4 = get_percentage($avgratet,$countfour);
$bar4 = round($bar4, "0");

$bar3 = get_percentage($avgratet,$countthree);
$bar3 = round($bar3, "0");

$bar2 = get_percentage($avgratet,$counttwo);
$bar2 = round($bar2, "0");

$bar1 = get_percentage($avgratet,$countone);
$bar1 = round($bar1, "0");

}else{
$countfive = $countfour = $countthree = $counttwo = $countone = "0";
$bar5 = $bar4 = $bar3 = $bar2 = $bar1 = "0";
$avg = "5.0";
$count = "0";
}
?>