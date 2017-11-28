<?PHP

// FILE INCLUDE VALIDATION
if (!defined('idev_admin_updates')) { die('Unauthorized Access'); }

		if (!isset($webhook_url)) {
		$whu = $db->query("select webhook_url from idevaff_config");
		$whu = $whu->fetch();
		$webhook_url = $whu['webhook_url'];
		}
	
	if (!filter_var($webhook_url, FILTER_VALIDATE_URL) === false) {

$event = str_replace("_", ".", $event);

if ($event == "affiliate.terminated") {
	$affiliate_details_table = "deleted_accounts";
	} else {
	$affiliate_details_table = "affiliates";
}
	
$get_aff_details = $db->prepare("select * from idevaff_{$affiliate_details_table} where id = ?");
$get_aff_details->execute(array($data_affiliate_id));
$get_aff_results = $get_aff_details->fetch();

//header('Content-Type: text/plain');
include ("auth_codes.php");

$result = [
    'status' => '',
    'url' => '',
    'event' => '',
    'stamp' => time(),
];

	if (function_exists("curl_init")) {
    $curl_handle = curl_init();
    if ($curl_handle) {
		
switch ($event) {
	
case "commission.created":
case "commission.approved":
case "commission.declined":
	
	$profile_name = $db->prepare("select name from idevaff_carts where id = ?");
	$profile_name->execute(array($data_cart_profile));
	$qry = $profile_name->fetch();
	$data_cart_name = $qry['name'];
	
	        $data = array(
			'event' => $event, 
			'affiliate_id' => $data_affiliate_id, 
			'username' => $get_aff_results['username'], 
			'first_name' => $get_aff_results['f_name'], 
			'last_name' => $get_aff_results['l_name'], 
			'email' => $get_aff_results['email'], 
			'order_number' => $data_order_number, 
			'commission_amount' => $data_commission, 
			'sale_amount' => $data_sale_amount, 
			'currency' => $data_currency,
			'sub_id' => $data_sub_id, 
			'tid_1' => $data_tid1, 
			'tid_2' => $data_tid2, 
			'tid_3' => $data_tid3, 
			'tid_4' => $data_tid4, 
			'cart_integration' => $data_cart_name, 
			'commission_timestamp' => $data_timestamp, 
			'commission_date' => $data_date, 
			'commission_time' => $data_time, 
			'webhook_timestamp' => time(), 
			'webhook_date' => date('m-d-Y', time()), 
			'webhook_time' => date('h:i a', time()), 
        );
		
break;

case "payment.completed":
	
		$data = array(
			'event' => $event, 
			'affiliate_id' => $data_affiliate_id, 
			'username' => $get_aff_results['username'], 
			'first_name' => $get_aff_results['f_name'], 
			'last_name' => $get_aff_results['l_name'], 
			'email' => $get_aff_results['email'], 
			'payment_amount' => $data_amount, 
			'currency' => $data_currency, 
			'webhook_timestamp' => time(), 
			'webhook_date' => date('m-d-Y', time()), 
			'webhook_time' => date('h:i a', time()), 
			);
			
break;

case "debit.created":
case "debit.removed":
case "debit.settled":
	
		$data = array(
			'event' => $event, 
			'affiliate_id' => $data_affiliate_id, 
			'username' => $get_aff_results['username'], 
			'first_name' => $get_aff_results['f_name'], 
			'last_name' => $get_aff_results['l_name'], 
			'email' => $get_aff_results['email'], 
			'debit_amount' => $data_amount, 
			'debit_reason' => $data_reason, 
			'debit_timestamp' => $data_timestamp, 
			'debit_date' => date('m-d-Y', $data_timestamp), 
			'debit_time' => date('h:i a', $data_timestamp),
			'webhook_timestamp' => time(), 
			'webhook_date' => date('m-d-Y', time()), 
			'webhook_time' => date('h:i a', time()), 
			);
			
break;
	
case "affiliate.created":
case "affiliate.terminated":

		$get_pay_name = $db->prepare("select name from idevaff_payment_methods where id = ?");
		$get_pay_name->execute(array($get_aff_results['pay_method']));
		$get_pay_name = $get_pay_name->fetch();
		$pay_name = $get_pay_name['name'];
	
		$data = array(
			'event' => $event, 
			'affiliate_id' => $data_affiliate_id, 
			'username' => $get_aff_results['username'], 
			'first_name' => $get_aff_results['f_name'], 
			'last_name' => $get_aff_results['l_name'], 
			'email' => $get_aff_results['email'], 
			'payable' => $get_aff_results['payable'], 
			'company' => $get_aff_results['company'], 
			'address_1' => $get_aff_results['address_1'], 
			'address_2' => $get_aff_results['address_2'], 
			'city' => $get_aff_results['city'], 
			'state' => $get_aff_results['state'], 
			'zip' => $get_aff_results['zip'], 
			'country' => $get_aff_results['country'], 			
			'phone' => $get_aff_results['phone'], 
			'fax' => $get_aff_results['fax'], 
			'website_url' => $get_aff_results['url'], 
			'ip_address' => $get_aff_results['ip'], 			
			'payment_method' => $pay_name, 				
			'signup_date_timestamp' => $get_aff_results['signup_date'], 
			'signup_date' => date('m-d-Y', $get_aff_results['signup_date']), 
			'webhook_timestamp' => time(), 
			'webhook_date' => date('m-d-Y', time()), 
			'webhook_time' => date('h:i a', time()), 
			);
			
break;

}
	
        $data_string = json_encode($data);
		
		$useragent = "iDevAffiliate_Signature";
        curl_setopt($curl_handle, CURLOPT_URL, $webhook_url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, $useragent);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));

        $jsonresult = curl_exec($curl_handle);
        $info = curl_getinfo($curl_handle);
		
		$result['status'] = $info['http_code'];
        if (isset($http_codes[$info['http_code']])) { $result['status'] .= ' ' . $http_codes[$info['http_code']]; }
        $result['url'] = $info['url'];
        $result['event'] = $data['event'];
		
		$st=$db->prepare("insert into idevaff_webhook_log (id, response_code, request_url, event_name, code) VALUES (null, ?, ?, ?, ?)");
		$st->execute(array($result['status'], $result['url'], $result['event'], $result['stamp']));

        curl_close($curl_handle);

	}
	}
	
	

//var_dump($result);

	}
	
	?>
