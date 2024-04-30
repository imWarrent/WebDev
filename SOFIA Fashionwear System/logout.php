<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();

//delete cookie
setcookie("username", null, -1);
setcookie("userid", null, -1);
setcookie("ranking", null, -1);

// Redirect to login page
header("location: index.php");
exit;
?>