<?PHP
#############################################################
## iDevAffiliate Version 9
## Copyright - iDevDirect LLC
## Website: http://www.idevdirect.com/
## Support: http://www.idevsupport.com/
#############################################################

$error = null;

// ------------------------------------------------------------------
// Check Username Exists
// ------------------------------------------------------------------
$check_username = $db->prepare("select id from idevaff_affiliates where username = ?");
$check_username->execute(array($username));
if ($check_username->rowCount()) { $error .= "- Username is taken.\r\n"; }

// ------------------------------------------------------------------
// Check Username Is Short
// ------------------------------------------------------------------
function username_short($credential) {
global $db;
$user_min = $db->query("select user_min from idevaff_config");
$user_min = $user_min->fetch();
$user_min = $user_min['user_min'];
$rtn_value = false;
if (get_magic_quotes_gpc()) {
$credential = stripslashes($credential); }
if ((strlen($credential) < $user_min)) {
$rtn_value=true; } return $rtn_value; }
if (username_short($username)) { $error .= "- Username is too short or missing. " . $user_min . " charaters min.\r\n"; }

// ------------------------------------------------------------------
// Check Password Is Short
// ------------------------------------------------------------------
function password_short($credential) {
global $db;
$pass_min = $db->query("select pass_min from idevaff_config");
$pass_min = $pass_min->fetch();
$pass_min = $pass_min['pass_min'];
$rtn_value = false;
if (get_magic_quotes_gpc()) {
$credential = stripslashes($credential); }
if ((strlen($credential) < $pass_min)) {
$rtn_value=true; } return $rtn_value; }
if (password_short($password)) { $error .= "- Password is too short or missing. " . $pass_min . " charaters min.\r\n"; }

// ------------------------------------------------------------------
// Check Email Is Valid
// ------------------------------------------------------------------

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $error .= "- Email address is missing or invalid.\r\n"; }

// ------------------------------------------------------------------
// ALL OTHER VALUES ARE SANITIZED BUT NOT CHECKED AGAINST RULES.
// You can do that below if you want.
// ------------------------------------------------------------------

?>