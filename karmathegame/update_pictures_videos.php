<? include("connect.php");
include("checklogin.php");
if($_POST['Hidsubmit']=='1')
{
	if($_FILES["picture"]['tmp_name'])
	{
		$file=$_FILES["picture"];
		$send_name1=ereg_replace("[^A-Za-z0-9.]","_",$file["name"]);
		$filename1=rand().$send_name1;
		$filetoupload=$file['tmp_name'];
		$path="SafePicsVideos/".$filename1;
		copy($filetoupload,$path);
		
		$InsertUserQry="INSERT INTO users_pics_videos set 
			userid='".addslashes($_SESSION['UsErIdFrOnT'])."',
			type='".addslashes($_REQUEST['TYPE'])."',
			picture='".addslashes($filename1)."',
			ipaddress = '".get_client_ip()."',
			addeddate=now()";
		mysql_query($InsertUserQry);
	}
	header("location:update_pictures_videos.php?TYPE=".$_REQUEST['TYPE']."&msg=yes&userid_to=".$_REQUEST['userid_to']."");
	exit;
}
if($_POST['sharepics'])
{
	if(mysql_real_escape_string($_REQUEST['userid_to'])!='' && count($_POST['sharepiccheckbox'])>0)
	{
		$arrrr=$_POST['sharepiccheckbox'];
		for($aa=0;$aa<count($arrrr);$aa++)
		{
			$getusers_sociallinks_shareRs=mysql_query("SELECT * FROM users_pics_videos_share WHERE picid='".$arrrr[$aa]."' and userid_from='".$_SESSION['UsErIdFrOnT']."' and userid_to='".mysql_real_escape_string($_REQUEST['userid_to'])."'");
			$Totgetusers_sociallinks_share=mysql_affected_rows();
			if($Totgetusers_sociallinks_share<=0)
			{
				$InsertUserQry="INSERT INTO users_pics_videos_share set 
				picid='".addslashes($arrrr[$aa])."',
				userid_from='".$_SESSION['UsErIdFrOnT']."',
				userid_to='".mysql_real_escape_string($_REQUEST['userid_to'])."',
				addeddate=now()";
				mysql_query($InsertUserQry);
			}
		}
		$allids=implode(",",$_POST['sharepiccheckbox']);
		///ADD RECORD FOR MESSAGE TABLE
		$query = "insert into users_emails 
					 set 
					 userid_from = '".addslashes($_SESSION['UsErIdFrOnT'])."',
					 userid_to ='".mysql_real_escape_string($_REQUEST['userid_to'])."',
					 TYPE ='safe',
					 TYPE_TABLE ='users_pics_videos',
					 TYPE_TABLE_ID ='".addslashes($allids)."',
					 createdate =now(),
					 ipaddress = '".get_client_ip()."'";
		mysql_query($query) or die(mysql_error()); 
		///END OF ADD RECORD FOR MESSAGE TABLE	
	}	
	header("location:update_pictures_videos.php?TYPE=".$_REQUEST['TYPE']."&msg=yes&userid_to=".$_REQUEST['userid_to']."");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><? echo $SITE_TITLE;?></title>
	<link href="css/style_popups.css" rel="stylesheet" type="text/css" />
</head>
<body style="text-align:center;overflow:scroll;background:#5d4c46;">
<form name="frmpopup" id="frmpopup" enctype="multipart/form-data" method="post" style="width:100%;background-color:#5d4c46; font-size: 0vh;" >
	<div class="header">
		<div class="top_info">
			<div class="icon_holder">
				<img src="images/safeWhiteFill.png" border="0"></img>
			</div>
			<div class="text_holder" style="color: white;">
				SAFE
			</div>
			<div class="icon_holder"style="float:right;">
				<a href="#" onclick="hide_pop();"><img src="images/popup_close.png" border="0" /></a>
			</div>
		</div>
	</div>	<!-- the header ends -->

	<div class="middlesection">
		<div class="centered_info">
			<div style="width: 100%;padding-top: 2%; margin-bottom: 5%;display: flex;">
				<div style="width: 50%;">
					<? if($_REQUEST['msg']=='yes'){?>
						<div style="color:#FF0000">Uploaded Sucessfully!></div>
					<? }?>
					<div class="dashboard_whitetext" >Select <? echo $_REQUEST['TYPE'];?>:&nbsp;<input type="file" name="picture" id="picture" class="inputbox" style="color:#FFFFFF;"   />&nbsp;
							<input type="hidden" name="Hidsubmit" id="Hidsubmit" value="0" />
					</div>
				</div>
				<div style="width: 50%; float: right;">
					<input type="image" name="sendbutton" id="sendbutton"  src="images/button_upload.png"  onclick="return frmcheck();"  align="absmiddle"/>
					<a href="#" onclick="deleteShareMultimedia();">
						<img src="images/button_delete.png"  align="absmiddle" border="0" />
					</a>
				</div>
			</div>
			<div style="width: 100%;padding-top: 2%; display: flex;">
				<div style="width: 50%;">
					<?
					$getPicsQryRs=mysql_query("SELECT * FROM users_pics_videos WHERE userid='".$_SESSION['UsErIdFrOnT']."' and type='".$_REQUEST['TYPE']."' ORDER BY id DESC");
					$TotgetPics=mysql_affected_rows();
					if($TotgetPics>0)
					{
						?>
						<div id="shareMultimediaList">
							<?
							$TTT=0;
							while($getPicsQryRow=mysql_fetch_array($getPicsQryRs))
							{
								//if($TTT%6==0){echo "</tr><tr>";}
								?>
								<div align="center"  style="width:33%;float:left;">
									<? if($getPicsQryRow['type']=='Picture'){?>
										<img src="<? echo "SafePicsVideos/".$getPicsQryRow['picture'];?>" style="width:100%;height:100px;" />
									<? }?>
									<? if($getPicsQryRow['type']=='Video'){?>
										<img src="images/shareVideo.png" style="width:100%;height:100px;"/>
									<? }?>
									<? if($getPicsQryRow['type']=='Music'){?>
										<img src="images/shareMusic.png" style="width:100%;height:100px;"/>
									<? }?>
									<br />
									<input id="<?echo $getPicsQryRow['id']?>" type="checkbox" name="sharepiccheckbox[]" <? echo CheckEitherPICVIDEOShareOrNot($getPicsQryRow['id'],$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?> value="<? echo $getPicsQryRow['id'];?>" style="margin-top:10px;" />
									<br /><br />
								</div>
								<?
								$TTT++;
							}
							?></div>
					<? } ?>
				</div>
				<div style="width: 50%; float: right;">
					<h3>Uploaded <? echo $_REQUEST['TYPE'];?>s!</h3>
						<input onclick="shareMultimedia(<?echo $_SESSION['UsErIdFrOnT'].','.$_REQUEST['userid_to']?>);"
							   type="button" style="background-color: transparent;height: 50px;border: 1px solid white;
										color: white;padding: 15px 5px 15px 5px;text-align: center;
										text-decoration: none;display: inline-block;font-size: 20px;margin: 4px 2px;
										cursor: pointer;" value="SHARE WITH <? echo GetUserName($_REQUEST['userid_to']);?>" name="sharepics" id="sharepics" />
				</div>
			</div>
		</div>
	</div>

	<div class="footer"></div>

</form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script language="javascript">
	function frmcheck()
	{
		if (document.getElementById("picture").value=='')
		{
			alert("Please select file.");
			document.getElementById("picture").focus();
			return false;
		}
		document.getElementById('Hidsubmit').value='1';
		document.getElementById('sendbutton').submit();
		return true;
	}

	function shareMultimedia(userFrom, userTo) {
		var count = 0;
		var i = 0;
		var list =document.getElementById('shareMultimediaList');
		for (i=0; i < list.childElementCount; i++){
			if(list.children[i].children[2].checked){
				count++;
				jQuery.ajax({
					type: "POST",
					url: "util.php",
					data: {
						"method" : "sendMail",
						"typeTableId" :  list.children[i].children[2].id,
						"userIdFrom" : userFrom,
						"userIdTo" : userTo,
						"type" : 'safe',
						"typeTable" : 'users_pics_videos',
						"accepted" : 'N'
					},
					success: function(data){
						console.log(data);
					}
				});
				jQuery.ajax({
					type: "POST",
					url: "util.php",
					data: {
						"method" : "shareImage",
						"picId" :  list.children[i].children[2].id,
						"userIdFrom" : userFrom,
						"userIdTo" : userTo
					},
					success: function(data){
						console.log(data);
					}
				});
			}
		}
		if(count ==0){
			alert("Please select a picture or video to share");
		}else{
			alert("Shared Success");
		}
	}

	function deleteShareMultimedia() {
		var count = 0;
		var i = 0;
		var list =document.getElementById('shareMultimediaList');
		for (i=0; i < list.childElementCount; i++){
			if(list.children[i].children[2].checked){
				count++;
				jQuery.ajax({
					type: "POST",
					url: "util.php",
					data: {
						"method" : "DeleteShareMultimedia",
						"id" :  list.children[i].children[2].id
					},
					success: function(data){
						console.log(data);
					}
				});
			}
		}
		console.log(count);
		if(count != 0){
			alert("Delete Success");
			window.location.reload();
		}else{
			alert("Please, Select a element to delete");
		}
	}

	function hide_pop() {
		window.close();
	}
</script>
</body>
</html>