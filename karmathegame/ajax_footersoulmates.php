<?php
include("connect.php");
$allselected=$_REQUEST['allselected'];

$GetUsersQry3="SELECT ideas.startdate, ideas.enddate , ideas.picture , ideas.place , ideas.title , ideas.cost , marketers.amb_picture_main , bucket_list.* from ideas left join marketers on ideas.ambassador=marketers.id left join bucket_list on ideas.id=bucket_list.ideaid where 1=1 and bucket_list.userid='".$_REQUEST['id']."' order by bucket_list.id desc";
$GetUsersQryRs3=mysql_query($GetUsersQry3);
$Tot2=mysql_affected_rows();
if (strpos($allselected, "Infinity") !== false)
{
	$userid_to='';
	$getHidedusersQryRs=mysql_query("SELECT userid_to FROM  users_likes_tagged WHERE userid_from ='".$_SESSION['UsErIdFrOnT']."' and type='TAGGED'");
	$TotgetHidedusersQryRs=mysql_affected_rows();
	if($TotgetHidedusersQryRs>0)	
	{
		while($getHidedusersQryRow=mysql_fetch_array($getHidedusersQryRs))
		{
			$userid_to.=$getHidedusersQryRow['userid_to'].",";
		}	
		$userid_to=substr($userid_to,0,-1);
		$andQryHide.=" id in ($userid_to) OR";
	}
	else
	{
		$andQryHide.=" id in (9999999999999) OR";
	}
}

if (strpos($allselected, "ThumbsUp") !== false)
{
	$userid_to='';
	$getHidedusersQryRs=mysql_query("SELECT userid_to FROM  users_likes_tagged WHERE userid_from ='".$_SESSION['UsErIdFrOnT']."' and type='LIKE'");
	$TotgetHidedusersQryRs=mysql_affected_rows();
	if($TotgetHidedusersQryRs>0)	
	{
		while($getHidedusersQryRow=mysql_fetch_array($getHidedusersQryRs))
		{
			$userid_to.=$getHidedusersQryRow['userid_to'].",";
		}	
		$userid_to=substr($userid_to,0,-1);
		$andQryHide.=" id in ($userid_to) OR";
	}
	else
	{
		$andQryHide.=" id in (9999999999999) OR";
	}
}

