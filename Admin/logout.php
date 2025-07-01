<?php
session_start();
session_destroy(); // destroy all session data
header("Location: admin_login.php"); // redirect user to login page
exit();
?>
