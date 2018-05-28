<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
  $contact = json_decode(file_get_contents("php://input"));
  $receiver_id = 148188;
  $secret = '0909c0e1ea5198b04c59fe2a425ab7841a190233';
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
      "picture_url" => "https://p7vip-9d6eb.firebaseapp.com/assets/P7VIPlogo.jpg",
      "notify_url" => "https://p7vip.xyz/recibirpago.php?mail=".$contact->mail."&product=".$contact->prod, // se está pasando la segunda variable para comprobar qué se está pagando y cuánto.
      "notify_api_version" => "1.3",
      "payer_email" => $contact->mail,
      "payer_name" => $contact->name
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
