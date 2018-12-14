<?php
  header ('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header ("Access-Control-Allow-Headers: Content-Type, Authorization");
  $contact = json_decode (file_get_contents ("php://input"));
  // $url = "https://power.kraken.bo:8443/api/kraken/" . $contact->id . "/invoice-basic";
  $url = "https://power.kraken.bo:8443/api/kraken/25823/invoice-basic";
  $curl = curl_init ();
  curl_setopt_array ($curl, array (
    CURLOPT_PORT => "8443",
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_CAINFO => __DIR__.'/STAR_kraken_bo.crt',
    CURLOPT_CAPATH => __DIR__.'/STAR_kraken_bo.crt',
    CURLOPT_HTTPHEADER => array (
      "Cache-Control: no-cache",
      "Accept: application/problem+json",
      // "Authorization: Bearer " . $contact->tok,
      "Authorization: Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJxcmZoazAiLCJhdXRoIjoiUk9MRV9JTlRFR1JBVElPTiIsImV4cCI6MTUyODU2MTcyMH0.PIf1GrAxpq0cq3Fp8orrwNWNkdVEW6YrG113TM5KycG3T09aaZyh0ptNTvwctaIf_VH3h5OPwPpYKXFlayv9qw",
      "Content-Type: application/json"
    )
  ));

  $response = curl_exec ($curl);
  $err = curl_error ($curl);

  curl_close ($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    // echo $tok;
    // echo json_encode ($response);
    $result = json_decode ($response, true);

    // The entire result printed out
    echo json_encode ($result);
  }
