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
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="170" align="left" valign="top" >
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left" valign="top" class="whitetext" height="40"><h2><? echo $username;?></h2></td>
						  </tr>
						  <tr>
							<td align="center" height="250" valign="middle" style="background-color:#FFFFFF;" ><img src="<? echo GetAvatarImage($GetUsersQryRow['avatarid'],'big');?>" alt="" width="150"  /></td>
						  </tr>
						</table>
					</td>
					<td   align="left" valign="top" style="padding-left:60px;" class="whitetext">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  
						  <tr>
								<td>
									<table border="0" cellspacing="0" cellpadding="0">
								  	    <tr>
										  <td  class="whitetext">
										  <input type="radio" name="outtype" id="outtype_1" value="DATE" checked="checked" onclick="document.getElementById('Hidouttype').value='DATE'"/>&nbsp;<label for="outtype_1">DATE</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  <input type="radio" name="outtype" id="outtype_2" value="EVENT" onclick="document.getElementById('Hidouttype').value='EVENT'"/>&nbsp;<label for="outtype_2">EVENT</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
										  <input type="radio" name="outtype" id="outtype_3" value="GROUP" onclick="document.getElementById('Hidouttype').value='GROUP'"/>&nbsp;<label for="outtype_3">GROUP</label> </td>
										</tr>   
									</table>
						  	</td>
						 </tr>
						 <tr>
								<td style="padding-top:15px;">
									<table border="0" cellspacing="0" cellpadding="0">
								  	    <tr>
										  <td  class="whitetext">
										  <input type="radio" name="relationtype" id="relationtype_1" value="RELATIONSHIP" checked="checked" onclick="document.getElementById('Hidrelationtype').value='RELATIONSHIP'"/>&nbsp;<label for="relationtype_1">RELATIONSHIP</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  <input type="radio" name="relationtype" id="relationtype_2" value="FRIENDSHIP" onclick="document.getElementById('Hidrelationtype').value='FRIENDSHIP'"/>&nbsp;<label for="relationtype_2">FRIENDSHIP</label>
										  			  	
						 </tr>
										  </td>
							
										</tr>   
									</table>
						  	</td>
						  
						 <tr>
								<td style="padding-top:15px;">
									<table border="0" cellspacing="0" cellpadding="0">
								  	    <tr>
										  <div style="display:inline-block;" class="whitetext">WHEN <input type="text" name="outdate"  id="outdate" placeholder="mm/dd/yyyy" onClick="displayCalendar(document.getElementById('outdate'),'mm/dd/yyyy',this);" style="width:100px;"/></div>
										  
										   <div  style="display:inline-block;margin-left:50px;" class="whitetext">TIME <input id="goOutTime" type="text" name="outtime"  id="outtime" placeholder="6 to 8 pm"  style="width:100px;"/></div>
										   
									     </tr>
										  <tr>
										  <td  class="whitetext" style="padding-top:15px;">
											  <input type="radio" name="whomidea" id="whomidea_1" value="YOUR IDEA" checked="checked" onclick="control2(1);"/>&nbsp;<label for="whomidea_1">YOUR IDEA</label>&nbsp;&nbsp;&nbsp;&nbsp;
											  <input type="radio" style="margin-left:50px;" name="whomidea" id="whomidea_2" value="MY IDEA" onclick="control2(2);"/>&nbsp;<label for="whomidea_2">MY IDEA</label>
										  </td>
										</tr>   
									</table>
						  	</td>
						 </tr>
						 <tr>
								<td style="padding-top:15px; ">
									    <div id="other_list" style="width:85%; height:300px; display:block;" >
                	 <ul style="overflow:auto;height:100%;">
                	<?
                	
			if($Tot2>0)
			{
		while($GetUsersQryRow3=mysql_fetch_array($GetUsersQryRs3))
		{
		
		?><li style="width:100%;height:100px;border:none;margin-bottom:10px;background:none;position:relative;vertical-align: top;"  onclick="document.getElementById('id_bucket').value='<? echo $GetUsersQryRow3['id'];?>'">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="display:inline-block;">
				  <tr>
					<td style="height:120px;background-color:gray;text-transform:uppercase;width:20%;" align="center" vertical-align:top;nowrap="nowrap">
						<span style="color:#FFFFFF;font-size:12px;"><? echo date("l",strtotime($GetUsersQryRow3['startdate']));?></span><br />
						<span style="color:#FFFFFF;font-size:20px;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow3['startdate']));?></span><br />
						<div style="font-size:12px;text-transform:none;">through</div>
						<span style="color:#FFFFFF;font-size:12px;"><? echo date("l",strtotime($GetUsersQryRow3['enddate']));?></span><br />
						<span style="color:#FFFFFF;font-size:20px;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow3['enddate']));?></span>
					</td>
					<td style="vertical-align:top;" width="45%"><? if($GetUsersQryRow3['picture']!='' && file_exists("Ideas/".$GetUsersQryRow3['picture'])){?><img src="Ideas/<? echo $GetUsersQryRow3['picture'];?>" height="120" width="100%" style="margin-top:0px;" /><? }else{?>&nbsp;<? } ?></td>
					<td width="35%" height="60px" style="vertical-align:top;">
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
				<input style="position:absolute;transform: scale(2); top:10px;left:102%;"
 type="checkbox"  class="checks" id="<? echo $GetUsersQryRow3['id'];?>" onclick="control3(<? echo $GetUsersQryRow3['id'];?>);document.getElementById('id_bucket').value='<? echo $GetUsersQryRow3['id'];?>';" >
			</li>
			
		<? }?>
		</ul>
		
	<? }else{?>	
	<div  class="whitetext">
	Bucketlist is empty.
	</div>
	<? }?>
                    </div>
		
							    <div id="my_blist" style="width:87%; height:300px;display:none;">
                	 <ul style="overflow:auto;height:100%;">
                	<?
                	
			if($Tot>0)
			{
		while($GetUsersQryRow2=mysql_fetch_array($GetUsersQryRs2))
		{
		?><li  style="width:100%;height:100px;border:none;margin-bottom:10px;background:none;position:relative;vertical-align: top;"  >
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="display:inline-block;">
				  <tr>
					<td style="height:120px;background-color:gray;text-transform:uppercase;width:20%;" align="center" nowrap="nowrap">
						<span style="color:#FFFFFF;font-size:12px;"><? echo date("l",strtotime($GetUsersQryRow2['startdate']));?></span><br />
						<span style="color:#FFFFFF;font-size:20px;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow2['startdate']));?></span><br />
						<div style="font-size:12px;text-transform:none;">through</div>
						<span style="color:#FFFFFF;font-size:12px;"><? echo date("l",strtotime($GetUsersQryRow2['enddate']));?></span><br />
						<span style="color:#FFFFFF;font-size:20px;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow2['enddate']));?></span>
					</td>
					<td width="45%"><? if($GetUsersQryRow2['picture']!='' && file_exists("Ideas/".$GetUsersQryRow2['picture'])){?><img src="Ideas/<? echo $GetUsersQryRow2['picture'];?>" height="120" width="100%" style="margin-top:0px;" /><? }else{?>&nbsp;<? } ?></td>
					<td width="35%" height="60px">
					<div style="width:95%;height:60px;margin-left:10px;border-style:solid; border-color:black;height:50%; background:black;position:relative;margin-bottom:5px;">
					<span style="color:#999999;font-size:11px;"><? echo stripslashes($GetUsersQryRow2['place']);?></span><br />
					<span style="color:#FFFFFF;font-size:12px;"><? echo stripslashes($GetUsersQryRow2['title']);?></span><br />
					</div>
					<div style="position:relative;width:62px;height:62px; display:inline-block;margin-left:10px;background:black;position:relative;"><? if($GetUsersQryRow2['amb_picture_main']!='' && file_exists("ambassador/".$GetUsersQryRow2['amb_picture_main'])){?>		
			<img src="ambassador/<? echo$GetUsersQryRow2['amb_picture_main'];?>" height="52" width="52" style="margin-top:5px; margin-left:5px;" border="0" /><? } ?>
					</div>
					<div style="color:#F88129;font-size:24px;text-align:right;width:139.3;display:inline-block;float:right;background:black;position:relative;height:62px;" >
					<br /> <span style="font-size:12px;text-align:center;">$</span><strong><? echo stripslashes($GetUsersQryRow2['cost']);?></strong></div>
					</td>
					
				  </tr>
				</table>
			<input style="position:absolute;transform: scale(2); top:10px;left:102%;"
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
		
		
		
		
						  		</td>
						 </tr>
						 <tr>
								<td style="padding-top:15px;">
									<table border="0" cellspacing="0" cellpadding="0">
								  	    <tr>
										  <td  class="whitetext">
										  <input type="radio" name="payby" id="payby_1" value="I WILL PAY" checked="checked" onclick="document.getElementById('Hidpayby').value='I WILL PAY'"/>&nbsp;<label for="payby_1">I'LL PAY</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  <input type="radio" name="payby" id="payby_2" value="YOU PAY" onclick="document.getElementById('Hidpayby').value='YOU PAY'"/>&nbsp;<label for="payby_2">YOU PAY</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  <input type="radio" name="payby" id="payby_3" value="SPLIT" onclick="document.getElementById('Hidpayby').value='SPLIT'"/>&nbsp;<label for="payby_3">SPLIT</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  <input type="radio" name="payby" id="payby_4" value="T.C. OF Y." onclick="document.getElementById('Hidpayby').value='T.C. OF Y.'"/>&nbsp;<label for="payby_4">T.C. OF Y.</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  </td>
										</tr>   
									</table>
						  	</td>
						 </tr>
						 <tr>
							<td align="left" style="padding-top:20px;">
							<input type="hidden" id="Hidouttype" name="Hidouttype" value="DATE" />
							<input type="hidden" id="Hidrelationtype" name="Hidrelationtype" value="RELATIONSHIP" />
							<input type="hidden" id="Hidwhomidea" name="Hidwhomidea" value="YOUR IDEA" />
							<input type="hidden" id="Hidpayby" name="Hidpayby" value="I WILL PAY" />
						
							<input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
							<input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
							<input type="hidden" id="id_bucket" name="id_bucket" value="" />
							<input type="image" name="sendbutton" id="sendbutton"  src="images/send-button.png" align="top" onclick="return POPUPfrmcheck('goout');" /> <a href="#" onclick="hide_pop();return false;"><img src="images/close-button.png" border="0" /></a>
							<span id="MessageId" style="color:#FF0000;"></span>
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
		<input type="hidden" id="Hidouttype" name="Hidouttype" value="DATE" />
		<input type="hidden" id="Hidrelationtype" name="Hidrelationtype" value="RELATIONSHIP" />
		<input type="hidden" id="Hidwhomidea" name="Hidwhomidea" value="YOUR IDEA" />
		<input type="hidden" id="Hidpayby" name="Hidpayby" value="I WILL PAY" />
						
		<input type="hidden" id="userid_to" name="userid_to" value="<? echo mysql_real_escape_string($_REQUEST['id']);?>" />
		<input type="hidden" id="userid_from" name="userid_from" value="<? echo $_SESSION['UsErIdFrOnT'];?>" />
		<input type="hidden" id="id_bucket" name="id_bucket" value="" />
		
		
		<div class="button">
			<a href="#" onclick="hide_pop();return false;">
				<img src="images/close-button.png" border="0" />
			</a>
		</div>
		<div class="button">
			<input type="image" name="sendbutton" id="sendbutton"  src="images/send-button.png" align="top" onclick="return POPUPfrmcheck('goout');" /> 
		</div>
		
		
	</div>
</div>


</form>
</body>
</html>