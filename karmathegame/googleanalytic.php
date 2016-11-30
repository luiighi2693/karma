<?
$queryAAAA = "select * from google_analytic";
$resultAAAA = mysql_query($queryAAAA);
$rowAAAA = mysql_fetch_array($resultAAAA);
$descriptionAAAA=stripslashes($rowAAAA["description"]);
$enable_payAAAA=stripslashes($rowAAAA["enable_is"]);
if($enable_payAAAA=="Y")
{ echo $descriptionAAAA; } ?>