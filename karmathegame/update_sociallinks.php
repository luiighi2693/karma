<? include("connect.php");
include("checklogin.php");
$GetUsersQry="SELECT * FROM users WHERE active='Y' and id='".mysql_real_escape_string($_REQUEST['userid_to'])."' ORDER BY id DESC";
$GetUsersQryRs=mysql_query($GetUsersQry);
$GetUsersQryRow=mysql_fetch_array($GetUsersQryRs);
if($GetUsersQryRow['username']!=''){$username=stripslashes($GetUsersQryRow['username']);}else{$username=stripslashes($GetUsersQryRow['couponcode']);}
if($_POST['Hidsubmit']=='1')
{
	$InsertUserQry="UPDATE users set 
	social_fb='".addslashes($_POST['social_fb'])."',
	social_twitter='".addslashes($_POST['social_twitter'])."',
	social_youtube='".addslashes($_POST['social_youtube'])."',
	social_in='".addslashes($_POST['social_in'])."',
	social_pinterest='".addslashes($_POST['social_pinterest'])."',
	social_instagram='".addslashes($_POST['social_instagram'])."',
	social_rss='".addslashes($_POST['social_rss'])."' WHERE id='".$_SESSION['UsErIdFrOnT']."'";
	mysql_query($InsertUserQry);
	
	if(mysql_real_escape_string($_REQUEST['userid_to'])!='')
	{
		if($_POST['social_fb_share']==''){$social_fb_share='N';}else{$social_fb_share='Y';}
		if($_POST['social_twitter_share']==''){$social_twitter_share='N';}else{$social_twitter_share='Y';}
		if($_POST['social_youtube_share']==''){$social_youtube_share='N';}else{$social_youtube_share='Y';}
		if($_POST['social_in_share']==''){$social_in_share='N';}else{$social_in_share='Y';}
		if($_POST['social_pinterest_share']==''){$social_pinterest_share='N';}else{$social_pinterest_share='Y';}
		if($_POST['social_instagram_share']==''){$social_instagram_share='N';}else{$social_instagram_share='Y';}
		if($_POST['social_rss_share']==''){$social_rss_share='N';}else{$social_rss_share='Y';}
		
		$getusers_sociallinks_shareRs=mysql_query("SELECT * FROM users_sociallinks_share WHERE userid_from='".$_SESSION['UsErIdFrOnT']."' and userid_to='".mysql_real_escape_string($_REQUEST['userid_to'])."'");
		$Totgetusers_sociallinks_share=mysql_affected_rows();
		if($Totgetusers_sociallinks_share>0)
		{
			$InsertUserQry="UPDATE users_sociallinks_share set 
			social_fb_share='".addslashes($social_fb_share)."',
			social_twitter_share='".addslashes($social_twitter_share)."',
			social_youtube_share='".addslashes($social_youtube_share)."',
			social_in_share='".addslashes($social_in_share)."',
			social_pinterest_share='".addslashes($social_pinterest_share)."',
			social_instagram_share='".addslashes($social_instagram_share)."',
			social_rss_share='".addslashes($social_rss_share)."' 
			WHERE userid_from='".$_SESSION['UsErIdFrOnT']."' and userid_to='".mysql_real_escape_string($_REQUEST['userid_to'])."' ";
			mysql_query($InsertUserQry);
		}
		else
		{
			$InsertUserQry="INSERT INTO users_sociallinks_share set 
			social_fb_share='".addslashes($social_fb_share)."',
			social_twitter_share='".addslashes($social_twitter_share)."',
			social_youtube_share='".addslashes($social_youtube_share)."',
			social_in_share='".addslashes($social_in_share)."',
			social_pinterest_share='".addslashes($social_pinterest_share)."',
			social_instagram_share='".addslashes($social_instagram_share)."',
			social_rss_share='".addslashes($social_rss_share)."' ,
			userid_from='".$_SESSION['UsErIdFrOnT']."',
			userid_to='".mysql_real_escape_string($_REQUEST['userid_to'])."'";
			mysql_query($InsertUserQry);
		}

		$query = mysql_query("SELECT * FROM users_sociallinks_share WHERE userid_from='".$_SESSION['UsErIdFrOnT']."' and userid_to='".mysql_real_escape_string($_REQUEST['userid_to'])."' ");
		$queryArray = mysql_fetch_array($query);

		$queryMail = mysql_query("INSERT INTO users_emails SET userid_from=".$_SESSION['UsErIdFrOnT'].", userid_to=".$_REQUEST['userid_to'].", TYPE='socialLinks', TYPE_TABLE='users_sociallinks_share', TYPE_TABLE_ID='".$queryArray['id']."', accepted='N', rejected='N', createdate='".date("Y-m-d H:i:s")."', ipaddress='".get_client_ip()."', viewed='N'");
	}
	header("location:update_sociallinks.php?msg=yes&userid_to=".$_REQUEST['userid_to']."");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><? echo $SITE_TITLE;?></title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body style="text-align:center;">
<div class="dashboardpopup" style="width:98%;height:98%;" >
	<div id="pad_wrapper_newlife">
		<div id="pad_newlife" style="border:0px solid gray;	border-radius:0px;max-width:100%;">
			<div id="rightsidePOPUP" style="color:#FFFFFF">
				
				<table width="95%" style="text-align:center;margin-left:auto;margin-right:auto;" align="center" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<table width="100%" align="center" border="0" cellspacing="3" cellpadding="3">
								<tr>
									<td class="bottmborder_white">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="8%" align="left"><img src="images/icon5.jpg" border="0"/></td>
												<td width="82%"><h1 style="text-align:left;">SAFE</h1></td>
												<td width="10%" align="right"><a href="#" onclick="window.close();return false;"><img src="images/popup_close.png" border="0" /></a></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td style="padding-top:20px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<? if($_REQUEST['msg']=='yes'){?>
												<tr>
													<td align="left"  valign="top" style="color:#FF0000">Updated Sucessfully!</td>
												</tr>
											<? }?>
											<tr>
										
												<td  align="left" valign="top"  class="dashboard_whitetext">
													<form name="frmsocial" id="frmsocial" enctype="multipart/form-data" method="post">
														<table width="100%" border="0" cellspacing="2" cellpadding="2">
															<tr>
																<td align="left"  valign="top"  width="10%">
																	<table width="100%" border="0" cellspacing="0" cellpadding="0">
																		<tr>
																			<td align="left"  height="35" valign="top" class="dashboard_whitetext" >SHARE</td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle" height="32"><input type="checkbox" name="social_fb_share" id="social_fb_share" value="Y" <? echo CheckEitherSharedOrNot('social_fb_share',$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?>  /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle" height="32"><input type="checkbox" name="social_twitter_share" id="social_twitter_share" value="Y"   <? echo CheckEitherSharedOrNot('social_twitter_share',$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?>   /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle" height="32"><input type="checkbox" name="social_youtube_share" id="social_youtube_share" value="Y"    <? echo CheckEitherSharedOrNot('social_youtube_share',$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?>  /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle" height="32"><input type="checkbox" name="social_in_share" id="social_in_share" value="Y"    <? echo CheckEitherSharedOrNot('social_in_share',$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?>  /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle" height="32"><input type="checkbox" name="social_pinterest_share" id="social_pinterest_share" value="Y"   <? echo CheckEitherSharedOrNot('social_pinterest_share',$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?>   /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle" height="32"><input type="checkbox" name="social_instagram_share" id="social_instagram_share" value="Y"    <? echo CheckEitherSharedOrNot('social_instagram_share',$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?>  /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle" height="32"><input type="checkbox" name="social_rss_share" id="social_rss_share" value="Y"  <? echo CheckEitherSharedOrNot('social_rss_share',$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?>    /></td>
																		</tr>
																	</table>
																</td>
																<td align="left"  valign="top" width="90%" >
																	<table width="100%" border="0" cellspacing="0" cellpadding="0">
																		<tr>
																			<td align="left"  height="35" valign="top" class="dashboard_whitetext" >UPDATE YOUR SOCIAL LINKS</td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle"><img src="images/icon_facebook.png" align="absmiddle" />&nbsp;<input type="text" name="social_fb" id="social_fb" value="<? echo stripslashes($CURRENTgetuserwryRow['social_fb']);?>" class="inputbox" style="width:90%;" /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle"><img src="images/icon_twitter.png" align="absmiddle" />&nbsp;<input type="text" name="social_twitter" id="social_twitter" value="<? echo stripslashes($CURRENTgetuserwryRow['social_twitter']);?>"  class="inputbox" style="width:90%;" /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle"><img src="images/icon_youtube.png" align="absmiddle" />&nbsp;<input type="text" name="social_youtube" id="social_youtube" value="<? echo stripslashes($CURRENTgetuserwryRow['social_youtube']);?>"  class="inputbox" style="width:90%;" /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle"><img src="images/icon_linkdin.png" align="absmiddle" />&nbsp;<input type="text" name="social_in" id="social_in" value="<? echo stripslashes($CURRENTgetuserwryRow['social_in']);?>"  class="inputbox" style="width:90%;" /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle"><img src="images/icon_pinterest.png" align="absmiddle" />&nbsp;<input type="text" name="social_pinterest" id="social_pinterest" value="<? echo stripslashes($CURRENTgetuserwryRow['social_pinterest']);?>"  class="inputbox" style="width:90%;" /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle"><img src="images/icon_instagram.png" align="absmiddle" />&nbsp;<input type="text" name="social_instagram" id="social_instagram" value="<? echo stripslashes($CURRENTgetuserwryRow['social_instagram']);?>"  class="inputbox" style="width:90%;" /></td>
																		</tr>
																		<tr>
																			<td align="left"  valign="middle"><img src="images/icon_rss.png" align="absmiddle" />&nbsp;<input type="text" name="social_rss" id="social_rss" value="<? echo stripslashes($CURRENTgetuserwryRow['social_rss']);?>"  class="inputbox" style="width:90%;" /></td>
																		</tr>
																	</table>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="left"  valign="middle" height="50">
																	<input type="hidden" name="Hidsubmit" id="Hidsubmit" value="0" />
																	<input type="image" name="sendbutton" id="sendbutton"  src="images/send-button.png" align="top" onclick="updateAndShareLinks();" /></td>
															</tr>
														</table>
													</form>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>	
</div>
<script>
	function updateAndShareLinks() {
		alert("shared succefully");
		document.getElementById('Hidsubmit').value = '1';
	}
</script>
</body>
</html>