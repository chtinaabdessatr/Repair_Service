<?php
session_start();
$tec_id= $_SESSION["TID"];
	if(!isset($_SESSION["TID"]))
	{
		echo"<script>window.open('tec_login.php?mes=Access Denied...','_self');</script>";
		
	}		

?>