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
                                <img src="images/icon_bail.png" border="0">
                            </td>
                            <td width="52%">
                                <h1 style="text-align:left;">BAIL</h1>
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
        <table style="text-align:center;margin-left:auto;margin-right:auto;padding-bottom: 30px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"></table>
        <table style="text-align:center;margin-left:auto;margin-right:auto; background-color: #c1c1bf;" width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td>
                    <h1 style="text-align:center;font-size: 30px;color: black;">IF YOU WOULD LIKE TO DESTROY YOUR AVATAR AND DELETE THE PROFILE, YOU MAY CHECK THE BOX BELOW THEN PRESS THE DESTROY BUTTON. ALL CHATS, PICTURES, FRIENDS LINKS AND EMAILS WILL BE DELETED FROM THE SYSTEM. THIS CANNOT BE UNDEONE.</h1>
                </td>
             </tr>
            <tr>
                <td style="    padding: 30px;">
                <div style="">
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
                </td>
            </tr>
            <tr>
                <td style="padding-bottom: 20px;">
                    <input onclick="deleteAccount(<? echo $_SESSION['UsErIdFrOnT'];?>)" style="text-align:center;font-size: 40px; height: 100px;width: 350px;color: black;background-color: #870505;border: none;" type="button" value="DESTROY"/>
                </td>
            </tr>
            </tbody>
        </table>
        <input onclick="location.href='http://www.karmathegame.org/karmathegame/login.php';" style="text-align:center;font-size: 40px; height: 100px;width: 350px;color: black;background-color: #c1c1bf;border: none; margin-left: 50px;margin-top: 30px;" type="button" value="LOGOUT"/>
        <input onclick="hide_pop();return false;" style="text-align:center;font-size: 40px; height: 100px;width: 350px;color: black;background-color: #c1c1bf;border: none; float: right; margin-right: 50px;margin-top: 30px;" type="button" value="CANCEL"/>
    </div>
</div>
</body>
</html>