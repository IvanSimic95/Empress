<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';
use SendGrid\Mail\Mail;
if(!$conn){ //CHECK DB CONNECTION FIRST
$submitStatus = "Database Error!";
$EMessage = 'Could not Connect to Database Server:'.mysql_error();
$returnData = [$submitStatus,$EMessage];
echo json_encode($returnData);
die();
}

$request = $_SERVER['REQUEST_METHOD'];

if ($request === 'POST') {


$cat = $_POST['category'];
$ema = $_POST['email'];
$msg = $_POST['message'];
$name = "customer";

$email = new Mail();
			$email->setFrom("contact@psychic-empress.com", "Psychic Empress");
			$email->setSubject("Support Request");
			$email->addTo("contact@psychic-empress.com", "Psychic Empress",
				[
					"category" => $cat,
					"email" => $ema,
					"message" => $msg,
				]
			);
			$email->replyTo($ema, $name);
			$email->setTemplateId("d-571356252dcb43a6a5a21000cf895328");
			$sendgrid = new \SendGrid($sendg3);
			try {
				$response = $sendgrid->send($email);
        $submitStatus = "Success";
        $SuccessMessage = "Support Request Sent!";
        $redirectPayment = "";
        $returnData = [$submitStatus,$SuccessMessage,$redirectPayment];
        echo json_encode($returnData);
			} catch (Exception $e) { 
				echo 'Caught exception: '.  $e->getMessage(). "\n";
				error_log('$e->getMessage()');

        $lastRowInsert = "";
        $submitStatus = "Error";
        $ErrorMessage = "Error: " . $sql . "" . mysqli_error($conn);
        $returnData = [$submitStatus,$ErrorMessage];
        echo json_encode($returnData);
			}



$conn->close();



}else{
echo "Direct access is not allowed!";  
}


?>