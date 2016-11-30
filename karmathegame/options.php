<? 
if($_SESSION['UsErIdFrOnT']!='')
{
$getuserwry="SELECT * FROM options WHERE id='".$_SESSION['UsErIdFrOnT']."'";
$getuserwryRs=mysql_query($getuserwry);
$Totgetuser=mysql_affected_rows();
if($Totgetuser<=0)
	{
		$sql="INSERT INTO options 
		VALUES ($_SESSION['UsErIdFrOnT'],1,1,1);
		$getuserwryRs=mysql_query($getuserwry);
	}
}
?>