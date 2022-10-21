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

$email = new Mail();
			$email->setFrom("contact@psychic-empress.com", "Psychic Empress");
			$email->setSubject("Payment Confirmed!");
			$email->addTo(
				$orderEmail,
				$orderName,
				[
					"name" => $orderName,
					"email" => $orderEmail,
					"status" => "processing",
					"product" => $product,
					"productNice" => $productNice,
					"orderid" => $orderID,
					"partner" => $orderSex,
					"birthday" => $birthday,
					"price" => $price,
					"emaillink" => $emailLink,
					"msg" => $message
				]
			);
			$email->setTemplateId("d-94ff935883c14a6186def78f3bef0d84");
			$sendgrid = new \SendGrid($sendg3);
			try {
				$response = $sendgrid->send($email);
				print_r($response);

        $submitStatus = "Success";
        $SuccessMessage = "Support Request Sent!";
        $redirectPayment = "";
        $returnData = [$submitStatus,$SuccessMessage,$redirectPayment];

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