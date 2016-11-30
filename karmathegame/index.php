<? include("connect.php");
if($_SERVER['HTTP_HOST']!="yogs")
{
	$sitepathh=$_SERVER['HTTP_HOST'];
	$tempp=substr($sitepathh,0,3);
	if($tempp!="www")
	{
		header("location:$SITE_URL/index.php");
	}
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><? echo $SITE_TITLE;?></title>
<link href="css/opening_styles.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<? include("top.php");?>
<div id="top_line"></div>
<div id="headline_titles">
<style type="text/css">body{background-image:url('images/background1.png');background-color:#e6e6e6;background-position:top center; background-size:100%;background-repeat:no-repeat;background-attachment:fixed;background-border:0px 5px 0px 5px;}</style>
  <? include("left.php");?>
  <div id="center_content"> </div>
  <div id="right_content"> </div>
</div>
<? include("googleanalytic.php");?>
</body>
</html>