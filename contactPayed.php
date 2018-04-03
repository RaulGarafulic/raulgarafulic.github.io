<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
	$contact = json_decode(file_get_contents("php://input"));
  $url = 'https://paginasiete.api-us1.com';

  $params = array(
    'api_key'      => 'efbcb2030498e0239577a6a77e125b4b6b3f9a3e1ee598642063f02abeb034efdc2a1508',
    'api_action'   => 'contact_edit',
    'api_output'   => 'serialize'
  );

  $post = array(
    'id'                       => $contact->id, // example contact ID to modify
    'tags'                     => 'api',
    'field[20, $contact->id]'  => $contact->prod, // where 345 is the field ID, and DATAID is the ID of the contact's data row
    'field[21, $contact->id]'  => 'Factura contabilizada',
    'field[29, $contact->id]'  => $contact->ini,
    'field[30, $contact->id]'  => $contact->fini,
  );

  $query = "";
  foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
  $query = rtrim($query, '& ');
  $data = "";
  foreach( $post as $key => $value ) $data .= urlencode($key) . '=' . urlencode($value) . '&';
  $data = rtrim($data, '& ');

  // clean up the url
  $url = rtrim($url, '/ ');

  // This sample code uses the CURL library for php to establish a connection,
  // submit your request, and show (print out) the response.
  if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

  // If JSON is used, check if json_decode is present (PHP 5.2.0+)
  if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
      die('JSON not supported. (introduced in PHP 5.2.0)');
  }

  // define a final API request - GET
  $api = $url . '/admin/api.php?' . $query;

  $request = curl_init($api); // initiate curl object
  curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
  curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
  curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
  //curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
  curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

  $response = (string)curl_exec($request); // execute curl fetch and store results in $response

  // additional options may be required depending upon your server configuration
  // you can find documentation on curl options at http://www.php.net/curl_setopt
  curl_close($request); // close curl object

  if ( !$response ) {
      die('Nothing was returned. Do you have a connection to Email Marketing server?');
  }

  // This line takes the response and breaks it into an array using:
  // JSON decoder
  //$result = json_decode($response);
  // unserializer
  $result = unserialize($response);
  // XML parser...
  // ...

  // Result info that is always returned
  echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
  echo 'Message: ' . $result['result_message'] . '<br />';

  // The entire result printed out
  echo 'The entire result printed out:<br />';
  echo '<pre>';
  print_r($result);
  echo '</pre>';

  // Raw response printed out
  echo 'Raw response printed out:<br />';
  echo '<pre>';
  print_r($response);
  echo '</pre>';

  // API URL that returned the result
  echo 'API URL that returned the result:<br />';
  echo $api;

  echo '<br /><br />POST params:<br />';
  echo '<pre>';
  print_r($post);
  echo '</pre>';
?>
