<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "pa";

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

//$cleanDB = mysqli_query($conn,'TRUNCATE TABLE orders_image;');

$d = $_SERVER['DOCUMENT_ROOT'].'order-processing/images/general'; 
$g = preg_grep('~\.(jpeg|jpg|png)$~', scandir($d));

foreach ($g as $key=>$item){
    echo $item.'<br>';
    $i = explode('-',$item);

    $a = $i[0];
    $a2 = $a + 9;
    $rage = rand($a,$a2);

    $g = $i[1];
    if($g == "m")$gender = "male";
    if($g == "f")$gender = "female";

    $insert = mysqli_query($conn,"INSERT INTO `orders_image` (`product`, `name`, `age`, `sex`) VALUES ('soulmate', '".$item."', '".$rage."', '".$gender."');");
}
?>