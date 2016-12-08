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
				<img src="images/icon_star.png" border="0"></img>
			</div>
			<div class="text_holder">
				stars
			</div>
			<div class="icon_holder"style="float:right;">
				<a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a>
			</div>
				 
		</div>
					
	</div>	<!-- the header ends -->
	<div class="middlesection">
		<div class="centered_info">
			<div class="avatar_pic" style="float:right;">
				<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt=""/>
			</div>
			<div class="avatar_pic">
				<? if($CURRENTgetuserwryRow['avatarid']!='') { $avatarlogo=stripslashes(GetName1("avatars","picture","id",$CURRENTgetuserwryRow['avatarid']));?>
					<img src="Avatars/<? echo $avatarlogo;?>"/>
				<? }?>
			</div>
			<div class="container" style="width:58%;margin-right:1%;">
				<div style="text-align:center;font-size:4vh;">HERE IS YOUR COMPATIBILITY READING</div>
				<div align="center"><iframe id="holamundo" src="stars_reading.php?id=<? echo $_REQUEST['id'];?>&from=<? echo $_SESSION['UsErIdFrOnT'];?>&to=<? echo mysql_real_escape_string($_REQUEST['id']);?>" width="100%" height="80%"  scrolling="yes"  frameborder="0"></iframe>
				</div>
				<div style="float: right;width:58%;    margin-top: 1%;">
					<a href="https://cafeastrology.com/" target="_blank" ><img src="images/cafeastrology.png" alt=""  style="width: 100%;"></a>
				</div>
			
				<div id="MessageId" class="redtext"></div>

			</div>
			
		</div>
	</div>
	
	<div class="footer">
		<div class="centered_info">
			
			<input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
			<input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
			<div class="button">
				<a href="#" onclick="hide_pop();return false;">
					<img src="images/button_close.png" border="0" />
				</a>
			</div>
			<div class="button">
				<input  type="image" name="sendbutton" id="sendbutton" src="images/button_send.png" onclick="return POPUPfrmcheck('hidepop');" />
			</div>
		
		
		</div>
	</div>	

</form>
</body>
</html>