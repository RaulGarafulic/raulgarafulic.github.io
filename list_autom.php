<?php
  header('Access-Control-Allow-Origin: https://p7vip-9d6eb.firebaseapp.com', false);
  header("Access-Control-Allow-Headers: Content-Type, Authorization");

  // Set up an object instance using our PHP API wrapper.
  define("ACTIVECAMPAIGN_URL", "https://paginasiete.api-us1.com");
  define("ACTIVECAMPAIGN_API_KEY", "efbcb2030498e0239577a6a77e125b4b6b3f9a3e1ee598642063f02abeb034efdc2a1508");
  // require_once("../activecampaign-api-php/includes/ActiveCampaign.class.php");
  $ac = new ActiveCampaign(ACTIVECAMPAIGN_URL, ACTIVECAMPAIGN_API_KEY);

  $response = $ac->api("contact/automation/list?offset=0&limit=50&contact_id=22");

  echo "<pre>";
  print_r($response);
  echo "</pre>";
?>
