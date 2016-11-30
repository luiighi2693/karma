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
				<br />
				  <tr>
					<td width="8%" align="left"><img src="images/safeWhiteFill.png" border="0"/></td>
					<td width="82%"><h1 style="text-align:left;">SAFE</h1></td>
					<td width="10%" align="right"><a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a></td>
				  </tr>
				 
				</table>
				 <br />
			</td>
			
		  </tr>
		  <tr>
			<td style="padding-top:20px;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
				  	<? if(mysql_real_escape_string($_REQUEST['id'])>0){?>
					<td width="38%" align="left" valign="top" >
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td colspan="2" align="left" valign="top" class="dashboard_whitetext" height="40"><h2><? echo $username;?></h2></td>
						  </tr>
						  <tr>
							<td align="left" valign="top" width="130">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td align="center" height="180" valign="middle" style="background-color:#FFFFFF;" ><img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt="" width="110"  /></td>
								  </tr>
								</table>
							</td>
							<td align="left" valign="top" style="padding-left:20px;">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td align="left"  valign="top" class="dashboard_whitetext" >HAS SHARED...</td>
								  </tr>
								  <?
								    //echo "SELECT * FROM users_sociallinks_share WHERE userid_from='".$_REQUEST['id']."' and userid_to='".mysql_real_escape_string($_SESSION['UsErIdFrOnT'])."'";
									$getusers_sociallinks_shareRs=mysql_query("SELECT * FROM users_sociallinks_share WHERE userid_from='".$_REQUEST['id']."' and userid_to='".mysql_real_escape_string($_SESSION['UsErIdFrOnT'])."'");
									$Totgetusers_sociallinks_share=mysql_affected_rows();
									if($Totgetusers_sociallinks_share>0)
									{
								  ?>
								  <tr>
									<td align="left"  height="50" valign="middle" class="dashboard_whitetext" >
									<?
										$uploaded='YES';
										$getusers_sociallinks_shareRow=mysql_fetch_array($getusers_sociallinks_shareRs);
										?>
										<? if($getusers_sociallinks_shareRow['social_fb_share']=='Y'){?><? $uploaded='YES';?><a href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_fb","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_facebook.png" border="0"  width="25"/></a>&nbsp;<? }?>
										<? if($getusers_sociallinks_shareRow['social_twitter_share']=='Y'){?><? $uploaded='YES';?><a href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_twitter","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_twitter.png" border="0" width="25"/></a>&nbsp;<? }?>
										<? if($getusers_sociallinks_shareRow['social_youtube_share']=='Y'){?><? $uploaded='YES';?><a href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_youtube","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_youtube.png" border="0" width="25"/></a>&nbsp;<? }?>
										<? if($getusers_sociallinks_shareRow['social_in_share']=='Y'){?><? $uploaded='YES';?><a href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_in","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_linkdin.png" border="0" width="25"/></a>&nbsp;<? }?>
										<? if($getusers_sociallinks_shareRow['social_pinterest_share']=='Y'){?><? $uploaded='YES';?><a href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_pinterest","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_pinterest.png" border="0" width="25"/></a>&nbsp;<? }?>
										<? if($getusers_sociallinks_shareRow['social_instagram_share']=='Y'){?><? $uploaded='YES';?><a href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_instagram","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_instagram.png" border="0" width="25"/></a>&nbsp;<? }?>
										<? if($getusers_sociallinks_shareRow['social_rss_share']=='Y'){?><? $uploaded='YES';?><a href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_rss","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_rss.png" border="0" width="25"/></a><? }?>
									</td>
								  </tr>
								  <? }?>
								  <?
								  $GetsharedPicRs=mysql_query("SELECT * FROM users_pics_videos_share WHERE  userid_from='".mysql_real_escape_string($_REQUEST['id'])."' and userid_to='".mysql_real_escape_string($_SESSION['UsErIdFrOnT'])."'");
								  $TotGetsharedPicRs=mysql_affected_rows();
								  if($TotGetsharedPicRs>0)
								  {
								  	  $sharedid='';
								  	  while($GetsharedPicRow=mysql_fetch_array($GetsharedPicRs))
									  {
									  	$sharedid.=$GetsharedPicRow['picid'].",";
									  }
									  $sharedid=substr($sharedid,0,-1);
									  $getPicsQryRs=mysql_query("SELECT * FROM users_pics_videos WHERE id in($sharedid) and type='Picture'  ORDER BY id DESC");
									  $TotgetPics=mysql_affected_rows();
									  $getPicsQryRs2=mysql_query("SELECT * FROM users_pics_videos WHERE id in($sharedid) and type='Video'  ORDER BY id DESC");
									  $TotgetPics2=mysql_affected_rows();
									  $getPicsQryRs3=mysql_query("SELECT * FROM users_pics_videos WHERE id in($sharedid) and type='Music'  ORDER BY id DESC");
									  $TotgetPics3=mysql_affected_rows();
									  ?>
									  <?php /*?><? if($uploaded=='YES' && ($TotgetPics>0)){?>
									  <tr>
										<td align="center"  valign="top" class="dashboard_whitetext" style="text-align:left" >AND</td>
									  </tr>
									  <? }?><?php */?>
									  <? if($TotgetPics>0)
									  {
											$getPicsQryRow=mysql_fetch_array($getPicsQryRs);
									  ?>
											  <tr>
												<td align="left"  valign="middle"  style="padding-top:5px;" ><? if($getPicsQryRow['type']=='Picture'){?><img id="MainImage" src="<? echo "SafePicsVideos/".$getPicsQryRow['picture']."";?>" width="150" height="100" /><? }?></td>
											  </tr>
											  <tr>
												<td align="left" valign="middle"  style="padding-top:5px;"><a href="#" onClick="openWinFullwidth('viewpics.php?userid_from=<? echo $_REQUEST['id'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Picture','usedadasr<?=rand();?>',1024,480,'yes','yes')"  class="dashboard_whitetext" style="font-size:10px;text-decoration:none;">CLICK TO ENLARGE AND SEE MORE</a></td>
											  </tr>
									  <? }?>
									  <? if($TotgetPics2>0)
									  {
											$getPicsQryRow2=mysql_fetch_array($getPicsQryRs2);
									  ?>
											  <tr>
												<td align="left"  valign="middle"  style="padding-top:15px;"><? if($getPicsQryRow2['type']=='Video'){?><img id="MainVideo" src="images/icon-player.png" /><? }?></td>
											  </tr>
											  <tr>
												<td align="left" valign="middle"  style="padding-top:5px;"><a href="#" onClick="openWinFullwidth('viewpics.php?userid_from=<? echo $_REQUEST['id'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Video','usedadasr<?=rand();?>',1024,480,'yes','yes')"  class="dashboard_whitetext" style="font-size:10px;text-decoration:none;">CLICK TO VIEW VIDEOS</a></td>
											  </tr>
									  <? }?>
									  <? if($TotgetPics3>0)
								  {
									  $getPicsQryRow3=mysql_fetch_array($getPicsQryRs3);
									  ?>
									  <tr>
										  <td align="left"  valign="middle"  style="padding-top:15px;"><? if($getPicsQryRow3['type']=='Music'){?><img id="MainMusic" src="images/icon_player.png" /><? }?></td>
									  </tr>
									  <tr>
										  <td align="left" valign="middle"  style="padding-top:5px;"><a href="#" onClick="openWinFullwidth('viewpics.php?userid_from=<? echo $_REQUEST['id'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Music','usedadasr<?=rand();?>',1024,480,'yes','yes')"  class="dashboard_whitetext" style="font-size:10px;text-decoration:none;">CLICK TO VIEW MUSIC</a></td>
									  </tr>
								  <? }?>
								<? }?>	 
								</table>
							</td>
						  </tr>
						</table>

						
					</td>
					<td width="2%" align="center" valign="top" class="rightborder_white" >&nbsp;
						
					</td>
					<? }?>
					<td  width="60%" align="left" valign="top"  class="dashboard_whitetext" style="padding-left:20px;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left"  valign="top" class="dashboard_whitetext" >WHAT WOULD YOU LIKE TO SHARE...</td>
						  </tr>
						  <tr>
							<td align="left"  height="50" valign="middle" class="dashboard_whitetext" >
							<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_facebook.png" border="0" /></a>&nbsp;
							<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_twitter.png" border="0" /></a>&nbsp;
							<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_youtube.png" border="0" /></a>&nbsp;
							<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_linkdin.png" border="0" /></a>&nbsp;
							<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_pinterest.png" border="0" /></a>&nbsp;
							<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_instagram.png" border="0" /></a>&nbsp;
							<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_rss.png" border="0" /></a>
							</td>
						  </tr>
						  <tr>
							  <td align="left"  height="50" valign="middle" class="dashboard_whitetext" >
								  <img src="images/pic_video.png" border="0" usemap="#Map" />
								  <img src="images/icon_player.png" href="#" onClick="openWinFullwidth('update_pictures_videos.php?TYPE=Music&userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"/>
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

<map name="Map" id="Map"><area shape="rect" coords="38,32,126,157" href="#" onClick="openWinFullwidth('update_pictures_videos.php?TYPE=Picture&userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"   /><area shape="rect" coords="148,30,237,158" href="#" onClick="openWinFullwidth('update_pictures_videos.php?TYPE=Video&userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"/></map></body>
</html>