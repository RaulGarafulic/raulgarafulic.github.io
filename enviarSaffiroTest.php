
<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type");
  // $contact = json_decode(file_get_contents("php://input"));

  $contact = new stdClass ();
  $contact->invoiceId = '2525';
  $contact->productId = '3666';
  $contact->invoiceNumber = '4';
  $contact->invoiceControlCode = '51-1A-EC-45-4B';
  $contact->nit = '21506733301';
  $contact->billName = 'FERUFINO';
  $contact->price = '45';
  $contact->formaPago = 'TCR';
  $contact->dateNow = '02/05/2018';
  $contact->timeNow = '10:30';
  // $contact->dateNow = '2\/05\/2018';
  $contact->mail = 'rgaafulicm@gmail.com';
  $contact->invoiceDosageAuthorizationNumber = '2';

  // $url = "http://190.181.60.250:8564/api/tesoreria/registroFacturaExterna?pIdRegistroExterno=1&pIdTransaccion=1&pNroFactura=1&pCodigoControl=1&pNit=1&pNombre=1&pMonto=1&pFormaPago=1&pMoneda=1&pFecha=01/01/2019&pHora=1&pIdProducto=1&pIdDepartamento=1&pIdCiudad=1&pIdEntidadFinaciera=1&pReferencia=1&pIdEmpresa=1&pIdUnidadNegocio=1&pIdEntidadRecaudadora=1&pIdPersona=1&pClasePersona=1&pNombreRazonSocial=1&pPrimerApellido=1&pSegundoApellido=1&pTelefono=1&pFechaNacimiento=01/01/2019&pDireccion=1&pCorreoElectronico=1&pNacionalidad=1&pGenero=1&pEjecutado=1&pEstado=1&pNumeroAutorizacion=1&pIdDocumento=1";
  $url = "http://190.181.60.250:8564/api/tesoreria/registroFacturaExterna?pIdRegistroExterno=1&pIdTransaccion=" . $contact->invoiceId . "&pNroFactura=" . $contact->invoiceNumber . "&pCodigoControl=" . $contact->invoiceControlCode . "&pNit=" . $contact->nit . "&pNombre=" . $contact->billName . "&pMonto=" . $contact->price . "&pFormaPago=" . $contact->formaPago . "&pMoneda=BOL&pFecha=" . $contact->dateNow . "&pHora=" . $contact->timeNow . "&pIdProducto=" . $contact->productId . "&pIdDepartamento=1&pIdCiudad=1&pIdEntidadFinaciera=1&pReferencia=1&pIdEmpresa=2&pIdUnidadNegocio=5&pIdEntidadRecaudadora=1&pIdPersona=" . $contact->nit . "&pClasePersona=nat&pNombreRazonSocial=" . $contact->billName . "&pPrimerApellido=_&pSegundoApellido=_&pTelefono=1&pFechaNacimiento=" . $contact->dateNow . "&pDireccion=_&pCorreoElectronico=" . $contact->mail . "&pNacionalidad=_&pGenero=_&pEjecutado=0&pEstado=1&pNumeroAutorizacion=" . $contact->invoiceDosageAuthorizationNumber . "&pIdDocumento=1";
  echo $url;
  // resp:{"code":1,"message":" PL.Tesoreria.RegistroExterno.RegistroDulicado (este mensaje no fué internacionalizado). "}{"code":1,"message":" PL.Tesoreria.RegistroExterno.RegistroDulicado (este mensaje no fu\u00e9 internacionalizado). "}

  // resp:{"code":1,"message":" Info-PL. . "}{"code":1,"message":" Info-PL. . "}
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
  echo '<br />';
  echo "resp:" . $response;
  $err = curl_error ($curl);
  curl_close ($curl);
  if ($err) {
    echo '<br />';
    echo "cURL Error #:" . $err;
  } else {
    $result = json_decode($response, true);
    echo json_encode ($result);
  }


  // http://190.181.60.250:8564/api/tesoreria/registroFacturaExterna?pIdRegistroExterno=1&pIdTransaccion=25825&pNroFactura=2&pCodigoControl=51-1A-EC-45-4B&pNit=2150673017&pNombre=FERRUFINO&pMonto=45&pFormaPago=TCR&pMoneda=BOL&pFecha=02/05/2018&pHora=10:30&pIdProducto=3666&pIdDepartamento=1&pIdCiudad=1&pIdEntidadFinaciera=1&pReferencia=1&pIdEmpresa=2&pIdUnidadNegocio=5&pIdEntidadRecaudadora=1&pIdPersona=2150673017&pClasePersona=nat&pNombreRazonSocial=FERRUFINO&pPrimerApellido=_&pSegundoApellido=_&pTelefono=1&pFechaNacimiento=02/05/2018&pDireccion=_&pCorreoElectronico=rgarafulicm@gmail.com&pNacionalidad=_&pGenero=_&pEjecutado=0&pEstado=1&pNumeroAutorizacion=2&pIdDocumento=1
