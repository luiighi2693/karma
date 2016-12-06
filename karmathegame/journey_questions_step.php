<? include("connect.php"); 
include("checklogin.php");
$TOPCONDENSE="YES";
if($_GET["start"]<=0 || $_GET["start"]=="" ) 
{
	$start_pglmt=0;
	if($_REQUEST['grp']==2 && $_REQUEST['subgrp']==1 && ($_REQUEST['start']=='' || $_REQUEST['start']==0) )
	{
		$end_pglmt=1;
	}
	else
	{
		$end_pglmt=2;
	}	
}
else
{
	$start_pglmt=$_GET["start"];
	$end_pglmt=$_GET["start"]+2;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/opening_styles.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="ajax_validation.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script src="js/moment.js"></script>
	<script src="js/combodate.js"></script>

<script>
$(function() {
$( "#profile_dob" ).combodate();
$( "#profile_dob" ).change(function(){
		SaveProfileAnswer('profile_dob',$( "#profile_dob" ).val());
	})
});
</script>
</head>
<body>
<? include("top.php");?>
<div id="top_line"></div><br />
<div id="headline_titles"> </div>
<style type="text/css">body{background-image:url('images/background3.png');background-color:#e6e6e6;background-position:top center; background-size:100%;background-repeat:no-repeat;background-attachment:fixed;background-border:0px 5px 0px 5px;}</style>
<form name="frmquestions" id="frmquestions" enctype="multipart/form-data" method="post">
    <div id="pad_wrapper_JourneyQuestions">
	<div id="pad_JourneyQuestions">
	<h1>&nbsp;</h1>
    <br>
	<div id="mbook_JourneyQuestions" style="margin-bottom:30px;width:80%;">
	<div style="width:100%;margin:0 auto;">
	  <div id="left_column" class="left_column">
		<div id="questions_JourneyQuestions">
		  <h1><? echo strtoupper(stripslashes(GetName1("groups","name","id",trim($_REQUEST['grp'])))); ?></h1>
		  <div id="<? if(trim($_REQUEST['grp'])==2){?>blue_line<? } else if(trim($_REQUEST['grp'])==1){?>yellow_line<? } else if(trim($_REQUEST['grp'])==3){?>red_line<? }?>"></div>
		  <br>
		  <?
		  $getQuestion_FULL="select questions.* from questions where groupid='".mysql_real_escape_string(trim($_REQUEST['grp']))."' and subgroupid='".mysql_real_escape_string(trim($_REQUEST['subgrp']))."'  order by questions.displayorder ASC ";
		  $strResultPerPage_FULL=mysql_query($getQuestion_FULL);
		  $TotgetQuestion_FULL=mysql_affected_rows(); 
		  if($_REQUEST['grp']==2 && $_REQUEST['subgrp']==1 && ($_REQUEST['start']=='' || $_REQUEST['start']==0) )
		  {
		  		?>
				<p style="text-align:left">Used for Astrology - Information not shown</p>
				<p style="text-align:left;padding-left:15px;">
					<label style="padding:0px;margin:0px;line-height:20px;">
					Date of Birth<br />
					<input type="text" name="profile_dob" id="profile_dob" data-format="DD/MM/YYYY" data-template="D MMM YYYY" value="<? echo stripslashes($CURRENTgetuserwryRow['profile_dob']);?>"	/>
					</label>
				</p>
				<p style="text-align:left;padding-left:15px;">
					<label style="padding:0px;margin:0px;line-height:20px;">
					Country of Birth<br />
					<input type="text" class="register_textfield2" name="profile_country" id="profile_country" value="<? echo stripslashes($CURRENTgetuserwryRow['profile_country']);?>" onblur="SaveProfileAnswer('profile_country',this.value);"  />
					</label>
				</p>
				<p style="text-align:left;padding-left:15px;">
					<label style="padding:0px;margin:0px;line-height:20px;">
					State of Birth<br />
					<input type="text" class="register_textfield2" name="profile_state" id="profile_state" value="<? echo stripslashes($CURRENTgetuserwryRow['profile_state']);?>"  onblur="SaveProfileAnswer('profile_state',this.value);" />
					</label>
				</p>
				<p style="text-align:left;padding-left:15px;">
					<label style="padding:0px;margin:0px;line-height:20px;">
					City of Birth<br />
					<input type="text" class="register_textfield2" name="profile_city" id="profile_city" value="<? echo stripslashes($CURRENTgetuserwryRow['profile_city']);?>" onblur="SaveProfileAnswer('profile_city',this.value);"  />
					</label>
				</p>
				<?
				  $getQuestionQry="select questions.* from questions where groupid='".mysql_real_escape_string(trim($_REQUEST['grp']))."' and subgroupid='".mysql_real_escape_string(trim($_REQUEST['subgrp']))."'  order by questions.displayorder ASC limit $start_pglmt,1";
				  $strResultPerPage=mysql_query($getQuestionQry);
				  $TotgetQuestion=mysql_affected_rows(); 
		  }
		  else
		  {
				  $getQuestionQry="select questions.* from questions where groupid='".mysql_real_escape_string(trim($_REQUEST['grp']))."' and subgroupid='".mysql_real_escape_string(trim($_REQUEST['subgrp']))."'  order by questions.displayorder ASC limit $start_pglmt,2";
				  $strResultPerPage=mysql_query($getQuestionQry);
				  $TotgetQuestion=mysql_affected_rows(); 
				  for($LP=0;$LP<1;$LP++)
				  {
					  $getQuestionQryRow=mysql_fetch_array($strResultPerPage);
					  ?>
					  <p style="text-align:left"><? echo ucfirst(stripslashes($getQuestionQryRow['question']));?></p>
						
							<? if($getQuestionQryRow['optionid']>0){?>
								<p style="text-align:left;padding-left:15px;height:280px;">
								  <?
								  $getQuestionOptionsQryRs=mysql_query("select  * from options_group_values where groupid='".mysql_real_escape_string(trim($getQuestionQryRow['optionid']))."'    order by id desc");
								  $TotgetQuestionOptions=mysql_affected_rows();
								  if($getQuestionQryRow['optiontype']=='Radio Options')
								  {
									  while($getQuestionOptionsQryRow=mysql_fetch_array($getQuestionOptionsQryRs))
									  {
									  ?>
										<input type="radio" name="answers1" id="answers1_<? echo $getQuestionOptionsQryRow['id'];?>" value="<? echo $getQuestionOptionsQryRow['id'];?>" <? echo GetAnswerChecked($getQuestionQryRow['id'],$getQuestionOptionsQryRow['id'],'');?> onclick="SaveQuestionsAnswer(<? echo $getQuestionQryRow['id'];?>,<? echo $getQuestionOptionsQryRow['id'];?>,'');"/>
										<label style="padding:0px;margin:0px" for="answers1_<? echo $getQuestionOptionsQryRow['id'];?>"><? echo ucfirst(stripslashes($getQuestionOptionsQryRow['name']));?></label>
										<br>
									<? } 	
								  } 
								  if($getQuestionQryRow['optiontype']=='Dropdown')
								  {
								  	  ?>
									  <select name="answers1" id="answers1" onchange="SaveQuestionsAnswer(<? echo $getQuestionQryRow['id'];?>,this.value,'');">
									  <option value="">Select</option>
									  <? 
									  while($getQuestionOptionsQryRow=mysql_fetch_array($getQuestionOptionsQryRs))
									  {
									  ?>
										<option value="<? echo $getQuestionOptionsQryRow['id'];?>"  <? echo GetAnswerSelected($getQuestionQryRow['id'],$getQuestionOptionsQryRow['id'],'');?>  ><? echo ucfirst(stripslashes($getQuestionOptionsQryRow['name']));?></option>
										<br>
									<? } ?>	
									</select>
								<?  } ?>	
								</p>	
							<? }else{?>
								<p style="text-align:left;height:280px;">
									<label style="padding:0px;margin:0px">
									<?
									if($getQuestionQryRow['textboxsize']!=''){$txtsize=$getQuestionQryRow['textboxsize'];}else{$txtsize=150;}
									?>
									<input type="text" class="register_textfield2" name="answers1_text" id="answers1_text" style="width:<? echo $txtsize;?>px;" value="<? echo GetAnswerChecked($getQuestionQryRow['id'],$getQuestionOptionsQryRow['id'],'text');?>"  onblur="SaveQuestionsAnswer(<? echo $getQuestionQryRow['id'];?>,0,this.value);"  /></label>
								</p>
							<? }?>
						<? if($getQuestionQryRow['picture']!=''){?>
							<? if($getQuestionQryRow['picturelink']!=''){?>
								<a href="<? echo WebsiteWithProperUrl(stripslashes($getQuestionQryRow['picturelink']));?>" target="_blank"><img src="Questions/<? echo stripslashes($getQuestionQryRow['picture']);?>" height="170" width="250" align="bottom"   border="0" style="float:right;margin-top:-170px;" /></a>
							<? }else{?>
								<img src="Questions/<? echo stripslashes($getQuestionQryRow['picture']);?>" height="170" width="250" align="bottom"   border="0" style="float:right;margin-top:-170px;"    />
							<? } ?>	
						<? }?>
						<br><br>
				  <? }?>
		  <? }?>
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
		  <h1><? echo strtoupper(stripslashes(GetName1("groups_subcategory","name","id",trim($_REQUEST['subgrp'])))); ?></h1>
		  <div id="<? if(trim($_REQUEST['grp'])==2){?>blue_line<? } else if(trim($_REQUEST['grp'])==1){?>yellow_line<? } else if(trim($_REQUEST['grp'])==3){?>red_line<? }?>"></div>
		  <br>
		  <?
		  for($LP=1;$LP<2;$LP++)
		  {
			  $getQuestionQryRow=mysql_fetch_array($strResultPerPage);
			  if($getQuestionQryRow['question']!='')
			  {
			  ?>
				  <p style="text-align:left"><? echo ucfirst(stripslashes($getQuestionQryRow['question']));?></p>
					
						<? if($getQuestionQryRow['optionid']>0){?>
							<p style="text-align:left;padding-left:15px;height:280px;">
							  <?
							  $getQuestionOptionsQryRs=mysql_query("select  * from options_group_values where groupid='".mysql_real_escape_string(trim($getQuestionQryRow['optionid']))."'    order by id desc");
							  $TotgetQuestionOptions=mysql_affected_rows();
							  if($getQuestionQryRow['optiontype']=='Radio Options')
							  {
								  while($getQuestionOptionsQryRow=mysql_fetch_array($getQuestionOptionsQryRs))
								  {
								  ?>
									<input type="radio" name="answers2" id="answers2_<? echo $getQuestionOptionsQryRow['id'];?>" value="<? echo $getQuestionOptionsQryRow['id'];?>" <? echo GetAnswerChecked($getQuestionQryRow['id'],$getQuestionOptionsQryRow['id'],'');?> onclick="SaveQuestionsAnswer(<? echo $getQuestionQryRow['id'];?>,<? echo $getQuestionOptionsQryRow['id'];?>,'');"/>
									<label style="padding:0px;margin:0px" for="answers2_<? echo $getQuestionOptionsQryRow['id'];?>"><? echo ucfirst(stripslashes($getQuestionOptionsQryRow['name']));?></label>
									<br>
								<? } 	
							  } 
							  if($getQuestionQryRow['optiontype']=='Dropdown')
							  {
								  ?>
								  <select name="answers2" id="answers2" onchange="SaveQuestionsAnswer(<? echo $getQuestionQryRow['id'];?>,this.value,'');">
								  <option value="">Select</option>
								  <? 
								  while($getQuestionOptionsQryRow=mysql_fetch_array($getQuestionOptionsQryRs))
								  {
								  ?>
									<option value="<? echo $getQuestionOptionsQryRow['id'];?>"  <? echo GetAnswerSelected($getQuestionQryRow['id'],$getQuestionOptionsQryRow['id'],'');?>  ><? echo ucfirst(stripslashes($getQuestionOptionsQryRow['name']));?></option>
									<br>
								<? } ?>	
								</select>
							<?  } ?>
							</p>
						<? }else{?>
							<p style="text-align:left;height:280px;">
								<label style="padding:0px;margin:0px">
								<?
								if($getQuestionQryRow['textboxsize']!=''){$txtsize=$getQuestionQryRow['textboxsize'];}else{$txtsize=150;}
								?>
								<input type="text" class="register_textfield2" name="answers2_text" id="answers2_text" style="width:<? echo $txtsize;?>px;" value="<? echo GetAnswerChecked($getQuestionQryRow['id'],$getQuestionOptionsQryRow['id'],'text');?>" onblur="SaveQuestionsAnswer(<? echo $getQuestionQryRow['id'];?>,0,this.value);"/></label>
							</p>	
						<? }?>
						<? if($getQuestionQryRow['picture']!=''){?>
								<? if($getQuestionQryRow['picturelink']!=''){?>
									<a href="<? echo WebsiteWithProperUrl(stripslashes($getQuestionQryRow['picturelink']));?>" target="_blank"><img src="Questions/<? echo stripslashes($getQuestionQryRow['picture']);?>" align="bottom" height="170" width="250" style="float:right;margin-top:-170px;"   border="0"  /></a>
								<? }else{?>
									<img src="Questions/<? echo stripslashes($getQuestionQryRow['picture']);?>" height="170" width="250" align="bottom"   border="0" style="float:right;margin-top:-170px;"   />
								<? } ?>	
						<? }?>
					<br><br>
				<? }?>
		  <? }?>
		  	
		</div>
		
		<!-- end #questions -->
	  </div>
	  
	  <!-- end #right_column -->
	  <? include("right_journey3buttons.php");?>
	  <!-- end of #pad -->
	  
	 </div> 
	  
	  
	  
	</div>
	
	<div id="bottom_border_newlife" style="padding-top:0px;height:20px;">
	  <p><h1>&nbsp;</h1></p>
	</div>
	</div>
		<? //paging div?>
			<div align="center" style="position:absolute;top:328px;width:40px;max-width:40px;margin:0 auto;margin-left:4%;margin-right:auto;z-index:0;">
			<?
			$tmpva="";
			foreach($_GET as $V=>$K)
			{
				if($V!="start")
					$tmpva.="&".$V."=".$K;
			}
			?>
			<?php /*?><? echo $getQuestionQryRs[1];?><?php */?>
			<? if($_GET["start"]!=0) { if($_GET["start"]<=1){$lmttt=$start_pglmt-1;}else{$lmttt=$start_pglmt-2;} ?>
				<a href="journey_questions_step.php?start=<?=$lmttt;?><? echo $tmpva;?>" ><img align="left" src='images/tab_back_big.png' width=40  border=0></a>
			<? }?>
			</div>
			
			<div align="center" style="position:absolute;top:328px;width:40px;max-width:40px;margin:0 auto;margin-left:90%;margin-right:auto;z-index:0;">
			<? if(($TotgetQuestion_FULL-$_GET["start"])>2) { ?>	
				<a href="journey_questions_step.php?start=<?=$end_pglmt;?><? echo $tmpva;?>"><img  align="right" src='images/tab_forward_big.png' width=40 border=0></a>
			<? } ?> 
			<?
			  $getQuestionQry_Bottom="select questions.* from questions where groupid='".mysql_real_escape_string(trim($_REQUEST['grp']))."' and subgroupid='".mysql_real_escape_string(trim($_REQUEST['subgrp']))."'  ORDER BY displayorder ASC LIMIT ".($_REQUEST['start']+2).",2";
			  $strResultPerPage_Bottom=mysql_query($getQuestionQry_Bottom);
			  $TotgetQuestion_Bottom=mysql_affected_rows();
			  if($TotgetQuestion_Bottom<=0)
			  {
					$lastdisplay=GetName1("groups_subcategory","displayorder","id",mysql_real_escape_string(trim($_REQUEST['subgrp'])));
					$GetGroupsQryRs=mysql_query("SELECT * FROM groups_subcategory WHERE groupid='".mysql_real_escape_string(trim($_REQUEST['grp']))."' and displayorder>'".$lastdisplay."'  ORDER BY displayorder ASC");
					$TotGetGroups=mysql_affected_rows();
					if($TotGetGroups>0)
					{
						$GetGroupsQryRow=mysql_fetch_array($GetGroupsQryRs);
						$subgroupid=$GetGroupsQryRow['id'];
						$maingroupid=$GetGroupsQryRow['groupid'];
					}
					else
					{
						if($_REQUEST['grp']==2){ $grp=1;}else if($_REQUEST['grp']==1){ $grp=3;}else if($_REQUEST['grp']==3){ $grp=4;}
						$lastdisplay=GetName1("groups_subcategory","displayorder","id",mysql_real_escape_string(trim($_REQUEST['subgrp'])));
						//echo "SELECT * FROM groups_subcategory WHERE groupid=".mysql_real_escape_string($grp)." and displayorder>".mysql_real_escape_string(trim($_REQUEST['subgrp']))."  ORDER BY displayorder ASC";
						$GetGroupsQryRs=mysql_query("SELECT * FROM groups_subcategory WHERE groupid=".mysql_real_escape_string($grp)."  ORDER BY displayorder ASC");
						$TotGetGroups=mysql_affected_rows();
						if($TotGetGroups>0)
						{
							$GetGroupsQryRow=mysql_fetch_array($GetGroupsQryRs);
							$subgroupid=$GetGroupsQryRow['id'];
							$maingroupid=$GetGroupsQryRow['groupid'];
						}
					}
					if($maingroupid!='')
					{
						?>
							<a href='journey_questions_step.php?grp=<? echo $maingroupid;?>&subgrp=<? echo $subgroupid;?>' ><img align="right" src='images/tab_forward_big.png' width="40" border=0></a>
						<?
					}
					else
					{
						?>
							<a href='journeystats.php'><img align="right" src='images/tab_forward_big.png' width="40" border=0></a>
						<?
					}
			  }
			?>
			
			</div>
			
		<? //paging div END?><div align="right" style="padding-bottom:10px;"><img src="images/guru-icon-corner.jpg" /></div>	
	</div>
	
	
  </form>
<? include("googleanalytic.php");?>
</body>
</html>