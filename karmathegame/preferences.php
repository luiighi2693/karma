<? include("connect.php");
include("checklogin.php");
$GetUsersQry="SELECT * FROM users WHERE active='Y' and id='".$_REQUEST['userid']."' ORDER BY id DESC";
$GetUsersQryRs=mysql_query($GetUsersQry);
$GetUsersQryRow=mysql_fetch_array($GetUsersQryRs);

if($GetUsersQryRow['username']!=''){$username=stripslashes($GetUsersQryRow['username']);}else{$username=stripslashes($GetUsersQryRow['couponcode']);}

$GetUSerWantQry="SELECT * FROM users_want WHERE userid='".$_REQUEST['userid']."'";
$GetUSerWantQryRs=mysql_query($GetUSerWantQry);
$TotGetUSerWant=mysql_affected_rows();
if($TotGetUSerWant>0)
{
	$GetUSerWantQryRow=mysql_fetch_array($GetUSerWantQryRs);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="popup_fun.js?rnd=<? echo rand();?>"></script>
<script language="javascript" src="ajax_validation.js?rnd=<? echo rand();?>"></script>
<? if($_SERVER['HTTP_HOST']=='yogs'){?>
<script src="js/jquery-1.9.1.js" type="text/javascript"></script>
<? }else{?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<? }?>
</head>
<body style="text-align:left;overflow:scroll;background-color:#ffffff">
<div  style="display:inline;">
	
	<div class="journal_section"  style="padding:0px;margin:0px;padding-left:5%;padding-top:2%;padding-right:5%;overflow:auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="24%" valign="top" style="padding-right:20px;"><img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" width="350" /></td>
			<td width="76%" valign="top">
				<? if($GetUsersQryRow['aboutme']!=''){?>
				<div class="journal_section" style="padding:0px;margin:0px;" >
						<h1  style="font-weight:normal;font-size:36px;"><? echo stripslashes($GetUsersQryRow['aboutme']);?></h1><br />
				</div>
				<? }?>
				<? if($GetUSerWantQryRow['my_gender']!=''){?>
					<h1 style="font-size:20px;font-weight:normal;">I am a <? echo $GetUSerWantQryRow['my_gender'];?></h1>
					<? if($GetUSerWantQryRow['want_gender1']!='' && $GetUSerWantQryRow['lookingfor1']!=''){?>
						<h1 style="font-size:20px;font-weight:normal;">
							&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender1'];?>
							<br />&nbsp;&nbsp;&nbsp;&nbsp;for
							<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor1']);?>
						</h1>
					<? }?>
					<? if($GetUSerWantQryRow['want_gender2']!='' && $GetUSerWantQryRow['lookingfor2']!=''){?>
						<h1 style="font-size:20px;font-weight:normal;">and<br />
							&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender2'];?>
							<br />&nbsp;&nbsp;&nbsp;&nbsp;for
							<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor2']);?>
						</h1>
					<? }?>
					<? if($GetUSerWantQryRow['want_gender3']!='' && $GetUSerWantQryRow['lookingfor3']!=''){?>
						<h1 style="font-size:20px;font-weight:normal;">and<br />
							&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender3'];?>
							<br />&nbsp;&nbsp;&nbsp;&nbsp;for
							<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor3']);?>
						</h1>
					<? }?>
					<? if($GetUSerWantQryRow['want_gender4']!='' && $GetUSerWantQryRow['lookingfor4']!=''){?>
						<h1 style="font-size:20px;font-weight:normal;">and<br />
							&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender4'];?>
							<br />&nbsp;&nbsp;&nbsp;&nbsp;for
							<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor4']);?>
						</h1>
					<? }?>
					<? if($GetUSerWantQryRow['want_gender5']!='' && $GetUSerWantQryRow['lookingfor5']!=''){?>
						<h1 style="font-size:20px;font-weight:normal;">and<br />
							&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender5'];?>
							<br />&nbsp;&nbsp;&nbsp;&nbsp;for
							<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor5']);?>
						</h1>
					<? }?>
					<? if($GetUSerWantQryRow['want_gender6']!='' && $GetUSerWantQryRow['lookingfor6']!=''){?>
						<h1 style="font-size:20px;font-weight:normal;">and<br />
							&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender6'];?>
							<br />&nbsp;&nbsp;&nbsp;&nbsp;for
							<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor6']);?>
						</h1>
					<? }?>
			  <? }?>
			</td>
		  </tr>
		</table>

		
	  
	  <?
	  
	  $getQuestionsQryRs=mysql_query("SELECT users_questions.* FROM users_questions,questions WHERE users_questions.questionid=questions.id  and users_questions.userid='".trim($_REQUEST['userid'])."' ORDER BY field(users_questions.groupid, '2','1','3') ASC ");
	  $TotgetQuestions=mysql_affected_rows();
	  if($TotgetQuestions>0)
	  {
	  		while($getQuestionsQryRow=mysql_fetch_array($getQuestionsQryRs))
			{
				if($GRPID!=$getQuestionsQryRow['groupid'])
				{
					$GRPNAME=stripslashes(GetName1("groups","name","id",$getQuestionsQryRow['groupid']));
	  		?>
					<div>&nbsp;</div>
					<h1 style="font-weight:normal;font-size:36px;"><? echo $GRPNAME;?> 
					
						<? //show lock icon only if the user have not sent the request to unlock?>
						<? if($getQuestionsQryRow['groupid']==3){?>
							<?
							$getIntimcayLockRequestQryRs=mysql_query("SELECT * FROM users_intimicy_lock_request WHERE userid_from='".$_REQUEST['userid_from']."' and userid_to='".$_REQUEST['userid']."'");
							$TotgetIntimcayLockRequest=mysql_affected_rows();
							if($TotgetIntimcayLockRequest>0)
							{
								$getIntimcayLockRequestQryRow=mysql_fetch_array($getIntimcayLockRequestQryRs);
								if($getIntimcayLockRequestQryRow['rejected']=='Y')
								{
									?>
										<img src="images/lock.png" align="right" style="margin-top:-15px;margin-right:15px;" /><span style="font-size:11px;float:right;margin-right:15px;vertical-align:bottom;margin-top:16px;">REJECTED</span>
									<?
								}
								else if($getIntimcayLockRequestQryRow['accepted']=='N')
								{
									?>
										<img src="images/lock.png" align="right" style="margin-top:-15px;margin-right:15px;" /><span style="font-size:11px;float:right;margin-right:15px;vertical-align:bottom;margin-top:16px;">WAITING FOR ACCEPT</span>
									<?
								}
							}
							else
							{
							?>
								 <a href="#" onclick="RequestIntimicyLock(<? echo $_REQUEST['userid_from'];?>,<? echo $_REQUEST['userid'];?>);"><img src="images/lock.png" align="right" style="margin-top:-15px;margin-right:15px;" border="0" /></a><span style="font-size:11px;float:right;margin-right:15px;vertical-align:bottom;margin-top:16px;">CLICK LOCK TO REQUEST VIEW</span>
								 <span id="MessageId" style="color:#FF0000;font-size:10px;float:right"></span>
						<?  } ?>
					<? } ?>
					</h1>
					<div style="background-color:#5d4c46; height:4px; width:98%;"></div>
					<div>&nbsp;</div>
			<?
				}
				?>
				<? if($getQuestionsQryRow['groupid']!=3 ){?>
				
					<h1 style="font-size:18px;font-weight:normal;">
					<span  style="font-size:22px;font-weight:normal;"><? echo stripslashes(GetName1("questions","question","id",$getQuestionsQryRow['questionid']));?></span>
					<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<? if($getQuestionsQryRow['answerid']!='' && $getQuestionsQryRow['answerid']!='0'){?>
							<? echo stripslashes(GetName1("options_group_values","name","id",$getQuestionsQryRow['answerid']));?>
						<? }else{?>
							<? echo stripslashes($getQuestionsQryRow['answeertext']);?>
						<? }?>
					</h1>
					<div>&nbsp;</div>
				<?
				}
				else
				{
					if($TotgetIntimcayLockRequest>0 && $getIntimcayLockRequestQryRow['accepted']=='Y')
					{
					?>
						<h1 style="font-size:18px;font-weight:normal;">
						<span  style="font-size:22px;font-weight:normal;"><? echo stripslashes(GetName1("questions","question","id",$getQuestionsQryRow['questionid']));?></span>
						<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<? if($getQuestionsQryRow['answerid']!='' && $getQuestionsQryRow['answerid']!='0'){?>
								<? echo stripslashes(GetName1("options_group_values","name","id",$getQuestionsQryRow['answerid']));?>
							<? }else{?>
								<? echo stripslashes($getQuestionsQryRow['answeertext']);?>
							<? }?>
						</h1>
						<div>&nbsp;</div>
					<?
					}
				}
				$GRPID=$getQuestionsQryRow['groupid'];
			}
	  }
	  ?>
	  <div>&nbsp;</div>
	</div>
</div>
</body>
</html>