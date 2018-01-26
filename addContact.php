<?php
include('./includes/ActiveCampaign.class.php');
	// require "vendor/autoload.php";

	$ac = new ActiveCampaign("https://acme4257.api-us1.com", "71c07c7865033e51fbb323fce74a4f600720bd1b3c507d2d95336d68f59340fc2967cb16");
	/*
	* ADD OR EDIT CONTACT (TO THE NEW LIST CREATED ABOVE).
	*/

	$contact = array(
		"email"              => "test@example.com",
		"first_name"         => "Test 6",
		"phone"         => "69829335",
		"asdf" => "asdf"
		// "p[{$list_id}]"      => $list_id,
		// "status[{$list_id}]" => 1, // "Active" status
	);

	$contact_sync = $ac->api("contact/sync", $contact);

	if (!(int)$contact_sync->success) {
		// request failed
		echo "<p>Syncing contact failed. Error returned: " . $contact_sync->error . "</p>";
		exit();
	}

	// successful request
	$contact_id = (int)$contact_sync->subscriber_id;
	echo "<p>Contact synced successfully (ID {$contact_id})!</p>";
?>
