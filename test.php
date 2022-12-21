<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/templates/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use Mailgun\Mailgun;

$mgClient = Mailgun::create($mg, 'https://api.mailgun.net/v3/notification.psychic-empress.com');
$domain = "notification.psychic-empress.com";
$params = array(
  'from'    => 'Psychic Empress <noreply@notification.psychic-empress.com>',
  'to'      => 'email@isimic.com',
  'subject' => 'Hello',
  'text'    => 'Testing some Mailgun awesomness!'
);

# Make the call to the client.
$mgClient->messages()->send($domain, $params);

?>