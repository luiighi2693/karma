<? include("connect.php");
include("checklogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><? echo $SITE_TITLE;?></title>
	<link href="css/style_popups.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
</head>
<body style="text-align:center;">
<div class="header">
	<div class="top_info">
		<div class="icon_holder">
			<img src="images/icon_music.png" border="0" alt="">
		</div>
		<div class="text_holder">
			music share
		</div>
	</div>
</div>

<div class="middlesection" style="width: 100%; height: 74%;">
	<div class="centered_info">
		<div style="width:50%;margin-left:25%;height:50px;margin-top:4%;">
			<input id="searchMusicText" style="width:100%; height:100%; padding-left:5%; font-size:20px;display:inline-block;vertical-align:top;" placeholder="enter a song name.."/>
		</div>

		<div style="width:50%;margin-left:25%;height:40%;margin-top:4%;">

			<div style="height:100%; width:100% ;">
				<div style="height:100% ;width: 50%;display:inline-block;margin-right:1%; ">
					<img src="images/youtube.jpg" style="width:100%; height:100%;">
				</div>
				<div style="height:100%; ;width:48%; display:inline-block;">
					<div style="height:49%;width:100%;margin-bottom:1.5%;float:top;">
						<img src="images/itunes.jpg" style="width:100%; height:100%;"/>
					</div>
					<div style="height:49%;width:100%;">
						<img src="images/amazon.png" style="width:100%; height:100%;"/>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<div class="footer">
	<div class="centered_info">
		<div class="button" >
			<a href="#" onclick="hide_pop();return false;">
				<img alt="" src="images/button_close.png" border="0" style="width: 100%;"/>
			</a>
		</div>
		<div class="button" >
			<input  style="width: 100%;" type="image" name="sendbutton" id="sendbutton" src="images/button_send.png" onclick="shareMusic(<? echo $_SESSION['UsErIdFrOnT'].','.$_REQUEST['id']?>);" />
		</div>
		<span id="MessageId" style="color:#FF0000;"></span>
	</div>

</body>
</html>