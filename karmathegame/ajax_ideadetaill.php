<?php
include("connect.php");
$GetUsersQry="SELECT * FROM ideas WHERE id='".$_REQUEST['id']."' ORDER BY id DESC";
$GetUsersQryRs=mysql_query($GetUsersQry);
$GetUsersQryRow=mysql_fetch_array($GetUsersQryRs);


?>
<div id="ideas_middle"style="margin-top:0px;height:100%;overflow:auto;">
	<div class="clearfix">
		<div class="journey_book" style="display:inline;width:98%;float:left;text-align:left;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="left" style="line-height:32px;color:#FFFFFF;text-transform:none">&nbsp;<? echo stripslashes($GetUsersQryRow['title']);?></td>
			  </tr>
			</table>
		</div>
	</div>
	<div class="clearfix" style="margin-top:0px;" >
		<? if($GetUsersQryRow['picture']!='' && file_exists("Ideas/".$GetUsersQryRow['picture'])){?>
			<a <? if($GetUsersQryRow['link']!=''){?>href="<? echo stripslashes($GetUsersQryRow['link']);?>" target="_blank"<? }else{?> href="#"<? }?>><img src="Ideas/<? echo $GetUsersQryRow['picture'];?>" height="200" width="98%" style="margin-top:0px;" border="0" /></a>
		<? } ?>
	</div>
	<div class="clearfix" style="margin-top:0px;background-color:#252525;width:98%" >
	
		<table border="0" cellspacing="0" cellpadding="0" style="width:100%">
		  <tr>
			<td style="padding:5%;">
				<span style="color:#999999;font-size:12px;"><? echo stripslashes($GetUsersQryRow['place']);?></span><br />
				<span style="color:#FFFFFF;font-size:18px;"><strong><a style="color:#FFFFFF;font-size:18px;text-decoration:none;" <? if($GetUsersQryRow['link']!=''){?>href="<? echo stripslashes($GetUsersQryRow['link']);?>" target="_blank"<? }else{?> href="#"<? }?>><? echo stripslashes($GetUsersQryRow['title']);?></a></strong></span><br /><br />
				
				<?
				$descrr=stripslashes($GetUsersQryRow['description']);
				$descrr=str_replace("<a ","<a style='color:#ffffff;' target='_blank' ",$descrr);
				?>
				<span style="color:#FFFFFF;font-size:14px;"><? echo $descrr;?></span>
			</td>
		  </tr>
		  <tr>
			<td style="padding:5%;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="left">
						<span style="color:#F88129;font-size:15px;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow['startdate']));?></span><br />
						<div style="color:#F88129;font-size:12px;text-transform:none;">through</div>
						<span style="color:#F88129;font-size:15px;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow['enddate']));?></span>
					</td>
					<td align="right">	
						
			
						
						<div style="color:#F88129;font-size:32px;text-align:right;" >
				
		
						<span style="font-size:20px;">$</span><strong><? echo stripslashes($GetUsersQryRow['cost']);?></strong>
						</div>
					</td>
				  </tr>
				</table>

			</td>
		  </tr>
		</table>

	</div>
</div>



