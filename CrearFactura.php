<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
  $contact = json_decode(file_get_contents("php://input"));
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_PORT => "8443",
    CURLOPT_URL => "https://power.kraken.bo:8443/api/kraken/create-invoice",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"branchId\": 2,\"customer\": {\"name\": \"$contact->name\",\"nit\": $contact->nit},\"details\": [{\"concept\": \"$contact->product\",\"quantity\": 1,\"subtotal\": $contact->price,\"unitPrice\": $contact->price}],\"economicActivityId\": 2,\"note\": \"\",\"totalAmount\": $contact->price}",
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_CAINFO => __DIR__.'/STAR_kraken_bo.crt',
    CURLOPT_CAPATH => __DIR__.'/STAR_kraken_bo.crt',
    CURLOPT_HTTPHEADER => array(
      "Cache-Control: no-cache",
      "Accept: application/problem+json",
      "Authorization: Bearer " . $contact->tok,
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
    $result = json_decode($response, true);

    // The entire result printed out
    echo json_encode ($result);
  }
