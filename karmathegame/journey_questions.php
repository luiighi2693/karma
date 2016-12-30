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
    <div id="bottom_border_newlife" style="padding-top:0px;">
		  <p><h1  style="padding-top:0px;">Your Date of Birth is NEVER shown and personal information is<br />shared only with your approval.</h1></p>
		</div>
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
								for($GG=1;$GG<=$TotGetGroups;$GG++)
								{
									$GetGroupsQryRow=mysql_fetch_array($GetGroupsQryRs);
						?>
									<? echo $GG;?>. <a href="journey_questions_step.php?grp=<? echo $_REQUEST['grp'];?>&subgrp=<? echo $GetGroupsQryRow['id'];?>"><? echo ucfirst(stripslashes($GetGroupsQryRow['name']));?></a><br /><br />
							<?  }?>		
							<? if(trim($_REQUEST['grp'])==2){?>
									<? echo $GG;?>. <a href="journey_questions_whatiwant.php?grp=2">Who am I and What do i Want</a><br /><br />
							<? }?>	
						<?  }?>
					  </p>
					  
					</div>
					<!-- end #questions -->
				  </div>
				  <!-- end #left_column -->
				  <div id="center_column" class="center_column">
					<div id="space">
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					  <div id="dark_center" class"dark_center"></div>
					  <!-- end #dark_center -->
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					</div>
					<!-- end #space -->
					<div id="binder">
					  <div id="dark_space" class"dark_space">
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
					  <div id="dark_center" class"dark_center"></div>
					  <!-- end #dark_center -->
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					</div>
					<!-- end #space -->
					<div id="binder">
					  <div id="dark_space" class"dark_space">
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
					  <div id="dark_center" class"dark_center"></div>
					  <!-- end #dark_center -->
					  <div id="white_block" class"white_block"></div>
					  <!-- end #white_block -->
					</div>
					<!-- end #space -->
					<div id="binder">
					  <div id="dark_space" class"dark_space">
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
					  <div id="dark_center" class"dark_center"></div>
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
		<div style="width:100%;height:60px;background:<?echo $_GET['color1']?>;">
			<div style="height=80%;width:10%;margin-right:5%;margin-bottom:2%;float:right;">
				<img  src="images/button_close.png" style="width:100%" "height:100%"/>
			</div>
		</div>
	  </div>
		<div align="right" style="padding-bottom:10px;"><img src="images/guru-icon-corner.jpg" /></div>
	</div>
<? include("googleanalytic.php");?>
</body>
</html>