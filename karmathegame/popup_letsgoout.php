<? include("connect.php");
include("checklogin.php");
$GetUsersQry="SELECT * FROM users WHERE active='Y' and id='".mysql_real_escape_string($_REQUEST['id'])."' ORDER BY id DESC";
$GetUsersQryRs=mysql_query($GetUsersQry);
$GetUsersQryRow=mysql_fetch_array($GetUsersQryRs);
if($GetUsersQryRow['username']!=''){$username=stripslashes($GetUsersQryRow['username']);}else{$username=stripslashes($GetUsersQryRow['couponcode']);}
 $GetUsersQry2="SELECT ideas.startdate, ideas.enddate , ideas.picture , ideas.place , ideas.title , ideas.cost , marketers.amb_picture_main , bucket_list.* from ideas left join marketers on ideas.ambassador=marketers.id left join bucket_list on ideas.id=bucket_list.ideaid where 1=1 and bucket_list.userid='".$_SESSION['UsErIdFrOnT']."' order by bucket_list.id desc";
$GetUsersQryRs2=mysql_query($GetUsersQry2);
$Tot=mysql_affected_rows();

$GetUsersQry3="SELECT ideas.startdate, ideas.enddate , ideas.picture , ideas.place , ideas.title , ideas.cost , marketers.amb_picture_main , bucket_list.* from ideas left join marketers on ideas.ambassador=marketers.id left join bucket_list on ideas.id=bucket_list.ideaid where 1=1 and bucket_list.userid='".$_REQUEST['id']."' order by bucket_list.id desc";
$GetUsersQryRs3=mysql_query($GetUsersQry3);
$Tot2=mysql_affected_rows();
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
				<img src="images/outingWhiteFill.png" border="0"></img>
				</div>
				<div class="text_holder">
					let's go out!!!
				</div>
				<div class="icon_holder" style="float:right;">
				<a href="#" onclick="hide_pop();return false;"><img src="images/popup_close.png" border="0" /></a>
				</div>
				 
			</div>
					
