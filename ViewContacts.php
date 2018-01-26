<?php

// By default, this sample code is designed to get the result from your ActiveCampaign installation and print out the result
$url = 'https://acme4257.api-us1.com';

// optional custom field search: provide field ID, and search query (this searches all custom field values)
/*
$fields = array(
    1 => 'value', // in this case, 1 is the custom field ID, and 'value' is the value you are searching for
);
*/

$params = array(

  // the API Key can be found on the "Your Settings" page under the "API" tab.
  // replace this with your API Key
  'api_key' => '71c07c7865033e51fbb323fce74a4f600720bd1b3c507d2d95336d68f59340fc2967cb16',

  'api_action' => 'contact_list',

  // define the type of output you wish to get back
  // possible values:
  // - 'xml'  :      you have to write your own XML parser
  // - 'json' :      data is returned in JSON format and can be decoded with
  //                 json_decode() function (included in PHP since 5.2.0)
  // - 'serialize' : data is returned in a serialized format and can be decoded with
  //                 a native unserialize() function
  'api_output' => 'json',

  // a comma-separated list of IDs of contacts you wish to fetch
  'ids' => '1,2,3,4,5',

  // filters (optional): supply filters that will narrow down the results
  // if any filters are set, don't pass the 'ids' parameter above

    // Email address: exact match
    //'filters[email]' => 'mike@test.com',

    // List ID's associated with contact: exact match. Provide multiple values (performs an OR operation) like this: '4,7'
    //'filters[listid]' => '4',

    // First Name: exact match. Provide multiple values (performs an OR operation) like this: 'mike,john'
    //'filters[first_name]' => 'mike',

    // Last Name: exact match. Provide multiple values (performs an OR operation) like this: 'smith,jones'
    //'filters[last_name]' => 'jones',

    // Organization: exact match.
    //'filters[organization]' => 'ABC Inc.',

    // Contact ID: only include contacts with an ID greater than some integer
    //'filters[id_greater]' => '44',

    // Contact ID: only include contacts with an ID less than some integer
    //'filters[id_less]' => '44',

    // Segment ID to return only contacts that match a list segment
    //'filters[segmentid]' => '13',

    // Status of contact: exact match. Provide multiple values (performs an OR operation) like this: '0,1' (0: unconfirmed, 1: active, 2: unsubscribed)
    //'filters[status]' => '1',

    // Filter on contact tag using either the tag id or the tag name. Only one tag filter is allowed. Use a list segment for filtering based on multiple tags.
    //'filters[tagid]' => '21',
    // or
    //'filters[tagname]' => 'my tag',

    // Contacts ON (or AT) a specific date/time (set status param): pattern match - provide any portion of MySQL-formatted date/time string
    //'filters[datetime]' => '2009-10-22',

    // Contacts *since* a specified date in the past (set status param): exact match - provide MySQL-formatted date/time string
    //'filters[since_datetime]' => '2009-10-22 00:00:00',

    // Contacts *until* a specified date (set status param): exact match - provide MySQL-formatted date/time string
    //'filters[until_datetime]' => '2009-10-23 00:00:00',

    // Filter on custom field values (include the custom field ID, or personalization tag surrounded by percent signs)
    //'filters[fields][%PERS_1%]' => 'value1 match',

    // Filter on custom field values (include the custom field ID, or personalization tag surrounded by percent signs)
    //'filters[fields][%PERS_2%]' => 'value2 match',

  // whether or not to return ALL data, or an abbreviated portion (set to 0 for abbreviated)
  'full' => 0,

  // optional: change how results are sorted (default is below)
  //'sort' => 'id', // possible values: id, datetime, first_name, last_name
  //'sort_direction' => 'DESC', // ASC or DESC
  //'page' => 2, // pagination - results are limited to 20 per page, so specify what page to view (default is 1)

);

// This section takes the input fields and converts them to the proper format
$query = "";
foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
$query = rtrim($query, '& ');

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
$result = json_decode($response, true);
// unserializer
// $result = unserialize($response);
// XML parser...
// ...

// Result info that is always returned
// echo 'Result: ' . ( $result['result_code'] ? 'SUCCESS' : 'FAILED' ) . '<br />';
// echo 'Message: ' . $result['result_message'] . '<br />';
//
// // The entire result printed out
// echo 'The entire result printed out:<br />';
// echo '<pre>';
// print_r($result);
// echo '</pre>';

// Raw response printed out
// echo 'Raw response printed out:<br />';
echo '<pre>';
print_r($response);
echo '</pre>';

// API URL that returned the result
// echo 'API URL that returned the result:<br />';
// echo $api;
?>
