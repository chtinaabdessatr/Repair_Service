<?php
session_start();
$tec_id= $_SESSION["AID"];
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('admin_login.php?mes=Access Denied...','_self');</script>";
		
	}		

?>