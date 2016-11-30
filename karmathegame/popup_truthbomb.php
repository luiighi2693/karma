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
	<link href="css/style.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
</head>
<body style="text-align:center;">
<form name="frmpopup" id="frmpopup" enctype="multipart/form-data" method="post">
	<table width="95%" style="text-align:center;margin-left:auto;margin-right:auto;" align="center" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="100%" align="center" border="0" cellspacing="3" cellpadding="3">
					<tr>
						<td class="bottmborder_white">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="8%" align="left"><img src="images/icon_bomb.png" border="0"/></td>
									<td width="82%"><h1 style="text-align:left;">TRUTH OR BOMB</h1></td>
									<td width="10%" align="right"><a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="padding-top:20px;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr >
									<td width="25%" align="left" valign="top"  >
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="center" height="190" valign="middle">
													<? if($CURRENTgetuserwryRow['avatarid']!='') { $avatarlogo=stripslashes(GetName1("avatars","picture","id",$CURRENTgetuserwryRow['avatarid']));?>
														<?$actualUser=mysql_query('select * FROM users where id='.$_SESSION['UsErIdFrOnT']);
														$actualUserArray=mysql_fetch_array($actualUser);
														echo '<h3 style="text-align: left;color: white;    padding-bottom: 10px;">'.$actualUserArray['username'].'</h3>';?>
														<img src="Avatars/<? echo $avatarlogo;?>" width="100%" height="295px" />
													<? }?>
												</td>
											</tr>
										</table>
									</td>
									<td  width="50%" align="left" valign="top" style="padding-left:20px;padding-right:10px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="left">
													<h3 style="text-align:left;width: 100%;color: white;    padding-bottom: 10px;">
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
													<div style="display: flex;">
														<div style="background-color: white;margin: 2px;    margin-right: 20px; ">
															<label><h3 style="    margin-left: 20px;     margin-top: 16px;" >You Say</h3></label>
															<textarea id="txtAreaUser" style="border-top: hidden; margin-left: 20px;border-left: none;" rows="17" cols="32"></textarea>
														</div>
														<br>
														<div style="background-color: white;margin: 2px;">
															<label><h3 style="    margin-left: 20px;     margin-top: 16px;" >They Say</h3></label>
															<textarea id="txtAreaUserForSend" style="border-top: hidden;margin-left: 20px;border-left: none;" rows="17" cols="32"></textarea>
														</div>
													</div>
												</td>
											</tr>
										</table>
									</td>
									<td width="25%" align="left" valign="top"  >
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="center" height="190" valign="middle">
													<?
													echo '<h3 style="text-align: right;color: white;    padding-bottom: 10px;">'.$GetUsersQryRow['username'].'</h3>';
													?>

													<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt="" width="100%" height="295px"/>
												</td>
											</tr>
										</table>
									</td>
								</tr>



				  
								<tr>
									<td colspan="3"   align="left" valign="bottom" class="dashboard_whitetext">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
						 
											<tr>
												<td width="25%"></td>
												<td width="25%" align="right" style="padding-top:20px;" colspan="2">
												<a href="#" onclick="saveAnswer(<? echo $_SESSION['UsErIdFrOnT'].', '.$questionSelectedArray['id'].', '.$_REQUEST['id'].', '.$torbComplement.', '.$questionSelectedArray['id'].', '.$mailAcepted;?>);hide_pop();return false;"><img src="images/send-button-green.png" border="0" /></a>
												<span id="MessageId" style="color:#FF0000;"></span>
												</td>
												<td width="25%"></td>
												<td width="25%"></td>
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
</form>
</body>
</html>