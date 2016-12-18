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
.singup_contNew {
	color: #3f3f3f;
	font-weight: normal;
}
div.scrollcontain {
	overflow:auto;
	clear:both;
}
div.scrollable { 
    position:relative; 
    overflow:hidden; 
    width: 100%; 
    height:600px;
	float:left;
} 
div.scrollable div.items { 
    width:20000em; 
    position:absolute; 
	background-color:#FFFFFF;
}  
div.scrollable div.items div.oneitem { 
    float:left; 
} 
h2.scrollitem {
	font-size:12px;
	font-weight: bold;
}
div.items a {
	text-decoration: none;	
} 
div.items div:hover {
	
} 
div.items div.active { 
    
}
a.browse div.arrow {
	display:block;
}
a.prevPage:hover div.arrow{	
}
a.nextPage div.arrow{	
}
a.nextPage:hover div.arrow{
}
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

</style>
<body style="background:<? echo $_REQUEST['color1'];?>;">
<div class="scrollcontain"> 
<div class="SliderName_2Description"  style="background:<? echo $_REQUEST['color1'];?>;">
<? echo GetUserName(mysql_real_escape_string($_REQUEST['userid_from']));?><br /><? echo stripslashes(GetName1("users","aboutme","id",mysql_real_escape_string($_REQUEST['userid_from'])));?>
</div>

  <div class="scrollable" id="scrollable_ID">
    <a class="prevPage browse left"><div class="SliderNamePrev_2"></div></a>
	<div id="items" class="items">
     <?
		  $GetsharedPicRs=mysql_query("SELECT * FROM users_pics_videos_share WHERE  userid_from='".mysql_real_escape_string($_REQUEST['userid_from'])."' and userid_to='".mysql_real_escape_string($_REQUEST['userid_to'])."'");
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
						while($getPicsQryRow=mysql_fetch_array($getPicsQryRs))
						{
				  ?>
      						<div class="oneitem"> <a  href="#">
							<? if($getPicsQryRow['type']=='Picture'){?>
								<img class="wheel_img_border"  src="<? echo "SafePicsVideos/".$getPicsQryRow['picture']."";?>" id="IMG_<? echo $getPicsQryRow['id'];?>" onload="resizeheight('IMG_<? echo $getPicsQryRow['id'];?>')"  border="0"  />
							<? }?>
							<? if($getPicsQryRow['type']=='Video'){?>
								<img class="wheel_img_border" src="images/icon-player.png" id="IMG_<? echo $getPicsQryRow['id'];?>" onload="resizeheight('IMG_<? echo $getPicsQryRow['id'];?>')"  border="0"  />
							<? }?>
							<? if($getPicsQryRow['type']=='Music'){?>
								<img class="wheel_img_border" src="images/icon-player.png" id="IMG_<? echo $getPicsQryRow['id'];?>" onload="resizeheight('IMG_<? echo $getPicsQryRow['id'];?>')"  border="0"  />
							<? }?>
							</a></div>
	 				 <? } ?>
				 <? } ?>	 		
        <? } ?>
    </div>
  </div>
  <a class="nextPage browse right"><div class="SliderNameNext_2"></div></a> 
  
  </div>
</body>
<script type="text/javascript" charset="utf-8">
$(document).ready(function () {
	$("div.scrollable").scrollable({
		size:1
	});

	for(var i =0; i	< document.getElementById('items').childElementCount; i++){
		//console.log(document.getElementById('items').children[i].children[0].children[0].id);
		resizeheight(document.getElementById('items').children[i].children[0].children[0].id);
	}
});
function resizeheight(imgid)
{
   document.getElementById(imgid).style.height=(screen.height-50)+"px";
}
document.getElementById('scrollable_ID').style.height=(screen.height-110)+"px";
</script>
</html>