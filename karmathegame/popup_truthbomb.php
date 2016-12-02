<? include("connect.php");
include("checklogin.php");
$GetUsersQry="SELECT * FROM users WHERE active='Y' and id='".mysql_real_escape_string($_REQUEST['id'])."' ORDER BY id DESC";
$GetUsersQryRs=mysql_query($GetUsersQry);
$GetUsersQryRow=mysql_fetch_array($GetUsersQryRs);
$torbComplement = "'torb', 'torb_question_answers'";
$mailAcepted = "'N'";
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
				<img src="images/icon_bomb.png" border="0" alt="">
			</div>
			<div class="text_holder">
				TRUTH OR BOMB
			</div>
			<div class="icon_holder"style="float:right;">
				<a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a>
			</div>
		</div>
	</div>

	<div class="middlesection" style="width: 100%;">
		<div class="centered_info">
			<div style="width: 100%; display: flex;">
				<div style="width: 23%; margin-right: 2%;">
					<? if($CURRENTgetuserwryRow['avatarid']!='') { $avatarlogo=stripslashes(GetName1("avatars","picture","id",$CURRENTgetuserwryRow['avatarid']));?>
						<?$actualUser=mysql_query('select * FROM users where id='.$_SESSION['UsErIdFrOnT']);
						$actualUserArray=mysql_fetch_array($actualUser);
						echo '<h3 style="text-align: left;color: white;    padding-bottom: 10px;">'.$actualUserArray['username'].'</h3>';?>
					<? }?>
				</div>
				<div style="width: 50%; margin-right: 2%;">
					<h3 style="color: white;">
						<?
						$questions = mysql_query('select * FROM torb_questions');
						$questionsArray = mysql_fetch_array($questions);
						$cantQuestions= mysql_num_rows($questions);

						$questionWithAnswer = false;
						$cont = 0;
						while (!$questionWithAnswer){
							$questionNumber = rand(1,$cantQuestions);
							$verifyAnswerUser = mysql_query('select * FROM torb_question_answers WHERE id_question='.$questionNumber.', id_user='.$actualUserArray['id']);
							if(empty($verifyAnswerUser)){
								$questionSelected =  mysql_query('select * FROM torb_questions WHERE id='.$questionNumber);
								$questionSelectedArray = mysql_fetch_array($questionSelected);
								echo $questionSelectedArray['torb_question'];
								$questionWithAnswer=true;
							}else{
								$cont++;
								if($cont>999){
									$questionWithAnswer=true;
								}
							}
						}
						?>
					</h3>
				</div>
				<div style="width: 23%;">
					<?
						echo '<h3 style="text-align: right;color: white;">'.$GetUsersQryRow['username'].'</h3>';
					?>
				</div>
			</div>
			<div style="width: 100%; display: flex;">
				<div style="width: 23%; margin-right: 2%;">
					<? if($CURRENTgetuserwryRow['avatarid']!='') { $avatarlogo=GetName1("avatars","picture","id",$CURRENTgetuserwryRow['avatarid']);?>
						<?$actualUser=mysql_query('select * FROM users where id='.$_SESSION['UsErIdFrOnT']);
						$actualUserArray=mysql_fetch_array($actualUser);
						?>
						<img src="Avatars/<? echo $avatarlogo;?>" width="100%" alt=""/>
					<? }?>
				</div>
				<div style="width: 23%; margin-right: 2%;">
					<div style="width:100%;color: black;background-color: white;">
						<h3 style="padding-left: 5%;padding-top: 5%;">You Say</h3>
					</div>
					<div style="background-color: white; width: 100%;">
						<textarea id="txtAreaUser" style="border-top: hidden;border-left: none;border-right: none; width: 100%; height: 70%;"></textarea>
					</div>
				</div>
				<div style="width: 23%; margin-right: 2%;">
					<div style="width:100%;color: black;background-color: white;">
						<h3 style="padding-left: 5%;padding-top: 5%;">They Say</h3>
					</div>
					<div style="background-color: white; width: 100%;">
						<textarea id="txtAreaUserForSend" style="border-top: hidden;border-left: none;border-right: none; width: 100%; height: 70%;"></textarea>
					</div>
				</div>
				<div style="width: 23%;">
					<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt="" width="100%"/>
				</div>
			</div>
		</div>
	</div>

	<div class="footer">
		<div class="button" style="margin-right: 3%;">
			<input  type="image" name="sendbutton" id="sendbutton" src="images/send-button.png" onclick="saveAnswer(<? echo $_SESSION['UsErIdFrOnT'].', '.$questionSelectedArray['id'].', '.$_REQUEST['id'].', '.$torbComplement.', '.$questionSelectedArray['id'].', '.$mailAcepted;?>);hide_pop();return false;" />
		</div>
		<span id="MessageId" style="color:#FF0000;"></span>
	</div>
</form>
</body>
</html>