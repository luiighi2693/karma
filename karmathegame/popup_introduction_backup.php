<? include("connect.php");
include("checklogin.php");
$GetUsersQry="SELECT * FROM users WHERE active='Y' and id='".mysql_real_escape_string($_REQUEST['id'])."' ORDER BY id DESC";
$GetUsersQryRs=mysql_query($GetUsersQry);
$GetUsersQryRow=mysql_fetch_array($GetUsersQryRs);
if($GetUsersQryRow['username']!=''){$username=stripslashes($GetUsersQryRow['username']);}else{$username=stripslashes($GetUsersQryRow['couponcode']);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/style.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
</head>
<body style="text-align:center;">
<form name="frmpopup" id="frmpopup" enctype="multipart/form-data" method="post">
<table width="95%" style="text-align:center;margin-left:auto;margin-right:auto;" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<table width="100%" align="center" border="0" cellspacing="3" cellpadding="3">
		  <tr>
			<td class="bottmborder_white">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="8%" align="left"><img src="images/icon1.jpg" border="0"/></td>
					<td width="82%"><h1 style="text-align:left;">INTRODUCTION</h1></td>
					<td width="10%" align="right"><a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a></td>
				  </tr>
				</table>
			</td>
		  </tr>
		  <tr>
			<td style="padding-top:20px;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="170" align="left" valign="top" style="background-color:#FFFFFF;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="center" height="250" valign="middle"><img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt="" width="150"  /></td>
						  </tr>
						</table>
					</td>
					<td   align="left" valign="top" style="padding-left:60px;padding-top:30px;" class="dashboard_whitetext">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left">
								<table border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td align="left" class="dashboard_whitetext"><h2><? echo $username;?></h2></td>
									<td align="left" style="padding-left:50px;"><img src="images/icon17.jpg" align="absmiddle" /> <img src="images/icon18.jpg" align="absmiddle"/> <img src="images/icon19.jpg" align="absmiddle"/></td>
								  </tr>
								</table>
							</td>
						  </tr>
						  <tr>
								<td>
									<table border="0" cellspacing="0" cellpadding="0">
								  	  <?
										$GetIntroductionQry="SELECT * FROM introduction_options  ORDER BY id ASC";
										$GetIntroductionQryRs=mysql_query($GetIntroductionQry);
										while($GetIntroductionQryRow=mysql_fetch_array($GetIntroductionQryRs))
										{
										?>
										<tr>
										  <td width="25" height="40"><input onclick="document.getElementById('Hidintroduction').value=<? echo $GetIntroductionQryRow['id'];?>" type="radio" name="introduction" id="introduction_<? echo $GetIntroductionQryRow['id'];?>" value="<? echo $GetIntroductionQryRow['id'];?>" /></td>
										  <td  class="dashboard_whitetext"><label for="introduction_<? echo $GetIntroductionQryRow['id'];?>"><h3><? echo $GetIntroductionQryRow['name'];?></h3></label></td>
										</tr>   
									  <? }?>
									</table>
						  	</td>
						 </tr>
						 <tr>
							<td align="left" style="padding-top:10px;">
							<input type="hidden" id="Hidintroduction" name="Hidintroduction" value="" />
							<input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
							<input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
							<input type="image" name="sendbutton" id="sendbutton" src="images/send-button.png" onclick="return POPUPfrmcheck('introduction');" /> <a href="#" onclick="hide_pop();return false;"><img src="images/close-button.png" border="0" /></a>
							<span id="MessageId" style="color:#FF0000;"></span>
							</td>
						 </tr>
						</table>
					</td>
				  </tr>
				</table>
			</td>
		  </tr>
		</table>
	</td>
  </tr>
</table>
</form>
</body>
</html>