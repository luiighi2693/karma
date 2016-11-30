<?php
session_start();
include ("../include/config.inc.php");
include ("../include/functions.php");
include_once ("../include/prs_function.php");
include_once ("linkvars.php");	
$db=mysql_connect($DBSERVER, $USERNAME, $PASSWORD) or die ("Couldnt connect")	;
mysql_select_db($DATABASENAME,$db) or die("Couldnt find database")	;
?>