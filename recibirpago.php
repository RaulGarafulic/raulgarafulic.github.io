<?php
  header('Access-Control-Allow-Origin: https://khipu.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
require __DIR__ . '/vendor/autoload.php';


$receiver_id = 162163;
$secret = '2bd49ecf95c4375dc3e09e89d98cf284d9420939';
$mail = $_GET["mail"];
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
    if ($response->getReceiverId() == $receiver_id) {
        if ($response->getStatus() == 'done') {
          $url = 'https://paginasiete.api-us1.com';
          $params = array(
              'api_key'      => 'efbcb2030498e0239577a6a77e125b4b6b3f9a3e1ee598642063f02abeb034efdc2a1508',
              'api_action'   => 'contact_sync',
              'api_output'   => 'serialize',
          );

          $post = array(
              'email' => $mail,
              'field[21,0]' => 'Factura pagada',
          );

          $query = "";
          foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
          $query = rtrim($query, '& ');

          $data = "";
          foreach( $post as $key => $value ) $data .= urlencode($key) . '=' . urlencode($value) . '&';
          $data = rtrim($data, '& ');

          $url = rtrim($url, '/ ');

          if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

          if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
              die('JSON not supported. (introduced in PHP 5.2.0)');
          }

          $api = $url . '/admin/api.php?' . $query;

          $request = curl_init($api);
          curl_setopt($request, CURLOPT_HEADER, 0);
          curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($request, CURLOPT_POSTFIELDS, $data);
          curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

          $response = (string)curl_exec($request);

          curl_close($request);

          if ( !$response ) {
              die('Nothing was returned. Do you have a connection to Email Marketing server?');
          }

          $result = unserialize($response);
        }
    } else {
        echo 'receiver_id no coincide';
    }
  }
  include facturaPagada.php;
} catch (\Khipu\ApiException $exception) {
  include facturaPagada.php;
}
