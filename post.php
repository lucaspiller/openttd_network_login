<? 
$output = ob_get_contents();
ob_end_clean();
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; 
?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>OpenTTD User Manager :: <? echo $place; ?></title>
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
  <meta http-equiv="Content-Language" content="en-gb" />
  <style type="text/css">
    @import url( 'main.css' );
  </style>
</head>
<body>
  <div id="page">
  
    <div id="sidebar">
      <div class="item">
        <a href="index.php" onfocus="this.blur()">Home</a>
      </div>
      
      <div class="menu">Your Account</div>
      <div class="item">
<? if (strlen($user_name)==0) { ?>
        <a href="login.php" onfocus="this.blur()">Login</a><br />
        <a href="register.php" onfocus="this.blur()">Register</a><br />
<? }else{ ?>
        <a href="index.php?a=logout" onfocus="this.blur()">Logout</a><br />
        <a href="info.php" onfocus="this.blur()">Account Information</a><br />
<? } ?>
      </div>
    </div>
    
    <div id="main">
<? echo $output; ?>
    </div>
    
    <div id="footer">
        Designed, created and maintained by Luca Spiller | Copyright &copy; 2005 Luca Spiller
    </div>
  </div>
</body>
</html>