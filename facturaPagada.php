<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
	$contact = json_decode(file_get_contents("php://input"));
  $url = 'https://paginasiete.api-us1.com';

  $params = array(
      'api_key'      => 'efbcb2030498e0239577a6a77e125b4b6b3f9a3e1ee598642063f02abeb034efdc2a1508',
      'api_action'   => 'contact_sync',
      'api_output'   => 'serialize',
  );

  $post = array(
      'email' => $contact->mail,
      'field[20,0]' => $contact->prod,
      'field[21,0]' => 'Factura contabilizada',
      'field[29,0]' => $contact->ini,
      'field[30,0]' => $contact->fini
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
  echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
  echo 'Message: ' . $result['result_message'] . '<br />';

  echo 'The entire result printed out:<br />';
  echo '<pre>';
  print_r($result);
  echo '</pre>';

  echo 'API URL that returned the result:<br />';
  echo $api;

  echo '<br /><br />POST params:<br />';
  echo '<pre>';
  print_r($post);
  echo '</pre>';
?>
