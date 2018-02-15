<?php
require __DIR__ . '/vendor/autoload.php';


$receiver_id = 162163;
$secret = '2bd49ecf95c4375dc3e09e89d98cf284d9420939';

$api_version = $_POST["api_version"];
$notification_token = $_POST["notification_token"];
// $notification_token = 'obtener-desde-los-parametros'; //Parámetro notification_token
$amount = 1;

try {
  if ($api_version == '1.3') {
    $configuration = new Khipu\Configuration();
    $configuration->setSecret($secret);
    $configuration->setReceiverId($receiver_id);
    // $configuration->setDebug(true);

    $client = new Khipu\ApiClient($configuration);
    $payments = new Khipu\Client\PaymentsApi($client);

    $response = $payments->paymentsGet($notification_token);
      $date = new DateTime ('tomorrow');
    if ($response->getReceiverId() == $receiver_id) {
        if ($response->getStatus() == 'done' && $response->getAmount() == $amount) {
          // session_start();
          echo '0';
          // $_SESSION['permit'] = 'Ok';
          // $url = "Location: https://p7vip-9d6eb.firebaseapp.com/pagado/?date=" . $date;
          // header($url, true, 301);
        }
    } else {
        echo 'receiver_id no coincide';
    }
  } else {
    // session_start();
    echo '1';
      // $_SESSION['permit'] = 'Ok';
      // $url = "Location: https://p7vip-9d6eb.firebaseapp.com/pagado/?date=" . $date;
      // header($url, true, 301);
  }
} catch (\Khipu\ApiException $exception) {
    print_r($exception->getResponseObject());
}
