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
	header("location:update_pictures_videos.php?TYPE=".$_REQUEST['TYPE']."&color1=".$_REQUEST['color1']."&msg=yes&userid_to=".$_REQUEST['userid_to']."");
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
	header("location:update_pictures_videos.php?TYPE=".$_REQUEST['TYPE']."&color1=".$_REQUEST['color1']."&msg=yes&userid_to=".$_REQUEST['userid_to']."");
	exit;
}
?>
<!DOCTYPE html >
<html >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><? echo $SITE_TITLE;?></title>
	<link href="css/style_popups.css" rel="stylesheet" type="text/css" />
</head>
<body id="pad_newlife" style="overflow:auto;background:<? echo $_REQUEST['color1'];?>;">
<form name="frmpopup" id="frmpopup" enctype="multipart/form-data" method="post" style="height:100%;color:white; height:100%; " >
	<div class="header">
		<div class="top_info" style="padding-bottom:0.1%;">
			<div class="icon_holder" style="float:left;">
				<img src="images/icon_safe.png" border="0" ></img>
			</div>
			<div class="text_holder" style="color: white;font-size:3.5vw;">
				safe
			</div>
			
		</div>
	</div>	<!-- the header ends -->

	<div class="row" style="height:40%;">
		<div class="centered_info">
			<div class="row" style="height:20%;margin-top:1%;">
				<div style="width:10%;height:100%;display:inline-block;font-size:1.5vw;">
					Select <? echo $_REQUEST['TYPE'];?>
					
				</div>
				<div style="width:30%;height:100%;display:inline-block;">
					
					<input style="width:100%;" type="file" name="picture" id="picture"/>
					<input  type="hidden" name="Hidsubmit" id="Hidsubmit" value="0" />
				</div>
				<div style="width:10%;height:100%;display:inline-block;">
					
						<input style="width:100%;height:100%;"type="image" name="sendbutton" id="sendbutton"  src="images/button_upload.png"  onclick="return frmcheck();"  align="absmiddle"/>
					
			</div>
				
				
				<div style="width:10%;height:100%;display:inline-block;">
					
					<a href="#" onclick="deleteShareMultimedia();">
						<img src="images/button_delete.png"  style="width:100%;height:100%;" align="absmiddle" border="0" />
					</a>	
					
				</div>
				<div class="row"padding-top: 2%; height:10%;">
									<? if($_REQUEST['msg']=='yes'){?>
						<div style="color:#FF0000;width:20%;font-size:1vw;">Uploaded Sucessfully!</div>
					<? }?>
				</div>
				
				</div>
		</div>
			
				
			
	

		
	
		
		<div class="row" style=" display:block; height:60%;overflow: auto;position:absolute;">
		<?$getPicsQryRs=mysql_query("SELECT * FROM users_pics_videos WHERE userid='".$_SESSION['UsErIdFrOnT']."' and type='".$_REQUEST['TYPE']."' ORDER BY id DESC");
				$TotgetPics=mysql_affected_rows();{
		?>
			<div id="shareMultimediaList" style="width:100%;height:100%;">
				<?while($getPicsQryRow=mysql_fetch_array($getPicsQryRs))
						{?>
						
							<? if($getPicsQryRow['type']=='Picture'){?>
							<div align="center"  style="width:12.5%;float:left; height:180px;">
								<img src="<? echo "SafePicsVideos/".$getPicsQryRow['picture'];?>" style="width:100%;height:150px;" />
								<input  class="item" id="<?echo $getPicsQryRow['id']?>" type="checkbox" name="sharepiccheckbox[]" <? echo CheckEitherPICVIDEOShareOrNot($getPicsQryRow['id'],$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?> value="<? echo $getPicsQryRow['id'];?>" style="margin-top:5px;" />
							</div> 
								
							<? }?>
							<? if($getPicsQryRow['type']=='Video'){?>
							<div align="center"  style="width:12.5%;float:left; height:180px;">
								<video width="100%" height="160px" style="padding:4px;color:black;background:black;" controls>
								<source src="<? echo "SafePicsVideos/".$getPicsQryRow['picture'];?>" type="video/<? echo  pathinfo("SafePicsVideos/".$getPicsQryRow['picture'], PATHINFO_EXTENSION);?>"/> 
								</video>
								<input  class="item" id="<?echo $getPicsQryRow['id']?>" type="checkbox" name="sharepiccheckbox[]" <? echo CheckEitherPICVIDEOShareOrNot($getPicsQryRow['id'],$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?> value="<? echo $getPicsQryRow['id'];?>" style="margin-top:5px;" />
								</div> 
							<? }?>
								
							<? if($getPicsQryRow['type']=='Music'){?>
							<div class="row" style="width:95%;height:7%;padding-left:5%;padding-top:0.1%;margin-bottom:0.5%;">
							 <input class="item" id="<?echo $getPicsQryRow['id']?>" type="checkbox" name="sharepiccheckbox[]" <? echo CheckEitherPICVIDEOShareOrNot($getPicsQryRow['id'],$_SESSION['UsErIdFrOnT'],mysql_real_escape_string($_REQUEST['userid_to']));?> value="<? echo $getPicsQryRow['id'];?>" style="margin-top:5px; display:inline-block;    -ms-transform: translate(0%, -45%);
    -webkit-transform: translate(0%, -45%);
    transform: translate(0%, -45%);" />
								<img src="images/icon_headset.png" style="width:1.5%;height:100%;display:inline-block" onclick="Playsong('<? echo $getPicsQryRow['picture'];?>');" ondblclick="Stopsong();"   />								
								 <div onclick="Playsong('<? echo $getPicsQryRow['picture'];?>');" ondblclick="Stopsong();"  style="height:100%;padding-top:1%;width:40%;color:white;font-size:1.1vw;overflow:hidden;display:inline-block;font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;line-height:100%;"><div style="height:80%; float:bottom;margin-bottom:1%;padding-top:0.9%;"><? echo $getPicsQryRow['picture'];?></div></div>
								
								
							</div>  	
							<? }?>
						

							
							
						
						<? } ?>
			</div>
		<? } ?>	
		</div>
	
	
	<div class="row" style="height:10%;position:absolute;bottom:0;">

			<div class="centered_info">
			<div class="button" style="width:10%;" >
				<a href="#" onclick="hide_pop();return false;">
			 		<img src="images/button_close.png" border="0" />
				</a>
			</div>
			<div class="button" style="width:20%;">
				<input onclick="shareMultimedia(<?echo $_SESSION['UsErIdFrOnT'].','.$_REQUEST['userid_to']?>);"
							   type="button" style="background-color: transparent;height: 99%;border: 1px solid white;
										color: white;padding: 5% 10% 4.2% 10%;text-align: center;
										text-decoration: none;display: inline-block;font-size: 1vw;
										cursor: pointer;" value="SHARE WITH <? echo GetUserName($_REQUEST['userid_to']);?>" name="sharepics" id="sharepics" />
			</div>
			<audio tabindex="0" id="songs">
		<source src='music/looperman-l-0782612-0087385-40a-soul-link.wav'>
			</audio>
		</div>	
	</div>
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
	function getext(url)
	{
	return("video/"+url.substr(id.length - 3));
	}
	function Playsong(songname) {
		var thissound = document.getElementById('songs');
		thissound.pause();
		thissound.currentTime = 0;
		document.getElementById('songs').src="SafePicsVideos/"+songname;
		thissound.addEventListener('ended', function () {
			this.currentTime = 0;
			this.play();
		}, false);
		thissound.play();
	}
	function Stopsong()
	{
	var thissound = document.getElementById('songs');
		thissound.pause();
		thissound.currentTime = 0;
	}
	function shareMultimedia(userFrom, userTo) {
		var count = 0;
		var i = 0;
		var list =document.getElementsByClassName('item');
		
		for (i=0; i < list.length; i++){
			if(list[i].checked){
				count++;
				jQuery.ajax({
					type: "POST",
					url: "util.php",
					data: {
						"method" : "sendMail",
						"typeTableId" :  list[i].id,
						"userIdFrom" : userFrom,
						"userIdTo" : userTo,
						"type" : 'safe',
						"typeTable" : 'users_pics_videos',
						"accepted" : 'N',
						
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
						"picId" :  list[i].id,
						"userIdFrom" : userFrom,
						"userIdTo" : userTo,
						
						
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
		var list =document.getElementsByClassName('item');
		for (i=0; i < list.length; i++){
			if(list[i].checked){
				count++;
				jQuery.ajax({
					type: "POST",
					url: "util.php",
					data: {
						"method" : "DeleteShareMultimedia",
						"id" :  list[i].id
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