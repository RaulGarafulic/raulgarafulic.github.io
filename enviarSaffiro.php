
<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type");
  $contact = json_decode(file_get_contents("php://input"));

  // $contact = new stdClass ();
  // $contact->invoiceId = '2525';
  // $contact->productId = '3666';
  // $contact->invoiceNumber = '4';
  // $contact->invoiceControlCode = '51-1A-EC-45-4B';
  // $contact->nit = '21506733301';
  // $contact->billName = 'FERUFINO';
  // $contact->price = '45';
  // $contact->formaPago = 'TCR';
  // $contact->dateNow = '02/05/2018';
  // $contact->timeNow = '10:30';
  // // $contact->dateNow = '2\/05\/2018';
  // $contact->mail = 'rgaafulicm@gmail.com';
  // $contact->invoiceDosageAuthorizationNumber = '2';

  $url = "http://190.181.60.250:8564/api/tesoreria/registroFacturaExterna?pIdRegistroExterno=1&pIdTransaccion=" . $contact->invoiceId . "&pNroFactura=" . $contact->invoiceNumber . "&pCodigoControl=" . $contact->invoiceControlCode . "&pNit=" . $contact->nit . "&pNombre=" . $contact->billName . "&pMonto=" . $contact->price . "&pFormaPago=" . $contact->formaPago . "&pMoneda=BOL&pFecha=" . $contact->dateNow . "&pHora=" . $contact->timeNow . "&pIdProducto=" . $contact->productId . "&pIdDepartamento=1&pIdCiudad=1&pIdEntidadFinaciera=" . $contact->bank . "&pReferencia=1&pIdEmpresa=2&pIdUnidadNegocio=5&pIdEntidadRecaudadora=1&pIdPersona=" . $contact->nit . "&pClasePersona=nat&pNombreRazonSocial=" . $contact->billName . "&pPrimerApellido=_&pSegundoApellido=_&pTelefono=1&pFechaNacimiento=" . $contact->dateNow . "&pDireccion=_&pCorreoElectronico=" . $contact->mail . "&pNacionalidad=_&pGenero=_&pEjecutado=0&pEstado=1&pNumeroAutorizacion=" . $contact->invoiceDosageAuthorizationNumber . "&pIdDocumento=1";

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_PORT => "8564",
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_POSTFIELDS => "{\"hola\": 0}",
    CURLOPT_TIMEOUT => 4,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
  ));

  $response = curl_exec ($curl);
  // echo '<br />';
  echo "Kantutani:" . $response;
  $err = curl_error ($curl);
  curl_close ($curl);
  if ($err) {
    echo '<br />';
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
    $result = json_decode($response, true);
    echo json_encode ($result);
  }


  //
