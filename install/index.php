<?PHP
#############################################################
## iDevAffiliate Version 9
## Copyright - iDevDirect LLC
## Website: http://www.idevdirect.com/
## Support: http://www.idevsupport.com/
#############################################################

$idev_error = null;

if (!extension_loaded("IonCube Loader")) { $idev_error = "ioncube"; }
if (!extension_loaded('mcrypt')) { $idev_error = "mcrypt"; }
if (!extension_loaded('PDO')) { $idev_error = "pdo"; }

if (version_compare(phpversion(), '5.6.0', '<')) {
	$idev_error = "php";
	$version_required = "PHP 5.6 or 7.0";
}

if (!isset($idev_error)) {
header("Location: install.php"); exit;

} else {

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>iDevAffiliate <?PHP echo $write_edition; ?> Installation Program</title>
<link href="templates/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="templates/bootstrap/css/custom.css" rel="stylesheet">
</head>
<body>
  
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
<div class="navbar-header" style="margin-top:6px;"><img src="../admin/images/idevaffiliate_logo.png"></div>
<div class="navbar-collapse collapse">
</div>
</div>
</div>

<div id="wrap">
<div class="container">

<div style="padding:20px; width:1000px; margin-left:auto; margin-right:auto;">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><strong>Critical Error</strong><span class="pull-right">iDevAffiliate Installation Failure</span></h3>
</div>

<?PHP if ($idev_error == "php") { ?>
  <div class="panel-body">
    <div class="alert alert-info">The <strong>PHP version</strong> being used on your hosting account is outdated.</div>
	<p>Your web server is currently using PHP version <strong><?PHP echo phpversion(); ?></strong>. In order to install and run iDevAffiliate, <strong><?PHP echo $version_required; ?></strong> must be enabled on your web hosting account. You will need to contact your web hosting provider and/or server admin and ask them to upgade your hosting account to use <strong><?PHP echo $version_required; ?></strong>.</p>
	<p style="color:#CC0000; font-weight:bold;">Please take a moment to do this now.</p>
	<p><a href="index.php" class="btn btn-primary btn-sm">Try Again</a></p>
	<p>If after clicking the above button you still see this page, <strong><?PHP echo $version_required; ?></strong> is still not enabled in which case you will need to continue working with your web hosting provider and/or server admin.</p>
	<p><strong>Please Note:</strong><br />This is not a task the iDevAffiliate support team can complete for you. This task can only be completed by the person or entity responsible for managing your web hosting server. There is nothing additional required for you to purchase. This is a service that is already present on your web hosting account. It simply needs turned on/enabled. PHP INFO is provided below so you can review your server settings.</p>
  </div>
<?PHP } ?>

<?PHP if ($idev_error == "pdo") { ?>
  <div class="panel-body">
    <div class="alert alert-info"><strong>PDO</strong> is not enabled on your web hosting account.</div>
	<p>In order to install and run iDevAffiliate, <strong>PDO</strong> must be enabled on your web hosting account. You will need to contact your web hosting provider and/or server admin and ask them to enable <strong>PDO</strong> on your web hosting account.</p>
	<p style="color:#CC0000; font-weight:bold;">Please take a moment to do this now.</p>
	<p><a href="index.php" class="btn btn-primary btn-sm">Try Again</a></p>
	<p>If after clicking the above button you still see this page, <strong>PDO</strong> is still not properly enabled in which case you will need to continue working with your web hosting provider and/or server admin.</p>
	<p><strong>Please Note:</strong><br />This is not a task the iDevAffiliate support team can complete for you. This task can only be completed by the person or entity responsible for managing your web hosting server. There is nothing additional required for you to purchase. This is a service that is already present on your web hosting account. It simply needs turned on/enabled. PHP INFO is provided below so you can review your server settings.</p>
  </div>
<?PHP } ?>

<?PHP if ($idev_error == "ioncube") { ?>
  <div class="panel-body">
    <div class="alert alert-info"><strong>ionCube</strong> is not enabled on your web hosting account.</div>
	<p>In order to install and run iDevAffiliate, <strong>ionCube</strong> must be enabled on your web hosting account. You will need to contact your web hosting provider and/or server admin and ask them to enable <strong>ionCube</strong> on your web hosting account.</p>
	<p style="color:#CC0000; font-weight:bold;">Please take a moment to do this now.</p>
	<p><a href="index.php" class="btn btn-primary btn-sm">Try Again</a></p>
	<p>If after clicking the above button you still see this page, <strong>ionCube</strong> is still not properly enabled in which case you will need to continue working with your web hosting provider and/or server admin.</p>
	<p><strong>Please Note:</strong><br />This is not a task the iDevAffiliate support team can complete for you. This task can only be completed by the person or entity responsible for managing your web hosting server. There is nothing additional required for you to purchase. This is a service that is already present on your web hosting account. It simply needs turned on/enabled. PHP INFO is provided below so you can review your server settings.</p>
  </div>
<?PHP } ?>

<?PHP if ($idev_error == "mcrypt") { ?>
  <div class="panel-body">
    <div class="alert alert-info"><strong>Mcrypt</strong> is not enabled on your web hosting account.</div>
	<p>In order to install and run iDevAffiliate, <strong>Mcrypt</strong> must be enabled on your web hosting account. You will need to contact your web hosting provider and/or server admin and ask them to enable <strong>Mcrypt</strong> on your web hosting account.</p>
	<p style="color:#CC0000; font-weight:bold;">Please take a moment to do this now.</p>
	<p><a href="index.php" class="btn btn-primary btn-sm">Try Again</a></p>
	<p>If after clicking the above button you still see this page, <strong>Mcrypt</strong> is still not properly enabled in which case you will need to continue working with your web hosting provider and/or server admin.</p>
	<p><strong>Please Note:</strong><br />This is not a task the iDevAffiliate support team can complete for you. This task can only be completed by the person or entity responsible for managing your web hosting server. There is nothing additional required for you to purchase. This is a service that is already present on your web hosting account. It simply needs turned on/enabled. PHP INFO is provided below so you can review your server settings.</p>
  </div>
<?PHP } ?>
	
</div>
</div>

<br />

<?PHP phpinfo(); ?>


</div>
</div>



<div id="footer">
<div class="container">
<p class="text-muted credit pull-right">Copyright 2000-<?PHP echo date("Y"); ?> - iDevDirect LLC - <a href="http://www.idevdirect.com/" target="_blank">iDevAffiliate</a></p>
</div>
</div>

</body>
</html>

<?PHP } ?>