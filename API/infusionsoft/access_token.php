<?php
require_once 'autoload.php';
include_once '../../API/config.php';

$base_url = str_replace("http://", "https://", $base_url);

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
    'redirectUri'  => $base_url.'/API/infusionsoft/access_token.php',
));

if (isset($_GET['code'])) {
	try {
		$infusionsoft->requestAccessToken($_GET['code']);
		$access_token = serialize($infusionsoft->getToken());
		$st = $db->prepare("update idevaff_carts_data set inf_access_token = (AES_ENCRYPT(?, '" . SITE_KEY . "'))");
		$st->execute(array($access_token));
		echo 'Access Token has been set. You may close this window.';
	}
	catch (\Infusionsoft\InfusionsoftException $e) {
		echo $e->getMessage();
	}
}