if (strpos($allselected, "Heart") !== false)
{
	$userid_to='';$userid_from='';
	$getHidedusersQryRs=mysql_query("SELECT userid_from FROM  users_likes_tagged WHERE userid_to ='".$_SESSION['UsErIdFrOnT']."' ");
	$TotgetHidedusersQryRs=mysql_affected_rows();
	if($TotgetHidedusersQryRs>0)	
	{
		while($getHidedusersQryRow=mysql_fetch_array($getHidedusersQryRs))
		{
			$userid_from.=$getHidedusersQryRow['userid_from'].",";
		}	
		$userid_from=substr($userid_from,0,-1);
		$andQryHide.=" id in ($userid_from) OR";
	}
	else
	{
		$andQryHide.=" id in (9999999999999) OR";
	}
}
if($_REQUEST['type']=='Ideas' && $allselected!='')
{
	
	$GetUsersQry="SELECT ideas.*, marketers.amb_picture_main FROM ideas left join marketers on ideas.ambassador=marketers.id WHERE 1=1 ORDER BY id DESC";
	$GetUsersQryRs3=mysql_query($GetUsersQry);
	$Tot2=mysql_affected_rows();
	if($Tot2>0)
			{
		while($GetUsersQryRow3=mysql_fetch_array($GetUsersQryRs3))
		{
		
		?><li class="listItem2"  onclick="document.getElementById('id_bucket').value='<? echo $GetUsersQryRow3['id'];?>'">
				<div class="idea_info_left2" onclick="ClickIdeas(<? echo $GetUsersQryRow3['id']?>)">
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
									<div class="row" style="margin-top:5%;height:20%;min-height:20%;margin-top:2%;
height:auto !important;">
										<span style="color:#999999;font-size:0.95vw;"><? echo stripslashes($GetUsersQryRow3['place']);?></span>
									</div>
									<div class="row" style="margin-top:3%;">
										<span style="color:#FFFFFF;font-size:1vw;"><? echo stripslashes($GetUsersQryRow3['title']);?></span>
									</div>
								</div>
					<div style="position:relative;width:39%;height:49%; display:inline-block;background:black;position:relative;"><? if($GetUsersQryRow3['amb_picture_main']!='' && file_exists("ambassador/".$GetUsersQryRow3['amb_picture_main'])){?>		
			<img src="ambassador/<? echo$GetUsersQryRow3['amb_picture_main'];?>" height="90%" width="90%" style="margin-top:5%; margin-left:5%;" onclick="UpdateMiddleSection(<?echo $GetUsersQryRow3['ambassador']?>,'11');setbar(<?echo $GetUsersQryRow3['ambassador']?>);" border="0" /><? } ?>
			
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
	List is empty.
	</div>
	<? }?>
<? }else{?>

	<div class="photo_list">
						<ul class="clearfix" id="SoulmateboxID" style="height: 720px;">
	<?
	if($andQryHide!='')
	{
		$andQryHide=substr($andQryHide,0,-2);
		$andQryHide="and ($andQryHide)";
	}
	$GetUsersQry="SELECT id,avatarid FROM users WHERE active='Y' and id!='".$_SESSION['UsErIdFrOnT']."' $andQryHide group by id ORDER BY id DESC ";
	$GetUsersQryRs=mysql_query($GetUsersQry);
	$Tot=mysql_affected_rows();
	if($Tot>0)
	{
		while($GetUsersQryRow=mysql_fetch_array($GetUsersQryRs))
		{
		?>
		
			<li onClick="ClickAvatar2(<? echo $GetUsersQryRow['id']?>,'1');">
				<div class="icon_wrap" style="color:#ffffff;text-align:center;">
					<? echo GetUserName($GetUsersQryRow['id']);?>
					<?php /*?><a href="#" class="link_icon">Link</a> <a href="#" class="like_icon">Like</a><a href="#" class="fav_icon">Favourite</a><?php */?>
				</div>
				<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid']);?>" alt="" width="75" height="114" />
			</li>
		<? }?>
	<? }else{?>	
	No result found.
	<? }?>
	</div>
	</div>
	
	<div style="display:inline;z-index:500;float:left;width:38.35%;margin-right:4px;" id="bucket_middle"">
              <div  style="margin-top:0px;height:100%;overflow:auto;position:absolute;">
 <div id="other_list" style="width:100%; height:300px; display:block;" >
                	 <ul style="overflow:auto;height:100%;">
                	<?
                	
			if($Tot2>0)
			{
		while($GetUsersQryRow3=mysql_fetch_array($GetUsersQryRs3))
		{
		
		?><li  style="width:100%;  margin-top:10px;" onclick="document.getElementById('id_bucket').value='<? echo $GetUsersQryRow3['id'];?>'">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="display:inline-block;">
				  <tr>
					<td style="height:120px;background-color:gray;text-transform:uppercase;width:20%;" align="center" nowrap="nowrap">
						<span style="color:#FFFFFF;font-size:12px;"><? echo date("l",strtotime($GetUsersQryRow3['startdate']));?></span><br />
						<span style="color:#FFFFFF;font-size:20px;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow3['startdate']));?></span><br />
						<div style="font-size:12px;text-transform:none;">through</div>
						<span style="color:#FFFFFF;font-size:12px;"><? echo date("l",strtotime($GetUsersQryRow3['enddate']));?></span><br />
						<span style="color:#FFFFFF;font-size:20px;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow3['enddate']));?></span>
					</td>
					<td width="45%"><? if($GetUsersQryRow3['picture']!='' && file_exists("Ideas/".$GetUsersQryRow3['picture'])){?><img src="Ideas/<? echo $GetUsersQryRow3['picture'];?>" height="120" width="100%" style="margin-top:0px;" /><? }else{?>&nbsp;<? } ?></td>
					<td width="35%" height="60px">
					<div style="width:95%;height:60px;margin-left:10px;border-style:solid; border-color:black;height:50%; background:black;position:relative;margin-bottom:5px;">
					<span style="color:#999999;font-size:11px;"><? echo stripslashes($GetUsersQryRow3['place']);?></span><br />
					<span style="color:#FFFFFF;font-size:12px;"><? echo stripslashes($GetUsersQryRow3['title']);?></span><br />
					</div>
					<div style="position:relative;width:62px;height:62px; display:inline-block;margin-left:10px;background:black;position:relative;"><? if($GetUsersQryRow3['amb_picture_main']!='' && file_exists("ambassador/".$GetUsersQryRow3['amb_picture_main'])){?>		
			<img src="ambassador/<? echo$GetUsersQryRow3['amb_picture_main'];?>" height="52" width="52" style="margin-top:5px; margin-left:5px;" border="0" /><? } ?>
					</div>
					<div style="color:#F88129;font-size:24px;text-align:right;width:139.3;display:inline-block;float:right;background:black;position:relative;height:62px;" >
					<br /> <span style="font-size:12px;text-align:center;">$</span><strong><? echo stripslashes($GetUsersQryRow3['cost']);?></strong></div>
					</td>
					
				  </tr>
				</table>
			
			</li>
			
		<? }?>
		</ul>
	<? }?>
                    </div>
</div>
</div>
<? }?>