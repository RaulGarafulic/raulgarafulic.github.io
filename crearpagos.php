<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
  $contact = json_decode(file_get_contents("php://input"));
  $receiver_id = 162163;
  $secret = '2bd49ecf95c4375dc3e09e89d98cf284d9420939';
  require __DIR__ . '/vendor/autoload.php';
  $price = (int) $contact->price;
  $configuration = new Khipu\Configuration();
  $configuration->setReceiverId($receiver_id);
  $configuration->setSecret($secret);

  $client = new Khipu\ApiClient($configuration);
  $payments = new Khipu\Client\PaymentsApi($client);

  try {
    $opts = array (
      "transaction_id" => "MTI-100",
      "return_url" => "https://p7vip-9d6eb.firebaseapp.com/comprobante",
      "cancel_url" => "http://www.paginasiete.bo",
      "picture_url" => "http://mi-ecomerce.com/pictures/foto-producto.jpg",
      "notify_url" => "https://p7vip.xyz/recibirpago.php/",
      "notify_api_version" => "1.3",
      "payer_email" => $contact->mail
    );
    $response = $payments->paymentsPost(
      "Suscripcion P7 VIP " . $contact->prod . ".", //Motivo de la compra
      "BOB", //Moneda
      $price, //Monto
      $opts //campos opcionales
    );
    $url = $response->getPaymentUrl();
    echo $url;
    // header($url, true, 301);

  } catch (\Khipu\ApiException $e) {
      echo print_r($e->getResponseBody(), TRUE);
  }
?>
