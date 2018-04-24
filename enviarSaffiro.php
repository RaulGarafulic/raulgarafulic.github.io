<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
  $contact = json_decode(file_get_contents("php://input"));

  $ch = curl_init("http://saffiro2.kantutani.com:8561/api/Tesoreria/PostRegistroFactura?pIdRegistroExterno=501&pIdTransaccion=" . $contact->invoiceId . "&pNroFactura=" . $contact->invoiceNumber . "&pCodigoControl=" . $contact->invoiceControlCode . "&pNit=" . $contact->nit . "&pNombre=" . $contact->billName . "&pMonto=" . $contact->price . "&pFormaPago=tarjeta&pMoneda=BOB&pFecha=" . $contact->dateNow . "&pHora=" . $contact->timeNow . "&pIdProducto=" . $contact->productId . "&pIdDepartamento=1&pIdCiudad=1&pIdEntidadFinaciera=1&pReferencia=1&pIdEmpresa=1&pIdUnidadNegocio=1&pIdEntidadRecaudadora=1&pIdPersona=1&pClasePersona=1&pNombreRazonSocial=1&pPrimerApellido=1&pSegundoApellido=1&pTelefono=0&pFechaNacimiento=01/01/2018&pDireccion=1&pCorreoElectronico=1&pNacionalidad=1&pGenero=1&pEjecutado=1&pEstado=1&pNumeroAutorizacion=" . $contact->invoiceDosageAuthorizationNumber . "1&pIdDocumento=1");

  curl_setopt($ch, CURLOPT_HEADER, 0);

  curl_exec($ch);
  curl_close($ch);
?>
