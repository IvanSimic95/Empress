<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use Mailgun\Mailgun;

$mg = Mailgun::create($mgkey, 'https://api.eu.mailgun.net'); // For EU servers

// Now, compose and send your message.
// $mg->messages()->send($domain, $params);
$mg->messages()->send('notification.psychic-empress.com', [
  'from'    => 'noreply@notification.psychic-empress.com',
  'to'      => 'email@isimic.com',
  'subject' => 'Test Email Title',
  'text'    => 'Your Order is now Complete!',
  'template'=> 'neworder',
  'h:X-Mailgun-Variables' => '{"EmailTitle": "Test Email Title", "orderNumber": "112233", "emailText": "Your Order is now Complete!"}'
]);
?>