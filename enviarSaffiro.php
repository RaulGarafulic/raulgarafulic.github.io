
<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type");
  $contact = json_decode(file_get_contents("php://input"));
  // id persona el carnet de la identidad = nit
  // clase persona todas son naturales = 'nat'
  // pNombreRazonSocial = nombre completo de la persona.
  // primer y segundo apellido = _
  // telefono = telefono
  // pFechaNacimiento = la fecha del día
  // direccion = _
  // correo pCorreoElectronico = añadir
  // nacionalidad = boliviano
  // genero = _
  $url = "http://saffiro2.kantutani.com:8561/api/Tesoreria/PostRegistroFactura?pIdRegistroExterno=1&pIdTransaccion=" . $contact->invoiceId . "&pNroFactura=" . $contact->invoiceNumber . "&pCodigoControl=" . $contact->invoiceControlCode . "&pNit=" . $contact->nit . "&pNombre=" . $contact->billName . "&pMonto=" . $contact->price . "&pFormaPago=" . $contact->formaPago . "&pMoneda=BOL&pFecha=" . $contact->dateNow . "&pHora=" . $contact->timeNow . "&pIdProducto=" . $contact->productId . "&pIdDepartamento=1&pIdCiudad=1&pIdEntidadFinaciera=1&pReferencia=1&pIdEmpresa=2&pIdUnidadNegocio=5&pIdEntidadRecaudadora=1&pIdPersona=" . $contact->nit . "&pClasePersona=nat&pNombreRazonSocial=" . $contact->billName . "&pPrimerApellido=_&pSegundoApellido=_&pTelefono=1&pFechaNacimiento=" . $contact->dateNow . "&pDireccion=_&pCorreoElectronico=" . $contact->mail . "&pNacionalidad=_&pGenero=_&pEjecutado=0&pEstado=1&pNumeroAutorizacion=" . $contact->invoiceDosageAuthorizationNumber . "&pIdDocumento=1";
  echo $url;
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_PORT => "8561",
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_POSTFIELDS => "{\"hola\": 0}",
    CURLOPT_TIMEOUT => 3,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
  ));

  $response = curl_exec ($curl);
  $err = curl_error ($curl);
  curl_close ($curl);
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $result = json_decode($response, true);
    echo json_encode ($result);
  }
