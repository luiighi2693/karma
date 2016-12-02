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
				<img src="images/icon_hide.png" border="0"></img>
			</div>
			<div class="text_holder">
				hide
			</div>
			<div class="icon_holder"style="float:right;">
				<a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a>
			</div>
			
		</div>
					
	</div>	<!-- the header ends -->
	<div class="middlesection">
		<div class="centered_info" >
			<div class="text1"><strong><? echo $username;?></strong></div>
			<div class="avatar_pic">
				<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt=""/>
			</div>
			<div class="container2">
				<h1 style="text-align:left;"><input type="radio" name="neverwann" id="neverwann"  value="Y"/> <label for="neverwann" style="font-size:70%;">Click here if you never want to see this Player again</label></h1>
			<div align="left" class="whitetext" style="padding-top:10PX;">DOING THIS DOES NOT HARM THE OTHER PLAYER OR YOURSELF. IT HELPS YOU TO LOWER YOUR NUMBER AND GET CLOSER TO YOUR SOULMATES.</div>
			
			<div colspan="2" align="left" class="whitetext" style="padding-top:10PX;">TO TEMPORARILY HIDE YOURSELF FROM THE ENTIRE GAME CLICK THE BUTTONS BELOW. THIS DOES NOT PAUSE THE GAME.</div>
			
			<div><h1 style="text-align:left;"><input type="radio" name="hideme" id="hideme1"  <? if(GetName1("users","hideme","id",$_SESSION['UsErIdFrOnT'])=='Y'){?>checked<? } ?>  value="Y"/> <label for="hideme1">HIDE ME</label></h1></div>
								<div><h1 style="text-align:left;"><input type="radio" name="hideme" id="hideme2"  <? if(GetName1("users","hideme","id",$_SESSION['UsErIdFrOnT'])=='N'){?>checked<? } ?>  value="N"/> <label for="hideme2">REVEAL ME</label></h1></div>
			<span id="MessageId" style="color:#FF0000;bottom:0;float:right;">Sent sucessfully</span>	
			</div>	
			 
		</div>
	</div>	
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
				<input  type="image" name="sendbutton" id="sendbutton" src="images/button_send.png" onclick="return POPUPfrmcheck('hidepop');"  />
			</div>
		
		
		</div>
	</div>	
</form>
</body>
</html>