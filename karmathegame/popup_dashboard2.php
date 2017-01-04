<? include("connect.php");
include("checklogin.php");
$avatarlogo = stripslashes(GetName1("avatars", "picture", "id", $CURRENTgetuserwryRow['avatarid']));
$msg = "Updated Successfully!";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title><? echo $SITE_TITLE;?></title>
	<link href="css/style_popups.css?id=<? echo rand();?>" rel="stylesheet" type="text/css" />
</head>
<body >
	<div class="header">
		<div class="top_info">
			<div class="icon_holder">
				
				<? if($_REQUEST['iconcolor']=="white"){?><img src="images/icon_gears.png" /><? }else{?><img src="images/icon_gears_black.png"  /><? } ?>
			</div>
			<div class="text_holder">
				Welcome to Karma the Game of Destiny
			</div>
			
		</div>
	</div>	<!-- the header ends -->
	<div class="middlesection" style="heig">
		<div class="centered_info" >
			<div class="avatar_pic">
				 <? if ($CURRENTgetuserwryRow['avatarid'] != '') {
                            $avatarlogo = stripslashes(GetName1("avatars", "picture", "id", $CURRENTgetuserwryRow['avatarid'])); ?>
                            <img src="Avatars/<? echo $avatarlogo; ?>" style="width: 100%;"/>
                        <? } ?>
			</div>
			<div class="container2" style="padding-top:5%;">
				
				<div style="width: 80%;margin-left: 10%; margin-right: 10%; height: 48%">
                    <div class="dashboard_whitetext" style="width: 100%; display:flex; font-size:1.5vw;height:45%;   margin-bottom: 3%;">
                        You can start anytime and reach out to anyone, but it's a good
                        idea to fill in some of the questions in your JourneyBook.
                        <a href="journeystats.php"><img
                                src="images/icon_journeybook.png" align="right"
                                height="100%" border="0"></a>
                    </div>
                    <div class="dashboard_whitetext" style="width: 100%; display: flex;font-size:1.5vw;height:45%;    margin-bottom: 1%;">
                        Once you let the Game Guru know who you are and who you'd like
                        to meet, your Potential Soulmates can be recalculated to bring
                        you closer to the people who are looking to play the Game with
                        someone like you...
                    </div>
                </div>
			</div>
		</div>
	</div>
	
	<div class="footer">
	<div class="centered_info">
	<input type="hidden" name="Hidsubmit" id="Hidsubmit" value="0"/>
		<div class="button">
			<a href="#" onclick="hide_pop();return false;">
				<img src="images/button_close.png" border="0" />
			</a>
		</div>
		
	</div>
</body>
</html>