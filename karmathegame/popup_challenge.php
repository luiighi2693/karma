<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/opening_styles.css">
<title></title>
</script>
</head>
<body>
<div id="main_menu">
	<div style=" text-align:center;" >
	
	<table style="text-align:center;margin-left:auto;margin-right:auto;" width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tr>
		<td class="bottmborder_white">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			<td width="8%" align="left">
			<img src="images/icon_challenge.png" border="0">
			<br />
			</td>
			<td width="52%">
				<h1 style="text-align:left;">CHALLENGE</h1>
			</td>
			<td width="10%" align="right">
				<a href="#" onclick="hide_pop();return false;">
				<img src="images/popup_close.png" border="0">
			</td>
			</tr>
		</table>
		<br />
		</td>
		<br />
		
	</tr>
	</tbody>
	</table>	 
	</div>
	<? ini_set( "display_errors", 0); 
	   include("connect.php"); 
	   include("checklogin.php");
	   $avatarlogo=stripslashes(GetName1("avatars","picture","id",$CURRENTgetuserwryRow['avatarid']));?>
	   <div style="height:50%;">
	   	
	   	<img style="margin-top:4%;width: 26%;padding-left: 6%;float: left;" src="Avatars/<? echo $avatarlogo;?>"/>
	   	
	    <div style="float:right; width:34%; font-size: 24px">
	    find a few games where we can open a screen to both people after other person accepts
	    </div>
	 </div>   
</body>
</html>   	