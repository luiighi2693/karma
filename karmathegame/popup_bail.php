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
<body style="text-align: center;">
<div id="main_menu" style="font-size: 0vh; width: 100%; ">
    <div class="header">
        <div class="top_info">
            <div class="icon_holder">
                <? if($_REQUEST['iconcolor']=="white"){?><img src="images/icon_bail.png" /><? }else{?><img src="images/icon_bail_black.png"  /><? } ?>
            </div>
            <div class="text_holder">
               bail
            </div>
            
        </div>
    </div>

    <div class="middlesection" style="height:70%;">
        <div class="centered_info">
            <div style="margin-top:2%;text-align:center;margin-left:auto;margin-right:auto; background-color: #c1c1bf; width: 70%;">
                <h1 style="text-align:center;font-size: 3vh;color: black;    padding-top: 1%;">IF YOU WOULD LIKE TO DESTROY YOUR AVATAR AND DELETE THE PROFILE, YOU MAY CHECK THE BOX BELOW THEN PRESS THE DESTROY BUTTON. ALL CHATS, PICTURES, FRIENDS LINKS AND EMAILS WILL BE DELETED FROM THE SYSTEM. THIS CANNOT BE UNDONE.</h1>

                <div style="    width: 100%;padding-top: 3%;padding-bottom: 5%;padding-right:2%;">
                    <input id="checkboxToDeleteAccount" style="zoom:2;
			  transform:scale(2);
			  -ms-transform:scale(2);
			  -webkit-transform:scale(2);
			  -o-transform:scale(2);
			  -moz-transform:scale(2);
			  transform-origin:0 0;
			  -ms-transform-origin:0 0;
			  -webkit-transform-origin:0 0;
			  -o-transform-origin:0 0;
			  -moz-transform-origin:0 0;
			  -webkit-transform-origin:0 0;" type=checkbox />
                </div>

                <div style="padding-bottom: 4%;">
                    <input onclick="deleteAccount(<? echo $_SESSION['UsErIdFrOnT'];?>)" style="text-align:center;font-size: 2vh; height: 15%;width: 25%;color: black;background-color: #870505;border: none;" type="button" value="DESTROY"/>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
    <div class="centered_info">
      
       
        <div class="button">
			<a href="#" onclick="hide_pop();return false;">
				<img src="images/button_cancel.png" border="0" />
			</a>
		</div>
		<div class="button">
			<input  onclick="location.href='http://www.karmathegame.org/karmathegame/login.php';"  type="image" value="LOGOUT" src="images/button_logout.png"  />
	</div>
	</div>
	 
    </div>
</div>
</body>
</html>