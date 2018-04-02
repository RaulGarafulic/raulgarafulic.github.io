<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
  $data = json_decode(file_get_contents("php://input"));
  $receiver_id = 162163;
  $secret = '2bd49ecf95c4375dc3e09e89d98cf284d9420939';

  require __DIR__ . '/vendor/autoload.php';

  $configuration = new Khipu\Configuration();
  $configuration->setReceiverId($receiver_id);
  $configuration->setSecret($secret);

  $client = new Khipu\ApiClient($configuration);
  $payments = new Khipu\Client\PaymentsApi($client);

  try {
    // $date = new DateTime ('tomorrow');
    // echo $date->format('d/m/Y');
    $opts = array (
      "transaction_id" => "MTI-100",
      "return_url" => "https://p7vip-9d6eb.firebaseapp.com/comprobante" . $data->tok,
      "cancel_url" => "http://www.paginasiete.bo",
      "picture_url" => "http://mi-ecomerce.com/pictures/foto-producto.jpg",
      "notify_url" => "https://p7vip.xyz/recibirpago.php/" . $data->tok,
      "notify_api_version" => "1.3",
      "payer_email" => $data->mail
    );
    $response = $payments->paymentsPost("Suscripcion del paquete " . $data->prod, //Motivo de la compra
      "BOB", //Moneda
      $data->price, //Monto
      $opts //campos opcionales
    );
    // $url = "Location: " . $response->getPaymentUrl();
    $url = $response->getPaymentUrl();
    echo $url;
    // header($url, true, 301);
  //
  } catch (\Khipu\ApiException $e) {
      echo print_r($e->getResponseBody(), TRUE);
  }
?>
