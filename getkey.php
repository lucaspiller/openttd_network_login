<?
include("sql.php");

$query = "SELECT * FROM `users` WHERE name = '".addslashes($name)."';";
$result = mysql_query ($query);
if (!$result) {
  die(mysql_error());
}
$userdat = mysql_fetch_array($result);
if ($userdat["name"] == "") {
  echo "NOUSER";
  exit;
}
if ($userdat["state"] == -1) {
  echo "BANNED";
}elseif ($userdat["state"] == 0) {
  echo "NOVERI";
}else{
  if (md5(addslashes($pass)) == $userdat["password"]) {
    $key = md5(rand());
    $query = "UPDATE `users` SET `key` = '".addslashes($key)."' WHERE name = '$name' LIMIT 1;";
    $result = mysql_query ($query);
    if (!$result) {
      die(mysql_error($link));
    }
    if (mysql_affected_rows($link) != 1) {
      echo "NOUSER";
    }else{
      echo $key;
    }
  }else{
    echo "BADPASS";
  }
}
?>