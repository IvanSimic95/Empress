<?php
//Check if server is localhost or guru and save DB info
$domain = $_SERVER['SERVER_NAME'];
if($domain == "pa.test"){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "pa";
  $base_url = "https://pa.test";
}else{
	$servername = "localhost";
	$username = "psychic_newpanel";
	$password = "Jepang123Iva";
	$db = "psychic_newpanel";
  $base_url = "https://psychic-artist.com";
}

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
$conn->query('set character_set_client=utf8');
$conn->query('set character_set_connection=utf8');
$conn->query('set character_set_results=utf8');
$conn->query('set character_set_server=utf8');
$conn->set_charset('utf8mb4');


// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM reviews ORDER BY review_date DESC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
$timestamp = rand( strtotime("Feb 01 2022"), strtotime("Feb 23 2022") );
$random_Date = date('Y-m-d H:i:s', $timestamp );
$id = $row['review_id'];
$text = $row['review_text'];

$newtext = str_replace("Melissa","Psychic Artist",$text);

$sql2 = "UPDATE `reviews` SET `review_date`='$random_Date' WHERE review_id='$id'" ;
$result2 = $conn->query($sql2); //UNCOMMENT THIS TO MAKE IT WORK! 
}
?> 