<? include("connect.php");
$LeftMenu='LOGIN';
$_SESSION['UsErIdFrOnT']='';
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
			
			header("location:dashboard.php");
			exit;
		}
		else
		{
			$message="Token and password does not match.";
		}
	}
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/opening_styles.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="cookies.js"></script>
</head>
<body onLoad="callcook1();" >
<? include("top.php");?>
<div id="top_line"></div>
<div id="headline_titles">
 <style type="text/css">body{background-image:url('images/background_L.png');background-color:#e6e6e6;background-position:top center; background-size:100%;background-repeat:no-repeat;background-attachment:fixed;background-border:0px 5px 0px 5px;}</style>
  <? include("left.php");?>
  
  <div id="center_content">
  <form name="frmselectavatar" id="frmselectavatar" enctype="multipart/form-data" method="post" onSubmit="return frmcheck();">
    
	<div id="login_box">
	<? if($message!=''){?><div style="color:#FF0000;padding:20px;" align="left"  ><? echo $message;?></div><? }?>
      <div id="username">TOKEN</div>
      <div id="username_box">
          <label><input type="text" name="couponcode" id="couponcode" class="inputbox"  ></label>
      </div>
      <br>
      <div id="password">PASSWORD</div>
      <div id="password_box">
        <label>
        <input type="password" name="passwordd" id="passwordd" class="inputbox"  >
        </label>
       </div>
	 
      
      <div id="password_box" style="background:none;margin:0px;margin-left:7px;height:10px;margin-bottom:10px;">
        <label style="margin:0px;height:10px;">
        <input name="remember" id="remember" type="checkbox" value="Y"  style="float:left; " /> Remember Me
        </label>
       </div>
	  
	  <div ><input type="submit" name="Submitbtn" value="Login" class="submitbutton"/>
	  <input type="hidden" name="HidRegUser" id="HidRegUser" value="0" />
	  </div>
    </div>
  </form>	
  </div>
  <div id="right_content"> </div>
</div>
<script language="javascript">
function frmcheck()
{
	form=document.frmselectavatar;
	if(form.couponcode.value=="")
	{
		alert("Please enter your token.")
		form.couponcode.focus();
		return false;
	} 
	if(form.passwordd.value=="")
	{
		alert("Please enter password.")
		form.passwordd.focus();
		return false;
	}
	document.frmselectavatar.HidRegUser.value='1';
	//document.frmselectavatar.submit();
	
	var couponcode=document.frmselectavatar.couponcode.value;
	var passwordd=document.frmselectavatar.passwordd.value;
	if(document.frmselectavatar.remember.checked==true)
	{
		Set_Cookie( 'couponcodeCC', couponcode, '', '/', '', '' );
		Set_Cookie( 'passworddCC', passwordd, '', '/', '', '' );
		Set_Cookie( 'Remembr', 'Y', '', '/', '', '' );
	}	
	else
	{		
		Set_Cookie( 'couponcodeCC', '', '', '/', '', '' );
		Set_Cookie( 'passworddCC', '', '', '/', '', '' );		
		Set_Cookie( 'Remembr', '', '', '/', '', '' );					
	}
	
	
	return true;    
}
function callcook1()
{	
	
	var newval=Get_Cookie('passworddCC')
	var newval1=Get_Cookie('couponcodeCC');	
	if(newval1==null || newval1=="" || newval1=="null")
	{		
		document.frmselectavatar.passwordd.value="";	
		document.frmselectavatar.couponcode.value="";	
		document.frmselectavatar.remember.checked=false;	
	}
	else
	{
		document.frmselectavatar.passwordd.value=newval;	
		document.frmselectavatar.couponcode.value=newval1;	
		document.frmselectavatar.remember.checked=true;		
	}
}
</script>
<? include("googleanalytic.php");?>
</body>
</html>