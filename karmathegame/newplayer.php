<? include("connect.php");
$TOPCONDENSE="YES";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/opening_styles.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body >
<? include("top.php");?>
<div id="top_line"></div><br />
<div id="headline_titles"> </div>
<style type="text/css">body{background-image:url('images/background3.png');background-color:#e6e6e6;background-position:top center; background-size:100%;background-repeat:no-repeat;background-attachment:fixed;background-border:0px 5px 0px 5px;}</style>
<div id="pad_wrapper_newlife">
  <div id="pad_newlife_fullwidth">
    <h1>ARE YOU READY? </h1>
    <br>
    <div id="login_box_newlife" style="text-align:center;">
        <img src="images/newplayer-holder.png" border="0" usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="3,5,209,325" href="selectavatar.php?grp=2" /><area shape="rect" coords="299,2,514,321" href="selectavatar.php?grp=1" /><area shape="rect" coords="607,5,812,326" href="selectavatar.php?grp=3" /></map>
    </div>
    
    <div id="bottom_border_newlife" style="padding:15px;">
      <p><h1>What is most important to you when considering a relationship?</h1></p>
    </div>
    <!-- end #bottom_border -->
  </div>
  
  <div align="right" style="padding-bottom:10px;">
  	<table  border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="right" valign="top" style="vertical-align:top;padding-right:3px;padding-top:3px;"><a href="http://bit.ly/1xguKig" target="_blank"><img src="images/quick-guide.jpg" align="texttop" border="0" /></a></td>
		<td align="right" valign="top"><img src="images/guru-icon-corner.jpg" /></td>
	  </tr>
	</table>

  </div>
  <!-- end of #pad -->
</div>
<? include("googleanalytic.php");?>
</body>
</html>