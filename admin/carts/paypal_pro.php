<?PHP
$cart_profile = '174';
$cart_profile_version = '1.0';
$cart_name = "Paypal Pro";
$cart_cat = '1';
$protection_eligible = '1';
$coupon_code_eligible = '1';
$per_product_eligible = '0';
$profile_protection_eligible = '1';
$recurring_supported = '1';
$alternate_commission_supported = '0';
$ssl_required = '0';

if (!isset($readingonly)) {
include("module_update.php");

?>

<?PHP include("includes/notifications.php"); ?>

<div class="widget box">
<div class="widget-header"><h4><i class="icon-shopping-cart"></i> <?PHP echo $cart_name; ?> Integration Instructions</h4>
<span class="pull-right"><a href="setup.php?action=2"><button class="btn btn-default btn-sm">Back To Integration Profiles</button></a>
</span>
</div>
<div class="widget-content">

<div class="alert alert-danger"><h4>Notice</h4>You should only have this integration enabled if you're using your own PayPal Pro payment form(s). If instead you are really using a cart/membership system with PayPal Pro enabled as the payment option, please <a href="setup.php?action=2">remove this integration</a> and enable the cart/membership system you're using.</div>

<div class="alert alert-success"><h4>PayPal Pro Specific Note</h4>
<ol>
    <li>This task should be performed by the person who originally placed the payment processing code for you in your credit card processing form. Possibly a web developer or site manager.</li>
    <li>You'll find an example integration under connect/example/paypal_pro.php</li>
</ol>
</div>
<?PHP include ("carts/notes_integration.php"); ?>


<table class="table table-striped table-bordered table-highlight-head">
<tbody>
<tr>
<td width="5%">1.</td>
<td width="95%">Edit your existing PayPal Pro processing file.</td>
</tr>
<tr>
<td width="5%">2.</td>
<td width="95%">In your existing file, find the following line of code (function) or if this line doesn't exist, find where you've added your payment success condition:</td>
</tr>
<tr>
<td width="5%"></td>
<td width="95%"><textarea rows="3" class="form-control">case 'success':
case 'successwithwarning':</textarea></td>
</tr>
<tr>
<td width="5%">3.</td>
<td width="95%">Copy/Paste the following code in to your file, <strong>below</strong> the line above.</td>
</tr>
<tr>
<td width="5%"></td>
<td width="95%"><textarea rows="52" class="form-control">// =========================================
// Start iDevAffiliate integration code.
// =========================================

// Required Data
$customer_ip = $_SERVER['REMOTE_ADDR']; // customer ip address change variable if needed
$idev_saleamt = $order->order_total; // specify sale amount here
$idev_ordernum = $order->order_number; // specify order number here

// Optional Data

$coupon_code = ''; // define here if exists for order
$idev_currency = ''; // define here if exists for order
$idev_secret = '<?PHP echo $secret; ?>'; // already set in default integration code - update this value if you ever reset your secret key

// Do Not Alter Below

$idv_url = '<?PHP echo $base_url; ?>/sale.php';
$profile = '174';

$data = array (
	"profile"       => $profile,
	"idev_saleamt"  => $idev_saleamt,
	"idev_ordernum" => $idev_ordernum,
	"coupon_code"   => $coupon_code,
	"ip_address"    => $customer_ip,
	"idev_currency" => $idev_currency,
	"idev_secret"   => $idev_secret
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $idv_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$json = curl_exec($ch);
curl_close($ch);

// =========================================
// End iDevAffiliate integration code.
// =========================================</textarea></td>
</tr>

</tbody>
</table>
</div>
</div>





<?PHP include("carts/notes.php"); ?>

<?PHP } ?>