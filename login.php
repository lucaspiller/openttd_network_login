<?
include "pre.php";
$place = "Login";
if($l==1) {
 $error = "";
 if (strlen($name)<3 or strlen($name)>80) {$error.="<li>Usernames are between 3 and 80 characters long</li>"; }
 if (strlen($pass1)<3 or strlen($pass1)>20) {$error.="<li>Passwords are between 3 and 20 characters long.</li>"; }
 if ($error<>"") { 
  echo error_msg($error);
 }else{
  $query = "SELECT * FROM users WHERE name='".addslashes($name)."'";
  $result = mysql_query ($query);
  $userdat = mysql_fetch_array($result);
   if(md5($pass1) == $userdat["password"] && $userdat["state"] == 1) { // Logged in
    session_register("user_name");
    session_register("user_email");
    $user_name = stripslashes($userdat["name"]);
    $user_email = stripslashes($userdat["email"]);
    echo comfirm("Your login was succesfull!","index.php","Home");
   }elseif ($userdat["state"] == 0) {
    echo error_msg("You have not verified your email address yet.");
   }elseif ($userdat["state"] == -1) {
    echo error_msg("Sorry, you are banned.");
   }else{
    echo error_msg("Your username or password are incorrect.");
   }
  }
}else{ // Show registration form
?>
      <center>
        <font size="4">Login</font><br />
      </center>
      <div class="text_stand">
        <form action="login.php" method="post">
          <table width=100% cellspacing=6>
            <tr>
              <td width="50%">
                <b>Please enter your Username</b><br>Usernames are between 3 and 80 characters long
              </td>
              <td width="50%">
                <input type="text" size="20" maxlength="80" name="name">
              </td>
            </tr>
            <tr>
              <td>
                <b>Please enter your Password</b><br>Passwords are between 3 and 20 characters long</td>
              <td>
                <input type="password" size="20" maxlength="20" name="pass1">
              </td>
            </tr>
            <tr>
              <td>
              </td>
              <td>
                <input type="submit" value="Login">
              </td>
            </tr>
          </table>
          <input type="hidden" name="l" value="1">
        </form>
      </div>
<?
}
include "post.php";
?>