<? include("connect.php"); 
include("checklogin.php");
$TOPCONDENSE="YES";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/opening_styles.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
</head>
<body>
<? include("top.php");?>
<div id="top_line"></div><br />
<div id="headline_titles"> </div>
<style type="text/css">body{background-image:url(backgrounds/background<?echo $_GET['bg']?>.png);background-color:#e6e6e6;background-position:top center; background-size:100%;background-repeat:no-repeat;background-attachment:fixed;background-border:0px 5px 0px 5px;}</style>
<div id="pad_wrapper_JourneyQuestions">
	<div id="pad_JourneyQuestions" style="background:<?echo $_GET['color1']?>">
	<h1>&nbsp;</h1> 
    <br>
	<div id="mbook_JourneyQuestions" style="width:80%;">
		<div style="width:100%;margin:0 auto;">
				  <div id="left_column" class="left_column">
					<div id="questions_JourneyQuestions">
					  <h1><? echo strtoupper(stripslashes(GetName1("groups","name","id",trim($_REQUEST['grp'])))); ?></h1>
					  <div id="<? if(trim($_REQUEST['grp'])==2){?>blue_line<? } else if(trim($_REQUEST['grp'])==1){?>yellow_line<? } else if(trim($_REQUEST['grp'])==3){?>red_line<? }?>"></div>
					  
					  <p align="left" style="text-align:left;padding-top:20px;"  class="graylink12">
						<?
							$GetGroupsQryRs=mysql_query("SELECT * FROM groups_subcategory WHERE groupid='".mysql_real_escape_string(trim($_REQUEST['grp']))."' ORDER BY displayorder ASC");
							$TotGetGroups=mysql_affected_rows();
							if($TotGetGroups>0)
							{
							 if(trim($_REQUEST['grp'])==2){?>
									1. <a href="journey_questions_whatiwant.php?grp=2&bg=<? echo $_GET['bg']?>&color1=<? echo $_GET['color1']?>">Who am I and What do i Want</a><br /><br />
							<? }
								if(strtoupper(stripslashes(GetName1("groups","name","id",trim($_REQUEST['grp']))))=='INTIMACY'){
									$TotGetGroups=1;
									mysql_query("SELECT * FROM users_questions WHERE questionid = 257 AND answerid IN (SELECT id FROM options_group_values WHERE name IN ('YES', 'MAYBE')) AND users_questions.userid = ".$_SESSION['UsErIdFrOnT']);
									if(mysql_affected_rows()>0){
										$TotGetGroups += 1;
										mysql_query("SELECT * FROM users_questions WHERE questionid = 261 AND answerid IN (SELECT id FROM options_group_values WHERE name IN ('YES', 'MAYBE')) AND users_questions.userid = ".$_SESSION['UsErIdFrOnT']);
										if(mysql_affected_rows()>0){
											$TotGetGroups += 1;
											mysql_query("SELECT * FROM users_questions WHERE questionid = 259 AND answerid IN (SELECT id FROM options_group_values WHERE name IN ('YES', 'MAYBE')) AND users_questions.userid = ".$_SESSION['UsErIdFrOnT']);
											if(mysql_affected_rows()>0){
												$TotGetGroups += 1;
											}
										}
									}

								}

								for($GG=2;$GG<=$TotGetGroups+1;$GG++)
								{
									$GetGroupsQryRow=mysql_fetch_array($GetGroupsQryRs);
						?>
									<? echo $GG-1;?>. <a href="journey_questions_step.php?grp=<? echo $_REQUEST['grp'];?>&subgrp=<? echo $GetGroupsQryRow['id'];?>&bg=<? echo $_GET['bg']?>&color1=<? echo $_GET['color1']?>"><? echo ucfirst(stripslashes($GetGroupsQryRow['name']));?></a><br /><br />
							<?  }?>		
							
						<?  }?>
					  </p>
					  
					</div>
					<!-- end #questions -->
				  </div>
				  <!-- end #left_column -->
				  <div id="center_column" class="center_column" style="background: <?echo $_GET['color1']?>">
					<div id="space">
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					  <div id="dark_center" class"dark_center" style="background: <?echo $_GET['color1']?>"></div>
					  <!-- end #dark_center -->
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					</div>
					<!-- end #space -->
					<div id="binder">
					  <div id="dark_space" class"dark_space" style="background: <?echo $_GET['color1']?>">
						<div id="dark_bar" class"dark_bar" style="background: <?echo $_GET['color1']?>"></div>
						<!-- end #dark_bar -->
						<div id="white_space" class"white_space"></div>
						<!-- end #white_space -->
					  </div>
					  <!-- end #dark_space -->
					</div>
					<!-- end #binder -->
					<div id="space">
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					  <div id="dark_center" class"dark_center" style="background: <?echo $_GET['color1']?>"></div>
					  <!-- end #dark_center -->
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					</div>
					<!-- end #space -->
					<div id="binder">
					  <div id="dark_space" class"dark_space" style="background: <?echo $_GET['color1']?>">
						<div id="dark_bar" class"dark_bar" style="background: <?echo $_GET['color1']?>"></div>
						<!-- end #dark_bar -->
						<div id="white_space" class"white_space"></div>
						<!-- end #white_space -->
					  </div>
					  <!-- end #dark_space -->
					</div>
					<!-- end #binder -->
					<div id="space">
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					  <div id="dark_center" class"dark_center" style="background: <?echo $_GET['color1']?>"></div>
					  <!-- end #dark_center -->
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					</div>
					<!-- end #space -->
					<div id="binder">
					  <div id="dark_space" class"dark_space" >
						<div id="dark_bar" class"dark_bar"></div>
						<!-- end #dark_bar -->
						<div id="white_space" class"white_space"></div>
						<!-- end #white_space -->
					  </div>
					  <!-- end #dark_space -->
					</div>
					<!-- end #binder -->
					<div id="space">
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					  <div id="dark_center" class"dark_center" style="background: <?echo $_GET['color1']?>"></div>
					  <!-- end #dark_center -->
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					</div>
					<!-- end #space -->
				  </div>
				  <!-- end #center_column -->
				  <div id="right_column" class="right_column">
					<div id="questions_JourneyQuestions">
					  <h1>&nbsp;</h1>
					  <p align="left" style="text-align:left"  class="graylink12">
						
					  </p>
					</div>
					<!-- end #questions -->
				  </div>
				  <!-- end #right_column -->
				  <? include("right_journey3buttons.php");?>
				  <!-- end of #pad -->
	  
	  	</div>
	  
		</div>
		<div id="bottom_border_newlife" style="padding-top:0px;">
		  <p><h1  style="padding-top:0px;">Your Date of Birth is NEVER shown and personal information is<br />shared only with your approval.</h1></p>
		</div>
	  </div>
	      
	</div>
	    <div class="SliderName_2Description"   style="position:relative;background:none;z-index:88889;margin-top:5%;">
	<div style="height:100%;width:100%;z-index:1;background:<? echo $_GET['color1']?>;position:absolute;opacity: 0.6;filter: alpha(opacity=60);">
	</div>
	<div style="height:100%;width:100%;z-index:12;position:absolute;">
	<div class="centered_info">
		<div class="button" style="margin-top:1.7%;height:60%;">
			<a href="http://www.karmathegame.org/karmathegame/dashboard.php" >
				<img src="images/button_close.png" border="0" />
			</a>
		</div>
		<div class="button" style="margin-top:1%;height:80%;width:6%;margin-right:38%;">
			<a href="#" >
				<img  src="images/guru-icon-corner.jpg" border="0" />
			</a>
		</div
	</div>
	</div>
	</div>
	
</div>
<? include("googleanalytic.php");?>
</body>
</html>