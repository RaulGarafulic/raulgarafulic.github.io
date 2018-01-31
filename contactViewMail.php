<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	$data = json_decode(file_get_contents("php://input"));


  $url = 'https://acme80851.api-us1.com';
  // $url = 'https://paginasiete.api-us1.com';
  $params = array(
    // 'api_key'      => 'efbcb2030498e0239577a6a77e125b4b6b3f9a3e1ee598642063f02abeb034efdc2a1508', //p7
    'api_key'      => '272d155e8a31b110c36cc8685525f15590e8697c6ef9004feffe1c9c60f3267d978af4d3',
    'api_action'   => 'contact_view_email',
    'api_output'   => 'json',
    'email'        => $data->mail,
  );

  $query = "";
  foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
  $query = rtrim($query, '& ');

  $url = rtrim($url, '/ ');

  if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

  if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
      die('JSON not supported. (introduced in PHP 5.2.0)');
  }

  $api = $url . '/admin/api.php?' . $query;

  $request = curl_init($api); // initiate curl object
  curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
  curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
  curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

  $response = (string)curl_exec($request); // execute curl fetch and store results in $response

  curl_close($request); // close curl object

  if ( !$response ) {
      die('Nothing was returned. Do you have a connection to Email Marketing server?');
  }
$result = json_decode($response, true);

// The entire result printed out
echo json_encode ($result);

?>
