<?php
include("connect.php");
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
$GetUsersQry3="SELECT ideas.startdate, ideas.enddate , ideas.picture , ideas.place , ideas.title , ideas.cost , marketers.amb_picture_main , bucket_list.* from ideas left join marketers on ideas.ambassador=marketers.id left join bucket_list on ideas.id=bucket_list.ideaid where 1=1 and bucket_list.userid='".$_REQUEST['userid']."' order by bucket_list.id desc";
$GetUsersQryRs3=mysql_query($GetUsersQry3);
$Tot2=mysql_affected_rows();
?>
<?
if($_REQUEST['slide']=='1' || $_REQUEST['slide']=='')
{
	?>
	<div style="display:inline;margin-top:0px;" id="AVATAR_ID">

<div class="clearfix"  id="journey_book">
	<div class="journey_book"  onload="updatecolor1('journey_book');" style="display:inline;width:100%;float:left;text-align:left;">
		<div  width="100%" border="0" cellspacing="0" cellpadding="0">
			  
			<div style="line-height:32px;color:#FFFFFF;display:inline-block;width:90%;">&nbsp;<? echo $username;?></div>
			<div style="line-height:32px;color:#FFFFFF;display:inline-block;width:10%;float:right;"><img src="images/icon_like.png" style="margin-right:5px;width:40%;height:80%;margin-top:4%;" /><img src="images/icon_infinity.png" style="width:40%;height:80%;margin-top:4%;"  /></div>
			 
		</div>
	</div>
</div>

		<div style="height:35px;line-height:35px;background-color:#EFEFEE;width:100%;" >
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left" style="line-height:35px;width:70%;vertical-align:top"><? if($GetUsersQryRow['aboutme']!=''){?>&nbsp;<? echo stripslashes($GetUsersQryRow['aboutme']);?><? }?></td>
					<td align="right" style="line-height:35px;width:30%;vertical-align:top"><span id="MessageIdNew" style="color:#FF0000;font-size:1vw;"></span>
						<input onclick="SaveLikedTagged('<? echo $_SESSION['UsErIdFrOnT'];?>','<? echo $_REQUEST['userid'];?>','LIKE',this.checked);" type="checkbox" name="liked" id="liked" value="Y" <? echo GetLikeTaggedChecked($_SESSION[ 'UsErIdFrOnT'],$_REQUEST[ 'userid'], 'LIKE');?> />
						<input type="checkbox" onclick="SaveLikedTagged('<? echo $_SESSION['UsErIdFrOnT'];?>','<? echo $_REQUEST['userid'];?>','TAGGED',this.checked);" name="tagged" id="tagged" value="Y" <? echo GetLikeTaggedChecked($_SESSION[ 'UsErIdFrOnT'],$_REQUEST[ 'userid'], 'TAGGED');?> />&nbsp;&nbsp;
					</td>
				</tr>
			</table>

		</div>

	
		<div style="width:100%;height:46%;margin-top:1%;position:relative">
			<div style="z-index:1;   width:100%; height:100%;position:absolute;">
			</div>
		
			<div  style="width:40%;height:96%;margin-top:1.8%;z-index:3;position:absolute;margin-left:2%;" >
				<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" id="<? if($GetUsersQryRow['aboutme']!=''){?>middleavatarImg1<? }else{?>middleavatarImg2<? }?>" />
			</div>

		
			<div id="avatar_default" style="height:100%;width:100%;">
				<div style="height:50%;width:100%;">
					<div style="width:59%;height:100%;display:inline-block;margin-right:1%;">
					</div>

					<div style="width:39%;height:100%;display:block;position:relative; right: -50%; top: -100%;">
						<div style="height:100%; width:100%; z-index:1;position:relative;display:inline-block;">
						</div>
						<div  style="height:100%; width:95%;margin-left:5%; z-index:100;position:relative;display:inline-block; top: -95%;">
							<div class="status" style="" id="Graphs_BOTH">
								<span style="height: 10%;" class="blue_bar" id="Graphs_BOTH_1">&nbsp;</span><br/>
								<span style="height: 10%;" class="yellow_bar" id="Graphs_BOTH_2">&nbsp;</span><?php /*?> 097%<br /><?php */ ?><br/>
								<span style="height: 10%;" class="pink_bar" id="Graphs_BOTH_3">&nbsp;</span>
							</div>
							<div class="user_status" style="margin-top:7%;" id="Graphs_YOU">
								<div class="clearfix">
									<div style="height: 33%;line-height: 2;" class="user_box" id="Graphs_YOU_4">you</div>
									<div class="user_stat">
										<span style="height: 10%;" class="blue_bar" id="Graphs_YOU_2">&nbsp;</span><br/>
										<span style="height: 10%;" class="yellow_bar" id="Graphs_YOU_1">&nbsp;</span><br/>
										<span style="height: 10%;" class="pink_bar" id="Graphs_YOU_3">&nbsp;</span>
									</div>
								</div>
							</div>
							<div class="user_status" id="Graphs_ME" style="opacity:1;z-index:10;">
								<div class="clearfix" style="cursor:pointer">
									<div style="height: 33%;line-height: 2;" class="user_box" <? echo GetMyColor($_SESSION['UsErIdFrOnT']); ?>
										 onClick="Updatebox(<? echo $_SESSION['UsErIdFrOnT']; ?>,1);document.getElementById('CurrentSelectedUserId').value='<? echo $_SESSION['UsErIdFrOnT']; ?>';">
										me
									</div>
									<div class="user_stat">
										<span class="blue_bar" style="height: 10%; width:<? echo GetBar($_SESSION['UsErIdFrOnT'], 2); ?>%;">&nbsp;</span><br/>
										<span class="yellow_bar" style="height: 10%; width:<? echo GetBar($_SESSION['UsErIdFrOnT'], 1); ?>%;">&nbsp;</span><br/>
										<span class="pink_bar" style="height: 10%; width:<? echo GetBar($_SESSION['UsErIdFrOnT'], 3); ?>%;">&nbsp;</span>
									</div>
								</div>
							</div>

						</div></div></div>

				<div style="height:49%;width:100%;margin-top:1%;">
				</div>
			</div>
		</div>	<!-- end #detail_box -->

	</div>
	<div style="width:100%;height:43%;margin-top:1%;position:relative;">
		<div style="z-index:1;  width:100%; height:100%;position:absolute;">
		</div>
		<div style="z-index:3;width:100%; height:100%;position:absolute;">
			<div style="width:95%;margin-left:2.5%;height:100%;">
				<div align="left" style="font-size:1.5vw;width:80%;vertical-align:top;color:white;"><strong><? if($GetUsersQryRow['aboutme']!=''){?>&nbsp;<? echo stripslashes($GetUsersQryRow['aboutme']);?><? }?></strong></div>
				
				<div style="width:95%;margin-left:2.5%;height:100%;margin-top:4%;">
					<? if($GetUSerWantQryRow['my_gender']!=''){?>
						<? if($GetUSerWantQryRow['want_gender1']!='' && $GetUSerWantQryRow['lookingfor1']!=''){?>
							<h1 style="font-size:1vw;font-weight:normal;color:white;"><strong><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender1'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor1']);?></strong></h1>
						<? }?>
			
						<? if($GetUSerWantQryRow['want_gender2']!='' && $GetUSerWantQryRow['lookingfor2']!=''){?>
							<h1 style="font-size:1vw;font-weight:normal;color:white;margin-top:1%;"><strong><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender2'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor2']);?></strong></h1>
						<? }?>
						<? if($GetUSerWantQryRow['want_gender3']!='' && $GetUSerWantQryRow['lookingfor3']!=''){?>
							<h1 style="font-size:1vw;font-weight:normal;color:white;margin-top:1%;"><strong><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender3'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor3']);?></strong></h1>
						<? }?>
						<? if($GetUSerWantQryRow['want_gender4']!='' && $GetUSerWantQryRow['lookingfor4']!=''){?>
							<h1 style="font-size:1vw;font-weight:normal;color:white;margin-top:1%;"><strong><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender4'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor4']);?></strong></h1>
						<? }?>
						<? if($GetUSerWantQryRow['want_gender5']!='' && $GetUSerWantQryRow['lookingfor5']!=''){?>
							<h1 style="font-size:1vw;font-weight:normal;color:white;margin-top:1%;"><strong><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender5'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor5']);?></strong></h1>
						<? }?>
						<? if($GetUSerWantQryRow['want_gender6']!='' && $GetUSerWantQryRow['lookingfor6']!=''){?>
							<h1 style="font-size:1vw;font-weight:normal;color:white;margin-top:1%;"><strong><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender6'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor6']);?></strong></h1>
						<? }?>
					<? }?>
				</div>
				
			</div>
		</div>
	</div>

	<?
}
else if($_REQUEST['slide']=='2')
{
	?>
	<div <?php /*?>class="journal_section"<?php */?> style="display:inline;">
		<div class="clearfix">
			<div class="journey_book" style="display:inline;width:98%;float:left;text-align:left;font-size:16px;">&nbsp;<? echo $username;?></div>
		</div>
		<? if($GetUsersQryRow['aboutme']!=''){?>
			<div class="journal_section" style="padding:0px;margin:0px;padding-left:2%;padding-top:15px;" >
				<h1><? echo stripslashes($GetUsersQryRow['aboutme']);?></h1>
			</div>
		<? }?>
		<div class="journal_section"  style="padding:0px;margin:0px;padding-left:2%;padding-top:15px;">
			<? if($GetUSerWantQryRow['my_gender']!=''){?>
				<? if($GetUSerWantQryRow['want_gender1']!='' && $GetUSerWantQryRow['lookingfor1']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender1'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor1']);?></h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender2']!='' && $GetUSerWantQryRow['lookingfor2']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender2'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor2']);?></h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender3']!='' && $GetUSerWantQryRow['lookingfor3']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender3'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor3']);?></h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender4']!='' && $GetUSerWantQryRow['lookingfor4']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender4'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor4']);?></h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender5']!='' && $GetUSerWantQryRow['lookingfor5']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender5'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor5']);?></h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender6']!='' && $GetUSerWantQryRow['lookingfor6']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;"><? echo $GetUSerWantQryRow['my_gender'];?> seeks <? echo $GetUSerWantQryRow['want_gender6'];?> for <? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor6']);?></h1>
				<? }?>
			<? }?>
		</div>
	</div>
	<?
}
else if($_REQUEST['slide']=='11')
{
	?>

	<?
	$GetUsersQry3="SELECT * FROM Amb_pictures WHERE amb_id='".$_REQUEST['userid']."' ORDER BY id DESC";
	$GetUsersQryRs3=mysql_query($GetUsersQry3);
	$Tot3=mysql_affected_rows();
	$GetUsersQry4="SELECT marketers.amb_picture_main, marketers.firstname FROM marketers WHERE id='".$_REQUEST['userid']."' ORDER BY id DESC";
	$GetUsersQryRs4=mysql_query($GetUsersQry4);
	$GetUsersQryRow4=mysql_fetch_array($GetUsersQryRs4);
	$total=$Tot3 +1;
	?>
	<div class="container_pics" style="width:100%;height:100%;position:relative;">
		<div  style="width:60%;height:50%;position:relative;margin-left:20%;" class="photos">
       	    
			<img src="ambassador/<? echo$GetUsersQryRow4['amb_picture_main'];?>" style="width:100%;height:100%;">
			<div class"numbertext" style="margin-top:2%;font-size:24px;padding-left:45%;color:white;"> 1 / <?echo $total ?></div>
          
	</div>
	<?
	if($Tot3>0)
	{
		$counter=1;
		while($GetUsersQryRow3=mysql_fetch_array($GetUsersQryRs3))
		{
		
			$counter++;
			?>

  
			<div  style="width:60%;height:50%; display:none;position:relative;margin-left:20%;" class="photos">
       	   
				<img src="ambassador/<? echo$GetUsersQryRow3['picture'];?>" style="width:100%;height:100%;">
				<div class"numbertext" style="margin-top:2%;font-size:24px;padding-left:45%;color:white;"><?echo $counter ?> / <?echo $total ?></div>
           
			</div>
			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>
		<? }?>
       
	<? }?>
	<div style="height:30%; width:90%;margin-left:5%;margin-top:10%;">
		<div style="width:100%;font-size:30px;color:white;"><?echo $GetUsersQryRow4['firstname'];?></div>
		<div style="width:100%;font-size:20px;color:white;">want to know what to put in here</div>
		<div style="width:100%;height:60px; margin-top:3%;">
			<div style="width:60px; height:60px;display:inline-block;">
				<img style="width:60px; height:60px;" src="images/social-google-plus-icon.png" border="0">
			</div>
				
			<div style="width:60px; height:60px;display:inline-block;">
				<img style="width:60px; height:60px;" src="images/social-instagram-icon.png" border="0">
			</div>
			<div style="width:60px; height:60px;display:inline-block;">
				<img style="width:60px; height:60px;" src="images/social-skype-icon.png" border="0">
			</div>
			<div style="width:60px; height:60px;display:inline-block;">
				<img style="width:60px; height:60px;" src="images/social-WeChat-Icon.png" border="0">
			</div>
			<div style="width:60px; height:60px;display:inline-block;">
				<img style="width:60px; height:60px;" src="images/social-linkedin-icon.png" border="0">
			</div>
			<div style="width:60px; height:60px;display:inline-block;">
				<img style="width:60px; height:60px;" src="images/social-youtube-icon.png" border="0">
			</div>
			<div style="width:60px; height:60px;display:inline-block;">
				<img style="width:60px; height:60px;" src="images/social-vemeo-icon.png" border="0">
			</div>
				
			<div style="width:60px; height:60px;display:inline-block;">
				<img style="width:60px; height:60px;" src="images/social-pinterist-icon.png" border="0">
			</div>
			<div style="width:60px; height:60px;display:inline-block;">
				<img style="width:60px; height:60px;" src="images/social-twitter-icon.png" border="0">
			</div>
			<div style="width:60px; height:60px;display:inline-block;">
				<img style="width:60px; height:60px;" src="images/social-windows-icon.png" border="0">
			</div>
				
		</div>
	</div>
	</div>



<?
}
else if($_REQUEST['slide']=='10')
{
	?>
	<div id="other_list" style="width:100%; height:100%; display:block;" >
		<ul style="overflow:auto;height:100%;">
			<?
                	
			if($Tot2>0)
			{
			while($GetUsersQryRow3=mysql_fetch_array($GetUsersQryRs3))
			{
		 
				?>
				<li class="listItem2"  onclick="document.getElementById('id_bucket').value='<? echo $GetUsersQryRow3['id'];?>'">
					<div class="idea_info_left2">
						<span style="color:#FFFFFF;font-size:2vh;"><? echo date("l",strtotime($GetUsersQryRow3['startdate']));?></span>			<br />
						<span style="color:#FFFFFF;font-size:2vh;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow3['startdate']));?></span><br />
						<div style="font-size:12px;text-transform:none;">through</div>
						<span style="color:#FFFFFF;font-size:2vh;"><? echo date("l",strtotime($GetUsersQryRow3['enddate']));?></span><br />
						<span style="color:#FFFFFF;font-size:2vh;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow3['enddate']));?></span>
					</div>
					<div class="idea_pic2" onclick="setIdeaSelected(<? echo $GetUsersQryRow3['id']?>);ClickIdeas(<? echo $GetUsersQryRow3['id']?>);">
						<? if($GetUsersQryRow3['picture']!='' && file_exists("Ideas/".$GetUsersQryRow3['picture'])){?><img src="Ideas/<? echo $GetUsersQryRow3['picture'];?>" height="100%" width="100%" style="margin-top:0px;" /><? }else{?>&nbsp;<? } ?>
						<td width="35%" height="60px" style="vertical-align:top;">
					
					</div>
		
					<div class="idea_info_rigth2">
						<div style="width:100%;height:49%; background:black;position:relative;margin-bottom:1%;padding-top:3%;">
							<div class="row" style="min-height:20%;margin-top:2%; height:auto !important;">
								<span style="color:#999999;font-size:0.95vw;"><? echo stripslashes($GetUsersQryRow3['place']);?></span>
							</div>
							<div class="row" style="margin-top:3%;">
								<span style="color:#FFFFFF;font-size:1vw;"><? echo stripslashes($GetUsersQryRow3['title']);?></span>
							</div>
						</div>
						<div style="position:relative;width:39%;height:49%; display:inline-block;background:black;position:relative;"><? if($GetUsersQryRow3['amb_picture_main']!='' && file_exists("ambassador/".$GetUsersQryRow3['amb_picture_main'])){?>
								<img src="ambassador/<? echo$GetUsersQryRow3['amb_picture_main'];?>" height="90%" width="90%" style="margin-top:5%; margin-left:5%;" onclick="UpdateMiddleSection(<?echo $GetUsersQryRow3['ambassador']?>,'11');currentSlide(1);" border="0" /><? } ?>
			
						</div>
						<div style="color:#F88129;font-size:2vh;text-align:right;width:59%;display:inline-block;float:right;background:black;position:relative;height:49%;" >
							<div class="row" style="height:39%;"> </div>
							<div class="row" style="float:bottom;font-size:2.5vh;text-align:center;"> <span style="font-size:1.5vw;">$</span><strong><? echo stripslashes($GetUsersQryRow3['cost']);?></strong></div></div>
					</div>
	
					
			
				</li>
			
			<? }?>
		</ul>
		
		<? }else{?>
			<div  class="dashboard_whitetext">
				Bucketlist is empty.
			</div>
		<? }?>
	</div>




<?
}
else if($_REQUEST['slide']=='3')
{
	?>
	<div <?php /*?>class="journal_section"<?php */?> style="display:inline;">
		<div class="clearfix">
			<div class="journey_book" style="display:inline;width:98%;float:left;text-align:left;font-size:16px;">&nbsp;<? echo $username;?></div>
		</div>
		<? if($GetUsersQryRow['aboutme']!=''){?>
			<div class="journal_section" style="padding:0px;margin:0px;padding-left:2%;padding-top:15px;" >
				<h1><? echo stripslashes($GetUsersQryRow['aboutme']);?></h1>
			</div>
		<? }?>
		<div class="journal_section"  style="padding:0px;margin:0px;padding-left:2%;padding-top:15px;overflow:auto;height:85%;">
			<? if($GetUSerWantQryRow['my_gender']!=''){?>
				<h1 style="font-size:16px;font-weight:normal;">I am a <? echo $GetUSerWantQryRow['my_gender'];?></h1>
				<? if($GetUSerWantQryRow['want_gender1']!='' && $GetUSerWantQryRow['lookingfor1']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;">
						&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender1'];?>
						<br />&nbsp;&nbsp;&nbsp;&nbsp;for
						<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor1']);?>
					</h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender2']!='' && $GetUSerWantQryRow['lookingfor2']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;">and<br />
						&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender2'];?>
						<br />&nbsp;&nbsp;&nbsp;&nbsp;for
						<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor2']);?>
					</h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender3']!='' && $GetUSerWantQryRow['lookingfor3']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;">and<br />
						&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender3'];?>
						<br />&nbsp;&nbsp;&nbsp;&nbsp;for
						<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor3']);?>
					</h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender4']!='' && $GetUSerWantQryRow['lookingfor4']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;">and<br />
						&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender4'];?>
						<br />&nbsp;&nbsp;&nbsp;&nbsp;for
						<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor4']);?>
					</h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender5']!='' && $GetUSerWantQryRow['lookingfor5']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;">and<br />
						&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender5'];?>
						<br />&nbsp;&nbsp;&nbsp;&nbsp;for
						<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor5']);?>
					</h1>
				<? }?>
				<? if($GetUSerWantQryRow['want_gender6']!='' && $GetUSerWantQryRow['lookingfor6']!=''){?>
					<h1 style="font-size:16px;font-weight:normal;">and<br />
						&nbsp;&nbsp;&nbsp;&nbsp;seeking a <? echo $GetUSerWantQryRow['want_gender6'];?>
						<br />&nbsp;&nbsp;&nbsp;&nbsp;for
						<br />&nbsp;&nbsp;&nbsp;&nbsp;<? echo GetName1("lookingfor","name","id",$GetUSerWantQryRow['lookingfor6']);?>
					</h1>
				<? }?>
			<? }?>
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
						<h1><? echo $GRPNAME;?>

							<? //show lock icon only if the user have not sent the request to unlock?>
							<? if($getQuestionsQryRow['groupid']==3){?>
								<?
								$getIntimcayLockRequestQryRs=mysql_query("SELECT * FROM users_intimicy_lock_request WHERE userid_from='".$_SESSION['UsErIdFrOnT']."' and userid_to='".$_REQUEST['userid']."'");
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
									<a href="#" onclick="RequestIntimicyLock(<? echo $_SESSION['UsErIdFrOnT'];?>,<? echo $_REQUEST['userid'];?>);"><img src="images/lock.png" align="right" style="margin-top:-15px;margin-right:15px;" border="0" /></a><span style="font-size:11px;float:right;margin-right:15px;vertical-align:bottom;margin-top:16px;">CLICK LOCK TO REQUEST VIEW</span>
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

					<h1 style="font-size:16px;font-weight:normal;">
						<? echo stripslashes(GetName1("questions","question","id",$getQuestionsQryRow['questionid']));?>
						<br />&nbsp;&nbsp;&nbsp;&nbsp;
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
						<h1 style="font-size:16px;font-weight:normal;">
							<? echo stripslashes(GetName1("questions","question","id",$getQuestionsQryRow['questionid']));?>
							<br />&nbsp;&nbsp;&nbsp;&nbsp;
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
	<?
}
else if($_REQUEST['slide']=='12')
{
	$GetUsersQry4="SELECT marketers.about01 FROM marketers WHERE id=".$_REQUEST['userid'];
	$GetUsersQryRs4=mysql_query($GetUsersQry4);
	$GetUsersQryRow4=mysql_fetch_array($GetUsersQryRs4);
	?>
	<div style="font-size: 2.5vh;color: white;text-align: center;">
		<?echo $GetUsersQryRow4['about01'];?>
	</div>
<? }?>
