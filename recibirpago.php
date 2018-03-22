<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
require __DIR__ . '/vendor/autoload.php';


$receiver_id = 162163;
$secret = '2bd49ecf95c4375dc3e09e89d98cf284d9420939';

$api_version = $_POST["api_version"];
$notification_token = $_POST["notification_token"];

try {
  if ($api_version == '1.3') {
    $configuration = new Khipu\Configuration();
    $configuration->setSecret($secret);
    $configuration->setReceiverId($receiver_id);
    // $configuration->setDebug(true);

    $client = new Khipu\ApiClient($configuration);
    $payments = new Khipu\Client\PaymentsApi($client);

    $response = $payments->paymentsGet($notification_token);
    $datetime = new DateTime('tomorrow');
    $day = $datetime->format('d');
    $month = $datetime->format('m');
    $date = $day . '/' . $month;
    if ($response->getReceiverId() == $receiver_id) {
        if ($response->getStatus() == 'done') {
          $url = "Location: https://p7vip-9d6eb.firebaseapp.com/pagado/?date=" . $date;
          header($url, true, 301);
        }
    } else {
        echo 'receiver_id no coincide';
    }
  } else {
    $datetime = new DateTime('tomorrow');
    $day = $datetime->format('d');
    $month = $datetime->format('m');
    $date = $day . '/' . $month;
    $url = "Location: https://p7vip-9d6eb.firebaseapp.com/pagado/?date=" . $date;
    header($url, true, 301);
  }
} catch (\Khipu\ApiException $exception) {
    print_r($exception->getResponseObject());
}
