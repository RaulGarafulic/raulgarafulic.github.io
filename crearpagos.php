<?php
  // Debemos conocer el $receiverId y el $secretKey de ante mano.
  $receiver_id = 162163;
  $secret = '2bd49ecf95c4375dc3e09e89d98cf284d9420939';

  require __DIR__ . '/vendor/autoload.php';

  $configuration = new Khipu\Configuration();
  $configuration->setReceiverId($receiver_id);
  $configuration->setSecret($secret);
  // $configuration->setDebug(true);

  $client = new Khipu\ApiClient($configuration);
  // $config = $client->getConfig();
  // $serializer = $client->getSerializer();
  // echo $config;
  // echo $serializer;
  $payments = new Khipu\Client\PaymentsApi($client);

  try {
    $date = new DateTime ('tomorrow');
    echo $date->format('d/m/Y');
    $mail = "rgarafulicm@gmail.com";
    $xml = "
      <items>
          <mail>$mail</mail>
      </items>
    ";
    echo $xml;
    // $opts = array (
    //   "transaction_id" => "MTI-100",
    //   "return_url" => "http://localhost/2activecampaign/crearpago3.php",
    //   "cancel_url" => "http://mi-ecomerce.com/backend/cancel",
    //   "picture_url" => "http://mi-ecomerce.com/pictures/foto-producto.jpg",
    //   "notify_url" => "http://localhost/2activecampaign/recibirpago.php",
    //   "notify_api_version" => "1.3",
    //   "custom" => $xml
    // );
    // $response = $payments->paymentsPost("Compra de prueba de la API", //Motivo de la compra
    //   "BOB", //Moneda
    //   45.0, //Monto
    //   $opts //campos opcionales
    // );
    // $url = "Location: " . $response->getPaymentUrl();
    // // print_r($response->payment_url);
    // header($url, true, 301);

  } catch (\Khipu\ApiException $e) {
      echo print_r($e->getResponseBody(), TRUE);
  }
?>
