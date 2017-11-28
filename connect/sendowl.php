<?php
#############################################################
## iDevAffiliate Version 9.1
## Copyright - iDevDirect LLC
## Website: http://www.idevdirect.com/
## Support: http://www.idevsupport.com/
#############################################################

include_once ("../API/config.php");

$idv_url = $base_url . '/sale.php';
$profile = '164';
$admin_email = $address;
$admin_email = 'zikubd@gmail.com';


$input = @file_get_contents("php://input");
$event_json = json_decode($input);


if ( isset($event_json->order) && isset($event_json->order->transactions) && is_array($event_json->order->transactions) ) {

    $transaction = end($event_json->order->transactions);

    if ( isset( $transaction->refund ) && $transaction->refund == 1 ) {
        //this is refund...
        //do nothing
    }
    else {
        $amount = $event_json->order->settled_gross;
        $amount = substr($amount, 1);
        $transaction_id = $event_json->order->id;
        $currency = $event_json->order->settled_currency;
        $ip_address = $event_json->order->buyer_ip_address;
        $discount = $event_json->order->discount_code;


        $data = array (
            "profile"       => $profile,
            "idev_saleamt"  => $amount,
            "idev_ordernum" => $transaction_id,
            'ip_address'    => $ip_address,
            'idev_currency' => $currency,
            'idev_secret'   => $secret
        );

        if ( $discount != '' ) {
            $data['coupon_code'] = $discount;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $idv_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $json = curl_exec($ch);
        curl_close($ch);

        //mail($admin_email, 'Sendowl Pursed Data', print_r($data,true));
    }


}


header('X-PHP-Response-Code: 200', true, 200);
die();



