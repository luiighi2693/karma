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
	<link href="css/style_popups.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
</head>
<body style="text-align:center;">
<form name="frmpopup" id="frmpopup" enctype="multipart/form-data" method="post" style="font-size: 0vh;">
	<div class="header">
		<div class="top_info">
			<div class="icon_holder">
				<img src="images/safeWhiteFill.png" border="0"></img>
			</div>
			<div class="text_holder">
				SAFE
			</div>
			<div class="icon_holder"style="float:right;">
				<a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a>
			</div>
		</div>
	</div>	<!-- the header ends -->

	<div class="middlesection">
		<div class="centered_info">
			<div class="text1"><strong><? echo $username;?></strong></div>
			<div style="width: 20%; height:71%;display:inline-block;float:left;">
				<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt="" style="width: 100%;"/>
			</div>
			<div style="width: 20%; height:100%;display:inline-block;float:left;overflow: auto;">
				<div class="text1" style="padding-left: 2%;padding-bottom: 10%;"><strong>HAS SHARED...</strong></div>
				<?
				$getusers_sociallinks_shareRs=mysql_query("SELECT * FROM users_sociallinks_share WHERE userid_from='".$_REQUEST['id']."' and userid_to='".mysql_real_escape_string($_SESSION['UsErIdFrOnT'])."'");
				$Totgetusers_sociallinks_share=mysql_affected_rows();
				if($Totgetusers_sociallinks_share>0)
				{
					?>
					<?
					$uploaded='YES';
					$getusers_sociallinks_shareRow=mysql_fetch_array($getusers_sociallinks_shareRs);
					?>
					<? if($getusers_sociallinks_shareRow['social_fb_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_fb","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_facebook.png" border="0"  width="25"/></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_twitter_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_twitter","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_twitter.png" border="0" width="25"/></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_youtube_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_youtube","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_youtube.png" border="0" width="25"/></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_in_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_in","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_linkdin.png" border="0" width="25"/></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_pinterest_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_pinterest","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_pinterest.png" border="0" width="25"/></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_instagram_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_instagram","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_instagram.png" border="0" width="25"/></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_rss_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_rss","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_rss.png" border="0" width="25"/></a><? }?>
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
					<? if($TotgetPics>0){
					$getPicsQryRow=mysql_fetch_array($getPicsQryRs);
					?>

					<? if($getPicsQryRow['type']=='Picture'){?><img style="padding-bottom: 5%;padding-left: 2%;" id="MainImage" src="<? echo "SafePicsVideos/".$getPicsQryRow['picture']."";?>" width="100%" height="100" /><? }?>
					<a href="#" onClick="openWinFullwidth('viewpics.php?userid_from=<? echo $_REQUEST['id'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Picture','usedadasr<?=rand();?>',1024,480,'yes','yes')"  class="dashboard_whitetext" style="font-size:10px;text-decoration:none;float: left; padding-left: 2%;">CLICK TO ENLARGE AND SEE MORE</a>
				<? }?>
					<? if($TotgetPics2>0){
					$getPicsQryRow2=mysql_fetch_array($getPicsQryRs2);
					?>
					<? if($getPicsQryRow2['type']=='Video'){?><img style="padding-bottom: 5%;padding-left: 2%; padding-top: 5%;" id="MainVideo" src="images/shareVideo.png" width="100%" height="100" /><? }?>
					<a href="#" onClick="openWinFullwidth('viewpics.php?userid_from=<? echo $_REQUEST['id'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Video','usedadasr<?=rand();?>',1024,480,'yes','yes')"  class="dashboard_whitetext" style="font-size:10px;text-decoration:none;float: left; padding-left: 2%;">CLICK TO VIEW VIDEOS</a>
				<? }?>
					<? if($TotgetPics3>0){
					$getPicsQryRow3=mysql_fetch_array($getPicsQryRs3);
					?>
					<? if($getPicsQryRow3['type']=='Music'){?><img style="padding-bottom: 5%;padding-left: 2%; padding-top: 5%;" id="MainMusic" src="images/shareMusic.png" width="100%" height="100"/><? }?><a href="#" onClick="openWinFullwidth('viewpics.php?userid_from=<? echo $_REQUEST['id'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Music','usedadasr<?=rand();?>',1024,480,'yes','yes')"  class="dashboard_whitetext" style="font-size:10px;text-decoration:none;float: left; padding-left: 2%;">CLICK TO VIEW MUSIC</a>
				<? }?>
				<? }?>
			</div>
			<div style="display:inline-block;height:80%;width:55%;margin-left:4%;" >
					<div style="width: 100%;">
						<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_facebook.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_twitter.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_youtube.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_linkdin.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_pinterest.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_instagram.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openWin2('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"  ><img src="images/icon_rss.png" border="0" /></a>
					</div>
					<div style="width: 100%;">
						<img src="images/sharePicture.png" href="#" width="33%" onClick="openWinFullwidth('update_pictures_videos.php?TYPE=Picture&userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"/>
						<img src="images/shareVideo.png" href="#" width="33%" onClick="openWinFullwidth('update_pictures_videos.php?TYPE=Video&userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"/>
						<img src="images/shareMusic.png" href="#" width="33%" onClick="openWinFullwidth('update_pictures_videos.php?TYPE=Music&userid_to=<? echo $_REQUEST['id'];?>','usedadasr<?=rand();?>',700,480,'yes','yes')"/>
					</div>
			</div>
		</div>
	</div>

	<div class="footer"></div>
</form>
</html>