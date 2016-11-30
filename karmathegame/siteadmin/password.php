<? 
include("admin.config.inc.php");
include("connect.php");
$name=$_POST['name'];
$password=$_POST['password'];
if(trim($name)!='' && $password!='')
{
	$query=mysql_query("select * from admin WHERE username='$name' AND password='$password'");  
	//$query=mysql_query("select * from hosts WHERE username='$name' AND password='$password'");  
	$row=mysql_fetch_assoc($query);
	$total_rows=mysql_num_rows($query);
	$ADMIN_USERNAME=$row["username"];
	$ADMIN_PASSWORD=$row["password"];
	
	$UID=$row["userid"];
	if(isset($UsErId))
	{
		setcookie("UsErId","");
		$UsErId="";
	}
	if(($name==$ADMIN_USERNAME) && ($password==$ADMIN_PASSWORD) && ($total_rows>0))
	{
		setcookie("UsErId",1);
		setcookie("UsErOfAdMiN",$ADMIN_USERNAME);
		setcookie('ReSoUrCe','');
		header("Location:inner.php");
	}
	else
	{		   
		header("Location:index.php?Err=1");
	}
}
else
{		   
	header("Location:index.php?Err=1");
}	
?>