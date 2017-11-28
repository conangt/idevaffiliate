<?PHP
$cart_profile = '176';
$cart_profile_version = '1.0';
$cart_name = "ThriveCart";
$cart_cat = '5';
$protection_eligible = '1';
$coupon_code_eligible = '1';
$per_product_eligible = '0';
$profile_protection_eligible = '1';
$recurring_supported = '1';
$alternate_commission_supported = '0';
$ssl_required = '0';

	// CREATE TABLE DATA
	$checkdat = $db->query("SHOW COLUMNS from idevaff_carts_data LIKE 'thrivecart_key'");
	if (!$checkdat->rowCount()) {
	$add_column = $db->prepare("ALTER TABLE idevaff_carts_data ADD thrivecart_key blob");
	$add_column->execute(); }

if (!isset($readingonly)) {
include("module_update.php");

	// UPDATE DATA
	if (isset($_POST['thrivecart_key'])) {
	$st = $db->prepare("update idevaff_carts_data set thrivecart_key = (AES_ENCRYPT(?, '" . SITE_KEY . "'))");
	$st->execute(array($_POST['thrivecart_key']));
	$success_message = "<strong>Success!</strong> Settings saved.";
	}

	// GET CART DATA
	$query_cart_data = $db->query("SELECT AES_DECRYPT(thrivecart_key, '" . SITE_KEY . "') AS decrypted_key from idevaff_carts_data");
	$query_cart_data->setFetchMode(PDO::FETCH_ASSOC);
	$cart_data=$query_cart_data->fetch();
	$thrivecart_key=$cart_data['decrypted_key'];

?>

<?PHP include("includes/notifications.php"); ?>

<div class="widget box">
<div class="widget-header"><h4><i class="icon-shopping-cart"></i> <?PHP echo $cart_name; ?> Integration Instructions</h4>
<span class="pull-right"><a href="setup.php?action=2"><button class="btn btn-default btn-sm">Back To Integration Profiles</button></a>
</span>
</div>
<div class="widget-content">

<?PHP include ("carts/notes_integration.php"); ?>

<table class="table table-striped table-bordered table-highlight-head">
<tbody>
<tr>
<td width="5%">1.</td>
<td width="95%">Login to your ThriveCart admin center and go to <strong>Settings</strong> > <strong>API & Webhooks (section)</strong> > <strong>Webhooks & Notifications (View Settings)</strong>.</td>
</tr>
<tr>
<td width="5%">2.</td>
<td width="95%">Click <strong>Add another webhook</strong>.</td>
</tr>
<tr>
<td width="5%">3.</td>
<td width="95%">Enter <font color="#CC0000">iDevAffiliate</font> for your <strong>Webhook Name</strong>.</td>
</tr>
<tr>
<td width="5%">4.</td>
<td width="95%">Enter this URL as your <strong>Webhook URL</strong>:</td>
</tr>
<tr>
<td width="5%"></td>
<td width="95%"><textarea rows="2" class="form-control"><?PHP echo $base_url; ?>/connect/thrivecart.php</textarea></td>
</tr>
<tr>
<td width="5%"></td>
<td width="95%"><font color="#CC0000">Make sure the above path is correctly pointing to your installation folder/directory.</font></td>
</tr>

<tr>
<td width="5%"></td>
<td width="95%"><img src="//www.idevlibrary.com/files/thrivecart_settings.png" style="width:682px; height:209px; border:none;" /></td>
</tr>

</tbody>
</table>
</div>
</div>

<div class="widget box">
<div class="widget-header"><h4><i class="icon-shopping-cart"></i> <?PHP echo $cart_name; ?> Integration Settings</h4>
</div>
<div class="widget-content">
<form class="form-horizontal row-border" method="post" action="setup.php">

<div class="form-group">
<label class="col-md-3 control-label">ThriveCart Secret Word</label>
<div class="col-md-9"><input type="text" name="thrivecart_key" class="form-control input-width-xlarge" value="<?PHP echo html_output($thrivecart_key); ?>"><div class="help-block">Found in your ThriveCart admin center at Settings --> API & Webhook --> ThriveCart API --> Secret Word</div></div>
</div>

<div class="form-actions">
<input type="submit" value="Save Settings" class="btn btn-primary">
</div>

<input type="hidden" name="action" value="2">
<input type="hidden" name="code" value="1">
<input type="hidden" name="module" value="176">
<input name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" type="hidden" /></form>
</div>
</div>
<?PHP include("carts/notes.php"); ?>

<?PHP } ?>