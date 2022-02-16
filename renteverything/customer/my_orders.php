<?php

include("includes/db.php");
include("functions/functions.php");
//getting customer ID

$c = $_COOKIE['customer_email'];
	
	$get_c = "select * from customers where customer_email='$c'";
	$run_c = mysqli_query($db, $get_c);
	
	$row_c =mysqli_fetch_array($run_c);
		
		$customer_id = isset($row_c['customer_id']) ; 



?>
