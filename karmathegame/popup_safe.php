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
<form name="frmpopup" id="frmpopup" enctype="multipart/form-data" method="post">
	<div class="header">
		<div class="top_info">
			<div class="icon_holder">
				
				<? if($_REQUEST['iconcolor']=="white"){?><img src="images/icon_safe.png" /><? }else{?><img src="images/icon_safe_black.png"  /><? } ?>
			</div>
			<div class="text_holder">
				safe
			</div>
			
		</div>
	</div>	<!-- the header ends -->

	<div class="middlesection">
		<div class="centered_info">
			<div class="text1"><strong><? echo $username;?></strong></div>
			<div style="width: 20%; height:71%;display:inline-block;float:left;">
				<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt="" style="width: 100%;"/>
			</div>
			<div style="width: 20%; height:100%;display:inline-block;float:left;overflow: auto;padding-left:1%;">
				<div class="text1" style="padding-left: 2%;padding-bottom: 10%;font-size:1.5vw;"><strong>HAS SHARED...</strong></div>
				<div class="row" style="height:7%;margin-top:0%;">
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
					<? if($getusers_sociallinks_shareRow['social_fb_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;height:100%;width:12%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_fb","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_facebook.png" border="0"  width="100%" height="100%;"/></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_twitter_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;height:100%;width:12%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_twitter","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_twitter.png" border="0"width="100%" height="100%;" /></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_youtube_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;height:100%;width:12%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_youtube","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_youtube.png" width="100%" height="100%;" border="0" /></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_in_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;height:100%;width:12%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_in","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_linkdin.png"width="100%" height="100%;" border="0" /></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_pinterest_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;height:100%;width:12%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_pinterest","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_pinterest.png" width="100%" height="100%;" border="0" /></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_instagram_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;height:100%;width:12%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_instagram","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_instagram.png" width="100%" height="100%;" border="0" /></a>&nbsp;<? }?>
					<? if($getusers_sociallinks_shareRow['social_rss_share']=='Y'){?><? $uploaded='YES';?><a style="float:left; padding-left: 2%;height:100%;width:12%;" href="<? echo WebsiteWithProperUrl(stripslashes(GetName1("users","social_rss","id",$_REQUEST['id'])));?>" target="_blank" ><img src="images/icon_rss.png" border="0" width="100%" height="100%;" /></a><? }?>
				<? }?>
				</div>
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
					
					<div class="row" style="height:20%;margin-top:0%;">
					<? if($getPicsQryRow['type']=='Picture'){?><img onClick="openInNewTab('viewpics.php?userid_from=<? echo $_REQUEST['id'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Picture&color1=<? echo $_REQUEST['color1']?>')"  style="padding-left: 2%;" id="MainImage" src="<? echo "SafePicsVideos/".$getPicsQryRow['picture']."";?>" width="70%" height="100%" /><? }?>
					</div>
					<div class="row" style="height:5%;margin-top:0.5%;">
					<a href="#" onClick="openInNewTab('viewpics.php?userid_from=<? echo $_REQUEST['id'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Picture&color1=<? echo $_REQUEST['color1']?>')"  class="dashboard_whitetext" style="font-size:0.6vw;text-decoration:none;float: left; padding-left: 2%;">CLICK TO ENLARGE AND SEE MORE</a>
					</div>
				<? }?>
					<? if($TotgetPics2>0){
					$getPicsQryRow2=mysql_fetch_array($getPicsQryRs2);
					?>
					<? if($getPicsQryRow2['type']=='Video'){?>
					<div class="row" style="height:15%;margin-top:1%;">
					<img  onClick="openInNewTab('videoprev.php?userid_from=<? echo $_REQUEST['id'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Video&color1=<? echo $_REQUEST['color1']?>')" style="padding-left: 2%;float:left;width:30%;height:100%; " id="MainVideo" src="images/shareVideo.png"  /></div>
						<div class="row" style="height:5%;margin-top:0.5%;">
					<a href="#" onClick="openInNewTab('videoprev.php?userid_from=<? echo $_REQUEST['id'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Video&color1=<? echo $_REQUEST['color1']?>')"  class="dashboard_whitetext" style="font-size:0.6vw;text-decoration:none;float: left; padding-left: 2%;">CLICK TO VIEW VIDEOS</a>
					</div>
					<? }?>
					
				<? }?>
					<? if($TotgetPics3>0){
					$getPicsQryRow3=mysql_fetch_array($getPicsQryRs3);
					?>
					<? if($getPicsQryRow3['type']=='Music'){?><div class="row" style="height:15%;margin-top:1%;">
					<img style="padding-left: 2%;float:left;width:30%;height:100%;" id="MainMusic" src="images/shareMusic.png" /></div>
					<div class="row" style="height:5%;margin-top:0.5%;"><a href="#" onClick="openInNewTab('musicprev.php?userid_from=<? echo $_REQUEST['id'];?>&color1=<? echo $_REQUEST['color1'];?>&userid_to=<? echo mysql_real_escape_string($_SESSION['UsErIdFrOnT']);?>&type=Music')"  class="dashboard_whitetext" style="font-size:0.6vw;text-decoration:none;float: left; padding-left: 2%;">CLICK TO VIEW MUSIC</a></div>	
					<? }?>
				
				<? }?>
				<? }?>
			</div>
			<div style="display:inline-block;height:80%;width:55%;padding-left:4%;" >
					<div style="width: 100%;">
						<a href="#" onClick="openInNewTab('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>&color1=<? echo $_REQUEST['color1']?>')"  ><img src="images/icon_facebook.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openInNewTab('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>&color1=<? echo $_REQUEST['color1']?>')"  ><img src="images/icon_twitter.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openInNewTab('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>&color1=<? echo $_REQUEST['color1']?>')"  ><img src="images/icon_youtube.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openInNewTab('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>&color1=<? echo $_REQUEST['color1']?>')"  ><img src="images/icon_linkdin.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openInNewTab('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>&color1=<? echo $_REQUEST['color1']?>')"  ><img src="images/icon_pinterest.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openInNewTab('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>&color1=<? echo $_REQUEST['color1']?>')"  ><img src="images/icon_instagram.png" border="0" /></a>&nbsp;
						<a href="#" onClick="openInNewTab('update_sociallinks.php?userid_to=<? echo $_REQUEST['id'];?>&color1=<? echo $_REQUEST['color1']?>')"  ><img src="images/icon_rss.png" border="0" /></a>
					</div>
					<div style="width: 100%;">
					<img src="images/shareMusic.png" href="#" style="width:32%;height:60%;float:left;"  onClick="openInNewTab('update_pictures_videos.php?TYPE=Music&color1=<? echo $_REQUEST['color1']?>&userid_to=<? echo $_REQUEST['id'];?>')"/>
					<img src="images/shareVideo.png" href="#" style="width:32%;height:60%;float:left;"  onClick="openInNewTab('update_pictures_videos.php?TYPE=Video&color1=<? echo $_REQUEST['color1']?>&userid_to=<? echo $_REQUEST['id'];?>')"/>
						<img src="images/sharePicture.png" href="#" style="width:32%;height:60%;float:left;" onClick="openInNewTab('update_pictures_videos.php?TYPE=Picture&color1=<? echo $_REQUEST['color1']?>&userid_to=<? echo $_REQUEST['id'];?>')"/>
						
						
					</div>
			</div>
		</div>
	</div>

	<div class="footer"  >
	<div class="centered_info">
		<div class="button">
			<a href="#" onclick="hide_pop();return false;">
				<img src="images/button_close.png" border="0" />
			</a>
		</div>
	</div>
	
	</div>
</form>
</html>