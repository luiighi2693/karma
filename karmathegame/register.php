<? 
include("connect.php");
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
</style>
</head>

<body>


<form name="FrmReportErr"  method="post" enctype="multipart/form-data"  onSubmit="return RegisterValid();">
<table width="400" align="center" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #60993B;border-radius:5px;">
  <tr>
    <td height="30" align="center" valign="middle" ><h1 class="style1" style="color:#60993B;padding:0px;margin-top:8px;margin-bottom:8px;">Register to be a Brand Ambassador</h1></td>
  </tr>
  <tr>
    <td  align="center" valign="middle" style="border-top:1px solid #60993B;padding-top:8px;" ><strong style="color:#333333">Who Recruited you?    0000 if not applicable.</strong></td>
  </tr>
  <tr>
    <td  align="center" height="50" valign="middle" style="border-bottom:1px solid #60993B;padding-top:8px;color:#333333" >Brand Ambassador:
	<select name="recruitedby"  id="recruitedby">
		<option value="0000">0000</option>
		<?
		$selmarketerQryRs=mysql_query("SELECT code,firstname FROM marketers WHERE code!='' ORDER by firstname asc ");
		while($selmarketerQryRow=mysql_fetch_array($selmarketerQryRs))
		{
			?>
				<option value="<? echo $selmarketerQryRow['code'];?>"><? echo ucfirst(stripslashes($selmarketerQryRow['firstname']));?></option>
			<?
		}
		?>
	</select>
	</td>
  </tr>
  <tr>
    <td align="center" valign="middle" >
	<table  border="0" cellspacing="0" cellpadding="3" width="350">
	  <tr>
		<td align="left" colspan="2" valign="top" style="color:#FF0000"><span id="MsggRP" style="color:#FF0000;" ></span><?=$message;?></td>
	  </tr>
	  <tr>
		<td align="left" valign="top">Full Name:&nbsp;</td>
		<td align="left" valign="top"><input type="text" name="fullname" id="fullname" value="<?=$_POST["fullname"]?>" onBlur="GetYourCode(this.value);" onKeyUp="GetYourCode(this.value);" class="searchinput"  /></td>
	  </tr>
	  <tr>
		<td align="left" valign="top">Email Address:&nbsp;</td>
		<td align="left" valign="top"><input type="text" name="registeremail" id="registeremail" value="<?=$_POST["registeremail"]?>" class="searchinput" /></td>
	  </tr>
	  <tr>
		<td align="left" valign="top">Phone No.:&nbsp;</td>
		<td align="left" valign="top"><input type="text" name="phone" id="phone" value="<?=$_POST["phone"]?>" class="searchinput"  /></td>
	  </tr>
	  <tr>
		<td align="left" valign="top">Your Code:&nbsp;</td>
		<td align="left" valign="top"><input type="text" name="yourcode" id="yourcode" readonly="true" value="<?=$_POST["yourcode"]?>" class="searchinput"  /></td>
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
</form>
<script>
function RegisterValid()
{
	form=document.FrmReportErr;
	if(form.fullname.value=="")
	{
		alert("Please enter full name.")
		form.fullname.focus();
		return false;
	}
	if(form.registeremail.value=="")
	{
		alert("Please enter your email address.")
		form.registeremail.focus();
		return false;
	}
	if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(form.registeremail.value)))
	{
		alert("Please enter a proper email address.");
		form.registeremail.focus();
		return false;
	}
	ADDRegister();return false;	
}
function ADDRegister()
{
   fullname=document.getElementById("fullname").value;
   registeremail=document.getElementById("registeremail").value;
   phone=document.getElementById("phone").value;
   yourcode=document.getElementById("yourcode").value;
   recruitedby=document.getElementById("recruitedby").value;
   var http3_RP = false;
	if(navigator.appName == "Microsoft Internet Explorer") {
	  http3_RP = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
	  http3_RP = new XMLHttpRequest();
	}
	http3_RP.abort();
	http3_RP.open("GET","ajax_register.php?fullname="+fullname+"&registeremail="+registeremail+"&phone="+phone+"&yourcode="+yourcode+"&recruitedby="+recruitedby+"", true);
	http3_RP.onreadystatechange=function()
	{
	  if(http3_RP.readyState == 4)
	  {  
		  //window.location.href='thank-you.php'; return false;
		  document.getElementById("MsggRP").innerHTML=http3_RP.responseText;
		  return false;
	  } 
	}
	http3_RP.send(null);
}
function GetYourCode(valll)
{
	fullname=document.getElementById("fullname").value;
	if(fullname=="")
	{
		document.getElementById("yourcode").value="";
	}
	else
	{
		var http3_YC = false;
		if(navigator.appName == "Microsoft Internet Explorer") {
		  http3_YC = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
		  http3_YC = new XMLHttpRequest();
		}
		http3_YC.abort();
		http3_YC.open("GET","ajax_code.php?fullname="+fullname+"", true);
		http3_YC.onreadystatechange=function()
		{
		  if(http3_YC.readyState == 4)
		  {  
			  document.getElementById("yourcode").value=http3_YC.responseText;
			  return false;
		  } 
		}
		http3_YC.send(null);
	}
}
</script>
</body>
</html>
