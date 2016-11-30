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
				<img src="images/icon_group.png" border="0"></img>
				</div>
				<div class="text_holder">
					groups
				</div>
				<div class="icon_holder" style="float:right;">
				<a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a>
				</div>
				 
			</div>
					
	</div>	<!-- the header ends -->
	
	
<div class="middlesection">
		<div class="centered_info" >
			<div class="whitetext">You must have 2 people to make a group and then you can tap other players to join, or they can ask members to join.</div>
				<div class="whitetext" style="height:5%;margin-top:1%;margin-bottom:1%;"><strong><? echo $username;?></strong></div>
				<div class="avatar_pic">
					<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt=""/>
				</div>
				<div class="container">
						<div  class="whitetext" id="groupleftletters" nowrap="nowrap">New Group Name:&nbsp;</div>
					        <div  class="whitetext" id="grouprightitems"><input type="text" name="groupid_new" id="groupid_new" class="inputboxchat" /></div>
						<div  class="whitetext" style="width:100%;">Or</div>
									 
						<div  class="whitetext"  id="groupleftletters"nowrap="nowrap" >My Groups:&nbsp;</div>
						<div class="whitetext" id="grouprightitems">
							<select  name="groupid" id="groupid" class="inputboxchat" >
												<option value=""></option>
												<?
												$mygroupsQryRs=mysql_query("SELECT * FROM users_groups WHERE name!='' and userid='".$_SESSION['UsErIdFrOnT']."' order by name asc");
												while($mygroupsQryRow=mysql_fetch_array($mygroupsQryRs))
												{
													?>
														<option value="<? echo $mygroupsQryRow['id'];?>"><? echo ucfirst(stripslashes($mygroupsQryRow['name']));?></option>
													<?
												}
												?>
							</select>
						 </div>
										
				</div>
				<div class="meetup_pic">
					<img src="images/affiliate_meetup.png"></img>
				</div>
		</div>	
</div>	
<div class="footer">
	<div class="centered_info">
		<input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
		<input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
		<span id="MessageId" style="color:#FF0000;"></span>
		
		<div class="button">
			<a href="#" onclick="hide_pop();return false;">
				<img src="images/close-button.png" border="0" />
			</a>
		</div>
		<div class="button">
			<input type="image" name="sendbutton" id="sendbutton"  src="images/send-button.png" align="top" onclick="return POPUPfrmcheck('groups');" /> 
		</div>
		
		
	</div>
</div>
	
</form>
</body>
</html>