<? include "pre.php";
$query = "SELECT * FROM users WHERE name='$user_name'";
$result = mysql_query ($query);
$userdat = mysql_fetch_array($result);
?>
      <center>
        <font size="4">Account Information</font><br />
      </center>
      <div class="text_stand">
        Below you can view your account information.
      </div>
      <div class="text_stand">
        <p><b>Account name:</b></p>
        <p><? echo stripslashes($userdat["name"]); ?></p>
        <p><b>Email address:</b></p>
        <p><? echo stripslashes($userdat["email"]); ?></p>
        <p><b>Registration date:</b></p>
        <p><? echo date("l dS of F Y",$userdat["joined"]); ?></p>
      </div>
<?
$place = "Account Information";
include "post.php";
?>