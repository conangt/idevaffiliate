<?php 
include("../API/config.php");

$json = file_get_contents("php://input");  
if (!empty($json)) {
	$contact = json_decode($json);
	if ($contact != null && json_last_error() === JSON_ERROR_NONE) {
		$profile_id = 172;
		$ip_address = $contact->Entry->Origin->IpAddress;
		$idev_saleamt = $contact->Entry->Order->OrderAmount;
		$idev_ordernum = $contact->Entry->Order->Id;
		
		/* generate tracking url */
		$tracking_url = $base_url.'/sale.php';
		$tracking_fields = 'profile='.$profile_id.'&ip_address='.$ip_address.'&idev_saleamt='.$idev_saleamt.'&idev_ordernum='.$idev_ordernum.'&idev_secret='.$secret;		
		//mail('mail@mail.com', 'Tracking Pixel Called', $tracking_url.'?'.$tracking_fields);
		/* generate tracking url */
		
		/* submit url */
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $tracking_url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $tracking_fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent: curl/7.39.0');
		$return = curl_exec($ch);
		curl_close($ch);
		/* submit url */
	}
}