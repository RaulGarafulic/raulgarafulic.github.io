<?php
require __DIR__ . '/vendor/autoload.php';


$receiver_id = 162163;
$secret = '2bd49ecf95c4375dc3e09e89d98cf284d9420939';

$api_version = $_POST['api_version'];
$notification_token = $_POST['notification_token'];
// $notification_token = 'obtener-desde-los-parametros'; //Parámetro notification_token
echo 'apiV is: ' . $api_version;
print_r ($notification_token);
var_dump($_POST);
$amount = 1;

try {
  print_r ($notification_token);
    if ($api_version == '1.3') {
        $configuration = new Khipu\Configuration();
        $configuration->setSecret($secret);
        $configuration->setReceiverId($receiver_id);
        // $configuration->setDebug(true);

        $client = new Khipu\ApiClient($configuration);
        $payments = new Khipu\Client\PaymentsApi($client);

        $response = $payments->paymentsGet($notification_token);
        if ($response->getReceiverId() == $receiver_id) {
            if ($response->getStatus() == 'done' && $response->getAmount() == $amount) {
                // marcar el pago como completo y entregar el bien o servicio
            }
        } else {
            echo 'receiver_id no coincide';
        }
    } else {
        echo 'Usar versión anterior de la API de notificación';
    }
} catch (\Khipu\ApiException $exception) {
    print_r($exception->getResponseObject());
}
