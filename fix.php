<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';




	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}


	$sql = 'SELECT * from orders WHERE user_sex = "unknown" AND order_status= "processing" LIMIT 50';
	$sqlResoult = $conn->query($sql);
	if($sqlResoult->num_rows == 0) {
	   echo "No Orders with STATUS = PROCESSING found in database.<br><hr>";
	} else {
		echo "Processing Orders: ".$sqlResoult->num_rows."<br><br>";
		while($row = $sqlResoult->fetch_assoc()) {
			$orderDate = $row["order_date"];
			$orderName = $row["user_name"];
			$ex = explode(" ",$orderName);
			$fName = $ex["0"];
			$orderID = $row["order_id"];
			$orderEmail = $row["order_email"];
			$orderAge = $row["user_age"];
			$orderPrio = $row["order_priority"];
			$orderProduct = $row["order_product"];
			$orderSex = $row["pick_sex"];
			$userSex = $row["user_sex"];
			$date1 = $orderDate;
			$date2 =  date("Y-m-d H:i:s");
			$start = new \DateTime($date1);
			$end = new \DateTime($date2);
			$interval = new \DateInterval('PT1H');
			$periods = new \DatePeriod($start, $interval, $end);
			$hours = iterator_count($periods);
			
			
$parser = new TheIconic\NameParser\Parser();
$name = $parser->parse($orderName);

$fName = $name->getFirstname();
$lName = $name->getLastname();

$oStatus = "pending";

  //Find User Gender
  function findGender($name) {
    $apiKey = 'Whc29bSnvP3zrQG3hYCwXKMoYu5h4ZQukS6n'; //Your API Key
    $getGender = json_decode(file_get_contents('https://gender-api.com/get?key=' . $apiKey . '&name=' . urlencode($name)));
    $data = [[
        "gender" => $getGender->gender,
        "accuracy"  => $getGender->accuracy
        ]];
    return $data;
    }
    
$findGenderFunc = findGender($fName);
$userGender = $findGenderFunc['0']['gender'];
$userGenderAcc = $findGenderFunc['0']['accuracy'];

$fbCampaign = $_SESSION['fbCampaign'];
$fbAdset = $_SESSION['fbAdset'];
$fbAd = $_SESSION['fbAd'];

if($userGender=="male"){
$partnerGender = "female";
}else{
$partnerGender = "male";
}
			
			
			
			$sqlupdate = "UPDATE `orders` SET `user_sex`='$userGender',`pick_sex`='$partnerGender',`order_status`='processing' WHERE order_id='$orderID'";
			if ($conn->query($sqlupdate) === TRUE) {
		    echo $orderID;

		}}}
?>