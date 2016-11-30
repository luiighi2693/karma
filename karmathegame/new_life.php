<? include("connect.php");
$LeftMenu='NEW LIFE';
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
<style type="text/css">body{background-image:url('images/background3.png');background-color:#e6e6e6;background-position:top center; background-size:100%;background-repeat:no-repeat;background-attachment:fixed;background-border:0px 5px 0px 5px;}</style>
  <? include("left.php");?>
  <div id="center_content">
    <div id="pad">
      <h1>GETTING STARTED</h1>
      <br>
      <p>1. For Rules go to the Rules link on the left.</p>
      <br>
      <p>2. You must be over 18 to play.</p>
      <br>
      <p>3. On the next screen you will enter your desired Username and Password.</p>
      <br>
      <p>4. VERY IMPORTANT.  You must choose which door you will enter into the Game.</p>
      <br>
      <p>5. Pick your avatar!</p>
      <br>
      <p>6. Pay $1.99 for 1 life, good for upto 30 days. (See Rules)</p>
      <br>
      <p>7. Enter Karma - the Game of Destiny.</p>
      <br>
      <p>Don't forget.  Use your JourneyBook to define who you are and what you want.  The more questions you answer the more you will narrow your search and find your true soulmates.  Also you will be able to upload your pictures, videos and writings into your "safe" for sharing at your discretion.  No one will be able to see your pictures or video until you let them and all files are deleted if you allow your avatar to be terminated.
      <p> 
    </div>
    <input name="choose" type="button" value="NEW LIFE" onClick="window.location.href='newplayer.php'">
  </div>
  <!-- end #center_content -->
  <div id="right_content"> </div>
  <!-- end #right_content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js?ver=1.6.1"></script>
<script language="javascript">
$(document).ready(function(){ resizeDiv();});
window.onresize = function(event) {resizeDiv();}
function resizeDiv() 
{
	vpw = $(window).width();
	vph = $(window).height();
	vph=vph-180;
	$('#pad').css({'height': vph + 'px'});
}
</script>
<? include("googleanalytic.php");?>
</body>
</html>