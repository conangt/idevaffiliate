<?PHP
#############################################################
## iDevAffiliate Version 9.1
## Copyright - iDevDirect LLC
## Website: http://www.idevdirect.com/
## Support: http://www.idevsupport.com/
#############################################################

$json = file_get_contents('php://input');
$body = json_decode($json, true);

if (is_null($body) or !isset($body['eventName'])) {
    header('HTTP/1.1 400 Bad Request');
    return;
}

switch ($body['eventName']) {
    case 'order.completed':

	/* Get iDevAffiliate Data */
	include("../API/config.php");
		
	$tracking_url = $base_url.'/sale.php';

	/* Get Snipcart Data */
	$order_id = $body['content']['invoiceNumber'];
	$ip_address = $body['content']['ipAddress'];

	$coupon_code = '';
	foreach ($body['content']['discounts'] as $discount_key => $discount) {
		$coupon_code = $discount['code'];
	}
	
	//$products_purchased = '';
	//foreach ($body['content']['items'] as $items_key => $items) {
	//	$products_purchased[] = $items['id'];
	//}
	
	$skus = array();
	foreach ($body['content']['items'] as $item) {
		if (!in_array($item['id'], $skus)) {
			$skus[] = $item['id'];
		}
	}
	$products_purchased = implode('|', $skus);
	
	
	$subtotal = $body['content']['subtotal'];

	/* Generate Tracking URL */
	$tracking_url = $base_url.'/sale.php';
	$tracking_fields = 'profile=151&ip_address='.$ip_address.'&idev_saleamt='.$subtotal.'&coupon_code='.$coupon_code.'&products_purchased='.$products_purchased.'&idev_ordernum='.$order_id.'&idev_secret='.$secret;
	
		//mail("jim@idevdirect.com","Test",$tracking_fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $tracking_url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $tracking_fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$return = curl_exec($ch);
		curl_close($ch);
		

		
    break;
}

header('HTTP/1.1 200 OK');