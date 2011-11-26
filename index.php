<? include "pre.php";
if ($a == "logout") {
  session_destroy(); 
  $user_name = "";
  $user_email = "";
}
?>
      <center>
        <font size="6">OpenTTD</font><br />
        <font size="4">User Manager</font><br />
      </center>
      <div class="text_stand">
        Welcome to the site of the OpenTTD User Manager, a project to build user authentication into mutiplayer OpenTTD games.
      </div>
      <div class="text_stand">
        <div class="text_header">News</div>
        <p><b>Saturday April 16th 2005</b></p>
        <p>Registrations work again.</p>
        <p><b>Friday April 15th 2005</b></p>
        <p>A few minor updates to the server stuff, now you can't get in before you have verified your email address, and there are a few security fixes.</p>
      </div>
<?
$place = "";
include "post.php";
?>