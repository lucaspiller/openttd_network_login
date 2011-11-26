<?
$ser_ip = 	"localhost";	// MySql Host
$ser_usr = 	"";	 	// MySql Username
$ser_pas = 	"";		// MySql Password
$database =	"ottd_login";		// MySql database to use

$url =  "http://192.168.0.2/ottd_login/"; // Base url of system
$from_email = "thelucster@gmail.com"; // From email

if (!$link = mysql_connect($ser_ip,$ser_usr,$ser_pas)) {
  die("Could not connect");	// Connect to MySql host
}
mysql_select_db($database) or die("Could not connect to database");	// Select Database

// Clear variables set above so they cannot be used in the script - just for security
$ser_ip = "";
$ser_usr = "";
$ser_pass = "";
$database = "";
?>
