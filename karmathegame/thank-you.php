<? include("connect.php");
$TOPCONDENSE="YES";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/opening_styles.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<? include("top.php");?>
<div id="top_line"></div>
<br />
<div id="headline_titles"> </div>
<style type="text/css">
body{background-image:url('images/background3.png');background-color:#e6e6e6;background-position:top center; background-size:100%;background-repeat:no-repeat;background-attachment:fixed;background-border:0px 5px 0px 5px;}
</style>
<div id="pad_wrapper">
  	<div id="pad_selectavatar">
		<div id="bottom_border_newlife">
		  <p align="left">
		  <? if($_REQUEST['msg']){?>
		  	<? echo $_REQUEST['msg'];?>
		  <? }else{?>
		  	<br />Thank You!<br /><br />Please check your email and validate it to add life to your avatar.
		  <? }?>
		  <br /><br /><br /><br /><br /><br /><br /></p>
		</div>
	</div>
</div>
<? include("googleanalytic.php");?>
</body>
</html>