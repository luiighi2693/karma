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
</script>
</head>
<body>
 <div class="header">
		<div class="top_info">
			<div class="icon_holder">
				<img src="images/icon_challenge.png" border="0"></img>
			</div>
			<div class="text_holder">
				challenge
			</div>
			<div class="icon_holder"style="float:right;">
				<a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a>
			</div>
				 
		</div>
					
	</div>	<!-- the header ends -->
	<div class="middlesection">
		<div class="centered_info">
			<div class="avatar_pic">
				<? if($CURRENTgetuserwryRow['avatarid']!='') { $avatarlogo=stripslashes(GetName1("avatars","picture","id",$CURRENTgetuserwryRow['avatarid']));?>
								<img src="Avatars/<? echo $avatarlogo;?>"/>
							<? }?>
			</div>
			<div class="container">
			<div style="float:right; width:50%; font-size: 3.6vh;">
	   			 find a few games where we can open a screen to both people after other person accepts
	   		 </div>
			</div>
		</div>
	</div>		
</body>
</html>   	