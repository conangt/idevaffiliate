<?php
#############################################################
## iDevAffiliate Version 9.1
## Copyright - iDevDirect LLC
## Website: http://www.idevdirect.com/
## Support: http://www.idevsupport.com/
#############################################################

require_once '../API/infusionsoft/autoload.php';
include_once '../API/config.php';

// GET CART DATA
$query_cart_data = $db->query("SELECT AES_DECRYPT(inf_client_key, '" . SITE_KEY . "') AS inf_client_key, AES_DECRYPT(inf_client_secret, '" . SITE_KEY . "') AS inf_client_secret, AES_DECRYPT(inf_access_token, '" . SITE_KEY . "') AS inf_access_token from idevaff_carts_data");
$query_cart_data->setFetchMode(PDO::FETCH_ASSOC);
$cart_data=$query_cart_data->fetch();
$inf_client_key=$cart_data['inf_client_key'];
$inf_client_secret=$cart_data['inf_client_secret'];
$inf_access_token=$cart_data['inf_access_token'];

$infusionsoft = new \Infusionsoft\Infusionsoft(array(
    'clientId'     => $inf_client_key,
    'clientSecret' => $inf_client_secret,
    'redirectUri' => '',
));

$infusionsoft->setToken(unserialize($inf_access_token));

function track_sale($infusionsoft, $base_url, $secret) {
	if (isset($_POST['Id']) && isset($_POST['IPAddress'])) {
		$Id = $_POST['Id'];
		$ip_address = $_POST['IPAddress'];
		
		// get last invoice
		$invoice = $infusionsoft->data()->query('Invoice', 1, 0, ['ContactId' => $Id], ['ProductSold', 'PromoCode', 'JobId'], 'Id', false);
		
		// get order id
		$idev_ordernum = $invoice[0]['JobId'];
		
		// get coupon code
		$coupon_code = '';
		if (isset($invoice[0]['PromoCode'])) {
			$coupon_code = $invoice[0]['PromoCode'];
		}
		
		/* get products purchased */
		$product_ids = explode(',', $invoice[0]['ProductSold']);
		$order_item_ids = array();
		$skus = array();
		foreach ($product_ids as $product_id) {
			// get order items
			$order_items = $infusionsoft->data()->query('OrderItem', 1, 0, ['ProductId' => $product_id], ['Id'], 'Id', false);
			$order_item_ids[] = $order_items[0]['Id'];
			
			// get skus
			$products = $infusionsoft->data()->query('Product', 1, 0, ['Id' => $product_id], ['Sku'], 'Id', false);
			$skus[] = $products[0]['Sku'];
		}
		$products_purchased = implode('|', $skus);
		/* get products purchased */
		
		/* get invoice items */
		$sub_total = 0;
		$coupon_discount = 0;
		foreach ($order_item_ids as $order_item_id) {
			$invoice_items = $infusionsoft->data()->query('InvoiceItem', 1, 0, ['OrderItemId' => $order_item_id], ['InvoiceAmt'], 'Id', false);
			$sub_total += $invoice_items[0]['InvoiceAmt'];
		}
		/* get invoice items */
		
		/* get total discount */
		$total_discount = $infusionsoft->data()->query('OrderItem', 1, 0, ['OrderId' => $invoice[0]['JobId'], 'ItemType' => 11], ['Id'], 'Id', false);
		if ($total_discount) { 
			$total_discount = $infusionsoft->data()->query('InvoiceItem', 1, 0, ['OrderItemId' => $total_discount[0]['Id']], ['InvoiceAmt'], 'Id', false);
			$coupon_discount += $total_discount[0]['InvoiceAmt'];
		}
		/* get total discount */
		
		/* get product discount */
		$product_discount = $infusionsoft->data()->query('OrderItem', 1, 0, ['OrderId' => $invoice[0]['JobId'], 'ItemType' => 12], ['Id'], 'Id', false);
		if ($product_discount) {
			$product_discount = $infusionsoft->data()->query('InvoiceItem', 1, 0, ['OrderItemId' => $product_discount[0]['Id']], ['InvoiceAmt'], 'Id', false);
			$coupon_discount += $product_discount[0]['InvoiceAmt'];
		}
		/* get product discount */
		
		/* get category discount */
		$category_discount = $infusionsoft->data()->query('OrderItem', 1, 0, ['OrderId' => $invoice[0]['JobId'], 'ItemType' => 13], ['Id'], 'Id', false);
		if ($category_discount) {
			$category_discount = $infusionsoft->data()->query('InvoiceItem', 1, 0, ['OrderItemId' => $product_discount[0]['Id']], ['InvoiceAmt'], 'Id', false);
			$coupon_discount += $category_discount[0]['InvoiceAmt'];
		}
		/* get category discount */
		
		$idev_saleamt = $sub_total + $coupon_discount; // get idev_saleamt
		
		/* generate tracking url */
		$tracking_url = $base_url.'/sale.php';
		$tracking_fields = 'profile=157&ip_address='.$ip_address.'&idev_saleamt='.$idev_saleamt.'&idev_ordernum='.$idev_ordernum.'&products_purchased='.$products_purchased.'&coupon_code='.$coupon_code.'&idev_secret='.$secret;
		//echo $tracking_url.'?'.$tracking_fields;
		//mail('jim@idevdirect.com', 'Tracking Pixel Called', $tracking_url.'?'.$tracking_fields, 'From: farazahmedmemon@gmail.com');
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
		//mail('jim@idevdirect.com', 'Tracking Pixel Called', 'Nothing posted.', 'From: farazahmedmemon@gmail.com');
	}
}

try {
	track_sale($infusionsoft, $base_url, $secret);
} catch (\Infusionsoft\TokenExpiredException $e) {
	// If the request fails due to an expired access token, we can refresh
	// the token and then do the request again.
	$infusionsoft->refreshAccessToken();
	$access_token = serialize($infusionsoft->getToken());
	$st = $db->prepare("update idevaff_carts_data set inf_access_token = (AES_ENCRYPT(?, '" . SITE_KEY . "'))");
	$st->execute(array($access_token));
	
	track_sale($infusionsoft, $base_url, $secret);
} catch (\Infusionsoft\InfusionsoftException $e) {
	//echo $e->getMessage();
	//mail('jim@idevdirect.com', 'Issue with Infusionsoft Integration', $e->getMessage(), 'From: farazahmedmemon@gmail.com');
}