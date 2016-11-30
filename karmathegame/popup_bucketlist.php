<?php
include("connect.php");
 $GetUsersQry="SELECT ideas.*, marketers.amb_picture_main , bucket_list.* from ideas left join marketers on ideas.ambassador=marketers.id left join bucket_list on ideas.id=bucket_list.ideaid where 1=1 and bucket_list.userid='".$_SESSION['UsErIdFrOnT']."' order by bucket_list.id desc";
$GetUsersQryRs=mysql_query($GetUsersQry);
$Tot=mysql_affected_rows();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <link href="css/opening_styles.css">
    <title><? echo $SITE_TITLE; ?></title>
    <script language="javascript">
        function hide_pop() {
            document.getElementById('rightsidePOPUP_MAIN').style.display = 'none';
        }
    </script>
</head>
<body>
 <table style="text-align:center;margin-left:auto;margin-right:auto;" width="95%" cellspacing="0" cellpadding="0"
               border="0" align="center">
            <tr>
                <td class="bottmborder_white">
                    <br/>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>

                            <td width="8%" align="left">
                                <img src="images/icon_bucketlist.png" border="0">
                            </td>
                            <td width="52%">
                                <h1 style="text-align:left;">My Bucketlist</h1>
                            </td>
                          
                            <td width="10%" align="right">
                                <a href="#" onclick="hide_pop();return false;">
                                    <img src="images/popup_close.png" border="0">
                                    </a>
                            </td>
                        </tr>
                        
                         
                    </table>
                    <br/>
                 </td>
           </tr>
  </table>  
                    <br/>
                    <div style="width:95%;margin-left:auto;margin-left:2.5%; height:70%">
                	 <ul id="buckedList" style="overflow:auto;height:100%;">
                	<?
                	
			if($Tot>0)
			{
		while($GetUsersQryRow=mysql_fetch_array($GetUsersQryRs))
		{
		?>
			<li  style="width:60%;  margin-top:10px;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="display:inline-block;">
				  <tr>
					<td style="height:120px;background-color:gray;text-transform:uppercase;width:20%;" align="center" nowrap="nowrap">
						<span style="color:#FFFFFF;font-size:12px;"><? echo date("l",strtotime($GetUsersQryRow['startdate']));?></span><br />
						<span style="color:#FFFFFF;font-size:20px;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow['startdate']));?></span><br />
						<div style="font-size:12px;text-transform:none;">through</div>
						<span style="color:#FFFFFF;font-size:12px;"><? echo date("l",strtotime($GetUsersQryRow['enddate']));?></span><br />
						<span style="color:#FFFFFF;font-size:20px;font-weight:bold;"><? echo date("M d",strtotime($GetUsersQryRow['enddate']));?></span>
					</td>
					<td width="45%"><? if($GetUsersQryRow['picture']!='' && file_exists("Ideas/".$GetUsersQryRow['picture'])){?><img src="Ideas/<? echo $GetUsersQryRow['picture'];?>" height="120" width="100%" style="margin-top:0px;" /><? }else{?>&nbsp;<? } ?></td>
					<td width="35%" height="60px">
					<div style="width:95%;height:60px;margin-left:10px;border-style:solid; border-color:black;height:50%; background:black;position:relative;margin-bottom:5px;">
					<span style="color:#999999;font-size:11px;"><? echo stripslashes($GetUsersQryRow['place']);?></span><br />
					<span style="color:#FFFFFF;font-size:12px;"><? echo stripslashes($GetUsersQryRow['title']);?></span><br />
					</div>
					<div style="position:relative;width:62px;height:62px; display:inline-block;margin-left:10px;background:black;position:relative;"><? if($GetUsersQryRow['amb_picture_main']!='' && file_exists("ambassador/".$GetUsersQryRow['amb_picture_main'])){?>		
			<img src="ambassador/<? echo$GetUsersQryRow['amb_picture_main'];?>" height="52" width="52" style="margin-top:5px; margin-left:5px;" border="0" /><? } ?>
					</div>
					<div style="color:#F88129;font-size:24px;text-align:right;width:139.3;display:inline-block;float:right;background:black;position:relative;height:62px;" >
					<br /> <span style="font-size:12px;text-align:center;">$</span><strong><? echo stripslashes($GetUsersQryRow['cost']);?></strong></div>
					</td>
					<div style="width:20px; height:20px;display:inline-block;transform: translate(650px,30px);">
				<input id="<?echo $GetUsersQryRow['id'];?>" style="transform: scale(2); top:0px;"
 type="checkbox" name="checks[]" >
					</div>
				  </tr>
				</table>
			
			</li>
			
		<? }?>
		</ul>
		<br />
		<div style="right=0px; width:40%;padding-left:61%;pading-top:5%;">
		 <a href="#" onclick="deleteBunckedListElements(<?echo $_SESSION['UsErIdFrOnT'];?>)">
                                    <img src="images/button_delete.png" border="0" >
                                    </a>
		</div>

	<? }?>
                    </div>
                    

                    
</body>
</html>