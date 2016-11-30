<?php
include_once("admin.config.inc.php");
include("admin.cookie.php");
include("connect.php"); 
$mlevel=3;
$id=$_GET["id"];
$seli="select * from adminuser where id='$id'";
$runi=mysql_query($seli);
$geti=mysql_fetch_object($runi);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<title> <?php echo $ADMIN_MAIN_SITE_NAME ?></title>
<head>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<link href="demo.css" type=text/css rel=stylesheet>
<link rel="stylesheet" href="main.css" type="text/css">
</head>
<body bgColor=#ffffff leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">
<script language=javascript src="body.js"></script>
<script language="javascript" type="text/javascript">
function MM_openBrWindow(theURL,winName,features)
{ 
  	window.open(theURL,winName,features);
}
</script>
<TABLE cellSpacing=10 cellPadding=0  border=0 width="98%" align="center">
	<TBODY>
		<tr>
		  <td width="100%" class="form_back" height="20">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="left"><span class="form111">Salesmen/Staff Details</span></td>
				<td align="right"><a href="#" onClick="javascript:window.close();">Close</a></td>
			  </tr>
			</table>
		 </td>
		</tr>
		<TR>
			<TD>			  
				<FORM name="form2" action="#" method="post" enctype="multipart/form-data">        
					<TABLE width="100%" border=0 cellSpacing=0 cellpadding="0" class="t-b">
						<tr>
						  <td width="22%" height="25" align="left" class="black12"><strong>Salesmen/Staff:</strong></td>
						  <td width="78%"><?=stripslashes($geti->usertype);?>&nbsp;</td>
						</tr>
						<tr>
						  <td width="22%" height="25" align="left" class="black12"><strong>User Name:</strong></td>
						  <td width="78%"><?=stripslashes($geti->username);?>&nbsp;</td>
						</tr>
						<tr>
						  <td width="22%" height="25" align="left" class="black12"><strong>Password:</strong></td>
						  <td width="78%"><?=stripslashes($geti->password);?>&nbsp;</td>
						</tr>
						<tr>
						  <td width="22%" height="25" align="left" class="black12"><strong>First Name:</strong></td>
						  <td width="78%"><?=stripslashes($geti->firstname);?>&nbsp;</td>
						</tr>
						 <tr>
						  <td width="22%" height="25" align="left" class="black12"><strong>Last Name:</strong></td>
						  <td width="78%"><?=stripslashes($geti->lastname);?>&nbsp;</td>
						</tr>
						<tr>
						  <td width="22%" height="25" align="left" class="black12"><strong>Address:</strong></td>
						  <td width="78%"><?=stripslashes($geti->address);?>&nbsp;</td>
						</tr>
						<tr>
						  <td width="22%" height="25" align="left" class="black12"><strong>Phone:</strong></td>
						  <td width="78%"><?=stripslashes($geti->phone);?>&nbsp;</td>
						</tr>
						<tr>
						  <td width="22%" height="25" align="left" class="black12"><strong>Email:</strong></td>
						  <td width="78%"><a href="mailto:<?=stripslashes($geti->email);?>"><?=stripslashes($geti->email);?></a>&nbsp;</td>
						</tr>
						<tr>
						  <td width="22%" height="25" align="left" class="black12"><strong>URL:</strong></td>
						  <td width="78%"><?=SALESFOLDERLOCATION;?>/<?=stripslashes($geti->url);?>&nbsp;</td>
						</tr>
					</TABLE>
				</FORM></TD>
		</TR>		
	</TBODY>
</TABLE>
</body>
</HTML>