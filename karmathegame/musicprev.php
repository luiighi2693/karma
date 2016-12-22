<? include("connect.php"); 
include("checklogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><? echo $SITE_TITLE;?></title>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery.tools.scrollable.min.js" type="text/javascript" charset="utf-8" ></script>
<script src="js/jquery.tools.scrollable2.min.js" type="text/javascript" charset="utf-8" ></script>
</head>
<style type="text/css" media="screen">
.SliderName_2Description {
	padding: 10px;
	font-family: Tahoma,Arial,Helvetica;
	font-size: 14px;
	letter-spacing: 1px;
	text-align: left;
	color: #ffffff;
	text-shadow: 0 1px 3px #000000;
	bottom:25px;
	position:absolute;
	z-index:88888;
	background-color:#666666;
	opacity: 0.5;
	filter: alpha(opacity=50);
	height:70px;
	width:97.5%;
	line-height:30px;
}
.centered_info
{
	width:95%;
	height:90%;
	margin-left:2.5%;
	
       
}
.SliderNamePrev_2 {
background: url(images/tab_back_big.png) no-repeat left center;
	width: 50px;
	height: 650px;
	display: block;
	position: absolute;
	top: 0;
	left: 0;
	text-decoration: none;
	z-index:88888;
	cursor:pointer;
}
.SliderNameNext_2 {
	background: url(images/tab_forward_big.png) no-repeat right center;
	width: 50px;
	height: 650px;
	display: block;
	position: absolute;
	top: 0;
	right: 10px;
	text-decoration: none;
	z-index:88888;cursor:pointer;
}
.button
{
	height:80%;
	width:10%;
	display:inline-block;
	float:right;
}
.button input{
	width:100%;
	height:100%;
}

.button img{
	width:100%;
	height:100%;
	margin-top:10%;
}
div.scrollable div.items { 
    width:100%;    position:absolute; 

	height:100%;
} 
div.scrollable { 
    position:relative; 
    overflow:hidden; 
    width: 100%; 
    height:600px;
    margin:auto;
} 
div.scrollcontain {
	overflow:auto;
	clear:both;
}
.row
{
	width:100%;
	height:5%;
	margin-top:1%;
}
</style>
<body style=" z-index:10;">
<div style="width:99%;height:98%;z-index:0;position:absolute;">
<video  autoplay loop src="anim_backgrounds/Volcano.mp4" type="video/mp4" style="width:100%;height:100%;background-size:100% 100%;  object-fit: inherit;" />

</div>
<div class="scrollcontain" style="z-index:11;"> 
<audio tabindex="0" id="songs"  onended="automatic();">
		<source src='music/looperman-l-0782612-0087385-40a-soul-link.wav'>
</audio>
<div class="SliderName_2Description"  style="background:none;opacity: 1;filter: alpha(opacity=100);z-index:88889;">
	<div class="centered_info">
	<div class="button">
			<a href="#" onclick="window.close();return false;">
				<img src="images/button_close.png" border="0" />
			</a>
		</div
	</div>
</div>
</div>
<div class="SliderName_2Description"  style="background:<? echo $_REQUEST['color1'];?>;">
	<? echo GetUserName(mysql_real_escape_string($_REQUEST['userid_from']));?><br /><? echo 		stripslashes(GetName1("users","aboutme","id",mysql_real_escape_string($_REQUEST['userid_from'])));?>
</div>
 
	<div class="scrollable" id="scrollable_ID">
		<div id="items" class="items" >
			<div style="height=80%;width:30%;margin-left:7%;margin-top:10%;">
				 <?  $GetsharedPicRs=mysql_query("SELECT * FROM users_pics_videos_share WHERE  userid_from='".mysql_real_escape_string($_REQUEST['userid_from'])."' and userid_to='".mysql_real_escape_string($_REQUEST['userid_to'])."'");
		  $TotGetsharedPicRs=mysql_affected_rows();
		  if($TotGetsharedPicRs>0)
		  {
			  $sharedid='';
			 
			  while($GetsharedPicRow=mysql_fetch_array($GetsharedPicRs))
			  {
				$sharedid.=$GetsharedPicRow['picid'].",";
			  }
			  $sharedid=substr($sharedid,0,-1);
			  
			  if($_REQUEST['type']){$andddd=" and type='".$_REQUEST['type']."'";}
			  $getPicsQryRs=mysql_query("SELECT * FROM users_pics_videos WHERE id in($sharedid) $andddd ORDER BY id DESC");
			  $TotgetPics=mysql_affected_rows();
			  ?> 
			  	<? if($TotgetPics>0)
				  {
				   $count=0;
						while($getPicsQryRow=mysql_fetch_array($getPicsQryRs))
						{
						$array[$count]=$getPicsQryRow['picture'];
						
						
				  ?>
						
							<div class="row" style="width:95%;height:7%;padding-left:5%;padding-top:0.1%;margin-bottom:0.5%;">
					
								<img src="images/icon_headset.png" id="<? echo $getPicsQryRow['picture'];?>" style="width:5%;height:100%;display:inline-block" onclick="Playsong('<? echo $getPicsQryRow['picture'];?>','<? echo $count?>');"  ondblclick="Stopsong();"  />								
								 <div onclick="Playsong('<? echo $getPicsQryRow['picture'];?>','<? echo $count?>');"  ondblclick="Stopsong();"  style="height:100%;padding-top:1%;width:40%;color:white;font-size:0.9vw;overflow:hidden;display:inline-block;font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;line-height:100%;"><div style="height:80%; float:bottom;margin-bottom:1%;padding-top:0.9%;"><? echo $getPicsQryRow['picture'];?></div>
								 </div>
								
								
							</div>  	
						
						<? $count=$count+1; } ?>
					
		<? } ?>
		<? } ?>
	</div>

 </div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script language="javascript">
		var currentselected="";
		var selectedid=0;
		var jsArray = <? echo json_encode($array); ?>;
function Playsong(songname,songnumber) {
		var thissound = document.getElementById('songs');
		if(currentselected!=="")
		{
		document.getElementById(currentselected).src="images/icon_headset.png";
		}
		currentselected=songname;
		selectedid=songnumber;
		thissound.pause();
		thissound.currentTime = 0;
		document.getElementById(songname).src="images/icon_pause_sm.png";
		document.getElementById('songs').src="SafePicsVideos/"+songname;
		thissound.play();
	}
	
	function automatic()
	{
			if(selectedid!==jsArray.length)
			{
				playsong(jsArray[selectedid+1],selectedid+1);
			
			}else
			{
				playsong(jsArray[0],0);
			}
	
	}
	function Stopsong()
	{
	
	var thissound = document.getElementById('songs');
	document.getElementById(currentselected).src="images/icon_headset.png";
		thissound.pause();
		thissound.currentTime = 0;
	}

</script>
</body>
</html>