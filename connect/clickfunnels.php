<?php
#############################################################
## iDevAffiliate Version 9.1
## Copyright - iDevDirect LLC
## Website: http://www.idevdirect.com/
## Support: http://www.idevsupport.com/
#############################################################

header('X-PHP-Response-Code: 200', true, 200);

$input = @file_get_contents("php://input");
$event_json = json_decode($input);

if (isset($event_json->event) && ($event_json->event == "created")) {

include_once ("../API/config.php");

// Define Basics
$idv_url = $base_url . '/sale.php';
$profile = '170';

// Get IP
//$ip_address = $event_json->contact->ip->addr;
//$ip_address = long2ip($ip_address);

$ip_address = $event_json->contact->ip;

// Get Order Number
	if (isset($event_json->charge_id))
	{
		$idev_ordernum = $event_json->charge_id;
	}
	elseif (isset($event_json->subscription_id))
	{
		$idev_ordernum = $event_json->subscription_id;
	}

// Get Sale Amount
$idev_saleamt = $event_json->original_amount_cents / 100; // convert from cents

// Get Currency
$idev_currency = $event_json->original_amount_currency;


        $data = array (
            "profile"       => $profile,
            "idev_saleamt"  => $idev_saleamt,
            "idev_ordernum" => $idev_ordernum,
            "ip_address"    => $ip_address,
            "idev_currency" => $idev_currency,
            "idev_secret"   => $secret
        );

	    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $idv_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $json = curl_exec($ch);
        curl_close($ch);

// testing only
// mail('mail@mail.com', 'clickfunnels ipn', 'curr: ' . $idev_currency . PHP_EOL . 'ip: ' . $ip_address . PHP_EOL . 'on: ' . $idev_ordernum . PHP_EOL . 'sale: ' . $idev_saleamt . PHP_EOL . '--------------' . PHP_EOL . print_r($_POST, true) . print_r($event_json, true));

}

die();

?>