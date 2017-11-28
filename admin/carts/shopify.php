<?PHP
$cart_profile = '72';
$cart_profile_version = '1.0';
$cart_name = "Shopify";
$cart_cat = '5';
$protection_eligible = '0';
$coupon_code_eligible = '1';
$per_product_eligible = '0';
$profile_protection_eligible = '1';
$recurring_supported = '0';
$alternate_commission_supported = '0';
$ssl_required = '1';

if (!isset($readingonly)) {
include("module_update.php");

$integration = $db->prepare("select * from idevaff_integration where type = ?");
$integration->execute(array($cart_profile));
$iconfig=$integration->fetch();
$opvar1_name = $iconfig['idev_var1'];
$opvar1_cart = $iconfig['cart_var1'];
$use_op1 = $iconfig['use_var1'];
$opvar1_tag = $iconfig['tag_var1'];
$opvar2_name = $iconfig['idev_var2'];
$opvar2_cart = $iconfig['cart_var2'];
$use_op2 = $iconfig['use_var2'];
$opvar2_tag = $iconfig['tag_var2'];
$opvar3_name = $iconfig['idev_var3'];
$opvar3_cart = $iconfig['cart_var3'];
$use_op3 = $iconfig['use_var3'];
$opvar3_tag = $iconfig['tag_var3'];
if (($use_op1 == 1) && ($opvar1_tag) && ($opvar1_cart)) { $addvar1 = "&idev_option_1=" . $opvar1_cart; }
if (($use_op2 == 1) && ($opvar2_tag) && ($opvar2_cart)) { $addvar2 = "&idev_option_2=" . $opvar2_cart; }
if (($use_op3 == 1) && ($opvar3_tag) && ($opvar3_cart)) { $addvar3 = "&idev_option_3=" . $opvar3_cart; }

?>
<div class="widget box">
<div class="widget-header"><h4><i class="icon-shopping-cart"></i> <?PHP echo $cart_name; ?> Integration Instructions</h4>
<span class="pull-right"><a href="setup.php?action=2"><button class="btn btn-default btn-sm">Back To Integration Profiles</button></a>
</span>
</div>
<div class="widget-content">

<?PHP include ("carts/notes_integration.php"); ?>

<table class="table table-striped table-bordered table-highlight-head">
<tr>
<td width="5%">1.</td>
<td width="95%">Login to your <font color="#CC0000"><?PHP echo $cart_name; ?> Admin Center</font>.</td>
</tr>
<tr>
<td width="5%">2.</td>
<td width="95%">Go to <b>Settings</b> then <b>Checkout</b>.</td>
</tr>
<tr>
<td width="5%">3.</td>
<td width="95%">Place the following code into the <b>Additional scripts</b> box.</td>
</tr>
<tr>
<td width="5%"></td>
<td width="95%"><textarea rows="6" class="form-control">{% if first_time_accessed %}
<img src="<?PHP echo $base_url; ?>/sale.php?profile=<?PHP echo $cart_profile; ?>&<?PHP echo $varname; ?>={{ subtotal_price | money_without_currency }}&<?PHP echo $idev_tracking; ?>={{ order_number }}&coupon_code={{discounts.first.code}}&idev_currency={{ shop.currency }}<?PHP if (isset($addvar1)){echo"$addvar1";}?><?PHP if (isset($addvar2)){echo"$addvar2";}?><?PHP if (isset($addvar3)){echo"$addvar3";}?>" style="height:0px; width:0px; border:0px;" />
{% endif %}</textarea></td>
</tr>
<tr>
<td width="5%" align="center"></td>
<td width="95%"><font color="#CC0000">Make sure the above path is correctly pointing to your installation folder/directory.</font></td>
</tr>
</table>
</div>
</div>
<?PHP include("carts/notes.php"); ?>

<?PHP } ?>