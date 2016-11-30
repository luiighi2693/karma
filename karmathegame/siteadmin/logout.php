<?php
	ini_set('session.use_trans_sid', true);
	session_start();
  	setcookie("UsErOfAdMiN","");
  	$UsErOfAdMiN="";
  	setcookie("UsErTyPe","");
  	$UsErTyPe="";
	setcookie("UsErId","");
  	$UsErId="";
  
  
	session_unregister("CartId");
	$CartId="";
	session_unregister("MCartId");
	$MCartId="";
	session_unregister("UsErOfAdMiN");
	session_unregister("UsErTyPe");
	session_unregister("UsErId");
	
 
  header("Location:index.php");
?>



