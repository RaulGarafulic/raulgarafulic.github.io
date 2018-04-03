<?php
  header('Access-Control-Allow-Origin: https://khipu.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
require __DIR__ . '/vendor/autoload.php';


$receiver_id = 162163;
$secret = '2bd49ecf95c4375dc3e09e89d98cf284d9420939';

$api_version = $_POST["api_version"];
$notification_token = $_POST["notification_token"];
$opts = $_POST["opts"];
$mail = $_POST["payer_email"];
try {
  if ($api_version == '1.3') {
    $configuration = new Khipu\Configuration();
    $configuration->setSecret($secret);
    $configuration->setReceiverId($receiver_id);
    // $configuration->setDebug(true);

    $client = new Khipu\ApiClient($configuration);
    $payments = new Khipu\Client\PaymentsApi($client);

    $response = $payments->paymentsGet($notification_token);
    if ($response->getReceiverId() == $receiver_id) {
        if ($response->getStatus() == 'done') {
          include facturaPagada.php;
        }
    } else {
        echo 'receiver_id no coincide';
    }
  }
} catch (\Khipu\ApiException $exception) {
    print_r($exception->getResponseObject());
}
