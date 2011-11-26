<?
include "pre.php";
$place = "Register";

if ($r==1) { // Process Registration
 $error="";
 if (strtolower($pass1)<>strtolower($pass2)) {$error.="<li>The entered passwords do not match</li>";}
 if (strtolower($email1)<>strtolower($email2)) {$error.="<li>The entered email addresses do not match</li>";}
 if (!strstr($email1,"@")) {$error.="<li>That is not a valid email address</li>";}
 if (strlen($name)<3 or strlen($name)>80) {$error.="<li>Usernames must be between 3 and 80 characters long</li>"; }
 if (strlen($pass1)<3 or strlen($pass1)>20) {$error.="<li>Passwords must be between 3 and 20 characters long</li>"; }
  
 $query = "SELECT * FROM users WHERE email='".addslashes($email)."'"; // Check for same email address
 $result = mysql_query ($query);
 if ($result!=1) {
  $output = "There was a MySql error:<BR>".mysql_error(); // Show error message
 }else{
  if (mysql_num_rows($result)>0) {
   $error.="<li>Someone has already registered with that email address, if you have l";
   $error.="ost you password click <a href=\"main.php?a=lostpass\">here</a>.</li>";
  }
 }
 $query = "SELECT * FROM users WHERE name='".addslashes($name)."'"; // Check for same name
 $result = mysql_query ($query);
 if (mysql_num_rows($result)>0) {
  $error.="<li>There is already a user with that name</li>";
 }
 if ($error!="") { 
 // Errors
  echo error_msg("There were the following errors:<ul>$error</ul>");
 }else{ 
 // No Errors so put data into database
  $time = time(); 
  $epass = md5($pass1);
  $key = md5(rand());
  $query = "INSERT INTO `users` (`name` , `email` , `password` , `joined` , `key`, `state` ) VALUES('".addslashes($name)."','".addslashes($email1)."', '".addslashes($epass)."','$time', '".addslashes($key)."', 0);";
  $result = mysql_query($query);
  if ($result!=1) {
    echo "There was a MySql error:<BR>".mysql_error(); // Show error message
  }else{
  $message = "Hello ".$name.",\n\nThank you for registering an account!\n\nIn order to use your account you will need to click on ";
  $message .= "the activation link below:\n\n".$url."register.php?r=2&name=".$name."&key=".$key."\n\nThanks,\nOpenTTD User Manager\n";
   //Success   
  $headers  = "From: \"OpenTTD User Manager\"<".$from_email.">\n";
  $headers .= "To: <".$email1.">\n";
  $headers .= "MIME-Version: 1.0\n";
  $headers .= "Content-Description: Notification\n";
  $headers .= "Content-Type: text/plain\n";
   mail("<".$email1.">", "OpenTTD User Manager - Account Activation", $message, $headers);
   $msg = "Your registration was successfull! You will recieve an email soon that includes an activation link you have to click. ";
   $msg .= "You will not be able to login before you have activated your account.";
   echo comfirm($msg,"index.php","Home");
  }

 }
}elseif ($r==2) { // Verify email address
  $query = "SELECT `key` FROM `users` WHERE name = '".addslashes($name)."' AND state = 0;";
  $result = mysql_query ($query);
  if (!$result) {
    die($query."<br>".mysql_error($link));
  }
  if (mysql_affected_rows($link) != 1) {
    echo error_msg("Invalid account name, or your account is already active.");
  }else{
    if (addslashes($key) == mysql_result($result,0)) {
      # Sets new random key
      $query = "UPDATE `users` SET `key` = '".addslashes(md5(rand()))."', `state` = 1 WHERE name = '".addslashes($name)."' LIMIT 1;";
      $result = mysql_query ($query);
      if (!$result) {
      die($query."<br>".mysql_error($link));
      }
      if (mysql_affected_rows($link) != 1) {
        echo error_msg("There was an unknown error.");
      }else{
        $msg = "Your account was activated! Please proceed to login!";
        echo comfirm($msg,"login.php","Login");
      }
    }else{
      echo error_msg("Your validation key is incorrect.");
    }
  }
}else{ // Show registration form
?>
       <center>
        <font size="4">Login</font><br />
      </center>
      <div class="text_stand">
        <form action="register.php" method="post">
          <table width=100% cellspacing=6>
            <tr>
              <td width="50%">
                <b>Please choose a Username</b>
                <br>Usernames must be between 3 and 80 characters long
              </td>
              <td width="50%">
                <input type="text" size="20" maxlength="80" name="name">
              </td>
            </tr>
            <tr>
              <td>
                <b>Please choose a Password</b><br>Passwords must be between 3 and 20 characters long
              </td>
              <td>
                <input type="password" size="20" maxlength="20" name="pass1">
              </td>
            </tr>
            <tr>
              <td>
                <b>Please re-enter your password</b><br>It must match exactly
              </td>
              <td>
                <input type="password" size="20" maxlength="20" name="pass2">
              </td>
            </tr>
            <tr>
              <td>
                <b>Please enter your email address</b><br>You will need this for confirmation
              </td>
              <td>
                <input type="text" size="20" name="email1">
              </td>
            </tr>
            <tr>
              <td>
                <b>Please re-enter your email address</b><br>It must match exactly
              </td>
              <td>
                <input type="text" size="20" name="email2" >
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" value="Register">
              </td>
            </tr>
          </table>
          <input type="hidden" name="r" value="1"> 
        </form>
      </div>
<?
}
include "post.php";
?>