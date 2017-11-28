<?php
#############################################################
## iDevAffiliate Version 9.1
## Copyright - iDevDirect LLC
## Website: http://www.idevdirect.com/
## Support: http://www.idevsupport.com/
#############################################################

include_once ("../API/config.php");

// Define Basics
$idv_url = $base_url . '/sale.php';
$profile = '176';

//user fields
//$secret_word = 'NIXLRJVNSHOE'; //from Settings --> API & Webhook --> ThriveCart API --> Secret Word

	// GET CART DATA
	$query_cart_data = $db->query("SELECT AES_DECRYPT(thrivecart_key, '" . SITE_KEY . "') AS decrypted_key from idevaff_carts_data");
	$query_cart_data->setFetchMode(PDO::FETCH_ASSOC);
	$cart_data=$query_cart_data->fetch();
	$thrivecart_key=$cart_data['decrypted_key'];

if ( isset($_POST, $_POST['thrivecart_secret'], $_POST['event']) && $_POST['thrivecart_secret'] == $thrivecart_key  && ( $_POST['event'] == 'order.success' || $_POST['event'] == 'order.subscription_payment' ) ) {
    $idev_saleamt = isset($_POST['order']['total']) ? floatval($_POST['order']['total']) / 100 : 0.00;
    $idev_ordernum = isset($_POST['order_id']) ? $_POST['order_id'] : '';
    $idev_currency = isset($_POST['currency']) ? $_POST['currency'] : '';
    $coupon = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '';
    $ip_address = isset($_POST['customer']['ip_address']) ? $_POST['customer']['ip_address'] : '';

    $data = array (
        "profile"       => $profile,
        "idev_saleamt"  => $idev_saleamt,
        "idev_ordernum" => $idev_ordernum,
        "ip_address"    => $ip_address,
        "coupon_code"   => $coupon,
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

    //mail('zikubd@gmail.com', 'ThriveCart Success Data', print_r($data, true));
}
header('X-PHP-Response-Code: 200', true, 200);
?>