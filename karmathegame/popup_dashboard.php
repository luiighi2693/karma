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
			<div class="container2">
				
				<div class="row" style="padding-top:5%;height:20%;">
				  	<div  style="width: 40%; font-size:1.3vw;display:inline-block;"> What do you call yourself?</div>
				  	 <div style="width: 59%;display:inline-block;">
                                		<input type="text" name="username" id="username" class="inputbox" placeholder="<? echo GetUserName($_SESSION['UsErIdFrOnT']); ?>" style="width:60%"/>
                            		</div>
				</div>
				
				<div class="row" style="height20%;">
				  	<div  style="width: 40%; font-size:1.3vw;display:inline-block;height:100%;">  What will be your secret code?</div>
				  	 <div style="width: 59%;display:inline-block;">
                                		<input type="text" name="password" id="passwordUser" class="inputbox" placeholder="change your password" style="width:60%;height:100%;"/>
                            		</div>
				</div>
				<div class="row" style="height:20%;">
				  	<div  style="width: 40%; font-size:1.3vw;display:inline-block;height:100%;"> Tagline:</div>
				  	
				  	 <div style="width: 59%;display:inline-block;">
                                		<textarea name="aboutme" id="aboutmeUser" class="inputbox" placeholder="Funny man seeks wonderful woman for love and passion" style="width:60%"></textarea>              </div>
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
		<div class="button">
                                <input style="width: 100%;"  type="image" name="saveuserpass" id="saveuserpass" src="images/button_save.png" onClick="frmupdatesave();" />
                </div>
	</div>
</body>