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
				<? if($_REQUEST['iconcolor']=="white"){?><img src="images/icon_intro.png"  /><? }else{?><img src="images/icon_intro_black.png".png"  /><? } ?>
			</div>
			<div class="text_holder">
				intro
			</div>
			
				 
		</div>
					
	</div>	<!-- the header ends -->	
	
	<div class="middlesection">
		<div class="centered_info">
			<div class="text1"><strong><? echo $username;?></strong></div>
			<div class="avatar_pic">
				<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt=""/>
			</div>
			<div class="emoticon_list" >
				<?
				$EMM=0;
				$getEmotionsQryRs=mysql_query("SELECT * FROM emoticons ORDER BY id DESC");
				while($getEmotionsQryRow=mysql_fetch_array($getEmotionsQryRs))
				{
					?>
					<a href="#" onclick="document.getElementById('Hidintroduction').value=<? echo $getEmotionsQryRow['id'];?>;SelectEmotion('<? echo $getEmotionsQryRow['picture'];?>');return false;">
						<img  src="Emoticons/<? echo $getEmotionsQryRow['picture'];?>" style="border:1px solid #000000; width: 11%;height:18%;"/>
					</a>
					<?
					$EMM++;
				}
				?>
			</div>
			<div class="emoticon_pic" id="BigEmotionID"></div>
			<div id="MessageId" class="redtext"></div>
		</div>
		
	</div>	<!-- the middlesection ends -->
		

	<div class="footer">
		<div class="centered_info">
			<input type="hidden" id="Hidintroduction" name="Hidintroduction" value="" />
			<input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
			<input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
			<div class="button">
				<a href="#" onclick="hide_pop();return false;">
					<img src="images/button_close.png" border="0" />
				</a>
			</div>
			<div class="button">
				<input  type="image" name="sendbutton" id="sendbutton" src="images/button_send.png" onclick="return POPUPfrmcheck('introduction');" />
			</div>
		
		
		</div>
	</div>	
							

</form>
</body>
</html>