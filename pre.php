<?
include("sql.php"); // Start MySql connection
include("functions.php"); // Extra functions

session_register("user_name");
session_register("user_email");
session_register("user_groups");

ob_start();
?>
