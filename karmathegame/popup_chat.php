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
<body style="text-align:center;" >
<form name="frmpopup" id="frmpopup" enctype="multipart/form-data" method="post" onmouseover="if(document.getElementById('frmpopup')!=null){
	document.getElementById('scrollchat').scrollTop = 10000;
	document.getElementById('frmpopup').setAttribute('id', 'frmpopup2');}" >
	<div class="header">
			<div class="top_info">
				<div class="icon_holder">
				<img src="images/icon_chat.png" border="0"></img>
				</div>
				<div class="text_holder">
					chat
				</div>
				<div class="icon_holder" style="float:right;">
				<a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a>
				</div>
				 
			</div>
					
	</div>	<!-- the header ends -->
	
	<div class="middlesection">
		<div class="centered_info" hidden>
		<table width="95%" style="text-align:center;margin-left:auto;margin-right:auto;" align="center" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="100%" align="center" border="0" cellspacing="3" cellpadding="3">
					<tr>
						<td style="padding-top:20px;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="160" align="left" valign="top" >
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="left" height="35" class="dashboard_whitetext">My Open Chats</td>
                                            </tr>
                                            <tr>
                                                <td align="left" height="250" width="140" valign="top" style="background-color:#FFFFFF;padding:4px;width:140px;" >
                                                    <div align="left" style="height:250px;overflow:scroll;overflow-x: hidden;overflow-y: auto;width:160px;">
                                                        <?
                                                        $getHidedusersQryRs=mysql_query("SELECT userid_to FROM users_hide WHERE userid_from='".$_SESSION['UsErIdFrOnT']."'");
                                                        $TotgetHidedusersQryRs=mysql_affected_rows();
                                                        if($TotgetHidedusersQryRs>0)
                                                        {
                                                            while($getHidedusersQryRow=mysql_fetch_array($getHidedusersQryRs))
                                                            {
                                                                $userid_to.=$getHidedusersQryRow['userid_to'].",";
                                                            }
                                                            $userid_to=substr($userid_to,0,-1);
                                                            $andQryHide=" and id not in ($userid_to)";
                                                        }
                                                        $getHidedusersQryRs=mysql_query("SELECT userid_to FROM users_zap WHERE userid_from='".$_SESSION['UsErIdFrOnT']."'");
                                                        $TotgetHidedusersQryRs=mysql_affected_rows();
                                                        if($TotgetHidedusersQryRs>0)
                                                        {
                                                            while($getHidedusersQryRow=mysql_fetch_array($getHidedusersQryRs))
                                                            {
                                                                $userid_to2.=$getHidedusersQryRow['userid_to'].",";
                                                            }
                                                            $userid_to2=substr($userid_to2,0,-1);
                                                            $andQryHide.=" and id not in ($userid_to2)";
                                                        }

                                                        $GetLeftChatUsersQry="SELECT id FROM users WHERE active='Y' and id!='".$_SESSION['UsErIdFrOnT']."' $andQryHide ORDER BY id DESC";
                                                        $GetLeftChatUsersQryRs=mysql_query($GetLeftChatUsersQry);
                                                        while($GetLeftChatUsersQryRow=mysql_fetch_array($GetLeftChatUsersQryRs))
                                                        {
                                                            ?>
                                                            <a href="#" class="graylink12" onclick="document.getElementById('userid_to').value='<? echo $GetLeftChatUsersQryRow['id'];?>';GETCHAT(<? echo $_SESSION['UsErIdFrOnT'];?>,<? echo $GetLeftChatUsersQryRow['id'];?>,'YES');setTimeout(function(){ document.getElementById('scrollchat').scrollTop = 10000; }, 500);"><? echo GetUserOnlineStatus($GetLeftChatUsersQryRow['id']);?> <? echo GetUserName($GetLeftChatUsersQryRow['id']);?><? echo GetUserChatNotifier($GetLeftChatUsersQryRow['id'],$_SESSION['UsErIdFrOnT']);?> </a><br />
                                                        <? }?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td   align="left" valign="top" style="padding-left:30px;" class="dashboard_whitetext">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                            <tr>
                                                <td valign="top" align="left" width="160">
                                                    <table width="98%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td height="35"  class="dashboard_whitetext"><? echo $LOGINusername;?></td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" >
                                                                <? if($CURRENTgetuserwryRow['avatarid']!='') { $avatarlogo=stripslashes(GetName1("avatars","picture","id",$CURRENTgetuserwryRow['avatarid']));?>
                                                                    <img src="Avatars/<? echo $avatarlogo;?>" width="150" height="210" />
                                                                <? }?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td valign="top" align="left">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td height="35"  class="dashboard_whitetext">Thread <span id="chatloaderID"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td >
                                                                <div id="scrollchat" style="width:100%;height:210px;background-color:#FFFFFF;color:#666666;overflow:scroll;overflow-x: hidden;overflow-y: auto;font-size:14px;padding:5px;">
																	<span id="AllChatsID">
																		<?
                                                                        $ret='';
                                                                        $getchatsRs=mysql_query("select * FROM users_chat where ( userid_to='".$_REQUEST['id']."' and userid_from='".$_SESSION['UsErIdFrOnT']."' )or ( userid_to='".$_SESSION['UsErIdFrOnT']."' and userid_from='".$_REQUEST['id']."') order by id asc");
                                                                        while($getchatsRow=mysql_fetch_array($getchatsRs))
                                                                        {
                                                                            $username_from=GetUserName($getchatsRow['userid_from']);
                                                                            //$ret.=$username_from.": ".nl2br(stripslashes($getchatsRow['message']));
                                                                            //$ret.="<br>";

                                                                            if($getchatsRow['userid_from']==$_SESSION['UsErIdFrOnT'])
                                                                            {
                                                                                $ret.="<div style='float:left;font-size:16px;'>".nl2br(stripslashes($getchatsRow['message']))."</div>";
                                                                            }
                                                                            else
                                                                            {
                                                                                $ret.="<div style='float:right;font-size:16px;margin-left:70px;'>".nl2br(stripslashes($getchatsRow['message']))."</div>";
                                                                            }

                                                                            //$ret.=$username_from.": ".nl2br(stripslashes($getchatsRow['message']));
                                                                            $ret.="<br><br><br>";
                                                                        }
                                                                        echo $ret;
                                                                        ?>
																	</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <? if($_REQUEST['id']!='' && $_REQUEST['id']>0){?>
                                                    <td valign="top" align="left" width="170" style="padding-left:10px;">
                                                        <div id="RIGHTSIDECHATTER_ID">
                                                            <table width="98%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td height="35"  class="dashboard_whitetext"><? echo $username;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td valign="top" >
                                                                        <? if($GetUsersQryRow['avatarid']!='') { $avatarlogo=stripslashes(GetName1("avatars","picture","id",$GetUsersQryRow['avatarid']));?>
                                                                            <img src="Avatars/<? echo $avatarlogo;?>" width="150" height="210" />
                                                                        <? }?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                <? }else{?>
                                                    <td width="170" valign="top" align="left"   style="padding-left:10px;"><span id="RIGHTSIDECHATTER_ID"></span></td>
                                                <? }?>
                                            </tr>

                                            <tr>
                                                <td align="left" style="padding-top:20px;" nowrap="nowrap" colspan="3">
                                                    <input type="text" name="message" id="message" class="inputboxchat"   />
                                                    <input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
                                                    <input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
                                                    <input type="image" name="sendbutton" id="sendbutton"  src="images/send-button.png" align="top" onclick="document.getElementById('scrollchat').scrollTop = 10000;setTimeout(function(){ document.getElementById('scrollchat').scrollTop = 10000; }, 500);return POPUPfrmcheck('chat');" />
                                                    <br /><span id="MessageId" style="color:#FF0000;"></span>
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
		 <input type="image" name="sendbutton" id="sendbutton"  src="images/button_send.png" align="top" onclick="document.getElementById('scrollchat').scrollTop = 10000;setTimeout(function(){ document.getElementById('scrollchat').scrollTop = 10000; }, 500);return POPUPfrmcheck('chat');" />
		</div>
		
		<br /><span id="MessageId" style="color:#FF0000;"></span>
		</div>
	</div>	
</form>
</body>
</html>