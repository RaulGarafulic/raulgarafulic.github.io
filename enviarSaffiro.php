<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
  $contact = json_decode(file_get_contents("php://input"));
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_PORT => "8564",
    CURLOPT_URL => "http://190.181.4.202:8564/api/Tesoreria/PostRegistroFactura?pIdRegistroExterno=501&pIdTransaccion=" . $contact->invoiceId . "&pNroFactura=" . $contact->invoiceId . "&pCodigoControl=" . $contact->invoiceControlCode . "&pNit=" . $contact->nit . "&pNombre=" . $contact->billName . "&pMonto=" . $contact->price . "&pFormaPago=tarjeta&pMoneda=BOB&pFecha=" . $contact->dateNow . "&pHora=" . $contact->timeNow . "&pIdProducto=" . $contact->productId . "&pIdDepartamento=1&pIdCiudad=1&pIdEntidadFinaciera=1&pReferencia=1&pIdEmpresa=1&pIdUnidadNegocio=1&pIdEntidadRecaudadora=1&pIdPersona=1&pClasePersona=1&pNombreRazonSocial=1&pPrimerApellido=1&pSegundoApellido=1&pTelefono=0&pFechaNacimiento=01/01/2018&pDireccion=1&pCorreoElectronico=1&pNacionalidad=1&pGenero=1&pEjecutado=1&pEstado=1&pNumeroAutorizacion=" . $contact->invoiceDosageAuthorizationNumber . "1&pIdDocumento=1",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{'hola'}",
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
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    // echo $tok;
    // echo json_encode ($response);
    $result = json_decode($response, true);

    // The entire result printed out
    echo json_encode ($result);
  }
