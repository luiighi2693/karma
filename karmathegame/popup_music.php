<? include("connect.php");
include("checklogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="css/opening_styles.css">
    <title></title>
</head>
<body>
<div id="main_menu">
	<div style="width:80% text-align:center margin-bottom: 50px;" >
	
	<table style="text-align:center;margin-left:auto;margin-right:auto;" width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
	<tr>
		<td class="bottmborder_white">
		<br />
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			<td width="8%" align="left">
			<img src="images/icon_music.png" border="0">
			</td>
			<td width="52%">
				<h1 style="text-align:left;">MUSIC SHARE</h1>
			</td>
			<td width="10%" align="right">
				<a href="#" onclick="hide_pop();return false;">
				<img src="images/popup_close.png" border="0">
			</td>
			</tr>
		</table>
		<br />
		</td>
		<br />
	</tr>
	</tbody>
	</table>	 
	</div>
	
	<div style="width:50%;margin-left:25%;height:50px;margin-top:4%;">
	<input id="searchMusicText" style="width:69%; height:100%; padding-left:5%; font-size:20px;display:inline-block;vertical-align:top;" placeholder=""/>
	<img src="images/send-button.png" style="width:29%; height:100%; display:inline-block;float:top;" onclick="shareMusic(<? echo $_SESSION['UsErIdFrOnT'].','.$_REQUEST['id']?>)"/>
	</div>
	
	<div style="width:50%;margin-left:25%;height:40%;margin-top:4%;">
	
		<div style="height:49%;width: 100%;margin-bottom:2%;">
			<div id="youtube" style="height:100%; ;width:39%;  display:inline-block;margin-right:1%;">
			<img src="images/youtube.jpg" style="width:100%; height:100%;">
			</div>
			<div style="height:100% ;width: 59%;background:black;display:inline-block;">
			<img src="images/spotify.jpg" style="width:100%; height:100%;">
			</div>
		
		</div>
	
		<div style="height:49%; ;width:100% ;">
		
			<div id="pandora" style="height:100% ;width: 59%;background:blue;display:inline-block;margin-right:1%;">
			<img src="images/pandora.jpg" style="width:100%; height:100%;">
			</div>
			<div style="height:100%; ;width:39%; display:inline-block;">
			
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
</body>
</html>