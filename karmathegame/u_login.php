<? include("connect.php");
$LeftMenu='LOGIN';
if($_POST['HidRegUser']=="1")
{
	$couponcode=trim($_POST['couponcode']);
	$password=trim($_POST['passwordd']);
	$SelCustomerQry=mysql_query("select * from users where couponcode='".addslashes($couponcode)."' and password='".addslashes($password)."'");
	$TotUsername=mysql_num_rows($SelCustomerQry);
	if($TotUsername>0)
	{
		$SelCustomerQryRow=mysql_fetch_array($SelCustomerQry);
		$_SESSION['UsErIdFrOnT']=$SelCustomerQryRow['id'];
		
		$SelCustomerQry=mysql_query("UPDATE users SET lastlogin=now(),online='Y' where id='".$_SESSION['UsErIdFrOnT']."'");
		
		header("location:dashboard.php");
		exit;
	}
	else
	{
		$SelCustomerQry=mysql_query("select * from users where username='".addslashes($couponcode)."' and password='".addslashes($password)."'");
		$TotUsername=mysql_num_rows($SelCustomerQry);
		if($TotUsername>0)
		{
			$SelCustomerQryRow=mysql_fetch_array($SelCustomerQry);
			$_SESSION['UsErIdFrOnT']=$SelCustomerQryRow['id'];
			
			$SelCustomerQry=mysql_query("UPDATE users SET lastlogin=now(),online='Y' where id='".$_SESSION['UsErIdFrOnT']."'");
			
			header("location:u_dashboard.php");
			exit;
		}
		else
		{
			$message="Token and password does not match.";
		}
	}
} 
?>
