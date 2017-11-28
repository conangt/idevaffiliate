<?PHP
#############################################################
## iDevAffiliate Version 9.1
## Copyright - iDevDirect LLC
## Website: http://www.idevdirect.com/
## Support: http://www.idevsupport.com/
#############################################################

include_once ("../API/config.php");

$idv_url = $base_url . '/sale.php';
$profile = '171';
$admin_email = $address;

$data = isset( $_POST['payload'] ) ? $_POST['payload'] : array();

if ( !empty($data) ) {
	$parsed_data = json_decode($data, true);
	//mail('zikubd@gmail.com', 'called', 'here: ' . print_r($parsed_data, true));
	if ( array_key_exists('event_type', $parsed_data) && $parsed_data['event_type'] == 'payment_thankyou' ) {

		$amount = $parsed_data['data']['payment']['amount'];
		$ip = $parsed_data['data']['payment']['ip_address'];

		$invoices = $parsed_data['data']['payment']['invoices'];

		if ( is_array($invoices) ) {
			$id = $invoices[0]['invoice_number'];
		} else {
			$id = $parsed_data['data']['payment']['payment_id'];
		}

		$currency = $parsed_data['data']['payment']['currency_code'];

		$return = array (
				"profile"       	=> $profile,
				"idev_saleamt"  	=> $amount,
				"idev_ordernum" 	=> $id,
				'ip_address'    	=> $ip,
				'idev_currency' 	=> $currency,
				'idev_secret'   	=> $secret
		);

		//mail('zikubd@gmail.com', 'called', 'here: ' . print_r($return, true));

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $idv_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $return);
		$json = curl_exec($ch);
		curl_close($ch);
	}

}

header('X-PHP-Response-Code: 200', true, 200);

	
?>