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
<div class="header">
	<div class="top_info">
		<div class="icon_holder">
			<img src="images/icon_zap.png" border="0" alt="">
		</div>
		<div class="text_holder">
			zap
		</div>
		
				 
	</div>
					
</div>	<!-- the header ends -->
<div class="middleSection">
	<div class="centered_info">
		<div style=" border-bottom: solid #FFFFFF; width: 100%;display: flex;padding-bottom: 2%;">
			<div style="width: 20%; background-color: white; ">
				<img style="    height: 71%;width: 100%;" src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt=""/>
			</div>
			<div style="width:78%;    margin-left: 2%;">
				<div>
					<h1 style="text-align:left;">
						<input type="radio" name="neverwann" id="neverwann"  value="Y" style="zoom: 2;"/>
						<label for="neverwann" style="font-size: 1.5vw;">Click here if wann to ZAP this player off your list and the game.</label>
					</h1>
				</div>
				<div style="padding-bottom: 2%;font-size: 3vh;padding-top: 2%;">DOING THIS WILL TERMINATE THE PLAYER IF THEY ONLY HAVE ONE LIFE. IF THEY HAVE MORE LIVES THEY WILL BE TAGGED AS HAVING BEEN ZAPPED AS A WARNING TO OTHER PLAYERS. YOU CAN ZAP FOR ANY PERSON BUT YOU WILL ALSO BE TAGGED AS SOMEONE WHO ZAPS.</div>
			</div>
		</div>
		<div style="width: 100%;display: flex;">
			<div  align="left" class="whitetext" style="padding-top:1%;display:inline-block; width: 30%;">CHECK ABOVE AND <br> CONFIRM BY REASON <br> HERE</div>
			<div id="hideme" align="left" class="whitetext" style="padding-top:1%; width: 60%;">

				<?
				$getZapOptionsQryRs=mysql_query("SELECT * FROM  zap_options ORDER BY id ASC");
				while($getZapOptionsQryRow=mysql_fetch_array($getZapOptionsQryRs))
				{
					?>
					<h3 style="text-align:left;">
						<input style="zoom: 2;" type="radio" name="hideme" id="hideme<? echo $getZapOptionsQryRow['id'];?>" value="<? echo $getZapOptionsQryRow['id'];?>"/>
						<label for="hideme<? echo $getZapOptionsQryRow['id'];?>"><? echo $getZapOptionsQryRow['name'];?></label>
					</h3>
				<? }?>
			</div>
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
			<input  type="image" name="sendbutton" id="sendbutton" src="images/button_send.png" onclick="return POPUPfrmcheck('zap');" />
		</div>
	</div>
</div>
</form>
</body>
</html>