</div>	<!-- the header ends -->
<div class="middlesection">
		<div class="centered_info" >
			<div class="text1"><strong><? echo $username;?></strong></div>
			<div class="avatar_pic">
				<img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt=""/>
			</div>
			<div class="container2">
				
				<div class="row" style="width:60%;">
					 <input type="radio" name="whomidea" id="whomidea_1" value="YOUR IDEA" checked="checked" onclick="control2(1);"/>&nbsp;<label for="whomidea_1" style="font-size:2vh;">YOUR IDEA</label>
					 <input type="radio" style="margin-left:5%;" name="whomidea" id="whomidea_2" value="MY IDEA" onclick="control2(2);"/>&nbsp;<label for="whomidea_2" style="font-size:2vh;">MY IDEA</label>
				</div>
				
	
				 <div id="other_list" class="ideaslist" style="display:inline-block;"  >
					 <ul>
					 <?if($Tot2>0){
						while($GetUsersQryRow3=mysql_fetch_array($GetUsersQryRs3))
						{?>
						<li class="listItem"  onclick="document.getElementById('id_bucket').value='<? echo $GetUsersQryRow3['id'];?>'">
							<div class="idea_info_left">
								<span style="color:#FFFFFF;font-size:1vw;"><? echo date("l",strtotime($GetUsersQryRow3['startdate']));?></span><br />
								<span style="color:#FFFFFF;font-size:2vh;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow3['startdate']));?></span><br />
								<div style="font-size:12px;text-transform:none;">through</div>
								<span style="color:#FFFFFF;font-size:2vh;"><? echo date("l",strtotime($GetUsersQryRow3['enddate']));?></span><br />
								<span style="color:#FFFFFF;font-size:2vh;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow3['enddate']));?></span>
							</div>
							
							<div class="idea_pic">
							<? if($GetUsersQryRow3['picture']!='' && file_exists("Ideas/".$GetUsersQryRow3['picture'])){?><img src="Ideas/<? echo $GetUsersQryRow3['picture'];?>" height="100%" width="100%" style="margin-top:0px;" /><? }else{?>&nbsp;<? } ?>
					<td width="35%" height="60px" style="vertical-align:top;">
					
							</div>
							
							<div class="idea_info_rigth">
								<div style="width:100%;height:50%; background:black;position:relative;margin-bottom:1%;">
								<span style="color:#999999;font-size:1.9vh;"><? echo stripslashes($GetUsersQryRow3['place']);?></span><br />
								<span style="color:#FFFFFF;font-size:1.8vh;"><? echo stripslashes($GetUsersQryRow3['title']);?></span><br />
					</div>
					<div style="position:relative;width:40%;height:49%; display:inline-block;background:black;position:relative;"><? if($GetUsersQryRow3['amb_picture_main']!='' && file_exists("ambassador/".$GetUsersQryRow3['amb_picture_main'])){?>		
			<img src="ambassador/<? echo$GetUsersQryRow3['amb_picture_main'];?>" height="90%" width="90%" style="margin-top:2%; margin-left:5%;" border="0" /><? } ?>
			
					</div>
					<div style="color:#F88129;font-size:2vh;text-align:right;width:59%;display:inline-block;float:right;background:black;position:relative;height:49%;" >
					<br /> <span style="font-size:1.2vh;text-align:center;">$</span><strong><? echo stripslashes($GetUsersQryRow3['cost']);?></strong></div>
							</div>
							<input style="position:absolute;transform: scale(1.5); top:10px;left:102%;"
 type="checkbox" class="checks" value="<? echo $GetUsersQryRow3['id'];?>" onclick="control3(<? echo $GetUsersQryRow3['id'];?>);document.getElementById('id_bucket').value='<? echo $GetUsersQryRow3['id'];?>';">
						</li>
						<? }?>
					</ul>	
					<? }else{?>	
					<div  class="whitetext">
						Bucketlist is empty.
					</div>
					<? }?>
           
				</div>
				 <div id="my_blist" class="ideaslist" style="display:none;" >
					 <ul>
					 <?if($Tot>0){
						while($GetUsersQryRow2=mysql_fetch_array($GetUsersQryRs2))
						{?>
						<li class="listItem"  onclick="document.getElementById('id_bucket').value='<? echo $GetUsersQryRow3['id'];?>'">
							<div class="idea_info_left">
								<span style="color:#FFFFFF;font-size:1.2vh;"><? echo date("l",strtotime($GetUsersQryRow2['startdate']));?></span><br />
								<span style="color:#FFFFFF;font-size:2vh;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow2['startdate']));?></span><br />
								<div style="font-size:12px;text-transform:none;">through</div>
								<span style="color:#FFFFFF;font-size:2vh;"><? echo date("l",strtotime($GetUsersQryRow2['enddate']));?></span><br />
								<span style="color:#FFFFFF;font-size:2vh;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow2['enddate']));?></span>
							</div>
							
							<div class="idea_pic">
							<? if($GetUsersQryRow2['picture']!='' && file_exists("Ideas/".$GetUsersQryRow3['picture'])){?><img src="Ideas/<? echo $GetUsersQryRow2['picture'];?>" height="100%" width="100%" style="margin-top:0px;" /><? }else{?>&nbsp;<? } ?>
					<td width="35%" height="60px" style="vertical-align:top;">
					
							</div>
							
							<div class="idea_info_rigth">
								<div style="width:100%;height:50%; background:black;position:relative;margin-bottom:1%;">
								<span style="color:#999999;font-size:1.9vh;"><? echo stripslashes($GetUsersQryRow2['place']);?></span><br />
								<span style="color:#FFFFFF;font-size:1.8vh;"><? echo stripslashes($GetUsersQryRow2['title']);?></span><br />
					</div>
					<div style="position:relative;width:40%;height:49%; display:inline-block;background:black;position:relative;"><? if($GetUsersQryRow2['amb_picture_main']!='' && file_exists("ambassador/".$GetUsersQryRow2['amb_picture_main'])){?>		
			<img src="ambassador/<? echo$GetUsersQryRow2['amb_picture_main'];?>" height="90%" width="90%" style="margin-top:2%; margin-left:5%;" border="0" /><? } ?>
			
					</div>
					<div style="color:#F88129;font-size:2vh;text-align:right;width:59%;display:inline-block;float:right;background:black;position:relative;height:49%;" >
					<br /> <span style="font-size:1.2vh;text-align:center;">$</span><strong><? echo stripslashes($GetUsersQryRow2['cost']);?></strong></div>
							</div>
						<input style="position:absolute;transform: scale(1.5); top:10px;left:102%;"
 type="checkbox" class="checks" value="<? echo $GetUsersQryRow2['id'];?>" onclick="control3(<? echo $GetUsersQryRow2['id'];?>);document.getElementById('id_bucket').value='<? echo $GetUsersQryRow2['id'];?>';">	
						</li>
						<? }?>
					</ul>	
					<? }else{?>	
					<div  class="whitetext">
						Bucketlist is empty.
					</div>
					<? }?>
           
				</div>
				<div class="radios2theright">
				<div class="row">
					<input style="font-size:1.2vh;" type="radio" name="outtype" id="outtype_1" value="DATE" checked="checked" onclick="document.getElementById('Hidouttype').value='DATE'"/>&nbsp;<label  style="font-size:100%;" for="outtype_1">DATE</label>
				</div>
					<div class="row">
					<input   type="radio" name="outtype" id="outtype_2" value="EVENT" onclick="document.getElementById('Hidouttype').value='EVENT'"/>&nbsp;<label  style="font-size:100%;" for="outtype_2">EVENT</label>
					</div>
					<div class="row">
					<input   style="font-size:2vh;"type="radio" name="outtype" id="outtype_3" value="GROUP" onclick="document.getElementById('Hidouttype').value='GROUP'"/>&nbsp;<label  style="font-size:100%;"for="outtype_3">GROUP</label>
					</div>	
				
				<div class="row" style="margin-top:5%;">
						<input type="radio" name="relationtype" id="relationtype_1" value="RELATIONSHIP" checked="checked" onclick="document.getElementById('Hidrelationtype').value='RELATIONSHIP'"/>&nbsp;<label  style="font-size:100%;" for="relationtype_1">RELATIONSHIP</label>
						</div>
						<div class="row">
										  <input type="radio" name="relationtype" id="relationtype_2" value="FRIENDSHIP" onclick="document.getElementById('Hidrelationtype').value='FRIENDSHIP'"/>&nbsp;<label  style="font-size:100%;" for="relationtype_2">FRIENDSHIP</label>
						</div>
					
				<div class="row" style="margin-top:5%;">
				
				 <div style="display:inline-block;font-size:100%;width:100%;">WHEN<input type="text" name="outdate"  id="outdate" placeholder="mm/dd/yyyy" onClick="displayCalendar(document.getElementById('outdate'),'mm/dd/yyyy',this);" style="width:50%;margin-left:5%;"/></div>
				
				</div>
				<div class="row" style="margin-top:5%;">
				<div  style="display:inline-block;font-size:100%;width:100%;">TIME<input id="goOutTime" type="text" name="outtime"  id="outtime" placeholder="6 to 8 pm"  style="width:50%;margin-left:8.9%;"/></div>
				</div>
				<div class="row" style="margin-top:5%;">
				<input type="radio" name="payby" id="payby_1" value="I WILL PAY" checked="checked" onclick="document.getElementById('Hidpayby').value='I WILL PAY'"/>&nbsp;<label for="payby_1">I'LL PAY</label>
				</div>
				<div class="row">
					<input type="radio" name="payby" id="payby_2" value="YOU PAY" onclick="document.getElementById('Hidpayby').value='YOU PAY'"/>&nbsp;<label for="payby_2">YOU PAY</label>
				</div>
				<div class="row">
					 <input type="radio" name="payby" id="payby_3" value="SPLIT" onclick="document.getElementById('Hidpayby').value='SPLIT'"/>&nbsp;<label for="payby_3">SPLIT</label>
				</div>										  <input type="radio" name="payby" id="payby_4" value="T.C. OF Y." onclick="document.getElementById('Hidpayby').value='T.C. OF Y.'"/>&nbsp;<label for="payby_4">T.C. OF Y.</label>
				</div>		
			</div>	
		</div>	
		</div>	
<div class="footer">
	<div class="centered_info">
		<input type="hidden" id="Hidouttype" name="Hidouttype" value="DATE" />
		<input type="hidden" id="Hidrelationtype" name="Hidrelationtype" value="RELATIONSHIP" />
		<input type="hidden" id="Hidwhomidea" name="Hidwhomidea" value="YOUR IDEA" />
		<input type="hidden" id="Hidpayby" name="Hidpayby" value="I WILL PAY" />
						
		<input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
		<input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
		<input type="hidden" id="id_bucket" name="id_bucket" value="" />
		
		
		<div class="button">
			<a href="#" onclick="hide_pop();return false;">
				<img src="images/button_close.png" border="0" />
			</a>
		</div>
		<div class="button">
			<input type="image" name="sendbutton" id="sendbutton"  src="images/button_send.png" align="top" onclick="return POPUPfrmcheck('goout');" /> 
		</div>
		
		
	</div>
</div>
</form>
</body>
</html>