<? 
include("connect.php");
function Get_CreatePasswordXXX()
{
	$chars = "23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";    
	srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 11) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
} 
if($_POST['HidRegUser']=="1")
{
	$codee=$_POST['codee'];
	$email=$_POST['email'];
	$SelCustomerQry=mysql_query("select id from marketers where code='".addslashes($codee)."'");
	$TotUsername=mysql_num_rows($SelCustomerQry);
	if($TotUsername>0 || $codee=="0000")
	{
		$SelCustomerQry=mysql_query("select id from users where email='".addslashes($_POST['email'])."'");
		$TotUsername=mysql_num_rows($SelCustomerQry);
		if($TotUsername<=0)
		{
			$CopuonCode=Get_CreatePasswordXXX();
			$InsertUserQry="INSERT INTO users set 
			email='".addslashes($_POST['email'])."',couponcode='".addslashes($CopuonCode)."',marketer='".addslashes($codee)."',
			regdate=curdate()";
			mysql_query($InsertUserQry);
			$InsertId=mysql_insert_id();
			
			$InsertUserQry2="INSERT INTO promotional  SET
			promocode='".addslashes($CopuonCode)."',lifes='3',
			chklimit='N',
			notimes='1',
			disctype='1',userid='".addslashes($InsertId)."',
			marketer='".addslashes($codee)."'";	
			mysql_query($InsertUserQry2);
			
			if($codee=="0000"){ $BA_Name="Game Guru"; } else { $BA_Name=ucwords(stripslashes(GetName1("marketers","firstname","code",$codee))); }
			
			$toemail=$_POST['email'];
			$from1="noreply@karmathegame.guru";
			$subject1="Karma - the Game of Destiny - Free Lives";
			$mailcontent1='
			<table width="100%" border="0" cellpadding=0 cellspacing=0>
				<tr>
					<td align="left">
					Hi and congratulations!!!  You are about to participate in the coolest thing since the internet went flat screen and chat rooms turned into myspace..... 
					<br><br>
					Karma the Game of Destiny.
					<br><br>
					Here is you token number for 3 free lives that can last up to 30 days in the game.  The rules are simple, the adventure is real, and the reward, to truly meet your soulmates....  you\'re gonna think it\'s magic, but it just the most clever game ever devised for people to interact with each other within the cloud...
					<br><br>
					Token: '.$CopuonCode.'<br>
					Brand Ambassador\'s Code: '.$codee.'<br>
					Brand Ambassador\'s Name: '.$BA_Name.'<br>
					<br>
					We will send you updates and let you know when you can use your 3 life token.
					<br><br>
					<a href="http://www.rpaxis.net/karma/"><img src="http://www.rpaxis.net/karma/karma.jpg" border="0"></a>
					<br>the Game Guru
					</td>
				</tr>
			</table>';
			//echo $toemail."<br>";echo $subject1."<br>";echo $mailcontent1."<br>";echo $from1."<br>";exit;
			if($_SERVER['HTTP_HOST']!="abc")
			{
				$headers  = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
				$headers .= "From: Karma <$from1>" . "\r\n";	
				mail($toemail, $subject1, $mailcontent1, $headers);	
			}
			
			header("location:thank-you.php");
			//$message="Thanks for register with us!<br>We will get in touch with you shortly.";
		}
		else
		{
			$message="Token Already Issued to this Email.";
		}
	}
	else
	{
		$message="Brand Ambassador's code is invalid.";
	}
} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Karma - Game of Destiny</title>
<style type="text/css">
.style1 {
	color: #000000;
}
.searchinput{
	border:1px solid #c0c0c0;
	width:90%;
	height:25px;
	padding:0 5px;
	color:#000000;
}
.searchbtn{
	background:#60993B;border-radius:5px;color:#FFF;font-weight:bold;cursor:pointer;border:none;padding:5px 12px;width:100%;
}
.searchbtn2{
	background:#5D4C45;border-radius:5px;color:#FFF;font-weight:bold;cursor:pointer;border:none;padding:5px 12px;width:100%;
}
a.link { text-decoration:none;color:#60993B;} 
a.link:hover { text-decoration:none;color:#000000;} 
</style>
</head>
<body>
<form name="frmregister"  method="post" enctype="multipart/form-data"  onSubmit="return valid();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
	<table width="400" align="center" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #60993B;border-radius:5px;">
  <tr>
    <td height="50" align="center" valign="middle" ><h1 class="style1" style="color:#60993B">Get 3 free lives</h1></td>
  </tr>
  <tr>
    <td height="100%" align="center" class="style1" valign="middle">Enter your Brand Ambassador's Code<br />
		If you didn't get a code enter 0000<br /><br /></td>
  </tr>
  <tr>
    <td align="center" valign="middle" >
	<table  border="0" cellspacing="0" cellpadding="3"  width="350">
	  <tr>
		<td align="center" colspan="2" valign="top" style="color:#FF0000"><?=$message;?></td>
	  </tr>
	  <tr>
		<td align="left" valign="top">Code:&nbsp;</td>
		<td align="left" valign="top"><input type="text" name="codee" id="codee" value="<?=$_POST["codee"]?>" class="searchinput"  /></td>
	  </tr>
	  <tr>
		<td align="left" valign="top">Your Email Address:&nbsp;</td>
		<td align="left" valign="top"><input type="text" name="email" id="email" value="<?=$_POST["email"]?>" class="searchinput" /></td>
	  </tr>
	  <tr>
		<td align="left" valign="top">&nbsp;</td>
		<td align="left" valign="top"><input type="submit" class="searchbtn" value="SUBMIT"  /></td>
	  </tr>
	  
	  <tr>
		<td align="left" colspan="2" valign="top">&nbsp;</td>
	  </tr>
	</table>
	</td>
  </tr><input type="hidden" name="HidRegUser" id="HidRegUser" value="0" />
  
</table>
	</td>
  </tr>
  <tr>
		<td align="left" colspan="2" valign="top">&nbsp;</td>
	  </tr>
	  <tr>
	<td align="center" colspan="2" valign="top"><a href="register.php" class="link" ><strong>REGISTER TO BE A BRAND AMBASSADOR</strong></a><?php /*?><input type="button" class="searchbtn2" style="width:400px" value="REGISTER TO BE A BRAND AMBASSADOR" onclick="window.location.href='register.php';"  /><?php */?></td>
  </tr>
</table>


</form>
<script>
function valid()
{
	form=document.frmregister;
	if(form.codee.value=="")
	{
		alert("Please enter code.")
		form.codee.focus();
		return false;
	} 
	if(form.email.value=="")
	{
		alert("Please enter your email address.")
		form.email.focus();
		return false;
	}
	if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.email.value)))
	{
		alert("Please enter a proper email address.");
		form.email.focus();
		return false;
	}  
	document.frmregister.HidRegUser.value='1';
	document.frmregister.submit();
	return true;    
}
</script>
</body>
</html>
