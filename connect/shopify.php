<?php
#############################################################
## iDevAffiliate Version 9.1
## Copyright - iDevDirect LLC
## Website: http://www.idevdirect.com/
## Support: http://www.idevsupport.com/
#############################################################

include("../API/config.php");
header("HTTP/1.1 200 OK");

// GET CART DATA
$query_cart_data = $db->query("SELECT AES_DECRYPT(shopify_key, '" . SITE_KEY . "') AS shopify_key from idevaff_carts_data");
$query_cart_data->setFetchMode(PDO::FETCH_ASSOC);
$cart_data=$query_cart_data->fetch();
$shopify_key=$cart_data['shopify_key'];

define('SHOPIFY_APP_SECRET', $cart_data['shopify_key']);

function verify_webhook($data, $hmac_header) {
	$calculated_hmac = base64_encode(hash_hmac('sha256', $data, SHOPIFY_APP_SECRET, true));
	return ($hmac_header == $calculated_hmac);
}

$hmac_header = $_SERVER['HTTP_X_SHOPIFY_HMAC_SHA256'];
$data = file_get_contents('php://input');
$verified = verify_webhook($data, $hmac_header);

if ($verified) {
	$data = json_decode($data);
	$ip_address = $data->browser_ip; // ip address
	$idev_ordernum = $data->order_number; // order number
	
	/* get coupon code */
	$coupon_code = '';
	if (isset($data->discount_codes[0]->code)) {
		$coupon_code = $data->discount_codes[0]->code;
	}
	/* get coupon code */
	
	/* get products purchased */
	$skus = array();
	foreach ($data->line_items as $line_item) {
		$skus[] = $line_item->sku;
	}
	$products_purchased = implode('|', $skus);
	/* get products purchased */
	
	$idev_saleamt = $data->subtotal_price; // get idev_saleamt
	
	/* generate tracking url */
	$tracking_url = $base_url.'/sale.php';
	$tracking_fields = 'profile=72&ip_address='.$ip_address.'&idev_saleamt='.$idev_saleamt.'&idev_ordernum='.$idev_ordernum.'&products_purchased='.$products_purchased.'&coupon_code='.$coupon_code.'&idev_secret='.$secret;
	//echo $tracking_url.'?'.$tracking_fields;
	//mail('mail@mail.com', 'Tracking Pixel Called', $tracking_url.'?'.$tracking_fields, 'From: farazahmedmemon@gmail.com');
	/* generate tracking url */
		
	/* submit url */
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $tracking_url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $tracking_fields);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$return = curl_exec($ch);
	curl_close($ch);
	/* submit url */
	
	
}
else {
	//mail('mail@mail.com', 'Not Verified Shopify', $data, 'From: farazahmedmemon@gmail.com');
}