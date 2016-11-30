<?
include("connect.php");
$message="";
if($_GET['fullname']!="")
{
	$digits = 3;
	$NOO=rand(pow(10, $digits-1), pow(10, $digits)-1);
	
	$str = $_GET['fullname'];
	$strexplode=explode(" ",$str);
	for( $i = 0; $i <count($strexplode); $i++ ) 
	{
		$message.= substr( $strexplode[$i], 0, 1 );
	}
	$message.=$NOO;
}
echo $message;
?>